<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Publicacion
 *
 * @Vich\Uploadable
 * @ORM\Table(name="publicaciones")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PublicacionRepository")
 * @ExclusionPolicy("all")
 */
class Publicacion extends BaseClass {
	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @Expose()
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="titulo", type="string", length=255)
	 * @Expose()
	 */
	private $titulo;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
	 * @Expose()
	 */
	private $descripcion;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="fecha_inicio", type="date")
	 * @Expose()
	 */
	private $fechaInicio;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="fecha_fin", type="date")
	 * @Expose()
	 */
	private $fechaFin;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="hora_inicio", type="time", nullable=true)
	 * @Expose()
	 * @Type("DateTime<'H:i'>")
	 */
	private $horaInicio;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="hora_fin", type="time", nullable=true)
	 * @Expose()
	 */
	private $horaFin;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\CategoriaPublicacion", mappedBy="publicacion", cascade={"persist", "remove"})
	 */
	private $categoriaPublicacion;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\EtiquetaPublicacion", mappedBy="publicacion", cascade={"persist", "remove"})
	 */
	private $etiquetaPublicacion;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\DescuentoPublicacion", mappedBy="publicacion", cascade={"persist", "remove"})
	 */
	private $descuentoPublicacion;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="cuerpo", type="text", nullable=true)
	 * @Expose()
	 */
	private $cuerpo;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoPublicacion")
	 * @ORM\JoinColumn(name="tipo_publicacion_id", referencedColumnName="id")
	 */
	private $tipoPublicacion;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\PublicacionEmpresa", mappedBy="publicacion", cascade={"persist", "remove"})
	 */
	private $publicacionEmpresa;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\LikesSharePorElemento", mappedBy="publicacion", cascade={"persist", "remove"})
	 */
	private $likeSharePorElemento;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="publicado", type="boolean", nullable=true)
	 */
	protected $publicado = true;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Favorito", mappedBy="publicacion", cascade={"persist", "remove"})
	 */
	private $favorito;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\CheckIn", mappedBy="publicacion", cascade={"persist", "remove"})
	 */
	private $checkIn;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoEvento")
	 * @ORM\JoinColumn(name="tipo_evento_id", referencedColumnName="id")
	 */
	private $tipoEvento;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\FechaPublicacion", mappedBy="publicacion")
	 */
	private $fechaPublicacion;

	/**
	 * NOTE: This is not a mapped field of entity metadata, just a simple property.
	 *
	 * @Vich\UploadableField(mapping="publicaciones_image", fileNameProperty="imageName")
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
	 * @Expose()
	 * @SerializedName("imagen_publicacion")
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
	 * @return Product
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
	 * @VirtualProperty()
	 * @SerializedName("premium")
	 */
	public function getPremium() {

		$return = false;

		if ( $this->getPublicacionEmpresa()->first()->getEmpresa()->getPremium() ) {
			$return = true;
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("empresa_id")
	 */
	public function getEmpresa() {

		$return = false;

		if ( $this->getPublicacionEmpresa()->first()->getEmpresa()->getId() ) {
			$return = $this->getPublicacionEmpresa()->first()->getEmpresa()->getId();
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("nombre_empresa")
	 */
	public function getNombreEmpresa() {

		$return = false;

		if ( $this->getPublicacionEmpresa()->first()->getEmpresa()->getNombre() ) {
			$return = $this->getPublicacionEmpresa()->first()->getEmpresa()->getNombre();
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("direccion_empresa")
	 */
	public function getDireccionEmpresa() {

		$return = array();

		if ( count( $this->getPublicacionEmpresa()->first()->getEmpresa()->getDireccionEmpresa() ) > 0 ) {
			if ( $this->getPublicacionEmpresa()->first()->getEmpresa()->getDireccionEmpresa()->first()->getDireccion() ) {
				$return = $this->getPublicacionEmpresa()->first()->getEmpresa()->getDireccionEmpresa()->first()->getDireccion();
			}
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("contacto_empresa")
	 */
	public function getContactoEmpresa() {

		$return = array();

		if ( $this->getPublicacionEmpresa()->first()->getEmpresa()->getContactoEmpresa()->first() ) {

			if ( $this->getPublicacionEmpresa()->first()->getEmpresa()->getContactoEmpresa()->first()->getContacto() ) {
				$return = $this->getPublicacionEmpresa()->first()->getEmpresa()->getContactoEmpresa()->first()->getContacto();
			}
		}

		return $return;

	}


	/**
	 * @VirtualProperty()
	 * @SerializedName("color")
	 */
	public function getColorPublicacion() {

		$return = false;

		if ( $this->getPublicacionEmpresa()->first()->getEmpresa()->getColor() ) {
			$return = $this->getPublicacionEmpresa()->first()->getEmpresa()->getColor();
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("promocion")
	 */
	public function getPromocion() {

		$return = false;

		if ( count( $this->getDescuentoPublicacion() ) > 0 ) {
			$return = $this->getDescuentoPublicacion()->first()->getDescuento()->getAbreviacion();
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("categorias")
	 */
	public function getCategorias() {

		$return = array();

		if ( $this->getCategoriaPublicacion() ) {
			foreach ( $this->getCategoriaPublicacion() as $categoriaPublicacion ) {
				$return[] = $categoriaPublicacion->getCategoria();
			}
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("rubros")
	 */
	public function getRubros() {

		$return = null;

		if ( $this->getPublicacionEmpresa()->first() ) {
			$return = $this->getPublicacionEmpresa()->first()->getEmpresa()->getRubros();
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("tipo_publicacion")
	 */
	public function getTipoDePublicacion() {

		$return = false;

		if ( $this->getTipoPublicacion() ) {
			$return = $this->getTipoPublicacion()->getSlug();
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("rango_fecha")
	 */
	public function getRangoFecha() {

		$retorno = array(
			"fecha_desde" => $this->fechaInicio ? date_format( $this->fechaInicio, "d-m-Y" ) : "",
			"fecha_hasta" => $this->fechaFin ? date_format( $this->fechaFin, "d-m-Y" ) : "",
			"hora_desde"  => $this->horaInicio ? date_format( $this->horaInicio, "H:i" ) : "",
			"hora_hasta"  => $this->horaFin ? date_format( $this->horaFin, "H:i" ) : ""
		);

		return $retorno;


	}

	private $likePersona = false;

	/**
	 * @VirtualProperty()
	 * @SerializedName("likes")
	 */
	public function getLikes() {

		$return = false;

		if ( $this->getFavorito() ) {
			$return = count( $this->getFavorito() );
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("like_persona")
	 */
	public function getLikePersona() {


		return $this->likePersona;

	}

	public function setLikePersona( $bool ) {
		$this->likePersona = $bool;

		return $this->likePersona;

	}

	private $checkInPersona = false;

	/**
	 * @VirtualProperty()
	 * @SerializedName("checkins")
	 */
	public function getCheckIns() {

		$return = false;

		if ( $this->getCheckIn() ) {
			$return = count( $this->getCheckIn() );
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("checkin_persona")
	 */
	public function getCheckInPersona() {


		return $this->checkInPersona;

	}

	public function setCheckInPersona( $bool ) {
		$this->checkInPersona = $bool;

		return $this->checkInPersona;

	}

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->categoriaPublicacion = new \Doctrine\Common\Collections\ArrayCollection();
		$this->descuentoPublicacion = new \Doctrine\Common\Collections\ArrayCollection();
		$this->publicacionEmpresa   = new \Doctrine\Common\Collections\ArrayCollection();

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
	 * Set titulo
	 *
	 * @param string $titulo
	 *
	 * @return Publicacion
	 */
	public function setTitulo( $titulo ) {
		$this->titulo = $titulo;

		return $this;
	}

	/**
	 * Get titulo
	 *
	 * @return string
	 */
	public function getTitulo() {
		return $this->titulo;
	}

	/**
	 * Set descripcion
	 *
	 * @param string $descripcion
	 *
	 * @return Publicacion
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
	 * Set fechaInicio
	 *
	 * @param \DateTime $fechaInicio
	 *
	 * @return Publicacion
	 */
	public function setFechaInicio( $fechaInicio ) {
		$this->fechaInicio = $fechaInicio;

		return $this;
	}

	/**
	 * Get fechaInicio
	 *
	 * @return \DateTime
	 */
	public function getFechaInicio() {
		return $this->fechaInicio;
	}

	/**
	 * Set fechaFin
	 *
	 * @param \DateTime $fechaFin
	 *
	 * @return Publicacion
	 */
	public function setFechaFin( $fechaFin ) {
		$this->fechaFin = $fechaFin;

		return $this;
	}

	/**
	 * Get fechaFin
	 *
	 * @return \DateTime
	 */
	public function getFechaFin() {
		return $this->fechaFin;
	}

	/**
	 * Set horaInicio
	 *
	 * @param \DateTime $horaInicio
	 *
	 * @return Publicacion
	 */
	public function setHoraInicio( $horaInicio ) {
		$this->horaInicio = $horaInicio;

		return $this;
	}

	/**
	 * Get horaInicio
	 *
	 * @return \DateTime
	 */
	public function getHoraInicio() {
		return $this->horaInicio;
	}

	/**
	 * Set horaFin
	 *
	 * @param \DateTime $horaFin
	 *
	 * @return Publicacion
	 */
	public function setHoraFin( $horaFin ) {
		$this->horaFin = $horaFin;

		return $this;
	}

	/**
	 * Get horaFin
	 *
	 * @return \DateTime
	 */
	public function getHoraFin() {
		return $this->horaFin;
	}

	/**
	 * Add categoriaPublicacion
	 *
	 * @param \AppBundle\Entity\CategoriaPublicacion $categoriaPublicacion
	 *
	 * @return Publicacion
	 */
	public function addCategoriaPublicacion( \AppBundle\Entity\CategoriaPublicacion $categoriaPublicacion ) {

		$categoriaPublicacion->setPublicacion( $this );

		$this->categoriaPublicacion->add( $categoriaPublicacion );

//        $this->categoriaPublicacion[] = $categoriaPublicacion;

		return $this;
	}

	/**
	 * Remove categoriaPublicacion
	 *
	 * @param \AppBundle\Entity\CategoriaPublicacion $categoriaPublicacion
	 */
	public function removeCategoriaPublicacion( \AppBundle\Entity\CategoriaPublicacion $categoriaPublicacion ) {
		$this->categoriaPublicacion->removeElement( $categoriaPublicacion );
	}

	/**
	 * Get categoriaPublicacion
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getCategoriaPublicacion() {
		return $this->categoriaPublicacion;
	}

	/**
	 * Set cuerpo
	 *
	 * @param string $cuerpo
	 *
	 * @return Publicacion
	 */
	public function setCuerpo( $cuerpo ) {
		$this->cuerpo = $cuerpo;

		return $this;
	}

	/**
	 * Get cuerpo
	 *
	 * @return string
	 */
	public function getCuerpo() {
		return $this->cuerpo;
	}

	/**
	 * Set fechaCreacion
	 *
	 * @param \DateTime $fechaCreacion
	 *
	 * @return Publicacion
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
	 * @return Publicacion
	 */
	public function setFechaActualizacion( $fechaActualizacion ) {
		$this->fechaActualizacion = $fechaActualizacion;

		return $this;
	}

	/**
	 * Set creadoPor
	 *
	 * @param \UsuariosBundle\Entity\Usuario $creadoPor
	 *
	 * @return Publicacion
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
	 * @return Publicacion
	 */
	public function setActualizadoPor( \UsuariosBundle\Entity\Usuario $actualizadoPor = null ) {
		$this->actualizadoPor = $actualizadoPor;

		return $this;
	}

	/**
	 * Set tipoPublicacion
	 *
	 * @param \AppBundle\Entity\TipoPublicacion $tipoPublicacion
	 *
	 * @return Publicacion
	 */
	public function setTipoPublicacion( \AppBundle\Entity\TipoPublicacion $tipoPublicacion = null ) {
		$this->tipoPublicacion = $tipoPublicacion;

		return $this;
	}

	/**
	 * Get tipoPublicacion
	 *
	 * @return \AppBundle\Entity\TipoPublicacion
	 */
	public function getTipoPublicacion() {
		return $this->tipoPublicacion;
	}

	/**
	 * Add publicacionEmpresa
	 *
	 * @param \AppBundle\Entity\PublicacionEmpresa $publicacionEmpresa
	 *
	 * @return Publicacion
	 */
	public function addPublicacionEmpresa( \AppBundle\Entity\PublicacionEmpresa $publicacionEmpresa ) {

		$publicacionEmpresa->setPublicacion( $this );

		$this->publicacionEmpresa->add( $publicacionEmpresa );

		return $this;
	}

	/**
	 * Remove publicacionEmpresa
	 *
	 * @param \AppBundle\Entity\PublicacionEmpresa $publicacionEmpresa
	 */
	public function removePublicacionEmpresa( \AppBundle\Entity\PublicacionEmpresa $publicacionEmpresa ) {
		$this->publicacionEmpresa->removeElement( $publicacionEmpresa );
	}

	/**
	 * Get publicacionEmpresa
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPublicacionEmpresa() {
		return $this->publicacionEmpresa;
	}

	/**
	 * Set publicado
	 *
	 * @param boolean $publicado
	 *
	 * @return Publicacion
	 */
	public function setPublicado( $publicado ) {
		$this->publicado = $publicado;

		return $this;
	}

	/**
	 * Get publicado
	 *
	 * @return boolean
	 */
	public function getPublicado() {
		return $this->publicado;
	}

	/**
	 * Add etiquetaPublicacion
	 *
	 * @param \AppBundle\Entity\EtiquetaPublicacion $etiquetaPublicacion
	 *
	 * @return Publicacion
	 */
	public function addEtiquetaPublicacion( \AppBundle\Entity\EtiquetaPublicacion $etiquetaPublicacion ) {

		$etiquetaPublicacion->setPublicacion( $this );

		$this->etiquetaPublicacion->add( $etiquetaPublicacion );


		return $this;
	}

	/**
	 * Remove etiquetaPublicacion
	 *
	 * @param \AppBundle\Entity\EtiquetaPublicacion $etiquetaPublicacion
	 */
	public function removeEtiquetaPublicacion( \AppBundle\Entity\EtiquetaPublicacion $etiquetaPublicacion ) {
		$this->etiquetaPublicacion->removeElement( $etiquetaPublicacion );
	}

	/**
	 * Get etiquetaPublicacion
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getEtiquetaPublicacion() {
		return $this->etiquetaPublicacion;
	}

	/**
	 * Add descuentoPublicacion
	 *
	 * @param \AppBundle\Entity\DescuentoPublicacion $descuentoPublicacion
	 *
	 * @return Publicacion
	 */
	public function addDescuentoPublicacion( \AppBundle\Entity\DescuentoPublicacion $descuentoPublicacion ) {


		$descuentoPublicacion->setPublicacion( $this );

		$this->descuentoPublicacion->add( $descuentoPublicacion );


		return $this;
	}

	/**
	 * Remove descuentoPublicacion
	 *
	 * @param \AppBundle\Entity\DescuentoPublicacion $descuentoPublicacion
	 */
	public function removeDescuentoPublicacion( \AppBundle\Entity\DescuentoPublicacion $descuentoPublicacion ) {
		$this->descuentoPublicacion->removeElement( $descuentoPublicacion );
	}

	/**
	 * Get descuentoPublicacion
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getDescuentoPublicacion() {
		return $this->descuentoPublicacion;
	}

	/**
	 * Add likeSharePorElemento
	 *
	 * @param \AppBundle\Entity\LikesSharePorElemento $likeSharePorElemento
	 *
	 * @return Publicacion
	 */
	public function addLikeSharePorElemento( \AppBundle\Entity\LikesSharePorElemento $likeSharePorElemento ) {
		$this->likeSharePorElemento[] = $likeSharePorElemento;

		return $this;
	}

	/**
	 * Remove likeSharePorElemento
	 *
	 * @param \AppBundle\Entity\LikesSharePorElemento $likeSharePorElemento
	 */
	public function removeLikeSharePorElemento( \AppBundle\Entity\LikesSharePorElemento $likeSharePorElemento ) {
		$this->likeSharePorElemento->removeElement( $likeSharePorElemento );
	}

	/**
	 * Get likeSharePorElemento
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getLikeSharePorElemento() {
		return $this->likeSharePorElemento;
	}

	/**
	 * Add favorito
	 *
	 * @param \AppBundle\Entity\Favorito $favorito
	 *
	 * @return Publicacion
	 */
	public function addFavorito( \AppBundle\Entity\Favorito $favorito ) {
		$this->favorito[] = $favorito;

		return $this;
	}

	/**
	 * Remove favorito
	 *
	 * @param \AppBundle\Entity\Favorito $favorito
	 */
	public function removeFavorito( \AppBundle\Entity\Favorito $favorito ) {
		$this->favorito->removeElement( $favorito );
	}

	/**
	 * Get favorito
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getFavorito() {
		return $this->favorito;
	}

	/**
	 * Add checkIn
	 *
	 * @param \AppBundle\Entity\CheckIn $checkIn
	 *
	 * @return Publicacion
	 */
	public function addCheckIn( \AppBundle\Entity\CheckIn $checkIn ) {
		$this->checkIn[] = $checkIn;

		return $this;
	}

	/**
	 * Remove checkIn
	 *
	 * @param \AppBundle\Entity\CheckIn $checkIn
	 */
	public function removeCheckIn( \AppBundle\Entity\CheckIn $checkIn ) {
		$this->checkIn->removeElement( $checkIn );
	}

	/**
	 * Get checkIn
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getCheckIn() {
		return $this->checkIn;
	}

    /**
     * Set tipoEvento
     *
     * @param \AppBundle\Entity\TipoEvento $tipoEvento
     *
     * @return Publicacion
     */
    public function setTipoEvento(\AppBundle\Entity\TipoEvento $tipoEvento = null)
    {
        $this->tipoEvento = $tipoEvento;

        return $this;
    }

    /**
     * Get tipoEvento
     *
     * @return \AppBundle\Entity\TipoEvento
     */
    public function getTipoEvento()
    {
        return $this->tipoEvento;
    }

    /**
     * Add fechaPublicacion
     *
     * @param \AppBundle\Entity\FechaPublicacion $fechaPublicacion
     *
     * @return Publicacion
     */
    public function addFechaPublicacion(\AppBundle\Entity\FechaPublicacion $fechaPublicacion)
    {
        $this->fechaPublicacion[] = $fechaPublicacion;

        return $this;
    }

    /**
     * Remove fechaPublicacion
     *
     * @param \AppBundle\Entity\FechaPublicacion $fechaPublicacion
     */
    public function removeFechaPublicacion(\AppBundle\Entity\FechaPublicacion $fechaPublicacion)
    {
        $this->fechaPublicacion->removeElement($fechaPublicacion);
    }

    /**
     * Get fechaPublicacion
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }
}
