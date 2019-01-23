<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Collection;

use App\Form\RemoveUserType;
use App\Form\SignUpFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{
    /**
     * @Route("/signup", name="SignUpPage")
     */
    public function getSignUpPageView(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm(SignUpFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hash = $encoder->encodePassword($user, $user->getPassword());

            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('LogInPage');
        }

        $viewData = [
            'form' => $form->createView()
        ];

        return $this->render('security/sign_up.html.twig', $viewData);
    }


    /**
     * @Route("/login", name="LogInPage")
     */
    public function getLogInPageView()
    {
        $viewData = [
            
        ];

        return $this->render('security/log_in.html.twig', $viewData);
    }

    /**
     * @Route("/logout", name="LogOutPage")
     */
    public function logout() {}

    
    /**
     * @Route("/admin", name="AdminPage")
     */
    public function getAdminView() 
    {

        $user = $this->getUser();

        $viewData = [
            'user' => $user
        ];

        return $this->render('security/admin.html.twig', $viewData);
    }

    /**
     * @Route("/admin/remove_user", name="RemoveUser")
     */
    public function getAdminRemoveUserView() 
    {
        $user = $this->getUser();

        //Get all users for Ranking
        $repo = $this->getDoctrine()->getRepository(User::class);
        $users = $repo->findAll();

        $viewData = [
            'user' => $user,
            'users' => $users
        ];

        return $this->render('security/remove_user.html.twig', $viewData);
    }

    /**
     * @Route("/admin/remove_user_method", name="RemoveUserMethod")
     */
    public function removeUser()
    {
        $userToRemove = $_POST['userToRemove'];

        $manager = $this->getDoctrine()->getManager();

        //Get user to remove
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findOneBy([
            'id' => $userToRemove
        ]);

        $manager->remove($user);
        $manager->flush();

        return $this->redirectToRoute('AdminPage');    
    }

    /**
     * @Route("/admin/grant_user", name="GrantUser")
     */
    public function getAdminGrantUserView() 
    {

        $user = $this->getUser();

        //Get all users for Ranking
        $repo = $this->getDoctrine()->getRepository(User::class);
        $users = $repo->findBy([
            'isAdmin' => null
        ]);

        $viewData = [
            'user' => $user,
            'users' => $users
        ];

        return $this->render('security/grant_user.html.twig', $viewData);
    }

    /**
     * @Route("/admin/grant_user_method", name="GrantUserMethod")
     */
    public function grantUser()
    {
        $userToGrant = $_POST['userToGrant'];

        $manager = $this->getDoctrine()->getManager();

        //Get user to remove
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findOneBy([
            'id' => $userToGrant
        ]);

        $user->setIsAdmin(1);
        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('AdminPage');    
    }

    /**
     * @Route("/admin/clean_collection", name="CleanCollection")
     */
    public function getAdminCleanCollectionView() 
    {

        $user = $this->getUser();

        //Get all users for Ranking
        $repo = $this->getDoctrine()->getRepository(User::class);
        $users = $repo->findAll();

        $viewData = [
            'user' => $user,
            'users' => $users
        ];

        return $this->render('security/clean_collection.html.twig', $viewData);
    }

    /**
     * @Route("/admin/clean_collection_method", name="CleanCollectionMethod")
     */
    public function cleanCollection()
    {
        $collectionToClean = $_POST['collectionToClean'];

        $manager = $this->getDoctrine()->getManager();

        //Get user to remove
        $repo = $this->getDoctrine()->getRepository(Collection::class);
        $collections = $repo->findBy([
            'userid' => $collectionToClean
        ]);

        foreach ($collections as $collection) {
            $manager->remove($collection);
        }
        
        $manager->flush();

        return $this->redirectToRoute('AdminPage');    
    }

    /**
     * @Route("/admin/add_bv", name="AddBV")
     */
    public function getAdminAddBVView() 
    {

        $user = $this->getUser();

        //Get all users for Ranking
        $repo = $this->getDoctrine()->getRepository(User::class);
        $users = $repo->findAll();

        $viewData = [
            'user' => $user,
            'users' => $users
        ];

        return $this->render('security/add_bv.html.twig', $viewData);
    }

    /**
     * @Route("/admin/add_bv_method", name="AddBVMethod")
     */
    public function addBV()
    {
        $userToGive = $_POST['userToGive'];
        $bvNumber = $_POST['BVNumber'];

        $manager = $this->getDoctrine()->getManager();

        //Get user to remove
        $repo = $this->getDoctrine()->getRepository(User::class);
        $user = $repo->findOneBy([
            'id' => $userToGive
        ]);

        $user->setBallotsNumber($user->getBallotsNumber() + $bvNumber);
        
        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('AdminPage');    
    }

        

}
