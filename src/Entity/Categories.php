<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRepository")
 */
class Categories
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;
    
     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Oeuvres", mappedBy="Categories")
     */
    private $oeuvres;
    
    public function __construct()
    {
        $this->oeuvres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;

    }

     
    /**
     * @param mixed $oeuvres
     */
    public function setOeuvres($oeuvres): void
    {
        $this->oeuvres = $oeuvres;
    public function getOeuvres()
    {
        return $this->getOeuvres();

    }


}
