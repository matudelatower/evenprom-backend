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
 * Direccion
 *
 * @ORM\Table(name="direcciones")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DireccionRepository")
 *
 * @ExclusionPolicy("all")
 */
class Direccion extends BaseClass {
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
	 * @ORM\Column(name="calle", type="string", length=255)
	 * @Expose()
	 */
	private $calle;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="altura", type="string", length=255)
	 * @Expose()
	 */
	private $altura;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="departamento", type="string", length=255, nullable=true)
	 * @Expose()
	 */
	private $departamento;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="piso", type="string", length=255, nullable=true)
	 * @Expose()
	 */
	private $piso;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="edificio", type="string", length=255, nullable=true)
	 * @Expose()
	 */
	private $edificio;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="Matudelatower\UbicacionBundle\Entity\Localidad")
	 * @ORM\JoinColumn(name="localidad_id", referencedColumnName="id")
	 */
	private $localidad;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\DireccionEmpresa", mappedBy="direccion", cascade={"persist", "remove"})
	 */
	private $direccionEmpresa;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="lat", type="string", length=255, nullable=true)
	 * @Expose()
	 */
	private $lat;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="lng", type="string", length=255, nullable=true)
	 * @Expose()
	 */
	private $lng;


	/**
	 * @VirtualProperty()
	 * @SerializedName("localidad")
	 */
	public function getJsonLocalidad() {

		$return = null;


		if ( $this->getLocalidad() ) {
			$return = $this->getLocalidad()->getDescripcion();
		}

		return $return;

	}
	/**
	 * @VirtualProperty()
	 * @SerializedName("departamento_localidad")
	 */
	public function getJsonDepartamento() {

		$return = null;


		if ( $this->getLocalidad() ) {
			$return = $this->getLocalidad()->getDepartamento()->getDescripcion();
		}

		return $return;

	}
	/**
	 * @VirtualProperty()
	 * @SerializedName("provincia")
	 */
	public function getJsonProvincia() {

		$return = null;


		if ( $this->getLocalidad() ) {
			$return = $this->getLocalidad()->getDepartamento()->getProvincia()->getDescripcion();
		}

		return $return;

	}
	/**
	 * @VirtualProperty()
	 * @SerializedName("pais")
	 */
	public function getJsonPais() {

		$return = null;


		if ( $this->getLocalidad() ) {
			$return = $this->getLocalidad()->getDepartamento()->getProvincia()->getPais()->getDescripcion();
		}

		return $return;

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
	 * Set calle
	 *
	 * @param string $calle
	 *
	 * @return Direccion
	 */
	public function setCalle( $calle ) {
		$this->calle = $calle;

		return $this;
	}

	/**
	 * Get calle
	 *
	 * @return string
	 */
	public function getCalle() {
		return $this->calle;
	}

	/**
	 * Set altura
	 *
	 * @param string $altura
	 *
	 * @return Direccion
	 */
	public function setAltura( $altura ) {
		$this->altura = $altura;

		return $this;
	}

	/**
	 * Get altura
	 *
	 * @return string
	 */
	public function getAltura() {
		return $this->altura;
	}

	/**
	 * Set departamento
	 *
	 * @param string $departamento
	 *
	 * @return Direccion
	 */
	public function setDepartamento( $departamento ) {
		$this->departamento = $departamento;

		return $this;
	}

	/**
	 * Get departamento
	 *
	 * @return string
	 */
	public function getDepartamento() {
		return $this->departamento;
	}

	/**
	 * Set piso
	 *
	 * @param string $piso
	 *
	 * @return Direccion
	 */
	public function setPiso( $piso ) {
		$this->piso = $piso;

		return $this;
	}

	/**
	 * Get piso
	 *
	 * @return string
	 */
	public function getPiso() {
		return $this->piso;
	}

	/**
	 * Set edificio
	 *
	 * @param string $edificio
	 *
	 * @return Direccion
	 */
	public function setEdificio( $edificio ) {
		$this->edificio = $edificio;

		return $this;
	}

	/**
	 * Get edificio
	 *
	 * @return string
	 */
	public function getEdificio() {
		return $this->edificio;
	}

	/**
	 * Set fechaCreacion
	 *
	 * @param \DateTime $fechaCreacion
	 *
	 * @return Direccion
	 */
	public function setFechaCreacion( $fechaCreacion ) {
		$this->fechaCreacion = $fechaCreacion;

		return $this;
	}

	/**
	 * Set fechaActualizacion
	 *
	 * @param \DateTime $fechaActualizacion
	 *
	 * @return Direccion
	 */
	public function setFechaActualizacion( $fechaActualizacion ) {
		$this->fechaActualizacion = $fechaActualizacion;

		return $this;
	}

	/**
	 * Set localidad
	 *
	 * @param \Matudelatower\UbicacionBundle\Entity\Localidad $localidad
	 *
	 * @return Direccion
	 */
	public function setLocalidad( \Matudelatower\UbicacionBundle\Entity\Localidad $localidad = null ) {
		$this->localidad = $localidad;

		return $this;
	}

	/**
	 * Get localidad
	 *
	 * @return \Matudelatower\UbicacionBundle\Entity\Localidad
	 */
	public function getLocalidad() {
		return $this->localidad;
	}

	/**
	 * Set creadoPor
	 *
	 * @param \UsuariosBundle\Entity\Usuario $creadoPor
	 *
	 * @return Direccion
	 */
	public function setCreadoPor( \UsuariosBundle\Entity\Usuario $creadoPor = null ) {
		$this->creadoPor = $creadoPor;

		return $this;
	}

	/**
	 * Set actualizadoPor
	 *
	 * @param \UsuariosBundle\Entity\Usuario $actualizadoPor
	 *
	 * @return Direccion
	 */
	public function setActualizadoPor( \UsuariosBundle\Entity\Usuario $actualizadoPor = null ) {
		$this->actualizadoPor = $actualizadoPor;

		return $this;
	}
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->direccionEmpresa = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add direccionEmpresa
     *
     * @param \AppBundle\Entity\DireccionEmpresa $direccionEmpresa
     *
     * @return Direccion
     */
    public function addDireccionEmpresa(\AppBundle\Entity\DireccionEmpresa $direccionEmpresa)
    {
        $this->direccionEmpresa[] = $direccionEmpresa;

        return $this;
    }

    /**
     * Remove direccionEmpresa
     *
     * @param \AppBundle\Entity\DireccionEmpresa $direccionEmpresa
     */
    public function removeDireccionEmpresa(\AppBundle\Entity\DireccionEmpresa $direccionEmpresa)
    {
        $this->direccionEmpresa->removeElement($direccionEmpresa);
    }

    /**
     * Get direccionEmpresa
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDireccionEmpresa()
    {
        return $this->direccionEmpresa;
    }

    /**
     * Set lat
     *
     * @param string $lat
     *
     * @return Direccion
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     *
     * @return Direccion
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string
     */
    public function getLng()
    {
        return $this->lng;
    }
}
