<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InstalacoesRepository")
 */
class Instalacoes implements \JsonSerializable
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
    private $endereco;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $geolocalizacao;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $concessionaria;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codclienteconc;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codinstalacaoconc;

    /**
     * @ORM\Column(type="boolean")
     */
    private $titulareouser;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titular;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $cpftitular;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $pessfisica;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="instalacoes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Consumo", mappedBy="instalacoes_id")
     */
    private $consumos;

    public function __construct()
    {
        $this->consumos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEndereco(): ?string
    {
        return $this->endereco;
    }

    public function setEndereco(string $endereco): self
    {
        $this->endereco = $endereco;

        return $this;
    }

    public function getGeolocalizacao(): ?string
    {
        return $this->geolocalizacao;
    }

    public function setGeolocalizacao(?string $geolocalizacao): self
    {
        $this->geolocalizacao = $geolocalizacao;

        return $this;
    }

    public function getConcessionaria(): ?string
    {
        return $this->concessionaria;
    }

    public function setConcessionaria(string $concessionaria): self
    {
        $this->concessionaria = $concessionaria;

        return $this;
    }

    public function getCodclienteconc(): ?string
    {
        return $this->codclienteconc;
    }

    public function setCodclienteconc(string $codclienteconc): self
    {
        $this->codclienteconc = $codclienteconc;

        return $this;
    }

    public function getCodinstalacaoconc(): ?string
    {
        return $this->codinstalacaoconc;
    }

    public function setCodinstalacaoconc(string $codinstalacaoconc): self
    {
        $this->codinstalacaoconc = $codinstalacaoconc;

        return $this;
    }

    public function getTitulareouser(): ?bool
    {
        return $this->titulareouser;
    }

    public function setTitulareouser(bool $titulareouser): self
    {
        $this->titulareouser = $titulareouser;

        return $this;
    }

    public function getTitular(): ?string
    {
        return $this->titular;
    }

    public function setTitular(?string $titular): self
    {
        $this->titular = $titular;

        return $this;
    }

    public function getCpftitular(): ?string
    {
        return $this->cpftitular;
    }

    public function setCpftitular(?string $cpftitular): self
    {
        $this->cpftitular = $cpftitular;

        return $this;
    }

    public function getPessfisica(): ?bool
    {
        return $this->pessfisica;
    }

    public function setPessfisica(?bool $pessfisica): self
    {
        $this->pessfisica = $pessfisica;

        return $this;
    }

    public function getUsuario(): ?User
    {
        return $this->usuario;
    }

    public function setUsuario(?User $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'Id' => $this->getId(),
            'usuarioId' => $this->getUsuario()->getId(),
            'endereco' => $this->getEndereco(),
            'geolocalizacao' => $this->getGeolocalizacao(),
            'concessionaria' => $this->getConcessionaria(),
            'codclienteconc' => $this->getCodclienteconc(),
            'codinstalacaoconc' => $this->getCodinstalacaoconc(),
            'pessfisica' => $this->getPessfisica(),
            'titulareouser' =>$this->getTitulareouser(),
            'cpftitular' => $this->getCpftitular(),
            'titular' =>$this->getTitular(),
            '_link' => [
                [
                    'rel' => 'self',
                    'path' => '/instalacoes/' . $this->getId()
                ]
            ]
        ];
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
            $consumo->setInstalacoesId($this);
        }

        return $this;
    }

    public function removeConsumo(Consumo $consumo): self
    {
        if ($this->consumos->contains($consumo)) {
            $this->consumos->removeElement($consumo);
            // set the owning side to null (unless already changed)
            if ($consumo->getInstalacoesId() === $this) {
                $consumo->setInstalacoesId(null);
            }
        }

        return $this;
    }
}
