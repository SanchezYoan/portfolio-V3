<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'profil.index')]
    public function index(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
            'user' => $user,
        ]);
    }

    #[Route('/api/password', name: 'api.password.update', methods: ['POST'])]
    public function updatePassword(
        Request $request,
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $em
    ): JsonResponse {
        $user = $this->getUser();

        if (!$user) {
            return $this->json(['error' => 'Non authentifié.'], 401);
        }

        $data            = json_decode($request->getContent(), true);
        $currentPassword = $data['currentPassword'] ?? '';
        $newPassword     = $data['newPassword'] ?? '';

        // Vérification mot de passe actuel
        if (!$hasher->isPasswordValid($user, $currentPassword)) {
            return $this->json(['error' => 'Mot de passe actuel incorrect.'], 400);
        }

        // Validation du nouveau mot de passe
        if (strlen($newPassword) < 8) {
            return $this->json(['error' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.'], 400);
        }

        // Hash et sauvegarde
        $user->setPassword($hasher->hashPassword($user, $newPassword));
        $em->flush();

        return $this->json(['message' => 'Mot de passe mis à jour avec succès.']);
    }
}
