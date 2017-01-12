<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
        $em = $this->getDoctrine()->getManager();
    	$articles = $em->getRepository('AppBundle:Article')->findAll();
      	return $this->render('article/homepage.html.twig',["articles"=> $articles]);
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
    		//Upload file
    		$this->get('image.uploader')->upload($article);
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
    	$articleImgPath = $article->getHeaderImage();
    	$article->setHeaderImage(new File($this->getParameter('file_path').$articleImgPath));

    	$form = $this->createForm(ArticleType::class, $article);

    	$form->handleRequest($request);
    	// BDD
    	if($form->isValid()) {
    		//Upload file
    		$this->get('image.uploader')->upload($article);
    		// update
    		$this->getDoctrine()->getManager()->flush();

    		$this->addFlash('success', 'The article was successfully updated in database!');

    		return  $this->redirectToRoute('article_homepage');
    	}
        // replace this example code with whatever you need
        return $this->render('article/add_update.html.twig', ['articleForm' => $form->createView(), 'article' => $article, 'oldArticleImage' => $articleImgPath]);
    }
}
