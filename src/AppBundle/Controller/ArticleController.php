<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;

/**
 * @Route("/article")
 */

class ArticleController extends Controller
{
    /**
     * @Route("/", name="article_homepage")
     */
    public function homepageAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('article/homepage.html.twig');
    }

    /**
     * @Route("/{id}", requirements={"id"="\d+"}, defaults={"id" = 1}, name="show_article")
     */
    public function showAction()
    {
        // replace this example code with whatever you need
        return $this->render('article/show.html.twig');
    }

    /**
     * @Route("/add", name="add_article")
     */
    public function addAction()
    {
    	$article = new Article();
    	$form = $this->createForm(ArticleType::class, $article);
        // replace this example code with whatever you need
        return $this->render('article/add.html.twig', ['articleForm' => $form->createView()]);
    }
}
