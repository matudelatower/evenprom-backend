<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * Onda
 *
 * @ORM\Table(name="ondas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OndaRepository")
 * @ExclusionPolicy("all")
 */
class Onda extends BaseClass{
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
	 * @ORM\Column(name="nombre", type="string", length=255, unique=true)
	 * @Expose()
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
	 * @ORM\Column(name="slug", type="string", length=255, unique=true)
	 * @Expose()
	 */
	private $slug;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\EmpresaOnda", mappedBy="onda", cascade={"persist", "remove"})
	 */
	private $empresaOnda;

	public function __toString() {
		return $this->nombre;
	}
	

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set nombre
	 *
	 * @param string $nombre
	 *
	 * @return Onda
	 */
	public function setNombre( $nombre ) {
		$this->nombre = $nombre;

		return $this;
	}

	/**
	 * Get nombre
	 *
	 * @return string
	 */
	public function getNombre() {
		return $this->nombre;
	}

	/**
	 * Set descripcion
	 *
	 * @param string $descripcion
	 *
	 * @return Onda
	 */
	public function setDescripcion( $descripcion ) {
		$this->descripcion = $descripcion;

		return $this;
	}

	/**
	 * Get descripcion
	 *
	 * @return string
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}

	/**
	 * Set slug
	 *
	 * @param string $slug
	 *
	 * @return Onda
	 */
	public function setSlug( $slug ) {
		$this->slug = $slug;

		return $this;
	}

	/**
	 * Get slug
	 *
	 * @return string
	 */
	public function getSlug() {
		return $this->slug;
	}
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->empresaOnda = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Onda
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
     * @return Onda
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Add empresaOnda
     *
     * @param \AppBundle\Entity\EmpresaOnda $empresaOnda
     * @return Onda
     */
    public function addEmpresaOnda(\AppBundle\Entity\EmpresaOnda $empresaOnda)
    {
        $this->empresaOnda[] = $empresaOnda;

        return $this;
    }

    /**
     * Remove empresaOnda
     *
     * @param \AppBundle\Entity\EmpresaOnda $empresaOnda
     */
    public function removeEmpresaOnda(\AppBundle\Entity\EmpresaOnda $empresaOnda)
    {
        $this->empresaOnda->removeElement($empresaOnda);
    }

    /**
     * Get empresaOnda
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmpresaOnda()
    {
        return $this->empresaOnda;
    }

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     * @return Onda
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
     * @return Onda
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
