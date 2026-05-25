<?php

namespace App\Controller\Admin;

use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
final class AdminAccountController extends AbstractController
{
    #[Route('/account', name: 'admin.account.index')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/account/index.html.twig', [
            'accounts' => $userRepository->findAll(),
        ]);
    }

    #[Route('/account/{id}', name: 'admin.account.show', requirements: ['id' => Requirement::DIGITS])]
    public function show(int $id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Compte introuvable');
        }

        return $this->render('admin/account/show.html.twig', [
            'user'      => $user,
            'userRoles' => $user->getRoles(),
        ]);
    }

    #[Route('/account/{id}/edit', name: 'admin.account.edit', requirements: ['id' => Requirement::DIGITS], methods: ['GET', 'POST'])]
    public function edit(int $id, Request $request, UserRepository $userRepository, EntityManagerInterface $em, UserPasswordHasherInterface $hasher): Response
    {
        $user = $userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Compte introuvable');
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $form->get('plainPassword')->getData();

            if ($plainPassword) {
                $user->setPassword($hasher->hashPassword($user, $plainPassword));
            }

            $em->flush();
            $this->addFlash('success', 'Compte mis à jour avec succès');
            return $this->redirectToRoute('admin.account.show', ['id' => $id]);
        }

        return $this->render('admin/account/edit.html.twig', [
            'user'      => $user,
            'userRoles' => $user->getRoles(),
            'form'      => $form,
        ]);
    }

    #[Route('/account/{id}/delete', name: 'admin.account.delete', requirements: ['id' => Requirement::DIGITS], methods: ['POST'])]
    public function delete(int $id, UserRepository $userRepository, EntityManagerInterface $em): Response
    {
        $user = $userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Compte introuvable');
        }

        try {
            $em->remove($user);
            $em->flush();
            $this->addFlash('success', 'Utilisateur supprimé avec succès');
        } catch (\Exception $e) {
            $this->addFlash('error', 'Erreur lors de la suppression');
        }

        return $this->redirectToRoute('admin.account.index');
    }
}
