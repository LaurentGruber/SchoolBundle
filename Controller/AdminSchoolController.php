<?php

namespace Laurent\SchoolBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use Symfony\Component\HttpFoundation\Request;
use Laurent\SchoolBundle\Entity\Classe;
use JMS\DiExtraBundle\Annotation as DI;
use Claroline\CoreBundle\Library\Workspace\Configuration;

class AdminSchoolController extends Controller
{
    /**
     * @EXT\Route("/admin/menu", name="laurentAdminSchoolMenu")
     * @EXT\Template("LaurentSchoolBundle::adminSchoolMenu.html.twig")
     */

    public  function adminSchoolMenuAction()
    {
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
        $em = $this->get('doctrine')->getManager();
        $repository = $em->getRepository('LaurentSchoolBundle:Classe');
        $templateDir=$this->container->getParameter('claroline.param.templates_directory');
        $this->workspaceManager = $this->container->get('claroline.manager.workspace_manager');
        $this->userManager = $this->container->get('claroline.manager.user_manager');

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
                while (($classeCsv = fgetcsv($file)) !== FALSE) {
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
                        $this->workspaceManager->create($config, $user);

                        $classe = new Classe;
                        $classe->setCode($code);
                        $classe->setName($name);
                        $classe->setDegre($degre);
                        $classe->setAnnee($annee);
                        $em->persist($classe);
                        $em->flush();

                        $messages[] = "La classe $code a bien été ajoutée et l'espace d'activité correspondant créé.";
                    }
                    else {
                        $messages[] = "<b>La classe $code existe déjà rien n'a été fait.</b>";
                    }
                }
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
}