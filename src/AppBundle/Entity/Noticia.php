<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Noticia
 *
 * @ORM\Table(name="noticias")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoticiaRepository")
 * @ExclusionPolicy("all")
 */
class Noticia {
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
	 */
	private $visibleDesde;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="visible_hasta", type="datetime", nullable=true)
	 */
	private $visibleHasta;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="orden", type="integer", nullable=true)
	 */
	private $orden;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="activo", type="boolean")
	 */
	private $activo;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\NoticiaEmpresa", mappedBy="noticia", cascade={"persist", "remove"})
	 */
	private $noticiaEmpresa;

	public function __toString() {
		return $this->titulo;
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
     * Set activo
     *
     * @param boolean $activo
     * @return Noticia
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean 
     */
    public function getActivo()
    {
        return $this->activo;
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
}
