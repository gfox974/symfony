<?php

namespace App\Controller;

use Throwable;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

    // routes loggees

    /**
    * @Route("/admin", name="admin")
    */

    public function admin()
    {
        try {
            $this->denyAccessUnlessGranted('ROLE_ADMIN', null, "non autorisé");
        } catch(Throwable $th) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('app/admin.html.twig');
    }
}
