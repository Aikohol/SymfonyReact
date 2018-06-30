<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
* @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
* @ORM\Entity
* @ORM\Table()
*/
class Articles
{
	public function __construct() {
		$this->createdAt = new \DateTime();
	}
	/**
	* @ORM\Id()
	* @ORM\GeneratedValue()
	* @ORM\Column(type="integer")
	* @Serializer\Groups({"list"})
	*/
	private $id;

	/**
	* @ORM\Column(type="string", length=255)
	* @Serializer\Groups({"detail", "list"})
	*/
	private $name;

	/**
	* @ORM\Column(type="text")
	* @Serializer\Groups({"detail"})
	*/
	private $content;

	/**
	* @ORM\Column(type="string", length=255)
	* @Serializer\Groups({"detail", "list"})
	*/
	private $image;

	/**
	* @ORM\Column(type="datetime")
	* @Serializer\Groups({"detail", "list"})
	*/
	private $createdAt;


	public function getId()
	{
		return $this->id;
	}

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;

		return $this;
	}

	public function getContent(): ?string
	{
		return $this->content;
	}

	public function setContent(string $content): self
	{
		$this->content = $content;

		return $this;
	}

	public function getImage(): ?string
	{
		return $this->image;
	}

	public function setImage(string $image): self
	{
		$this->image = $image;

		return $this;
	}

	public function getCreatedAt(): ?\DateTimeInterface
	{
		return $this->createdAt;
	}

	public function setCreatedAt(\DateTimeInterface $createdAt): self
	{
		$this->createdAt = $createdAt;

		return $this;
	}
}
