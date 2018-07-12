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
use App\Entity\Images;
use App\Repository\ArticlesRepository;
use App\Repository\ImagesRepository;

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
	* @Route("articles/new", name="home")
	* @Method("POST")
	**/
	public function new(Request $request) {
		$article = new Articles();
		$data = $request->getContent();
		$data = json_decode($data);
		$manager = $this->getDoctrine()->getManager();

		foreach($data->attributes as $key => $value) {
			$set = 'set' . ucfirst($key);
			$article->{$set}($value);
		}
		$manager->persist($article);
		$manager->flush();

		$id = $article->getId();
		return new Response($id, Response::HTTP_CREATED);
	}

	/**
	* @Route("/articles/{id}", requirements={"id" = "\d+"}, name="articles_show")
	**/
	public function show(Articles $article) {
		$data = $this->get('jms_serializer')->serialize($article, 'json',
		SerializationContext::create()->setGroups(['detail']));
		$response = new Response($data);
		$response->headers->set('Content-Type', 'application/json');
		$response->headers->set('Access-Control-Allow-Origin', '*');
		return $response;
	}

	/**
	* @Route("/articles/storeImages", name="articles_create")
	* @Method("POST")
	**/
	public function storeImages(Request $request, ArticlesRepository $repo)
	{
		$data = $request->files;
		$manager = $this->getDoctrine()->getManager();
		$id = $request->request->get('article_id');

		$article = $repo->find($id);
		for($i = 0; $i < count($request->files); $i++)
		{
			$name = "file" . $i;
			$ext = "." . $request->files->get($name)->getClientOriginalExtension();
			$file = $request->files->get("file" . $i);
			$path = "pictures/" . uniqid((string)(rand()*5)) . $ext;
			move_uploaded_file($file ,$path);
			$em = $this->getDoctrine()->getManager();
			$image = new Images();
			$image->setPath($path);
			$manager->persist($image);
			$article->addImage($image);
			$manager->flush();
		}
		$manager->persist($article);
		$manager->flush();

		$response = new Response("OUIIII", Response::HTTP_CREATED);
		return $response;
	}
}
