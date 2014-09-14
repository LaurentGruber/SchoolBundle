<?php

namespace Laurent\SchoolBundle\Controller;

use Claroline\CoreBundle\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use Symfony\Component\HttpFoundation\Request;
use Laurent\SchoolBundle\Entity\Classe;
use Claroline\CoreBundle\Entity\Group;
use JMS\DiExtraBundle\Annotation as DI;
use Claroline\CoreBundle\Library\Workspace\Configuration;
use Claroline\CoreBundle\Manager\ToolManager;
use Claroline\CoreBundle\Manager\RoleManager;
use Claroline\CoreBundle\Manager\UserManager;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Constraints\True;


class AdminSchoolController extends Controller
{
    private $sc;
    private $toolManager;
    private $roleManager;
    private $userManager;
    private $om;

    /**
     * @DI\InjectParams({
     *      "sc"                 = @DI\Inject("security.context"),
     *      "toolManager"        = @DI\Inject("claroline.manager.tool_manager"),
     *      "roleManager"        = @DI\Inject("claroline.manager.role_manager"),
     *      "userManager"        = @DI\Inject("claroline.manager.user_manager"),
     *      "om"                 = @DI\Inject("claroline.persistence.object_manager")
     * })
     */

    public function __construct(
        SecurityContextInterface $sc,
        ToolManager $toolManager,
        RoleManager $roleManager,
        UserManager $userManager,
        ObjectManager $om
    )
    {
        $this->sc                 = $sc;
        $this->toolManager        = $toolManager;
        $this->roleManager        = $roleManager;
        $this->workspaceAdminTool = $this->toolManager->getAdminToolByName('laurent_school_admin_tool');
        $this->userManager = $userManager;
        $this->om = $om;
    }


    /**
     * @EXT\Route("/admin/menu", name="laurentAdminSchoolMenu")
     * @EXT\Template("LaurentSchoolBundle::adminSchoolMenu.html.twig")
     */
    public  function adminSchoolMenuAction()
    {
        $this->checkOpen();
        return array();
    }

    /**
     * @EXT\Route("/admin/cs", name="laurentAdminSchoolCS")
     * @EXT\Template("LaurentSchoolBundle::cs.html.twig")
     */
    public function adminSchoolCSAction()
    {
        return array();
    }

