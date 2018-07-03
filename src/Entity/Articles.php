<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
		$this->images = new ArrayCollection();
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
	* @ORM\Column(type="datetime")
	* @Serializer\Groups({"detail", "list"})
	*/
	private $createdAt;

	/**
	* @ORM\OneToMany(targetEntity="App\Entity\Images", mappedBy="article", orphanRemoval=true)
	* @Serializer\Groups({"detail", "list"})
	*/
	private $images;


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

	public function getCreatedAt(): ?\DateTimeInterface
	{
		return $this->createdAt;
	}

	public function setCreatedAt(\DateTimeInterface $createdAt): self
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	/**
	* @return Collection|Images[]
	*/
	public function getImages(): Collection
	{
		return $this->images;
	}

	public function addImage(Images $image): self
	{
		if (!$this->images->contains($image)) {
			$this->images[] = $image;
			$image->setArticle($this);
		}

		return $this;
	}

	public function removeImage(Images $image): self
	{
		if ($this->images->contains($image)) {
			$this->images->removeElement($image);
			// set the owning side to null (unless already changed)
			if ($image->getArticle() === $this) {
				$image->setArticle(null);
			}
		}

		return $this;
	}
}
