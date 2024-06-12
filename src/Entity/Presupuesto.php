<?php

namespace App\Entity;

use App\Repository\PresupuestoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PresupuestoRepository::class)]
class Presupuesto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;


    #[ORM\Column]
    private ?float $Total = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Fecha_pedido = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $Fecha_modificación = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): static
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function setId(int $Id): static
    {
        $this->Id = $Id;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->Total;
    }

    public function setTotal(float $Total): static
    {
        $this->Total = $Total;

        return $this;
    }

    public function getFechaPedido(): ?\DateTimeInterface
    {
        return $this->Fecha_pedido;
    }

    #[ORM\PrePersist]
    public function setFechaPedido(\DateTimeInterface $Fecha_pedido): self
    {
        $this->Fecha_pedido = $Fecha_pedido;

        return $this;
    }

    public function getFechaModificación(): ?\DateTimeInterface
    {
        return $this->Fecha_modificación;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setFechaModificación(?\DateTimeInterface $Fecha_modificación): self
    {
        $this->Fecha_modificación = $Fecha_modificación;

        return $this;
    }
}
