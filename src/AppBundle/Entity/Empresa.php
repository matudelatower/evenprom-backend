<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Empresa
 *
 * @Vich\Uploadable
 * @ORM\Table(name="empresas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmpresaRepository")
 */
class Empresa extends BaseClass{
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
	 * @ORM\Column(name="color", type="string", length=255, nullable=true)
	 */
	private $color;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="premium", type="boolean", nullable=true)
	 */
	private $premium;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="link_youtube", type="string", length=255, nullable=true)
	 */
	private $linkYoutube;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="UsuariosBundle\Entity\Usuario", inversedBy="empresa")
	 * @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
	 */
	private $usuario;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\DireccionEmpresa", mappedBy="empresa", cascade={"persist", "remove"})
	 */
	private $direccionEmpresa;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\ContactoEmpresa", mappedBy="empresa", cascade={"persist", "remove"})
	 */
	private $contactoEmpresa;

	/**
	 * NOTE: This is not a mapped field of entity metadata, just a simple property.
	 *
	 * @Vich\UploadableField(mapping="empresas_image", fileNameProperty="imageName")
	 *
	 * @var File
	 */
	private $imageFile;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 *
	 * @var string
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
	public function setImageFile(File $image = null)
	{
		$this->imageFile = $image;

		if ($image) {
			// It is required that at least one field changes if you are using doctrine
			// otherwise the event listeners won't be called and the file is lost
			$this->fechaActualizacion = new \DateTime('now');
		}

		return $this;
	}

	/**
	 * @return File
	 */
	public function getImageFile()
	{
		return $this->imageFile;
	}

	/**
	 * @param string $imageName
	 *
	 * @return Product
	 */
	public function setImageName($imageName)
	{
		$this->imageName = $imageName;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getImageName()
	{
		return $this->imageName;
	}

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
	 * @return Empresa
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
	 * @return Empresa
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
	 * Set color
	 *
	 * @param string $color
	 *
	 * @return Empresa
	 */
	public function setColor( $color ) {
		$this->color = $color;

		return $this;
	}

	/**
	 * Get color
	 *
	 * @return string
	 */
	public function getColor() {
		return $this->color;
	}

    /**
     * Set premium
     *
     * @param boolean $premium
     * @return Empresa
     */
    public function setPremium($premium)
    {
        $this->premium = $premium;

        return $this;
    }

    /**
     * Get premium
     *
     * @return boolean 
     */
    public function getPremium()
    {
        return $this->premium;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Empresa
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
     * @return Empresa
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Set usuario
     *
     * @param \UsuariosBundle\Entity\Usuario $usuario
     * @return Empresa
     */
    public function setUsuario(\UsuariosBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \UsuariosBundle\Entity\Usuario 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     * @return Empresa
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
     * @return Empresa
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
        $this->direccionEmpresa = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contactoEmpresa = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set linkYoutube
     *
     * @param string $linkYoutube
     * @return Empresa
     */
    public function setLinkYoutube($linkYoutube)
    {
        $this->linkYoutube = $linkYoutube;

        return $this;
    }

    /**
     * Get linkYoutube
     *
     * @return string 
     */
    public function getLinkYoutube()
    {
        return $this->linkYoutube;
    }

    /**
     * Add direccionEmpresa
     *
     * @param \AppBundle\Entity\DireccionEmpresa $direccionEmpresa
     * @return Empresa
     */
    public function addDireccionEmpreson(\AppBundle\Entity\DireccionEmpresa $direccionEmpresa)
    {

	    $direccionEmpresa->setEmpresa($this);

	    $this->direccionEmpresa->add($direccionEmpresa);

//        $this->direccionEmpresa[] = $direccionEmpresa;

        return $this;
    }

    /**
     * Remove direccionEmpresa
     *
     * @param \AppBundle\Entity\DireccionEmpresa $direccionEmpresa
     */
    public function removeDireccionEmpreson(\AppBundle\Entity\DireccionEmpresa $direccionEmpresa)
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
     * Add contactoEmpresa
     *
     * @param \AppBundle\Entity\ContactoEmpresa $contactoEmpresa
     * @return Empresa
     */
    public function addContactoEmpreson(\AppBundle\Entity\ContactoEmpresa $contactoEmpresa)
    {
	    $contactoEmpresa->setEmpresa($this);

	    $this->contactoEmpresa->add($contactoEmpresa);

//        $this->contactoEmpresa[] = $contactoEmpresa;

        return $this;
    }

    /**
     * Remove contactoEmpresa
     *
     * @param \AppBundle\Entity\ContactoEmpresa $contactoEmpresa
     */
    public function removeContactoEmpreson(\AppBundle\Entity\ContactoEmpresa $contactoEmpresa)
    {
        $this->contactoEmpresa->removeElement($contactoEmpresa);
    }

    /**
     * Get contactoEmpresa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContactoEmpresa()
    {
        return $this->contactoEmpresa;
    }

    /**
     * Add direccionEmpresa
     *
     * @param \AppBundle\Entity\DireccionEmpresa $direccionEmpresa
     * @return Empresa
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
     * Add contactoEmpresa
     *
     * @param \AppBundle\Entity\ContactoEmpresa $contactoEmpresa
     * @return Empresa
     */
    public function addContactoEmpresa(\AppBundle\Entity\ContactoEmpresa $contactoEmpresa)
    {
        $this->contactoEmpresa[] = $contactoEmpresa;

        return $this;
    }

    /**
     * Remove contactoEmpresa
     *
     * @param \AppBundle\Entity\ContactoEmpresa $contactoEmpresa
     */
    public function removeContactoEmpresa(\AppBundle\Entity\ContactoEmpresa $contactoEmpresa)
    {
        $this->contactoEmpresa->removeElement($contactoEmpresa);
    }
}
