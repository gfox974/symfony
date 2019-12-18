<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Categorie;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {
        // $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'Blog Controller',
            'nom' => 'Test',
            'rand' => random_int(1,100),
            'articles' => $articles,
        ]);
    }
    
    /**
     * @Route("/blog/detail/{id}", name="detail")
    */
    public function detail(Article $article, Request $request)
    {
        // $repo = $this->getDoctrine()->getRepository(Article::class);
        // $article = $repo->find($id);
        // dump($article);
        return $this->render('blog/detail.html.twig', [
            'article' => $article,
        ]);
    }
    
    /**
     * @Route("/blog/contact", name="contact")
     */
    public function contact(Request $request, Contact $contact = null)
    {
        $em = $this->getDoctrine()->getManager();
        if (!$contact)
        {
            $contact = new Contact();
        }
        $form = $this->createFormBuilder($contact)
            ->add('photo')
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('cp')
            ->add('ville')
            ->add('email')
            ->add('age')
        ->add('Valider', SubmitType::class)
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            if (!$contact->getId())
            {
                $contact->setCreeLe(new DateTime());
            }
            $em->persist($contact);
            $em->flush();
            return $this->redirectToRoute('blog');
        }
        return $this->render('blog/contact.html.twig', [
            'monFormulaire' => $form->createView(),
        ]);
    }

    /**
     * @Route("/blog/aide", name="aide")
     */
    public function aide()
    {
        return $this->render('blog/aide.html.twig');
    }

    /**
     * @Route("/blog/hasard/{n}", name="hasard")
     */
    public function hasard($n)
    {
        $hasard = random_int(1,$n);
        return $this->render('/blog/hasard.html.twig', [
            'hasard' => $hasard,
        ]);
    }
    /**
    * @Route("/blog/creer", name="creer")
    * @Route("/blog/article/{id}/edit", name="editer")
    */
    public function creer(Request $request, Article $article = null)
    {
        $em = $this->getDoctrine()->getManager();
        if (!$article)
        {
            $article = new Article();
        }
        // $form = $this->createFormBuilder($article);
        $form = $this->createFormBuilder($article)
        // dump($form);
        // $form->add('titre')
            ->add('titre')
            ->add('corps')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'libelle' 
            ])
            ->add('auteur')
        ->add('Valider', SubmitType::class)
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            if (!$article->getId())
            {
                $article->setCreeLe(new DateTime());
            }
            $em->persist($article);
            $em->flush();
            return $this->redirectToRoute('blog');
        }

        return $this->render('blog/creer.html.twig', [
            'monFormulaire' => $form->createView(),
        //    'mode' => ($article->getId() !== null)? 'edit' : 'new'
            'edition' => ($article->getId() !== null)? true : false
        ]);
    }
}
