<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @UniqueEntity(fields={"username"}, message="There is already an account with this username")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @ORM\ManyToOne(targetEntity=UserPosition::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idPosition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $testingSystems;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raportingSystems;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $selenium = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ideEnvironments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $programmingLanguages;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default": false})
     */
    private $mysql = false;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $methodologies;

    /**
     * @ORM\Column(type="boolean", nullable=true, options={"default": false})
     */
    private $scrum = false;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getIdPosition(): ?UserPosition
    {
        return $this->idPosition;
    }

    public function setIdPosition(?UserPosition $idPosition): self
    {
        $this->idPosition = $idPosition;

        return $this;
    }

    public function getTestingSystems(): ?string
    {
        return $this->testingSystems;
    }

    public function setTestingSystems(?string $testingSystems): self
    {
        $this->testingSystems = $testingSystems;

        return $this;
    }

    public function getRaportingSystems(): ?string
    {
        return $this->raportingSystems;
    }

    public function setRaportingSystems(?string $raportingSystems): self
    {
        $this->raportingSystems = $raportingSystems;

        return $this;
    }

    public function isSelenium(): ?bool
    {
        return $this->selenium;
    }

    public function setSelenium(bool $selenium): self
    {
        $this->selenium = $selenium;

        return $this;
    }

    public function getIdeEnvironments(): ?string
    {
        return $this->ideEnvironments;
    }

    public function setIdeEnvironments(?string $ideEnvironments): self
    {
        $this->ideEnvironments = $ideEnvironments;

        return $this;
    }

    public function getProgrammingLanguages(): ?string
    {
        return $this->programmingLanguages;
    }

    public function setProgrammingLanguages(?string $programmingLanguages): self
    {
        $this->programmingLanguages = $programmingLanguages;

        return $this;
    }

    public function isMysql(): ?bool
    {
        return $this->mysql;
    }

    public function setMysql(bool $mysql): self
    {
        $this->mysql = $mysql;

        return $this;
    }

    public function getMethodologies(): ?string
    {
        return $this->methodologies;
    }

    public function setMethodologies(string $methodologies): self
    {
        $this->methodologies = $methodologies;

        return $this;
    }

    public function isScrum(): ?bool
    {
        return $this->scrum;
    }

    public function setScrum(bool $scrum): self
    {
        $this->scrum = $scrum;

        return $this;
    }
}
