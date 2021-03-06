<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * HotelAgencia
 *
 * @ORM\Table(name="hoteles_agencias")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\HotelAgenciaRepository")
 */
class HotelAgencia extends BaseClass{
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
	 * @Gedmo\Slug(fields={"nombre"})
	 * @ORM\Column(name="slug", type="string", length=255, unique=true)
	 */
	private $slug;


	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\EmpresaHotelAgencia", mappedBy="hotelAgencia", cascade={"persist", "remove"})
	 */
	private $empresaHotelAgencia;

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
     * Constructor
     */
    public function __construct()
    {
        $this->empresaHotelAgencia = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return HotelAgencia
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
     * @return HotelAgencia
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
     * Set slug
     *
     * @param string $slug
     * @return HotelAgencia
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Add empresaHotelAgencia
     *
     * @param \AppBundle\Entity\EmpresaHotelAgencia $empresaHotelAgencia
     * @return HotelAgencia
     */
    public function addEmpresaHotelAgencium(\AppBundle\Entity\EmpresaHotelAgencia $empresaHotelAgencia)
    {
        $this->empresaHotelAgencia[] = $empresaHotelAgencia;

        return $this;
    }

    /**
     * Remove empresaHotelAgencia
     *
     * @param \AppBundle\Entity\EmpresaHotelAgencia $empresaHotelAgencia
     */
    public function removeEmpresaHotelAgencium(\AppBundle\Entity\EmpresaHotelAgencia $empresaHotelAgencia)
    {
        $this->empresaHotelAgencia->removeElement($empresaHotelAgencia);
    }

    /**
     * Get empresaHotelAgencia
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmpresaHotelAgencia()
    {
        return $this->empresaHotelAgencia;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return HotelAgencia
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
     * @return HotelAgencia
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
     * @return HotelAgencia
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
     * @return HotelAgencia
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
