<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ThreadRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Thread;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use DateTime;
use Symfony\Component\Security\Core\Security;



class ForumController extends AbstractController
{
    /**
     * @Route("/forum", name="forum")
     */
    public function index(ThreadRepository $repo)
    {
        $threads = $repo->findAll();
        return $this->render('forum/index.html.twig', [
            'controller_name' => 'ForumController',
            'threads' => $threads
        ]);
    }

    /**
     * @Route("/forum/thread/{id}", name="thread")
    */
    public function detail(Thread $thread, Request $request)
    {
        $messages = $thread->getMessages();
        return $this->render('forum/thread.html.twig', [
            'thread' => $thread,
            'messages' => $messages
        ]);
    }

    /**
    * @Route("/forum/newthread", name="newthread")
    */
    public function newpost(Request $request, Thread $thread = null)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        $em = $this->getDoctrine()->getManager();
        $thread = new Thread();
        $author = $this->getUser();
        // $authorName = $this->getUser()->getUsername();
        $authorMail = $this->getUser()->getEmail();
        $form = $this->createFormBuilder($thread)
            ->add('subject')
            ->add('text')
        ->add('Valider', SubmitType::class)
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            if (!$thread->getId())
            {
                $thread->setAuthor($author);
                $thread->setEmail($authorMail);
                $thread->setCreatedAt(new DateTime());
            }
            $em->persist($thread);
            $em->flush();
            return $this->redirectToRoute('forum');
        }
        return $this->render('forum/newthread.html.twig', [
            'monFormulaire' => $form->createView(),
        ]);
    }

}
