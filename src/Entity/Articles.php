<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId()
    {
        return $this->id;
    }

	/**
	*@ORM\Column(type="string")
	**/
	private $name;

	/**
	*@return mixed
	**/

	public function getName()
	{
		return $this->name;
	}

	/**
	*@param mixed $name
	**/

	public function setName($name) : void
	{
		$this->name = $name;
	}

	/**
	*@ORM\Column(type="text")
	**/

	private $description;

	/**
	*@return mixed
	**/

	public function getDescription()
	{
		return $this->description;
	}

	/**
	*@param mixed $description
	**/

	public function setDescription($description) : void
	{
		$this->description = $description;
	}

}
