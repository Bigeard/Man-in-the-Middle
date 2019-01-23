<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Politic;
use App\Entity\Collection;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="LogOutHomePage")
     */
    public function getLogOutHomePageView()
    {
        $user = $this->getUser();

        if ($user != null) {
            return $this->redirectToRoute('LogInHomePage');
        }

        //Get all users for Ranking
        $repo = $this->getDoctrine()->getRepository(User::class);
        $users = $repo->findAll();

        $viewData = [
            'users' => $users 
        ];
        return $this->render('main/log_out_home.html.twig', $viewData);
    }

    /**
     * @Route("/home", name="LogInHomePage")
     */
    public function getLogInHomePageView()
    {
        $viewData = [
            'user' => $this->getUser() 
        ];
        return $this->render('main/log_in_home.html.twig', $viewData);
    }

    /**
     * @Route("/summon", name="SummonPage")
     */
    public function getSummonPageView()
    {

        //Create reference to User Repository
        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();

        if ($user->getBallotsNumber() < 200) {
            return $this->redirectToRoute('LogInHomePage');
        }

        //Create Array to Random pick politics
        $politicArray = [];

        //Get Repository
        $repo = $this->getDoctrine()->getRepository(Politic::class);
        $politics = $repo->findAll();

        //Put politics in array depending on rarity
        foreach ($politics as $politic)
        {
            switch ($politic->getRarity()) {
                case 1:
                    for ($i=0; $i < 6; $i++) { 
                        array_push($politicArray, $politic->getId());
                    }
                    break;
                case 2:
                    for ($i=0; $i < 3; $i++) { 
                        array_push($politicArray, $politic->getId());
                    }
                    break;
                case 3:
                    for ($i=0; $i < 1; $i++) { 
                        array_push($politicArray, $politic->getId());
                    }
                    break;
            }
        }

        //Random pick in array
        $summonedPolitic = $politicArray[rand(0,count($politicArray) - 1)];

        //Get politicid matching with random pick
        $repo = $this->getDoctrine()->getRepository(Politic::class);
        $finalPolitic = $repo->find($summonedPolitic);

        //Add random picked politic in database
        $summon = new Collection();
        $summon->setUserid($user);
        $summon->setPoliticid($finalPolitic);

        //Remove 200 BV from user account
        $user->setBallotsNumber($user->getBallotsNumber() - 200);

        $entityManager->persist($user);
        $entityManager->persist($summon);

        $entityManager->flush();

        
        
        $viewData = [
            'user' => $this->getUser(),
            'card' => $finalPolitic
        ];
        return $this->render('main/summon.html.twig', $viewData);
    }

    /**
     * @Route("/collection", name="CollectionPage")
     */
    public function getCollectionPageView()
    {
        $user = $this->getUser();

        $collection = $user->getCollections();

        $viewData = [
            'collection' => $collection,
            'user' => $this->getUser()
        ];


        return $this->render('main/collection.html.twig', $viewData);
    }

    /**
     * @Route("/claimbv", name="ClaimBV")
     */
    public function claimBV()
    {
        $user = $this->getUser();
        $entityManager = $this->getDoctrine()->getManager();

        if ($user->getLastClaim() != null) {
            $userLastClaim = $user->getLastClaim();
            $currentTime = new DateTime();

            //test if there is 5 minutes between lastClaim and now
            $diffDate = $currentTime->getTimestamp() - $userLastClaim->getTimestamp();
            if ($diffDate >= 300 ) {
                //Update Last Claim, value
                $user->setLastClaim(new \DateTime());

                //Add 200 BV to user account
                $user->setBallotsNumber($user->getBallotsNumber() + 200);

                $entityManager->persist($user);
                $entityManager->flush();
            }
            else {
                return $this->redirectToRoute('LogInHomePage');
            }
        }
        else {
            $user->setLastClaim(new \DateTime());
            //Add 200 BV to user account
            $user->setBallotsNumber($user->getBallotsNumber() + 200);

            $entityManager->persist($user);
            $entityManager->flush();
        }
        

        return $this->redirectToRoute('LogInHomePage');
    }

}
