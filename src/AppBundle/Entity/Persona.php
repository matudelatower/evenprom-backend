<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * Persona
 *
 * @Vich\Uploadable
 * @ORM\Table(name="personas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonaRepository")
 * @ExclusionPolicy("all")
 */
class Persona extends BaseClass {
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
	 * @ORM\Column(name="nombre", type="string", length=255)
	 * @Expose()
	 */
	private $nombre;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="apellido", type="string", length=255)
	 * @Expose()
	 */
	private $apellido;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
	 * @Expose()
	 */
	private $fechaNacimiento;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="dni", type="string", length=255, unique=true, nullable=true)
	 * @Expose()
	 */
	private $dni;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoDocumento")
	 * @ORM\JoinColumn(name="tipo_documento_id", referencedColumnName="id")
	 * @Expose()
	 */
	private $tipoDocumento;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="UsuariosBundle\Entity\Usuario", inversedBy="persona")
	 * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
	 */
	private $usuario;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\PersonaOnda", mappedBy="persona", cascade={"persist", "remove"})
	 */
	private $personaOnda;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\CheckIn", mappedBy="persona", cascade={"persist", "remove"})
	 */
	private $checkIn;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Favorito", mappedBy="persona", cascade={"persist", "remove"})
	 */
	private $favorito;

	/**
	 * NOTE: This is not a mapped field of entity metadata, just a simple property.
	 *
	 * @Vich\UploadableField(mapping="personas_image", fileNameProperty="imageName")
	 *
	 * @var File
	 */
	private $imageFile;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 *
	 * @var string
	 *
	 * @Expose()
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
	 * @SerializedName("ondas")
	 */
	public function getOndas() {

		$return = array();

		if ( $this->getPersonaOnda() ) {
			foreach ( $this->getPersonaOnda() as $personaOnda ) {
				$return[] = $personaOnda->getOnda();
			}
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("usuario_id")
	 */
	public function getUsuarioId() {

		$return = array();

		if ( $this->getUsuario() ) {
			$return = $this->getUsuario()->getId();
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("username")
	 */
	public function getUsername() {

		$return = array();

		if ( $this->getUsuario() ) {
			$return = $this->getUsuario()->getUsername();
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("checkIns")
	 */
	public function getCheckIns() {

		$return = $this->getCheckIn() ? $this->getCheckIn()->count() : null;

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("favoritos")
	 */
	public function getFavoritos() {

		$return = $this->getFavorito() ? $this->getFavorito()->count() : null;

		return $return;

	}

//	oAuth

	private $plainPassword;

	/**
	 * @return mixed
	 * @VirtualProperty()
	 * @SerializedName("plain_password")
	 */
	public function getPlainPassword() {
		return $this->plainPassword;
	}

	/**
	 * @param mixed $plainPassword
	 */
	public function setPlainPassword( $plainPassword ) {
		$this->plainPassword = $plainPassword;
	}


	public function __toString() {
		return $this->apellido . ", " . $this->nombre;
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
	 * Set nombre
	 *
	 * @param string $nombre
	 *
	 * @return Persona
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
	 * Set apellido
	 *
	 * @param string $apellido
	 *
	 * @return Persona
	 */
	public function setApellido( $apellido ) {
		$this->apellido = $apellido;

		return $this;
	}

	/**
	 * Get apellido
	 *
	 * @return string
	 */
	public function getApellido() {
		return $this->apellido;
	}

	/**
	 * Set dni
	 *
	 * @param string $dni
	 *
	 * @return Persona
	 */
	public function setDni( $dni ) {
		$this->dni = $dni;

		return $this;
	}

	/**
	 * Get dni
	 *
	 * @return string
	 */
	public function getDni() {
		return $this->dni;
	}

	/**
	 * Set fechaNacimiento
	 *
	 * @param \DateTime $fechaNacimiento
	 *
	 * @return Persona
	 */
	public function setFechaNacimiento( $fechaNacimiento ) {
		$this->fechaNacimiento = $fechaNacimiento;

		return $this;
	}

	/**
	 * Get fechaNacimiento
	 *
	 * @return \DateTime
	 */
	public function getFechaNacimiento() {
		return $this->fechaNacimiento;
	}

	/**
	 * Set fechaCreacion
	 *
	 * @param \DateTime $fechaCreacion
	 *
	 * @return Persona
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
	 * @return Persona
	 */
	public function setFechaActualizacion( $fechaActualizacion ) {
		$this->fechaActualizacion = $fechaActualizacion;

		return $this;
	}

	/**
	 * Set tipoDocumento
	 *
	 * @param \AppBundle\Entity\TipoDocumento $tipoDocumento
	 *
	 * @return Persona
	 */
	public function setTipoDocumento( \AppBundle\Entity\TipoDocumento $tipoDocumento = null ) {
		$this->tipoDocumento = $tipoDocumento;

		return $this;
	}

	/**
	 * Get tipoDocumento
	 *
	 * @return \AppBundle\Entity\TipoDocumento
	 */
	public function getTipoDocumento() {
		return $this->tipoDocumento;
	}

	/**
	 * Set creadoPor
	 *
	 * @param \UsuariosBundle\Entity\Usuario $creadoPor
	 *
	 * @return Persona
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
	 * @return Persona
	 */
	public function setActualizadoPor( \UsuariosBundle\Entity\Usuario $actualizadoPor = null ) {
		$this->actualizadoPor = $actualizadoPor;

		return $this;
	}

	/**
	 * Set usuario
	 *
	 * @param \UsuariosBundle\Entity\Usuario $usuario
	 *
	 * @return Persona
	 */
	public function setUsuario( \UsuariosBundle\Entity\Usuario $usuario = null ) {
		$this->usuario = $usuario;

		return $this;
	}

	/**
	 * Get usuario
	 *
	 * @return \UsuariosBundle\Entity\Usuario
	 */
	public function getUsuario() {
		return $this->usuario;
	}

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->personaOnda = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Add personaOnda
	 *
	 * @param \AppBundle\Entity\PersonaOnda $personaOnda
	 *
	 * @return Persona
	 */
	public function addPersonaOnda( \AppBundle\Entity\PersonaOnda $personaOnda ) {

		$personaOnda->setPersona( $this );

		$this->personaOnda->add( $personaOnda );

		return $this;
	}

	/**
	 * Remove personaOnda
	 *
	 * @param \AppBundle\Entity\PersonaOnda $personaOnda
	 */
	public function removePersonaOnda( \AppBundle\Entity\PersonaOnda $personaOnda ) {
		$this->personaOnda->removeElement( $personaOnda );
	}

	/**
	 * Get personaOnda
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPersonaOnda() {
		return $this->personaOnda;
	}

	/**
	 * Add checkIn
	 *
	 * @param \AppBundle\Entity\CheckIn $checkIn
	 *
	 * @return Persona
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
	 * Add favorito
	 *
	 * @param \AppBundle\Entity\Favorito $favorito
	 *
	 * @return Persona
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
}
