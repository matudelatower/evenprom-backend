<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

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
	 * @Gedmo\Slug(fields={"nombre"})
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
	 * @ORM\Column(name="cantidad_publicacion_comun", type="integer", nullable=true)
	 */
	private $cantidadPublicacionComun;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="cantidad_publicacion_exclusiva", type="integer", nullable=true)
	 */
	private $cantidadPublicacionExclusiva;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="perfil_empresa_video", type="boolean", nullable=true)
	 */
	private $perfilEmpresaVideo;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="perfil_empresa_foto", type="boolean", nullable=true)
	 */
	private $perfilEmpresaFoto;


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
	 * @var boolean
	 *
	 * @ORM\Column(name="compartir", type="boolean", nullable=true)
	 */
	private $compartir;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="link_web", type="boolean", nullable=true)
	 */
	private $linkWeb;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="boton_llamar", type="boolean", nullable=true)
	 */
	private $botonLlamar;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="deep_link", type="boolean", nullable=true)
	 */
	private $deepLink;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="mailing_operador", type="boolean", nullable=true)
	 */
	private $mailingOperador;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="usuario_vip_brasil", type="boolean", nullable=true)
	 */
	private $usuarioVipBrasil;



	/**
	 * NOTE: This is not a mapped field of entity metadata, just a simple property.
	 *
	 * @Vich\UploadableField(mapping="planes_image", fileNameProperty="imageName")
	 *
	 * @var File
	 *
	 * @Assert\File(mimeTypes={ "image/*" })
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
     * @return integer
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

    /**
     * Set geolocalizacion
     *
     * @param boolean $geolocalizacion
     *
     * @return Plan
     */
    public function setGeolocalizacion($geolocalizacion)
    {
        $this->geolocalizacion = $geolocalizacion;

        return $this;
    }

    /**
     * Get geolocalizacion
     *
     * @return boolean
     */
    public function getGeolocalizacion()
    {
        return $this->geolocalizacion;
    }

    /**
     * Set noticias
     *
     * @param boolean $noticias
     *
     * @return Plan
     */
    public function setNoticias($noticias)
    {
        $this->noticias = $noticias;

        return $this;
    }

    /**
     * Get noticias
     *
     * @return boolean
     */
    public function getNoticias()
    {
        return $this->noticias;
    }

    /**
     * Set cantidadPublicacionPremium
     *
     * @param integer $cantidadPublicacionPremium
     *
     * @return Plan
     */
    public function setCantidadPublicacionPremium($cantidadPublicacionPremium)
    {
        $this->cantidadPublicacionPremium = $cantidadPublicacionPremium;

        return $this;
    }

    /**
     * Get cantidadPublicacionPremium
     *
     * @return integer
     */
    public function getCantidadPublicacionPremium()
    {
        return $this->cantidadPublicacionPremium;
    }

    /**
     * Set cantidadPublicacionComun
     *
     * @param integer $cantidadPublicacionComun
     *
     * @return Plan
     */
    public function setCantidadPublicacionComun($cantidadPublicacionComun)
    {
        $this->cantidadPublicacionComun = $cantidadPublicacionComun;

        return $this;
    }

    /**
     * Get cantidadPublicacionComun
     *
     * @return integer
     */
    public function getCantidadPublicacionComun()
    {
        return $this->cantidadPublicacionComun;
    }

    /**
     * Set cantidadPublicacionExclusiva
     *
     * @param integer $cantidadPublicacionExclusiva
     *
     * @return Plan
     */
    public function setCantidadPublicacionExclusiva($cantidadPublicacionExclusiva)
    {
        $this->cantidadPublicacionExclusiva = $cantidadPublicacionExclusiva;

        return $this;
    }

    /**
     * Get cantidadPublicacionExclusiva
     *
     * @return integer
     */
    public function getCantidadPublicacionExclusiva()
    {
        return $this->cantidadPublicacionExclusiva;
    }

    /**
     * Set perfilEmpresaVideo
     *
     * @param boolean $perfilEmpresaVideo
     *
     * @return Plan
     */
    public function setPerfilEmpresaVideo($perfilEmpresaVideo)
    {
        $this->perfilEmpresaVideo = $perfilEmpresaVideo;

        return $this;
    }

    /**
     * Get perfilEmpresaVideo
     *
     * @return boolean
     */
    public function getPerfilEmpresaVideo()
    {
        return $this->perfilEmpresaVideo;
    }

    /**
     * Set perfilEmpresaFoto
     *
     * @param boolean $perfilEmpresaFoto
     *
     * @return Plan
     */
    public function setPerfilEmpresaFoto($perfilEmpresaFoto)
    {
        $this->perfilEmpresaFoto = $perfilEmpresaFoto;

        return $this;
    }

    /**
     * Get perfilEmpresaFoto
     *
     * @return boolean
     */
    public function getPerfilEmpresaFoto()
    {
        return $this->perfilEmpresaFoto;
    }

    /**
     * Set perfilEmpresaSlideFotos
     *
     * @param boolean $perfilEmpresaSlideFotos
     *
     * @return Plan
     */
    public function setPerfilEmpresaSlideFotos($perfilEmpresaSlideFotos)
    {
        $this->perfilEmpresaSlideFotos = $perfilEmpresaSlideFotos;

        return $this;
    }

    /**
     * Get perfilEmpresaSlideFotos
     *
     * @return boolean
     */
    public function getPerfilEmpresaSlideFotos()
    {
        return $this->perfilEmpresaSlideFotos;
    }

    /**
     * Set perfilEmpresallamada
     *
     * @param boolean $perfilEmpresallamada
     *
     * @return Plan
     */
    public function setPerfilEmpresallamada($perfilEmpresallamada)
    {
        $this->perfilEmpresallamada = $perfilEmpresallamada;

        return $this;
    }

    /**
     * Get perfilEmpresallamada
     *
     * @return boolean
     */
    public function getPerfilEmpresallamada()
    {
        return $this->perfilEmpresallamada;
    }

    /**
     * Set compartir
     *
     * @param boolean $compartir
     *
     * @return Plan
     */
    public function setCompartir($compartir)
    {
        $this->compartir = $compartir;

        return $this;
    }

    /**
     * Get compartir
     *
     * @return boolean
     */
    public function getCompartir()
    {
        return $this->compartir;
    }

    /**
     * Set linkWeb
     *
     * @param boolean $linkWeb
     *
     * @return Plan
     */
    public function setLinkWeb($linkWeb)
    {
        $this->linkWeb = $linkWeb;

        return $this;
    }

    /**
     * Get linkWeb
     *
     * @return boolean
     */
    public function getLinkWeb()
    {
        return $this->linkWeb;
    }

    /**
     * Set botonLlamar
     *
     * @param boolean $botonLlamar
     *
     * @return Plan
     */
    public function setBotonLlamar($botonLlamar)
    {
        $this->botonLlamar = $botonLlamar;

        return $this;
    }

    /**
     * Get botonLlamar
     *
     * @return boolean
     */
    public function getBotonLlamar()
    {
        return $this->botonLlamar;
    }

    /**
     * Set deepLink
     *
     * @param boolean $deepLink
     *
     * @return Plan
     */
    public function setDeepLink($deepLink)
    {
        $this->deepLink = $deepLink;

        return $this;
    }

    /**
     * Get deepLink
     *
     * @return boolean
     */
    public function getDeepLink()
    {
        return $this->deepLink;
    }

    /**
     * Set mailingOperador
     *
     * @param boolean $mailingOperador
     *
     * @return Plan
     */
    public function setMailingOperador($mailingOperador)
    {
        $this->mailingOperador = $mailingOperador;

        return $this;
    }

    /**
     * Get mailingOperador
     *
     * @return boolean
     */
    public function getMailingOperador()
    {
        return $this->mailingOperador;
    }

    /**
     * Set usuarioVipBrasil
     *
     * @param boolean $usuarioVipBrasil
     *
     * @return Plan
     */
    public function setUsuarioVipBrasil($usuarioVipBrasil)
    {
        $this->usuarioVipBrasil = $usuarioVipBrasil;

        return $this;
    }

    /**
     * Get usuarioVipBrasil
     *
     * @return boolean
     */
    public function getUsuarioVipBrasil()
    {
        return $this->usuarioVipBrasil;
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
}
