<?php

namespace App\Controller;

use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectController extends AbstractController
{
    #[Route('/project', name: 'project.index')]
    public function index(ProjectsRepository $projectsRepository): Response
    {
        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
            'projects' => $projectsRepository->findAll(),
        ]);
    }
    #[Route('/project/{id}', name: 'project.show', requirements: ['id' => '\d+'])]
    public function show(int $id, ProjectsRepository $projectsRepository): Response
    {
        $project = $projectsRepository->find($id);

        if (!$project) {
            throw $this->createNotFoundException('Project not found');
        }

        return $this->render('project/show.html.twig', [
            'controller_name' => 'ProjectController',
            'project' => $project,
        ]);
    }
}
