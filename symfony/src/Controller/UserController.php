<?php

namespace App\Controller;

use App\Entity\Counterparty;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $counterparties = $entityManager
                            ->getRepository(Counterparty::class)
                            ->findBy(['user_id' => $this->getUser()]);

        return $this->render('user/index.html.twig', [
            'counterparties' => $counterparties,
        ]);
    }
}
