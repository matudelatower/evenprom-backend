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

/**
 * Empresa
 *
 * @Vich\Uploadable
 * @ORM\Table(name="empresas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmpresaRepository")
 * @ExclusionPolicy("all")
 */
class Empresa extends BaseClass {
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
	 * @ORM\Column(name="nombre", type="string", length=255, unique=true)
	 * @Expose()
	 */
	private $nombre;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
	 * @Expose()
	 */
	private $descripcion;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="color", type="string", length=255, nullable=true)
	 * @Expose()
	 */
	private $color;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="premium", type="boolean", nullable=true)
	 * @Expose()
	 */
	private $premium;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="link_youtube", type="string", length=255, nullable=true)
	 * @Expose()
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
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\NoticiaEmpresa", mappedBy="empresa", cascade={"persist", "remove"})
	 */
	private $noticiaEmpresa;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\EtiquetaEmpresa", mappedBy="empresa", cascade={"persist", "remove"})
	 */
	private $etiquetaEmpresa;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\CategoriaEmpresa", mappedBy="empresa", cascade={"persist", "remove"})
	 */
	private $categoriaEmpresa;


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

	public function __toString() {
		return $this->nombre;
	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("contacto")
	 */
	public function getContacto() {

		$return = array();

		if ( $this->getContactoEmpresa()->first() ) {

			if ( $this->getContactoEmpresa()->first()->getContacto() ) {
				$return = $this->getContactoEmpresa()->first()->getContacto();
			}
		}

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("direccion")
	 */
	public function getDireccion() {

		$return = array();

		if ( $this->getDireccionEmpresa() ) {
			if ( $this->getDireccionEmpresa()->first()->getDireccion() ) {
				$return = $this->getDireccionEmpresa()->first()->getDireccion();
			}
		}

		return $return;

	}

	
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->direccionEmpresa = new \Doctrine\Common\Collections\ArrayCollection();
        $this->contactoEmpresa = new \Doctrine\Common\Collections\ArrayCollection();
        $this->noticiaEmpresa = new \Doctrine\Common\Collections\ArrayCollection();
        $this->etiquetaEmpresa = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categoriaEmpresa = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Empresa
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
     * @return Empresa
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
     * Set color
     *
     * @param string $color
     * @return Empresa
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
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
     * Add direccionEmpresa
     *
     * @param \AppBundle\Entity\DireccionEmpresa $direccionEmpresa
     * @return Empresa
     */
    public function addDireccionEmpreson(\AppBundle\Entity\DireccionEmpresa $direccionEmpresa)
    {
        $this->direccionEmpresa[] = $direccionEmpresa;

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
        $this->contactoEmpresa[] = $contactoEmpresa;

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
     * Add noticiaEmpresa
     *
     * @param \AppBundle\Entity\NoticiaEmpresa $noticiaEmpresa
     * @return Empresa
     */
    public function addNoticiaEmpresa(\AppBundle\Entity\NoticiaEmpresa $noticiaEmpresa)
    {
        $this->noticiaEmpresa[] = $noticiaEmpresa;

        return $this;
    }

    /**
     * Remove noticiaEmpresa
     *
     * @param \AppBundle\Entity\NoticiaEmpresa $noticiaEmpresa
     */
    public function removeNoticiaEmpresa(\AppBundle\Entity\NoticiaEmpresa $noticiaEmpresa)
    {
        $this->noticiaEmpresa->removeElement($noticiaEmpresa);
    }

    /**
     * Get noticiaEmpresa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNoticiaEmpresa()
    {
        return $this->noticiaEmpresa;
    }

    /**
     * Add etiquetaEmpresa
     *
     * @param \AppBundle\Entity\EtiquetaEmpresa $etiquetaEmpresa
     * @return Empresa
     */
    public function addEtiquetaEmpreson(\AppBundle\Entity\EtiquetaEmpresa $etiquetaEmpresa)
    {
//        $this->etiquetaEmpresa[] = $etiquetaEmpresa;

	    $etiquetaEmpresa->setEmpresa( $this );

	    $this->categoriaEmpresa->add( $etiquetaEmpresa );

        return $this;
    }

    /**
     * Remove etiquetaEmpresa
     *
     * @param \AppBundle\Entity\EtiquetaEmpresa $etiquetaEmpresa
     */
    public function removeEtiquetaEmpreson(\AppBundle\Entity\EtiquetaEmpresa $etiquetaEmpresa)
    {
        $this->etiquetaEmpresa->removeElement($etiquetaEmpresa);
    }

    /**
     * Get etiquetaEmpresa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEtiquetaEmpresa()
    {
        return $this->etiquetaEmpresa;
    }

    /**
     * Add categoriaEmpresa
     *
     * @param \AppBundle\Entity\CategoriaEmpresa $categoriaEmpresa
     * @return Empresa
     */
    public function addCategoriaEmpreson(\AppBundle\Entity\CategoriaEmpresa $categoriaEmpresa)
    {

	    $categoriaEmpresa->setEmpresa( $this );

	    $this->categoriaEmpresa->add( $categoriaEmpresa );

        return $this;
    }

    /**
     * Remove categoriaEmpresa
     *
     * @param \AppBundle\Entity\CategoriaEmpresa $categoriaEmpresa
     */
    public function removeCategoriaEmpreson(\AppBundle\Entity\CategoriaEmpresa $categoriaEmpresa)
    {
        $this->categoriaEmpresa->removeElement($categoriaEmpresa);
    }

    /**
     * Get categoriaEmpresa
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategoriaEmpresa()
    {
        return $this->categoriaEmpresa;
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

    /**
     * Add etiquetaEmpresa
     *
     * @param \AppBundle\Entity\EtiquetaEmpresa $etiquetaEmpresa
     * @return Empresa
     */
    public function addEtiquetaEmpresa(\AppBundle\Entity\EtiquetaEmpresa $etiquetaEmpresa)
    {
        $this->etiquetaEmpresa[] = $etiquetaEmpresa;

        return $this;
    }

    /**
     * Remove etiquetaEmpresa
     *
     * @param \AppBundle\Entity\EtiquetaEmpresa $etiquetaEmpresa
     */
    public function removeEtiquetaEmpresa(\AppBundle\Entity\EtiquetaEmpresa $etiquetaEmpresa)
    {
        $this->etiquetaEmpresa->removeElement($etiquetaEmpresa);
    }

    /**
     * Add categoriaEmpresa
     *
     * @param \AppBundle\Entity\CategoriaEmpresa $categoriaEmpresa
     * @return Empresa
     */
    public function addCategoriaEmpresa(\AppBundle\Entity\CategoriaEmpresa $categoriaEmpresa)
    {
        $this->categoriaEmpresa[] = $categoriaEmpresa;

        return $this;
    }

    /**
     * Remove categoriaEmpresa
     *
     * @param \AppBundle\Entity\CategoriaEmpresa $categoriaEmpresa
     */
    public function removeCategoriaEmpresa(\AppBundle\Entity\CategoriaEmpresa $categoriaEmpresa)
    {
        $this->categoriaEmpresa->removeElement($categoriaEmpresa);
    }
}
