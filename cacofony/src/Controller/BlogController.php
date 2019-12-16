<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'Blog Controller',
            'nom' => 'Test',
            'rand' => random_int(1,100),
            'tableau' => [1,2,3],
        ]);
    }
    
    /**
     * @Route("/blog/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('blog/contact.html.twig');
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
}
