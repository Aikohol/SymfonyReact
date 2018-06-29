<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Routing\Annotation\Annotation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Articles;
use App\Repository\ArticlesRepository;

class ArticlesController extends Controller
{
    /**
     * @Route("/articles", name="articles")
     */
    public function index(ArticlesRepository $repo)
    {
		// $repo = $this->getDoctrine()->getRepository(Articles::class);
		$articles = $repo->findAll();

        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController',
			'articles' => $articles,
        ]);
    }

	/**
	* @Route("/", name="home")
	**/

	public function home() {
		return $this->render('articles/home.html.twig');
	}
	/**
	* @Route("/articles/{id}", name="articles_show")
	**/

	public function show(Articles $article) {
		// $repo = $this->getDoctrine()->getRepository(Articles::class);
		// $article = $repo->find($id);

		return $this->render('articles/show.html.twig', [
			'article' => $article,
		]);
	}
}
