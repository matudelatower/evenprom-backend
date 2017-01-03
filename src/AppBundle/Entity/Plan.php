<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Plan
 *
 * @Vich\Uploadable
 * @ORM\Table(name="planes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PlanRepository")
 */
class Plan extends BaseClass
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
     * @ORM\Column(name="valor", type="decimal", precision=10, scale=2)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, unique=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="periodo", type="integer")
	 */
	private $periodo;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="slug", type="string", length=255, nullable=true)
	 */
	private $slug;


	/**
	 * @var string
	 *
	 * @ORM\Column(name="boton_mercado_pago", type="text", nullable=true)
	 */
	private $botonMercadoPago;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="boton_pay_pal", type="text", nullable=true)
	 */
	private $botonPayPal;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="geolocalizacion", type="boolean", nullable=true)
	 */
	private $geolocalizacion;


	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="noticias", type="boolean", nullable=true)
	 */
	private $noticias;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="cantidad_publicacion_premium", type="integer", nullable=true)
	 */
	private $cantidadPublicacionPremium;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="cantidad_publicaciones_comun", type="integer", nullable=true)
	 */
	private $cantidadPublicacionesComun;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="perfil_empresa_video", type="boolean", nullable=true)
	 */
	private $perfilEmpresaVideo;


	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="perfil_empresa_slide_fotos", type="boolean", nullable=true)
	 */
	private $perfilEmpresaSlideFotos;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="perfil_empresa_llamada", type="boolean", nullable=true)
	 */
	private $perfilEmpresallamada;



	/**
	 * NOTE: This is not a mapped field of entity metadata, just a simple property.
	 *
	 * @Vich\UploadableField(mapping="planes_image", fileNameProperty="imageName")
	 *
	 * @var File
	 */
	private $imageFile;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 *
	 * @var string
	 *
	 */
	private $imageName;

	/**
	 * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
	 * of 'UploadedFile' is injected into this setter to trigger the  update. If this
	 * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
	 * must be able to accept an instance of 'File' as the bundle will inject one here
	 * during Doctrine hydration.
	 *
	 * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
	 *
	 * @return Product
	 */
	public function setImageFile( File $image = null ) {
		$this->imageFile = $image;

		if ( $image ) {
			// It is required that at least one field changes if you are using doctrine
			// otherwise the event listeners won't be called and the file is lost
			$this->fechaActualizacion = new \DateTime( 'now' );
		}

		return $this;
	}

	/**
	 * @return File
	 */
	public function getImageFile() {
		return $this->imageFile;
	}

	/**
	 * @param string $imageName
	 *
	 */
	public function setImageName( $imageName ) {
		$this->imageName = $imageName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getImageName() {
		return $this->imageName;
	}


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return Plan
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Plan
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
     *
     * @return Plan
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
     * Set periodo
     *
     * @param integer $periodo
     *
     * @return Plan
     */
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get periodo
     *
     * @return integer
     */
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Plan
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
     *
     * @return Plan
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
     *
     * @return Plan
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
     *
     * @return Plan
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Plan
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
     * Set botonMercadoPago
     *
     * @param string $botonMercadoPago
     *
     * @return Plan
     */
    public function setBotonMercadoPago($botonMercadoPago)
    {
        $this->botonMercadoPago = $botonMercadoPago;

        return $this;
    }

    /**
     * Get botonMercadoPago
     *
     * @return string
     */
    public function getBotonMercadoPago()
    {
        return $this->botonMercadoPago;
    }

    /**
     * Set botonPayPal
     *
     * @param string $botonPayPal
     *
     * @return Plan
     */
    public function setBotonPayPal($botonPayPal)
    {
        $this->botonPayPal = $botonPayPal;

        return $this;
    }

    /**
     * Get botonPayPal
     *
     * @return string
     */
    public function getBotonPayPal()
    {
        return $this->botonPayPal;
    }
}
