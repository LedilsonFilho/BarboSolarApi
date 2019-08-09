<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $username;

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
     * @ORM\OneToMany(targetEntity="App\Entity\Instalacoes", mappedBy="usuario")
     */
    private $instalacoes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consumo", mappedBy="usuario_id")
     */
    private $consumos;

    public function __construct()
    {
        $this->instalacoes = new ArrayCollection();
        $this->consumos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Instalacoes[]
     */
    public function getInstalacoes(): Collection
    {
        return $this->instalacoes;
    }

    public function addInstalaco(Instalacoes $instalaco): self
    {
        if (!$this->instalacoes->contains($instalaco)) {
            $this->instalacoes[] = $instalaco;
            $instalaco->setUsuario($this);
        }

        return $this;
    }

    public function removeInstalaco(Instalacoes $instalaco): self
    {
        if ($this->instalacoes->contains($instalaco)) {
            $this->instalacoes->removeElement($instalaco);
            // set the owning side to null (unless already changed)
            if ($instalaco->getUsuario() === $this) {
                $instalaco->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Consumo[]
     */
    public function getConsumos(): Collection
    {
        return $this->consumos;
    }

    public function addConsumo(Consumo $consumo): self
    {
        if (!$this->consumos->contains($consumo)) {
            $this->consumos[] = $consumo;
            $consumo->setUsuarioId($this);
        }

        return $this;
    }

    public function removeConsumo(Consumo $consumo): self
    {
        if ($this->consumos->contains($consumo)) {
            $this->consumos->removeElement($consumo);
            // set the owning side to null (unless already changed)
            if ($consumo->getUsuarioId() === $this) {
                $consumo->setUsuarioId(null);
            }
        }

        return $this;
    }
}
