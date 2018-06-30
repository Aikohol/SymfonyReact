<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Routing\Annotation\Annotation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use JMS\Serializer\SerializationContext;
use App\Entity\Articles;
use App\Repository\ArticlesRepository;

class ArticlesController extends Controller
{
	/**
	* @Route("/articles", name="articles")
	*/
	public function index(ArticlesRepository $repo)
	{
		$articles = $repo->findAll();
		$data = $this->get('jms_serializer')->serialize($articles, 'json',
		SerializationContext::create()->setGroups(['list']));

		$response = new Response($data);
		$response->headers->set('Content-Type', 'application/json');

		return $response;
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
		$data = $this->get('jms_serializer')->serialize($article, 'json',
		SerializationContext::create()->setGroups(['detail']));

		$response = new Response($data);
		$response->headers->set('Content-Type', 'application/json');

		return $response;
		return $this->render('articles/show.html.twig', [
			'article' => $article,
		]);
	}

	/**
	* @Route("/articles_create")
	* @Method("POST")
	**/
	public function new(Request $request) {
		$article = new Articles();

		$data = $request->getContent();
		$data = json_decode($data);

		$manager = $this->getDoctrine()->getManager();

		foreach($data as $key => $value) {
			$set = 'set' . ucfirst($key);
			$article->{$set}($value);
		}
		$manager->persist($article);

		$manager->flush();

		return new Response('', Response::HTTP_CREATED);
	}
}
