<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Throwable;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        //throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $req, UserPasswordEncoderInterface $encoder)
    {
        if ($req->isMethod("POST"))
        {
            $user = new User();
            $user->setEmail($req->request->get('email'));
            $user->setPassword($encoder->encodePassword($user, $req->request->get('password')));
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('security/register.html.twig');
    }

    /**
     * @Route("/forgottenpassword", name="app_forgotten_password")
     */
    public function forgottenPassword(Request $req, TokenGeneratorInterface $tokenGenerator, MailerInterface $mailer)
    {
        if ($req->isMethod("POST"))
        {
            $email = $req->request->get('email');
            $repo = $this->getDoctrine()->getRepository(User::class);
            $user = $repo->findOneByEmail($email);

            if ($user == null) {
                $this->addFlash('danger', 'Erreur');
                return $this->redirectToRoute('home');
            }

            $em = $this->getDoctrine()->getManager();
            $token = $tokenGenerator->generateToken();
            try {
                $user->setToken($token);
                $em->persist($user);
                $em->flush();
            } catch(Throwable $th) {
                return $this->redirectToRoute('home');
            }
            
            $url = $this->generateUrl('app_reset_password', ['token'=>$token]);
            $mail = (new Email())
            ->from('test@test.test')
            ->to($user->getEmail())
            ->subject('reset pass')
            ->html('lien : http://localhost:8000'.$url);

            $sentEmail = $mailer->send($mail);
            $this->addFlash('notice', 'Message envoyé');
            return $this->redirectToRoute('home');
        }

        return $this->render('security/forgottenpassword.html.twig');
    }

    /**
     * @Route("/resetpassword/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $req, string $token, UserPasswordEncoderInterface $encoder)
    {
        if ($req->isMethod("POST"))
        {
            $em = $this->getDoctrine()->getManager();
            $repo = $this->getDoctrine()->getRepository(User::class);
            $user = $repo->findOneByToken($token);
            if ($user == null) {
                $this->addFlash('danger','erreur: token inconnu');
                return $this->redirectToRoute('home');
            }

            $user->setToken(null);
            $user->setPassword($encoder->encodePassword($user, $req->request->get('password')));
            $em->persist($user);
            $em->flush();

            $this->addFlash('notice','mot de passe modifié');
            return $this->redirectToRoute('home');
        }
        return $this->render('security/resetpassword.html.twig', [
            'token' => $token
        ]);
    }
}
