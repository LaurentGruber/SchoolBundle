<?php

namespace Laurent\SchoolBundle\Controller;

use Laurent\SchoolBundle\Entity\ChapitrePlanMatiere;
use Laurent\SchoolBundle\Entity\PlanMatiere;
use Laurent\SchoolBundle\Entity\PointMatiere;
use Claroline\CoreBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Claroline\CoreBundle\Persistence\ObjectManager;
use Claroline\CoreBundle\Manager\UserManager;


class PlanMatiereSchoolController extends Controller
{
    private $om;
    private $authorization;
    private $tokenStorage;
    private $userManager;

    /**
     * @DI\InjectParams({
     *     "om"            = @DI\Inject("claroline.persistence.object_manager"),
     *     "userManager"   = @DI\Inject("claroline.manager.user_manager"),
     *     "authorization" = @DI\Inject("security.authorization_checker"),
     *     "tokenStorage"  = @DI\Inject("security.token_storage")
     * })
     */

    public function __construct(
        ObjectManager $om,
        AuthorizationCheckerInterface $authorization,
        TokenStorageInterface $tokenStorage,
        UserManager $userManager
    )
    {
        $this->om = $om;
        $this->authorization = $authorization;
        $this->tokenStorage = $tokenStorage;
        $this->userManager = $userManager;
        $this->groupRepo = $om->getRepository('ClarolineCoreBundle:Group');
    }

    /**
     * @EXT\Route("/pl", name="laurentSchoolPlanMatiereList")
     * @EXT\Template("LaurentSchoolBundle::planMatiereList.html.twig")
     */

    public  function planMatiereListAction()
    {
        $this->checkOpen();
        $plRepository = $this->getDoctrine()->getRepository('LaurentSchoolBundle:PlanMatiere');
        $user = $this->tokenStorage->getToken()->getUser();
        $plmatieres = $plRepository->findUserPlanMatiere($user);

        return array('plmatieres'=> $plmatieres);
    }

    /**
     * @EXT\Route(
     *     "/pl/create/form",
     *     name="laurentSchoolPlanMatiereCreateForm",
     *     options = {"expose"=true}
     * )
     * @EXT\Method("GET")
     * @EXT\Template("LaurentSchoolBundle::planMatiereCreateForm.html.twig")
     *
     * Displays the admin homeTab form.
     *
     * @return Response
     */
    public function planMatiereCreateFormAction()
    {
        //$this->checkOpen();

        $form = $this->createFormBuilder()
            ->add('name', 'text', array('label' => 'Nom'))
            ->add(
                     'matiere',
                     'entity',
                     array(
                         'label' => 'Matière',
                         'class' => 'LaurentSchoolBundle:Matiere',
                         'property' => 'viewName',
                         'required' => false
                     )
                )
            ->add('refProgramme', 'text', array('label' => 'Référence programme'))
            ->getForm()
        ;

        return array('form' => $form->createView());
    }

    /**
     * @EXT\Route(
     *     "/pl/create",
     *     name="laurentSchoolPlanMatiereCreate",
     *     options = {"expose"=true}
     * )
     * @EXT\Method("POST")
     * @EXT\Template("LaurentSchoolBundle::planMatiereCreateForm.html.twig")
     *
     * Create a new Plan Matiere
     *
     * @return array|Response
     */
    public function planMatiereCreateAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('name', 'text', array('label' => 'Nom'))
            ->add(
                'matiere',
                'entity',
                array(
                    'label' => 'Matière',
                    'class' => 'LaurentSchoolBundle:Matiere',
                    'property' => 'viewName',
                    'required' => false
                )
            )
            ->add('refProgramme', 'text', array('label' => 'Référence programme'))
            ->getForm()
            ;
        $form->handleRequest($request);


