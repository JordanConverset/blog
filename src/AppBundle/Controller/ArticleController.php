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
    public function addAction(Request $request)
    {
    	$article = new Article();
    	$form = $this->createForm(ArticleType::class, $article);

    	$form->handleRequest($request);

    	// BDD
    	if($form->isValid()) {
    		// récupère la table
    		$em = $this->getDoctrine()->getManager();
    		// requête pour insertion
    		$em->persist($article);
    		// execute
    		$em->flush();

    		$this->addFlash('success', 'The article was successfully inserted in database!');

    		return  $this->redirectToRoute('article_homepage');
    	}
        // replace this example code with whatever you need
        return $this->render('article/add_update.html.twig', ['articleForm' => $form->createView(), 'article' => $article]);
    }

     /**
     * @Route("/update/{id}", requirements={"id" = "\d+"}, name="update_article")
     */
    public function updateAction(Article $article, Request $request)
    {
    	$form = $this->createForm(ArticleType::class, $article);

    	$form->handleRequest($request);

    	// BDD
    	if($form->isValid()) {
    		// update
    		$this->getDoctrine()->getManager()->flush();

    		$this->addFlash('success', 'The article was successfully updated in database!');

    		return  $this->redirectToRoute('article_homepage');
    	}
        // replace this example code with whatever you need
        return $this->render('article/add_update.html.twig', ['articleForm' => $form->createView(), 'article' => $article]);
    }
}
