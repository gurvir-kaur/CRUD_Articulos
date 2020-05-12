<?php

namespace App\Entity;

use App\Repository\ArticulosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticulosRepository::class)
 */
class Articulos
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
    private $titulo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contenido;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $fecha_de_creacion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido): self
    {
        $this->contenido = $contenido;

        return $this;
    }

    public function getFechaDeCreacion(): ?string
    {
        return $this->fecha_de_creacion;
    }

    public function setFechaDeCreacion(string $fecha_de_creacion): self
    {
        $this->fecha_de_creacion = $fecha_de_creacion;

        return $this;
    }
}
