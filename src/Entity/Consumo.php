<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConsumoRepository")
 */
class Consumo implements \JsonSerializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\instalacoes", inversedBy="consumos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $instalacoes_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="consumos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $usuario_id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $credito;

    /**
     * @ORM\Column(type="float")
     */
    private $consumo;

    /**
     * @ORM\Column(type="date")
     */
    private $datareferencia;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstalacoesId(): ?instalacoes
    {
        return $this->instalacoes_id;
    }

    public function setInstalacoesId(?instalacoes $instalacoes_id): self
    {
        $this->instalacoes_id = $instalacoes_id;

        return $this;
    }

    public function getUsuarioId(): ?user
    {
        return $this->usuario_id;
    }

    public function setUsuarioId(?user $usuario_id): self
    {
        $this->usuario_id = $usuario_id;

        return $this;
    }

    public function getCredito(): ?bool
    {
        return $this->credito;
    }

    public function setCredito(bool $credito): self
    {
        $this->credito = $credito;

        return $this;
    }

    public function getConsumo(): ?float
    {
        return $this->consumo;
    }

    public function setConsumo(float $consumo): self
    {
        $this->consumo = $consumo;

        return $this;
    }

    public function getDatareferencia(): ?\DateTimeInterface
    {
        return $this->datareferencia;
    }

    public function setDatareferencia(\DateTimeInterface $datareferencia): self
    {
        $this->datareferencia = $datareferencia;

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return [
            'Id' => $this->getId(),
            'usuarioId' => $this->getUsuarioId()->getId(),
            'instalacaoId' => $this->getInstalacoesId()->getId(),
            'credito' => $this->getCredito(),
            'consumo' => $this->getConsumo(),
            'dataReferencia' => $this->getDatareferencia()->format('m-Y')
        ];
    }
}
