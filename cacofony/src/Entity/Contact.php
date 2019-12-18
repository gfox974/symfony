<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank(
     *      message="ne peut pas etre vide"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank(
     *      message="ne peut pas etre vide"
     * )
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\Length(
     *      min = 2,
     *      max = 60,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank(
     *      message="ne peut pas etre vide"
     * )
     */
    private $adresse;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(
     *      min = 2,
     *      max = 5,
     *      minMessage = "cp doit avoir au moins {{ limit }} chiffres",
     *      maxMessage = "cp doit avoir au max {{ limit }} chiffres"
     * )
     * @Assert\NotBlank(
     *      message="ne peut pas etre vide"
     * )
     */
    private $cp;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\Length(
     *      min = 2,
     *      max = 60,
     *      minMessage = "Your first name must be at least {{ limit }} characters long",
     *      maxMessage = "Your first name cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank(
     *      message="ne peut pas etre vide"
     * )
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(
     *      message="ne peut pas etre vide"
     * )
     * @Assert\Email(
     *      message="doit etre un mail valide"
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     * @Assert\GreaterThanOrEqual(
     *     value = 18,
     *     message="vous devez etre majeur"
     * )
     */
    private $age;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank(
     *      message="ne peut pas etre vide"
     * )
     */
    private $creeLe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Url(
     *      message="doit etre une url"
     * )
     */
    private $photo;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?int
    {
        return $this->cp;
    }

    public function setCp(int $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getCreeLe(): ?\DateTimeInterface
    {
        return $this->creeLe;
    }

    public function setCreeLe(\DateTimeInterface $creeLe): self
    {
        $this->creeLe = $creeLe;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
