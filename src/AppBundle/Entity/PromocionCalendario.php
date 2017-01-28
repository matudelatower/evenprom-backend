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
 * PromocionCalendario
 *
 * @Vich\Uploadable
 * @ORM\Table(name="promociones_calendario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PromocionCalendarioRepository")
 * @ExclusionPolicy("all")
 */
class PromocionCalendario extends BaseClass {
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
	 * @ORM\Column(name="descripcion", type="string", length=255)
	 * @Expose()
	 */
	private $descripcion;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="disponible_desde", type="date")
	 */
	private $disponibleDesde;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="disponible_hasta", type="date")
	 */
	private $disponibleHasta;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="cuerpo", type="text", nullable=true)
	 * @Expose()
	 */
	private $cuerpo;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\LikesSharePorElemento", mappedBy="publicacion", cascade={"persist", "remove"})
	 */
	private $likeSharePorElemento;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa", inversedBy="promoCalendario")
	 * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
	 */
	private $empresa;

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
	 * @return PromocionCalendario
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
	 * @SerializedName("color")
	 */
	public function getColorPublicacion() {

		$return = false;

		if ( $this->getEmpresa()->getColor() ) {
			$return = $this->getEmpresa()->getColor();
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("nombre_empresa")
	 */
	public function getNombreEmpresa() {

		$return = false;

		if ( $this->getEmpresa() ) {
			$return = $this->getEmpresa()->getNombre();
		}

		return $return;

	}

	public function __toString() {
		return $this->titulo;
	}


	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set titulo
	 *
	 * @param string $titulo
	 *
	 * @return PromocionCalendario
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
	 * @return PromocionCalendario
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
	 * Set disponibleDesde
	 *
	 * @param \DateTime $disponibleDesde
	 *
	 * @return PromocionCalendario
	 */
	public function setDisponibleDesde( $disponibleDesde ) {
		$this->disponibleDesde = $disponibleDesde;

		return $this;
	}

	/**
	 * Get disponibleDesde
	 *
	 * @return \DateTime
	 */
	public function getDisponibleDesde() {
		return $this->disponibleDesde;
	}

	/**
	 * Set disponibleHasta
	 *
	 * @param \DateTime $disponibleHasta
	 *
	 * @return PromocionCalendario
	 */
	public function setDisponibleHasta( $disponibleHasta ) {
		$this->disponibleHasta = $disponibleHasta;

		return $this;
	}

	/**
	 * Get disponibleHasta
	 *
	 * @return \DateTime
	 */
	public function getDisponibleHasta() {
		return $this->disponibleHasta;
	}

	/**
	 * Set cuerpo
	 *
	 * @param string $cuerpo
	 *
	 * @return PromocionCalendario
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
	 * Constructor
	 */
	public function __construct() {
		$this->likeSharePorElemento = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Set fechaCreacion
	 *
	 * @param \DateTime $fechaCreacion
	 *
	 * @return PromocionCalendario
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
	 * @return PromocionCalendario
	 */
	public function setFechaActualizacion( $fechaActualizacion ) {
		$this->fechaActualizacion = $fechaActualizacion;

		return $this;
	}

	/**
	 * Add likeSharePorElemento
	 *
	 * @param \AppBundle\Entity\LikesSharePorElemento $likeSharePorElemento
	 *
	 * @return PromocionCalendario
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
	 * Set creadoPor
	 *
	 * @param \UsuariosBundle\Entity\Usuario $creadoPor
	 *
	 * @return PromocionCalendario
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
	 * @return PromocionCalendario
	 */
	public function setActualizadoPor( \UsuariosBundle\Entity\Usuario $actualizadoPor = null ) {
		$this->actualizadoPor = $actualizadoPor;

		return $this;
	}

	/**
	 * Set empresa
	 *
	 * @param \AppBundle\Entity\Empresa $empresa
	 *
	 * @return PromocionCalendario
	 */
	public function setEmpresa( \AppBundle\Entity\Empresa $empresa = null ) {
		$this->empresa = $empresa;

		return $this;
	}

	/**
	 * Get empresa
	 *
	 * @return \AppBundle\Entity\Empresa
	 */
	public function getEmpresa() {
		return $this->empresa;
	}
}
