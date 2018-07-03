<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
* @ORM\Entity(repositoryClass="App\Repository\ImagesRepository")
*/
class Images
{
	/**
	* @ORM\Id()
	* @ORM\GeneratedValue()
	* @ORM\Column(type="integer")
	*/
	private $id;

	/**
	* @ORM\Column(type="string", length=255)
	*@Serializer\Groups({"detail", "list"})
	*/
	private $path;

	/**
	* @ORM\ManyToOne(targetEntity="App\Entity\Articles", inversedBy="images")
	* @ORM\JoinColumn(nullable=false)
	*/
	private $article;

	public function getId()
	{
		return $this->id;
	}

	public function getPath(): ?string
	{
		return $this->path;
	}

	public function setPath(string $path): self
	{
		$this->path = $path;

		return $this;
	}

	public function getArticle(): ?Articles
	{
		return $this->article;
	}

	public function setArticle(?Articles $article): self
	{
		$this->article = $article;

		return $this;
	}
}