    /**
     * @EXT\Route("/import/classes", name="laurentAdminSchoolImportClasses")
     * @EXT\Template("LaurentSchoolBundle::adminSchoolImportView.html.twig")
     */
    public function adminSchoolImportClassesAction(Request $request)
    {
        $this->checkOpen();
        $em = $this->get('doctrine')->getManager();
        $om = $this->container->get('claroline.persistence.object_manager');
        $repository = $em->getRepository('LaurentSchoolBundle:Classe');
        $templateDir=$this->container->getParameter('claroline.param.templates_directory');
        $this->workspaceManager = $this->container->get('claroline.manager.workspace_manager');
        $this->workspaceRepo = $om->getRepository('ClarolineCoreBundle:Workspace\Workspace');
        $this->rightsManager = $this->container->get('claroline.manager.rights_manager');
        $this->ressourceNodeRepo = $om->getRepository('ClarolineCoreBundle:Resource\ResourceNode');


        $form = $this->createFormBuilder()
            ->add('fichier', 'file', array('label' => 'Fichier CSV'))
            ->add('envoyer', 'submit', array('attr' => array('class' => 'btn btn-primary')))
            ->getForm()
         ;

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                $messages = array();
                $fichier = $form->get('fichier')->getNormData();
                $file = fopen($fichier->getPathname(), 'r');
                $om->startFlushSuite();

                while (($classeCsv = fgetcsv($file)) !== FALSE && is_array($classeCsv) && count($classeCsv) === 4) {
                    $code = $classeCsv[0];
                    $name = $classeCsv[1];
                    $degre = $classeCsv[2];
                    $annee = $classeCsv[3];
                    if (!$repository->findOneByCode($code)){
                        $config = Configuration::fromTemplate(
                            $templateDir . 'default.zip'
                        );
                        $config->setWorkspaceName($name);
                        $config->setWorkspaceCode($code);
                        $config->setDisplayable(true);
                        $config->setSelfRegistration(false);
                        $config->setSelfUnregistration(false);
                        $config->setWorkspaceDescription('');

                        $user = $this->userManager->getUserById(1);
                        $workspace = $this->workspaceManager->create($config, $user);
                        $nameRoleProf = 'ROLE_WS_PROF_'.$workspace->getGuid();
                        $nameRoleEleve = 'ROLE_WS_ELEVE_'.$workspace->getGuid();
                        $roleProf = $this->roleManager->createWorkspaceRole($nameRoleProf, 'Prof', $workspace, $isReadOnly = True);
                        $roleEleve = $this->roleManager->createWorkspaceRole($nameRoleEleve, 'Élève', $workspace, $isReadOnly = True);
                        $this->om->forceFlush();

                        $toolHome = $this->toolManager->getOneToolByName('home');
                        $this->toolManager->addRole($toolHome, $roleProf, $workspace);
                        $this->toolManager->addRole($toolHome, $roleEleve, $workspace);
                        $toolRessource = $this->toolManager->getOneToolByName('resource_manager');
                        $this->toolManager->addRole($toolRessource, $roleProf, $workspace);
                        $this->toolManager->addRole($toolRessource, $roleEleve, $workspace);
                        $toolAgenda = $this->toolManager->getOneToolByName('agenda');
                        $this->toolManager->addRole($toolAgenda, $roleProf, $workspace);
                        $this->toolManager->addRole($toolAgenda, $roleEleve, $workspace);
//                        $toolMyBadges = $this->toolManager->getOneToolByName('my_badges');
//                        $this->toolManager->addRole($toolMyBadges, $roleProf, $workspace);
//                        $this->toolManager->addRole($toolMyBadges, $roleEleve, $workspace);
                        $toolActivity = $this->toolManager->getOneToolByName('claroline_activity_tool');
                        $this->toolManager->addRole($toolActivity, $roleProf, $workspace);
                        $this->toolManager->addRole($toolActivity, $roleEleve, $workspace);

                        $toolUsers = $this->toolManager->getOneToolByName('users');
                        $this->toolManager->addRole($toolUsers, $roleProf, $workspace);
//                        $toolBadges = $this->toolManager->getOneToolByName('badges');
//                        $this->toolManager->addRole($toolBadges, $roleProf, $workspace);
//                        $toolQuestions = $this->toolManager->getOneToolByName('ujm_questions');
//                        $this->toolManager->addRole($toolQuestions, $roleProf, $workspace);
                        $toolParcours = $this->toolManager->getOneToolByName('innova_path');
                        $this->toolManager->addRole($toolParcours, $roleProf, $workspace);

                        $node = $this->ressourceNodeRepo->findWorkspaceRoot($workspace);
                        $this->rightsManager->editPerms(1, $roleEleve, $node, $isRecursive = True);

                        $this->rightsManager->editPerms(31, $roleProf, $node, $isRecursive = True);

                        //$ids = array(1);
                        //$resourceTypes = $ids === null ?
                        //    array() :
                        //    $this->om->findByIds('ClarolineCoreBundle:Resource\ResourceType', array_keys($ids));
                        //$this->rightsManager->editCreationRights($resourceTypes, $roleProf, $node, $isRecursive = True);

                        $group = new Group();
                        $group->setName($code);
                        $em->persist($group);

                        $classe = new Classe;
                        $classe->setCode($code);
                        $classe->setName($name);
                        $classe->setDegre($degre);
                        $classe->setAnnee($annee);
                        $classe->setWorkspace($workspace);
                        $classe->setGroup($group);
                        $em->persist($classe);

                        $messages[] = "La classe $code a bien été ajoutée et l'espace d'activité correspondant créé.";
                    }
                    else {
                        $messages[] = "<b>La classe $code existe déjà rien n'a été fait.</b>";
                    }
                }

                $om->endFlushSuite();
                fclose($file);
                $content = $this->renderView('LaurentSchoolBundle::adminSchoolImportView.html.twig',
                    array('form' => $form->createView(),
                        'titre' => 'classes',
                        'action' => $this->generateUrl('laurentAdminSchoolImportClasses'),
                        'messages' => $messages
                    ));

                return new Response($content);
            }
        }

        return array('form' => $form->createView(),
            'titre' => 'classes',
            'action' => $this->generateUrl('laurentAdminSchoolImportClasses'),
            'messages' => ''
        );
    }

    /**
     * @EXT\Route("/import/eleveInClasses", name="laurentAdminSchoolImportElevesInClasses")
     * @EXT\Template("LaurentSchoolBundle::adminSchoolImportView.html.twig")
     */
    public function adminSchoolImportElevesInClassesAction(Request $request)
    {
        $this->checkOpen();
        $em = $this->get('doctrine')->getManager();
        $om = $this->container->get('claroline.persistence.object_manager');
        $classeRepo = $em->getRepository('Laurent\SchoolBundle\Entity\Classe');
        $this->workspaceRepo = $om->getRepository('ClarolineCoreBundle:Workspace\Workspace');
        $this->roleManager = $this->container->get('claroline.manager.role_manager');
        $this->roleRepo = $om->getRepository('ClarolineCoreBundle:Role');

        $form = $this->createFormBuilder()
            ->add('fichier', 'file', array('label' => 'Fichier CSV'))
            ->add('envoyer', 'submit', array('attr' => array('class' => 'btn btn-primary')))
            ->getForm()
        ;

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                $messages = array();
                $fichier = $form->get('fichier')->getNormData();
                $file = fopen($fichier->getPathname(), 'r');
                $this->om->startFlushSuite();

                while (($elevesCsv = fgetcsv($file)) !== FALSE && is_array($elevesCsv) && count($elevesCsv) === 2) {
                    $username = $elevesCsv[0];
                    $classeCode = $elevesCsv[1];
                    $classe = $classeRepo->findOneByCode($classeCode);
                    $workspace = $classe->getWorkspace();
                    $roleEleve = $this->roleRepo->findRoleByWorkspaceCodeAndTranslationKey($workspace->getCode(), 'Élève');

                    //throw new \Exception($this->userManager->getUserByUsername($username)->getId());

                    if ($this->userManager->getUserByUsername($username) ){
                        $user = $this->userManager->getUserByUsername($username);
                        $classe->addEleves($user);
                        $this->roleManager->associateRole($user, $roleEleve);
                        $em->persist($classe);

                        $messages[] = "<b>L'élève $username a été ajouté à la classe $classeCode.</b>";
                    }

                    else {
                        $messages[] = "<b>L'élève $username n'existe pas il faut d'abord le créer avant de l'ajouter à sa classe $classeCode.</b>";
                    }

                }

                $this->om->endFlushSuite();

                fclose($file);
                $content = $this->renderView('LaurentSchoolBundle::adminSchoolImportView.html.twig',
                    array('form' => $form->createView(),
                        'titre' => 'classes',
                        'action' => $this->generateUrl('laurentAdminSchoolImportElevesInClasses'),
                        'messages' => $messages
                    ));

                return new Response($content);

            }
        }
        return array('form' => $form->createView(),
            'titre' => 'classes',
            'action' => $this->generateUrl('laurentAdminSchoolImportElevesInClasses'),
            'messages' => ''
        );
    }

    private function checkOpen()
    {
        if ($this->sc->isGranted('OPEN', $this->workspaceAdminTool)) {
            return true;
        }

        throw new AccessDeniedException();
    }
}