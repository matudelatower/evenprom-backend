<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * EmpresaSubRubro
 *
 * @ORM\Table(name="empresa_sub_rubros")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmpresaSubRubroRepository")
 * @ExclusionPolicy("all")
 */
class EmpresaSubRubro extends BaseClass
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
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa", inversedBy="empresaSubRubro")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     */
    private $empresa;


    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\SubRubro", inversedBy="empresaRubro")
     * @ORM\JoinColumn(name="sub_rubro_id", referencedColumnName="id")
     */
    private $subRubro;

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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return EmpresaSubRubro
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
     * @return EmpresaSubRubro
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     * @return EmpresaSubRubro
     */
    public function setEmpresa(\AppBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \AppBundle\Entity\Empresa 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set subRubro
     *
     * @param \AppBundle\Entity\SubRubro $subRubro
     * @return EmpresaSubRubro
     */
    public function setSubRubro(\AppBundle\Entity\SubRubro $subRubro = null)
    {
        $this->subRubro = $subRubro;

        return $this;
    }

    /**
     * Get subRubro
     *
     * @return \AppBundle\Entity\SubRubro 
     */
    public function getSubRubro()
    {
        return $this->subRubro;
    }

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     * @return EmpresaSubRubro
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
     * @return EmpresaSubRubro
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
