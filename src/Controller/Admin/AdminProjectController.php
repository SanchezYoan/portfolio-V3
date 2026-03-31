<?php

namespace App\Controller\Admin;

use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProjectType;
use App\Entity\Projects;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route('/admin')]
final class AdminProjectController extends AbstractController {

    #[Route('/', name:'admin.home')]
    public function home(): Response
    {
        return $this->render('admin/admin.html.twig');
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
            throw $this->createNotFoundException('Project non trouvé');
        }

        return $this->render('admin/project/show.html.twig', [
            'project' => $project,
        ]);
    }

        #[Route('/project/new', name:'admin.project.new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $project = new Projects();
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em->persist($data);
            $em->flush();
            $this->addFlash('success', 'Projet créé avec succès');
            return $this->redirectToRoute('admin.project.index');
        }

        return $this->render('admin/project/edit.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    #[Route('/project/{id}/edit', name:'admin.project.edit', requirements: ['id' => Requirement::DIGITS], methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $em, Projects $project): Response
    {
        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em->persist($data);
            $em->flush();
            $this->addFlash('success', 'Projet mis à jour avec succès');
            return $this->redirectToRoute('admin.project.index');
        }

        return $this->render('admin/project/edit.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }
    #[Route('/project/{id}/delete', name:'admin.project.delete', requirements: ['id' => Requirement::DIGITS], methods: ['POST', 'DELETE'])]
    public function delete(Projects $project, EntityManagerInterface $em): Response
    {

        if (!$project) {
            throw $this->createNotFoundException('Project non trouvé');
        }

        $em->remove($project);

        $em->flush();

        $this->addFlash('success', 'Projet supprimé avec succès');

        return $this->redirectToRoute('admin.project.index');
    }
}
