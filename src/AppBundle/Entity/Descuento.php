<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * Descuento
 *
 * @ORM\Table(name="descuentos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DescuentoRepository")
 */
class Descuento extends BaseClass
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true, unique=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="porcentaje", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $porcentaje;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DescuentoPublicacion", mappedBy="descuento", cascade={"persist", "remove"})
     */
    private $descuentoPublicacion;


    /**
     * @var string
     *
     * @ORM\Column(name="abreviacion", type="string", length=255, nullable=true)
     */
    private $abreviacion;

    public function __toString() {
        return $this->nombre;
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Descuento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Descuento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set porcentaje
     *
     * @param string $porcentaje
     * @return Descuento
     */
    public function setPorcentaje($porcentaje)
    {
        $this->porcentaje = $porcentaje;

        return $this;
    }

    /**
     * Get porcentaje
     *
     * @return string 
     */
    public function getPorcentaje()
    {
        return $this->porcentaje;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Descuento
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return Descuento
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     * @return Descuento
     */
    public function setCreadoPor(\UsuariosBundle\Entity\Usuario $creadoPor = null)
    {
        $this->creadoPor = $creadoPor;

        return $this;
    }

    /**
     * Set actualizadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $actualizadoPor
     * @return Descuento
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->descuentoPublicacion = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add descuentoPublicacion
     *
     * @param \AppBundle\Entity\DescuentoPublicacion $descuentoPublicacion
     * @return Descuento
     */
    public function addDescuentoPublicacion(\AppBundle\Entity\DescuentoPublicacion $descuentoPublicacion)
    {
        $this->descuentoPublicacion[] = $descuentoPublicacion;

        return $this;
    }

    /**
     * Remove descuentoPublicacion
     *
     * @param \AppBundle\Entity\DescuentoPublicacion $descuentoPublicacion
     */
    public function removeDescuentoPublicacion(\AppBundle\Entity\DescuentoPublicacion $descuentoPublicacion)
    {
        $this->descuentoPublicacion->removeElement($descuentoPublicacion);
    }

    /**
     * Get descuentoPublicacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDescuentoPublicacion()
    {
        return $this->descuentoPublicacion;
    }

    /**
     * Set abreviacion
     *
     * @param string $abreviacion
     * @return Descuento
     */
    public function setAbreviacion($abreviacion)
    {
        $this->abreviacion = $abreviacion;

        return $this;
    }

    /**
     * Get abreviacion
     *
     * @return string 
     */
    public function getAbreviacion()
    {
        return $this->abreviacion;
    }
}
