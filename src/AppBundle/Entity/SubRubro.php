<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * SubRubro
 *
 * @ORM\Table(name="sub_rubros")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubRubroRepository")
 * @ExclusionPolicy("all")
 */
class SubRubro extends BaseClass
{
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
     * @ORM\Column(name="en", type="string", length=255, nullable=true)
     */
    private $en;

    /**
     * @var string
     *
     * @ORM\Column(name="pt", type="string", length=255, nullable=true)
     */
    private $pt;

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
     * @Gedmo\Slug(fields={"nombre"})
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     * @Expose()
     */
    private $slug;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rubro")
     * @ORM\JoinColumn(name="rubro_id", referencedColumnName="id")
     */
    private $rubro;


    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EmpresaSubRubro", mappedBy="subRubro", cascade={"persist", "remove"})
     */
    private $empresaRubro;


    public function __toString() {
        return $this->nombre;
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
     * Constructor
     */
    public function __construct()
    {
        $this->empresaRubro = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return SubRubro
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
     * @return SubRubro
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
     * Set slug
     *
     * @param string $slug
     * @return SubRubro
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return SubRubro
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
     * @return SubRubro
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Set rubro
     *
     * @param \AppBundle\Entity\Rubro $rubro
     * @return SubRubro
     */
    public function setRubro(\AppBundle\Entity\Rubro $rubro = null)
    {
        $this->rubro = $rubro;

        return $this;
    }

    /**
     * Get rubro
     *
     * @return \AppBundle\Entity\Rubro 
     */
    public function getRubro()
    {
        return $this->rubro;
    }

    /**
     * Add empresaRubro
     *
     * @param \AppBundle\Entity\EmpresaSubRubro $empresaRubro
     * @return SubRubro
     */
    public function addEmpresaRubro(\AppBundle\Entity\EmpresaSubRubro $empresaRubro)
    {
        $this->empresaRubro[] = $empresaRubro;

        return $this;
    }

    /**
     * Remove empresaRubro
     *
     * @param \AppBundle\Entity\EmpresaSubRubro $empresaRubro
     */
    public function removeEmpresaRubro(\AppBundle\Entity\EmpresaSubRubro $empresaRubro)
    {
        $this->empresaRubro->removeElement($empresaRubro);
    }

    /**
     * Get empresaRubro
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmpresaRubro()
    {
        return $this->empresaRubro;
    }

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     * @return SubRubro
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
     * @return SubRubro
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }

    /**
     * Set en
     *
     * @param string $en
     *
     * @return SubRubro
     */
    public function setEn($en)
    {
        $this->en = $en;

        return $this;
    }

    /**
     * Get en
     *
     * @return string
     */
    public function getEn()
    {
        return $this->en;
    }

    /**
     * Set pt
     *
     * @param string $pt
     *
     * @return SubRubro
     */
    public function setPt($pt)
    {
        $this->pt = $pt;

        return $this;
    }

    /**
     * Get pt
     *
     * @return string
     */
    public function getPt()
    {
        return $this->pt;
    }
}
