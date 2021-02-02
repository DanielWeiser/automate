<?php

namespace App\Controller;

use App\Entity\Contract;
use App\Entity\ContractProduct;
use App\Entity\Counterparty;
use App\Entity\Orders;
use App\Entity\OrdersProduct;
use App\Entity\User;
use App\Form\OrdersProductType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
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
        $em = $this->getDoctrine()->getManager();
        $counterparties = $em->getRepository(Counterparty::class)->findBy(['user' => $this->getUser()]);

        return $this->render('user/index.html.twig', [
            'counterparties' => $counterparties,
        ]);
    }

    /**
     * @Route("/about/{id}", requirements={"id"="\d+"}, name="about")
     */
    public function about(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $counterparties = $em->getRepository(Counterparty::class)->findBy(['user' => $this->getUser()]);
        $counterparty = $em->getRepository(Counterparty::class)->find($id);

        if (is_null($counterparty) || !in_array($counterparty, $counterparties, true)) {
            return $this->redirectToRoute('index');
        }

        return $this->render('user/about.html.twig', [
            'counterparty' => $counterparty,
        ]);
    }

    /**
     * @Route("/contracts/{id}", requirements={"id"="\d+"}, name="contracts")
     */
    public function contracts(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $contracts = $this->getContracts($id, $this->getUser(), $em);

        if (is_null($contracts)) {
            return $this->redirectToRoute('index');
        }

        $specifications = [];

        foreach ($contracts as $contract) {
            $contractProducts = $em->getRepository(ContractProduct::class)->findBy(['contract' => $contract]);

            if (empty($contractProducts)) {
                continue;
            }

            $specifications[] = $contractProducts;
        }

        return $this->render('user/contracts.html.twig', [
            'id' => $id,
            'contracts' => $specifications,
        ]);
    }

    /**
     * @Route("/orders/{id}", requirements={"id"="\d+"}, name="orders")
     */
    public function orders(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $contracts = $this->getContracts($id, $this->getUser(), $em);

        if (is_null($contracts)) {
            return $this->redirectToRoute('index');
        }

        $orders = [];
        $products = [];

        foreach ($contracts as $contract) {
            $orders = $em->getRepository(Orders::class)->findBy(['contract' => $contract]);

            if (empty($orders)) {
                continue;
            }

            $orders[] = $orders;
        }

        foreach ($orders as $order) {
            $orderProducts = $em->getRepository(OrdersProduct::class)->findBy(['orders' => $order]);

            if (empty($orderProducts)) {
                continue;
            }

            $products[] = $orderProducts;
        }
        dump($products); die();

        return $this->render('user/orders.html.twig', [
            'orders' => $products,
        ]);
    }

    /**
     * @Route("/createOrder/{id}", requirements={"id"="\d+"}, name="create_order")
     */
    public function createOrder(Request $request): Response
    {
        $ordersProduct = new OrdersProduct();
        $form = $this->createForm(OrdersProductType::class, $ordersProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            var_dump($task);

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }

        return $this->render('user/create_order.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param int $id
     * @param User $user
     * @param ObjectManager $em
     * @return array|null
     */
    private function getContracts(int $id, User $user, ObjectManager $em): ?array {
        $counterparties = $em->getRepository(Counterparty::class)->findBy(['user' => $user]);
        $counterparty = $em->getRepository(Counterparty::class)->find($id);

        if (is_null($counterparty) || !in_array($counterparty, $counterparties, true)) {
            return null;
        }

        return $em->getRepository(Contract::class)->findBy(['counterparty' => $counterparty]);
    }
}
