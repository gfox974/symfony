<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use JMS\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// ici, on prefixe la route de la classe apicontroller
/**
* @Route("/api")
*/
class ApiController extends AbstractController
{
    private $em;
    // injection de la dependance sous forme de service de la serialisation via le constructeur
    private $serialize;
    private $articlesRepo;

    public function __construct(SerializerInterface $serialize, EntityManagerInterface $em, ArticleRepository $articlesRepo) {
        $this->serialize = $serialize;
        $this->em = $em;
        $this->articlesRepo = $articlesRepo;
    }

    // on va creer une route atteignable uniquement par la methode post :

    /**
     * @Route("/articles", name="article_creer", methods={"POST"})
    */
    public function creerArticle(Request $request)
    {
        $data= $request->getContent();
        // on va deserialiser les données de la requete pour en faire un article (source, format out, format in)
        $article = $this->serialize->deserialize($data, "App\Entity\Article", "json");
        // puis on injecte l'article en bdd via l'entitymanager
        // $em = $this->getDoctrine()->getManager();
        $this->em->persist($article);
        $this->em->flush();

        // on va renvoyer un code retour ok (201 : ressource cree)
        return new Response('', Response::HTTP_CREATED);
    }

    // route delete article $id 

    /**
     * @Route("/articles/{id}", name="article_delete",  methods={"DELETE"})
    */
    public function delete($id)
    {
        $article = $this->articlesRepo->find($id);
        $this->em->remove($article);
        $this->em->flush();
        return new Response('', Response::HTTP_ACCEPTED);
    }


    /**
     * @Route("/articles", name="articles_liste")
     */
    public function index()
    {
    /* TESTS BASE
        // creation d'un article test en format json
        $article = new Article();
        $article
            ->setTitre("titre quelconque")
            ->setCorps("contenu du corps tessssssst");
        
        $json = $this->serialize->serialize($article, 'json');
        // on construit la reponse a partir de la representation en json de l'article (attention, class response de httpfondation !)
        $response = new Response($json);
        // On type la reponse dans le header http pour le browser
        $response->headers->set('Content-Type','application/json');
        return $response;
    */

        // todo : recuperer la liste des articles
        // $repo = $this->getDoctrine()->getRepository(Article);
        $articles = $this->articlesRepo->findAll();
        $json = $this->serialize->serialize($articles, 'json');
        $response = new Response($json);
        $response->headers->set('Content-Type','application/json');
        return $response;
    }

    // route detail article (read)

    /**
     * @Route("/articles/{id}", name="article_details")
    */
    public function detail($id)
    {
        $article = $this->articlesRepo->find($id);
        $json = $this->serialize->serialize($article, 'json');
        $response = new Response($json);
        $response->headers->set('Content-Type','application/json');
        return $response;
    }
}
