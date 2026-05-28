<?php

namespace App\Controller\Admin;

use App\Entity\ProjectDocument;
use App\Entity\ProjectImage;
use App\Repository\ProjectDocumentRepository;
use App\Repository\ProjectImageRepository;
use App\Repository\ProjectsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProjectType;
use App\Entity\Projects;
use Symfony\Component\Routing\Requirement\Requirement;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
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
            $this->handleGalleryImages($request, $data, $em);
            $this->handleDocuments($request, $data, $em);
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
            $this->handleGalleryImages($request, $data, $em);
            $this->handleDocuments($request, $data, $em);
            $this->addFlash('success', 'Projet mis à jour avec succès');
            return $this->redirectToRoute('admin.project.index');
        }

        return $this->render('admin/project/edit.html.twig', [
            'project' => $project,
            'form' => $form,
        ]);
    }

    #[Route('/project/{projectId}/image/{imageId}/delete', name: 'admin.project.image.delete', requirements: ['projectId' => Requirement::DIGITS, 'imageId' => Requirement::DIGITS], methods: ['POST'])]
    public function deleteImage(int $projectId, int $imageId, ProjectImageRepository $imageRepo, EntityManagerInterface $em): JsonResponse
    {
        $image = $imageRepo->find($imageId);

        if (!$image || $image->getProject()->getId() !== $projectId) {
            return $this->json(['error' => 'Image non trouvée.'], 404);
        }

        $filePath = $this->getParameter('kernel.project_dir') . '/public/images/projects/' . $image->getImage();
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $em->remove($image);
        $em->flush();

        return $this->json(['success' => true]);
    }

    private function handleGalleryImages(Request $request, Projects $project, EntityManagerInterface $em): void
    {
        $uploadedFiles = $request->files->get('new_images', []);

        if (!is_array($uploadedFiles)) {
            $uploadedFiles = [$uploadedFiles];
        }

        $uploadDir = $this->getParameter('kernel.project_dir') . '/public/images/projects';

        foreach ($uploadedFiles as $file) {
            if (!$file || !$file->isValid()) {
                continue;
            }

            $filename = uniqid('img_', true) . '.' . $file->guessExtension();
            $file->move($uploadDir, $filename);

            $projectImage = new ProjectImage();
            $projectImage->setImage($filename);
            $projectImage->setProject($project);
            $em->persist($projectImage);
        }

        $em->flush();
    }

    #[Route('/project/{projectId}/document/{docId}/delete', name: 'admin.project.document.delete', requirements: ['projectId' => Requirement::DIGITS, 'docId' => Requirement::DIGITS], methods: ['POST'])]
    public function deleteDocument(int $projectId, int $docId, ProjectDocumentRepository $docRepo, EntityManagerInterface $em): JsonResponse
    {
        $document = $docRepo->find($docId);

        if (!$document || $document->getProject()->getId() !== $projectId) {
            return $this->json(['error' => 'Document non trouvé.'], 404);
        }

        $filePath = $this->getParameter('kernel.project_dir') . '/public/documents/projects/' . $document->getFilename();
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $em->remove($document);
        $em->flush();

        return $this->json(['success' => true]);
    }

    private function handleDocuments(Request $request, Projects $project, EntityManagerInterface $em): void
    {
        $uploadedFiles = $request->files->get('new_documents', []);

        if (!is_array($uploadedFiles)) {
            $uploadedFiles = [$uploadedFiles];
        }

        $uploadDir = $this->getParameter('kernel.project_dir') . '/public/documents/projects';

        foreach ($uploadedFiles as $file) {
            if (!$file || !$file->isValid()) {
                continue;
            }

            $originalName = $file->getClientOriginalName();
            $filename     = uniqid('doc_', true) . '.' . $file->guessExtension();
            $file->move($uploadDir, $filename);

            $doc = new ProjectDocument();
            $doc->setFilename($filename);
            $doc->setOriginalName($originalName);
            $doc->setProject($project);
            $em->persist($doc);
        }

        $em->flush();
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
