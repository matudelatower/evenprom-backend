<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * NoticiaInterna
 *
 * @Vich\Uploadable
 * @ORM\Table(name="noticias_internas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoticiaInternaRepository")
 */
class NoticiaInterna extends BaseClass
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
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="resumen", type="string", length=255, nullable=true)
     */
    private $resumen;

    /**
     * @var string
     *
     * @ORM\Column(name="cuerpo", type="text")
     */
    private $cuerpo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visible_desde", type="date")
     */
    private $visibleDesde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visible_hasta", type="date")
     */
    private $visibleHasta;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\NoticiaInternaEmpresa", mappedBy="noticiaInterna", cascade={"persist", "remove"})
	 */
	private $noticiaInternaEmpresa;

	/**
	 * NOTE: This is not a mapped field of entity metadata, just a simple property.
	 *
	 * @Vich\UploadableField(mapping="noticias_internas_image", fileNameProperty="imageName")
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
     * Set titulo
     *
     * @param string $titulo
     *
     * @return NoticiaInterna
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
     *
     * @return NoticiaInterna
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
     *
     * @return NoticiaInterna
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
     *
     * @return NoticiaInterna
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
     *
     * @return NoticiaInterna
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
     * Constructor
     */
    public function __construct()
    {
        $this->noticiaInternaEmpresa = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return NoticiaInterna
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
     * @return NoticiaInterna
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Add noticiaInternaEmpresa
     *
     * @param \AppBundle\Entity\NoticiaInternaEmpresa $noticiaInternaEmpresa
     *
     * @return NoticiaInterna
     */
    public function addNoticiaInternaEmpresa(\AppBundle\Entity\NoticiaInternaEmpresa $noticiaInternaEmpresa)
    {
        $this->noticiaInternaEmpresa[] = $noticiaInternaEmpresa;

        return $this;
    }

    /**
     * Remove noticiaInternaEmpresa
     *
     * @param \AppBundle\Entity\NoticiaInternaEmpresa $noticiaInternaEmpresa
     */
    public function removeNoticiaInternaEmpresa(\AppBundle\Entity\NoticiaInternaEmpresa $noticiaInternaEmpresa)
    {
        $this->noticiaInternaEmpresa->removeElement($noticiaInternaEmpresa);
    }

    /**
     * Get noticiaInternaEmpresa
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNoticiaInternaEmpresa()
    {
        return $this->noticiaInternaEmpresa;
    }

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     *
     * @return NoticiaInterna
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
     * @return NoticiaInterna
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
