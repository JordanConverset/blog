<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExerciseController extends Controller
{
    /**
     * @Route("/test", name="test")
     */
    public function usersAction()
    {
        // return new Response('Hello', 500,  ['X-My-Header' => "Youhou j'ai fait mon propre header"]);
        return new Response($this->renderView('exercise/exercise.html.twig'), Response::HTTP_OK, ['X-My-Header' => "Youhou j'ai fait mon propre header"]);
    }
}
