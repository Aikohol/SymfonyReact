<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Repository\ImagesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Images;
use JMS\Serializer\SerializationContext;



class ImagesController extends Controller
{
	/**
	* @Route("/images", name="images")
	*/
	public function index(ImagesRepository $repo)
	{
		$images = $repo->findAll();
		$data = $this->get('jms_serializer')->serialize($images, 'json');

		$response = new Response($data);
		$response->headers->set('Content-Type', 'application/json');

		return $response;
		return $this->render('images/index.html.twig', [
			'controller_name' => 'ImagesController',
		]);
	}

	/**
	* @Route("/images/new")
	* @Method("POST")
	**/
	public function new(Request $request) {
		$image = new Images();

		$data = $request->getContent();
		$data = json_decode($data);

		$manager = $this->getDoctrine()->getManager();

		$image->setPath($data->path);
		$image->setArticle($data->article_id);

		$manager->persist($image);

		$manager->flush();

		return new Response('', Response::HTTP_CREATED);
	}
}
