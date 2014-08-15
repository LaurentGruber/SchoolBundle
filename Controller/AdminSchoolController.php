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


                return $this->redirect('http://www.google.be');
            }
        }

        return array('form' => $form->createView());
    }
}

/**
 * Import users from an array.
 * There is the array format:
 * @todo some batch processing
 *
 * array(
 *     array(firstname, lastname, username, pwd, email, code, phone),
 *     array(firstname2, lastname2, username2, pwd2, email2, code2, phone2),
 *     array(firstname3, lastname3, username3, pwd3, email3, code3, phone3),
 * )
 *
 * @param array $users
 *
 * @return array
 */
public function importUsers(array $users)
{
    $roleUser = $this->roleManager->getRoleByName('ROLE_USER');
    $max = $roleUser->getMaxUsers();
    $total = $this->countUsersByRoleIncludingGroup($roleUser);

    if ($total + count($users) > $max) {
        throw new AddRoleException();
    }

    $lg = $this->platformConfigHandler->getParameter('locale_language');
    $this->objectManager->startFlushSuite();

    foreach ($users as $user) {
        $firstName = $user[0];
        $lastName = $user[1];
        $username = $user[2];
        $pwd = $user[3];
        $email = $user[4];
        $code = isset($user[5])? $user[5] : null;
        $phone = isset($user[6])? $user[6] : null;

        $newUser = $this->objectManager->factory('Claroline\CoreBundle\Entity\User');
        $newUser->setFirstName($firstName);
        $newUser->setLastName($lastName);
        $newUser->setUsername($username);
        $newUser->setPlainPassword($pwd);
        $newUser->setMail($email);
        $newUser->setAdministrativeCode($code);
        $newUser->setPhone($phone);
        $newUser->setLocale($lg);
        $this->createUser($newUser);
    }

    $this->objectManager->endFlushSuite();
}