<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
final class AdminAccountController extends AbstractController {

    #[Route('/account', name: 'admin.account.index')]
    public function index(UserRepository $userRepository): Response
    {
        $accounts = $userRepository->findAll();
        return $this->render('admin/account/index.html.twig', [
            'accounts' => $accounts,
        ]);
    }


    #[Route('/account/{id}', name: 'admin.account.show', requirements: ['id' => '\d+'])]
    public function show(int $id, EntityManagerInterface $entityManager, UserRepository $userRepository): Response
    {
        // TODO: Get account by id
        $user = $userRepository->find($id);
        $userRoles = $user->getRoles();
        
        
        return $this->render('admin/account/show.html.twig', [
            'id' => $id,
            'user' => $user,
            'userRoles' => $userRoles,
        ]);
    }

    #[Route('/account/{id}/edit', name: 'admin.account.edit', requirements: ['id' => '\d+'])]
    public function edit(int $id): Response
    {
        return $this->render('admin/account/edit.html.twig', [
            'id' => $id,
        ]);
    }

    #[Route('/account/{id}/delete', name: 'admin.account.delete', requirements: ['id' => '\d+'])]
    public function delete(int $id): Response
    {
        return $this->render('admin/account/delete.html.twig', [
            'id' => $id,
        ]);
    }
}
