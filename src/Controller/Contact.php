<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\Type\UserFormType;
use App\Repository\ContactsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Contact extends AbstractController
{

    /**
     * @Route("/contact", name="contact")
     */
    public function index(ContactsRepository $contactsRepository)
    {
        return $this->render('contact/list.html.twig', ['contacts' => $contactsRepository->findAll()]);
    }

    /**
     * @Route("/contact/create", name="create_contact")
     */
    public function createUser(Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(UserFormType::class, new Contacts());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $entityManager->persist($contact);
            $entityManager->flush();
            $this->addFlash('success', 'User was created!');
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}")
     *
     *
     * @return Response
     */
    public function editUser(Contacts $contact, Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(UserFormType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $entityManager->persist($contact);
            $entityManager->flush();
            $this->addFlash('success', 'User was updated!');
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="app_contact_delete")
     *
     * @param Contacts               $contact
     * @param EntityManagerInterface $em
     *
     * @return RedirectResponse
     */
    public function deleteBlog(Contacts $contact, EntityManagerInterface $em): RedirectResponse
    {
        $em->remove($contact);
        $em->flush();
        $this->addFlash('success', 'User was deleted !');

        return $this->redirectToRoute('contact');
    }
}
