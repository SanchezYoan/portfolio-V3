<?php

namespace App\Controller\Admin;

use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
final class AdminProjectController extends AbstractController {

    #[Route('/', name:'admin.home')]
    public function home(): Response
    {
        return $this->render('admin/base.html.twig');
    }
    
    #[Route('/project', name: 'admin.project.index')]
    public function projectIndex(ProjectsRepository $projectsRepository): Response
    {
        return $this->render('admin/project/index.html.twig', [
            'projects' => $projectsRepository->findAll(),
        ]);
    }
    
    #[Route('/project/{id}', name: 'admin.project.show', requirements: ['id' => '\d+'])]
    public function show(int $id, ProjectsRepository $projectsRepository): Response
    {
        $project = $projectsRepository->find($id);

        if (!$project) {
            throw $this->createNotFoundException('Project not found');
        }

        return $this->render('admin/project/show.html.twig', [
            'project' => $project,
        ]);
    }
    #[Route('/project/edit/{id}', name:'admin.project.edit', requirements: ['id' => '\d+'])]
    public function edit(int $id, ProjectsRepository $projectsRepository): Response
    {
        $project = $projectsRepository->find($id);

        if (!$project) {
            throw $this->createNotFoundException('Project not found');
        }

        return $this->render('admin/project/edit.html.twig', [
            'project' => $project,
        ]);
    }
    #[Route('Project/delete/{id}', name:'admin.project.delete', requirements: ['id' => '\d+'])]
    public function delete(int $id, ProjectsRepository $projectsRepository): Response
    {
        $project = $projectsRepository->find($id);

        if (!$project) {
            throw $this->createNotFoundException('Project not found');
        }

        $projectsRepository->remove($project, true);

        return $this->redirectToRoute('admin.project.index');
    }
}
