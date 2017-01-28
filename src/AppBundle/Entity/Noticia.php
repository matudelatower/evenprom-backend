<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Noticia
 *
 * @Vich\Uploadable
 * @ORM\Table(name="noticias")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoticiaRepository")
 * @ExclusionPolicy("all")
 */
class Noticia extends BaseClass {
	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @SerializedName("id")
	 * @Expose
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="titulo", type="string", length=255)
	 * @SerializedName("titulo")
	 * @Expose
	 */
	private $titulo;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="resumen", type="string", length=255, nullable=true)
	 * @SerializedName("resumen")
	 * @Expose
	 */
	private $resumen;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="cuerpo", type="text")
	 * @SerializedName("cuerpo")
	 * @Expose
	 */
	private $cuerpo;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="visible_desde", type="datetime", nullable=true)
	 * @Expose
	 */
	private $visibleDesde;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="visible_hasta", type="datetime", nullable=true)
	 * @Expose
	 */
	private $visibleHasta;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="orden", type="integer", nullable=true)
	 */
	private $orden;


	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\NoticiaEmpresa", mappedBy="noticia", cascade={"persist", "remove"})
	 */
	private $noticiaEmpresa;


	/**
	 * NOTE: This is not a mapped field of entity metadata, just a simple property.
	 *
	 * @Vich\UploadableField(mapping="noticias_image", fileNameProperty="imageName")
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
		return $this->titulo;
	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("empresa_id")
	 */
	public function getEmpresa() {

		$return = false;

		if ( $this->getNoticiaEmpresa()->first()->getEmpresa()->getId() ) {
			$return = $this->getNoticiaEmpresa()->first()->getEmpresa()->getId();
		}

		return $return;

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
     * Set titulo
     *
     * @param string $titulo
     * @return Noticia
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set resumen
     *
     * @param string $resumen
     * @return Noticia
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen
     *
     * @return string 
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set cuerpo
     *
     * @param string $cuerpo
     * @return Noticia
     */
    public function setCuerpo($cuerpo)
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    /**
     * Get cuerpo
     *
     * @return string 
     */
    public function getCuerpo()
    {
        return $this->cuerpo;
    }

    /**
     * Set visibleDesde
     *
     * @param \DateTime $visibleDesde
     * @return Noticia
     */
    public function setVisibleDesde($visibleDesde)
    {
        $this->visibleDesde = $visibleDesde;

        return $this;
    }

    /**
     * Get visibleDesde
     *
     * @return \DateTime 
     */
    public function getVisibleDesde()
    {
        return $this->visibleDesde;
    }

    /**
     * Set visibleHasta
     *
     * @param \DateTime $visibleHasta
     * @return Noticia
     */
    public function setVisibleHasta($visibleHasta)
    {
        $this->visibleHasta = $visibleHasta;

        return $this;
    }

    /**
     * Get visibleHasta
     *
     * @return \DateTime 
     */
    public function getVisibleHasta()
    {
        return $this->visibleHasta;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     * @return Noticia
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }

  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->noticiaEmpresa = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add noticiaEmpresa
     *
     * @param \AppBundle\Entity\NoticiaEmpresa $noticiaEmpresa
     * @return Noticia
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return Noticia
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
     * @return Noticia
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
     * @return Noticia
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
     * @return Noticia
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
