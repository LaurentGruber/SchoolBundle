<?php

namespace Laurent\SchoolBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as EXT;
use Symfony\Component\HttpFoundation\Request;

class AdminSchoolController extends Controller
{
    /**
     * @EXT\Route("/admin", name="laurentAdminSchool")
     * @EXT\Template("LaurentSchoolBundle::adminSchoolView.html.twig")
     */
    public function adminSchoolAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('fichier', 'file')
            ->add('envoyer', 'submit')
            ->getForm()
         ;

        if ($request->getMethod() === 'POST') {
            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                $fichier = $form->get('fichier')->getNormData();

                //traitement

                return $this->redirect('http://www.google.be');
            }
        }

        return array('form' => $form->createView());
    }
}

?>