        if ($form->isValid()) {
            $em = $this->get('doctrine')->getManager();
            $planMatiere = new PlanMatiere;
            $planMatiere->setName($form["name"]->getData());
            $planMatiere->setMatiere($form["matiere"]->getData());
            $planMatiere->setRefProgramme($form["refProgramme"]->getData());
            $user = $this->tokenStorage->getToken()->getUser();
            $planMatiere->addProf($user);
            $em->persist($planMatiere);
            $em->flush();

            return new Response('success', 201);
        }
        return array('form' => $form->createView());
    }

    /**
     * @EXT\Route("/pl/{planMatiere}", name="laurentSchoolPlanMatiere")
     * @param PlanMatiere $planMatiere
     * @EXT\Template("LaurentSchoolBundle::planMatiere.html.twig")
     */

    public  function planMatiereAction(PlanMatiere $planMatiere)
    {
        $this->checkOpen();
        $pl = $planMatiere;
        $chapitres = $this->getDoctrine()->getManager()->getRepository('LaurentSchoolBundle:ChapitrePlanMatiere')->findChapitrePlanMatiere($pl);
        $total = 0;
        foreach ($chapitres as $chapitre)
        {
            $total += $chapitre->getNbPeriode();
        }
        $matiere = $pl->getMatiere();
        $nbHsem = $matiere->getNbPeriode();
        $nbH = $nbHsem * 26;

        //$pointMatieres = $this->getDoctrine()->getManager()->getRepository('LaurentSchoolBundle:PointMatiere')->findAll();

        return array('pl' => $pl, 'nbH' => $nbH, 'chapitres' => $chapitres, 'total' => $total);
    }

    /**
     * @EXT\Route(
     *     "/pl/{planMatiere}/chap/create",
     *     name="laurentSchoolPlanMatiereChapCreate",
     *     options = {"expose"=true}
     * )
     * @EXT\Method("POST")
     * @EXT\Template("LaurentSchoolBundle::planMatiereCreateChapForm.html.twig")
     *
     * Create a new chapite in Plan Matiere
     *
     * @param PlanMatiere $planMatiere
     *
     * @return array|Response
     */
    public function planMatiereCreateChapAction(Request $request, PlanMatiere $planMatiere)
    {
        $mois = array('1' => 'Janvier',
                      '2' => 'Février',
                      '3' => 'Mars',
                      '4' => 'Avril',
                      '5' => 'Mai',
                      '6' => 'Juin',
                      '7' => 'Juillet',
                      '8' => 'Août',
                      '9' => 'Septembre',
                      '10' => 'Octobre',
                      '11' => 'Novembre',
                      '12' => 'Décembre');

        $form = $this->createFormBuilder()
            ->add('name', 'text', array('label' => 'Nom'))
            ->add('nbPeriode', 'number', array('label'=> 'Nombre de période', 'required'  => false))
            ->add('ordre', 'number', array('label' => 'Ordre', 'required'  => false))
            ->add('annee', 'number', array('label' => 'Annee', 'required'  => false))
            ->add('moment', 'choice', array('label' => 'Moment', 'choices' => $mois, 'required'  => false))
            ->getForm()
        ;
        $form->handleRequest($request);


        if ($form->isValid()) {
            $em = $this->get('doctrine')->getManager();
            $chapitre = new ChapitrePlanMatiere;
            $chapitre->setName($form["name"]->getData());
            $chapitre->setNbPeriode($form["nbPeriode"]->getData());
            $chapitre->setOrdre($form["ordre"]->getData());
            $chapitre->setMoment($form["moment"]->getData());
            $chapitre->setAnnee($form["annee"]->getData());
            $chapitre->setPlanMatiere($planMatiere);
            $em->persist($chapitre);

            $em->flush();

            return new Response('success', 201);
        }

        return array('form' => $form->createView(), 'pl' => $planMatiere);
    }

    /**
     * @EXT\Route(
     *     "/pl/{chap}/pm/create",
     *     name="laurentSchoolPlanMatierePMCreate",
     *     options = {"expose"=true}
     * )
     * @EXT\Method("POST")
     * @EXT\Template("LaurentSchoolBundle::planMatiereCreatePMForm.html.twig")
     *
     * Create a new chapite in Plan Matiere
     *
     * @param ChapitrePlanMatiere $chap
     *
     * @return array|Response
     */
    public function planMatiereCreatePointMatiereAction(Request $request, ChapitrePlanMatiere $chap)
    {

        $form = $this->createFormBuilder()
            ->add('name', 'text', array('label' => 'Nom'))
            ->add('nbPeriode', 'number', array('label'=> 'Nombre de période', 'required'  => false))
            ->add('ordre', 'number', array('label' => 'Ordre', 'required'  => false))
            ->getForm()
        ;
        $form->handleRequest($request);


        if ($form->isValid()) {
            $em = $this->get('doctrine')->getManager();
            $pm = new PointMatiere;
            $pm->setName($form["name"]->getData());
            $pm->setNbPeriode($form["nbPeriode"]->getData());
            $pm->setOrdre($form["ordre"]->getData());
            $pm->addChapitre($chap);
            $em->persist($pm);
            $em->flush();

            return new Response('success', 201);
        }

        return array('form' => $form->createView(), 'chap' => $chap);
    }

    /**
     * @EXT\Route(
     *     "/prof/users/page/{page}",
     *     name="laurent_plan_matiere_list_prof",
     *     options={"expose"=true},
     *     defaults={"page"=1, "search"=""}
     * )
     * @EXT\Method("GET")
     * @EXT\ParamConverter("user", options={"authenticatedUser" = true})
     * @EXT\Template()
     *
     *
     * Displays the list of users that the current user can send a message to,
     * optionally filtered by a search on first name and last name
     *
     * @param integer $page
     * @param string  $search
     * @param User    $user
     *
     * @return Response
     */
    public function profUsersListAction(User $user, $page, $search)
    {
        $trimmedSearch = trim($search);
        $group = $this->groupRepo->findOneByName('Prof');
        #throw new \Exception($group->getName());
        #$group = $this->groupRepo->findOneBy(array('id' => '1'));
        #$logger = $this->get('logger');
        #$logger->info('Local variables', get_defined_vars());


        if ($user->hasRole('ROLE_PROF') or ($user->hasRole('ROLE_ADMIN'))) {
            if ($trimmedSearch === '') {
                $users = $this->userManager->getUsersByGroup($group ,$page);
                #$users = $this->userManager->getAllUsers($page, $max = 50);
            } else {
                $users = $this->userManager
                    ->getAllUsersBySearch($page, $trimmedSearch);
            }
        }

        return array('users' => $users, 'search' => $search);
    }


    private function checkOpen()
    {
        if ($this->authorization->isGranted('ROLE_PROF')) {
            return true;
        }

        throw new AccessDeniedException();
    }

}