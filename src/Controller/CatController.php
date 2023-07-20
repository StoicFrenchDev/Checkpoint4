<?php

namespace App\Controller;

use App\Entity\Cat;
use App\Entity\User;
use App\Form\CatType;
use App\Repository\CatRepository;
use App\Service\FileUploader;
use App\Service\ImageVerification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
#[Route('/cat', name: 'cat_')]
class CatController extends AbstractController
{
    #[Route('/new', name: 'new')]
    public function new(Request $request, CatRepository $catRepository): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $cat = new Cat();
        $form = $this->createForm(CatType::class, $cat);
        $cat->setOwner($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $catRepository->save($cat, true);

            $this->addFlash('success', 'Your cat\'s profile has been created!');
            return $this->redirectToRoute('cat_show', ['id' => $cat->getId()]);
        }

        return $this->renderForm('cat/new.html.twig', [
            'cat' => $cat,
            'form' => $form,
        ]);
    }

    #[Route('/', name: 'index')]
    public function index(CatRepository $catRepository): Response
    {
        $cats = $catRepository->findAll();
        return $this->render('cat/index.html.twig', [
            'cats' => $cats,
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(
        Cat $cat,
        CatRepository $catRepository,
        FileUploader $fileUploader,
        ImageVerification $imageVerification,
        Request $request,
    ): Response {
        $pictureFile = $request->files->get('upload-cat-picture');

        if (!empty($pictureFile)) {
            if (!$imageVerification->imageVerification($pictureFile)) {
                $this->addFlash('danger', 'Only use PNG, JPG ou JPEG format');
            } else {
                $pictureFilename = $fileUploader->upload($pictureFile);
                $cat->setProfilePicture($pictureFilename);
                $catRepository->save($cat, true);
                $this->addFlash('success', 'New profile picture added!');
            }
        }

        return $this->render('cat/show.html.twig', [
            'cat' => $cat,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit')]
    public function edit(Request $request, Cat $cat, CatRepository $catRepository): Response
    {
        $form = $this->createForm(CatType::class, $cat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $catRepository->save($cat, true);

            $this->addFlash('success', 'Your cat\'s profile has been updated!');
            return $this->redirectToRoute('cat_show', ['id' => $cat->getId()]);
        }

        return $this->renderForm('cat/edit.html.twig', [
            'cat' => $cat,
            'form' => $form,
        ]);
    }
}
