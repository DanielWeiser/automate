<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @IsGranted("ROLE_USER")
 */
class UserController extends AbstractController
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        /*$entityManager = $this->getDoctrine()->getManager();

        $user = $entityManager->getRepository(User::class)->find(2);
        $user->setUsername("admin");
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));
        $user->setRoles(["ROLE_ADMIN"]);
        $entityManager->persist($user);

        $user1 = $entityManager->getRepository(User::class)->find(1);
        $user1->setUsername("user");
        $user1->setPassword($this->passwordEncoder->encodePassword(
            $user1,
            'user'
        ));
        $user1->setRoles(["ROLE_USER"]);
        $entityManager->persist($user);

        $entityManager->flush();*/

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
