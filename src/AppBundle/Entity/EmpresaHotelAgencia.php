<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * EmpresaHotelAgencia
 *
 * @ORM\Table(name="empresas_hoteles_agencias")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmpresaHotelAgenciaRepository")
 */
class EmpresaHotelAgencia extends BaseClass
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa", inversedBy="empresaHotelAgencia")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     */
    private $empresa;


    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\HotelAgencia", inversedBy="empresaHotelAgencia")
     * @ORM\JoinColumn(name="hotel_agencia_id", referencedColumnName="id")
     */
    private $hotelAgencia;


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
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     * @return EmpresaHotelAgencia
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
     * Set hotelAgencia
     *
     * @param \AppBundle\Entity\HotelAgencia $hotelAgencia
     * @return EmpresaHotelAgencia
     */
    public function setHotelAgencia(\AppBundle\Entity\HotelAgencia $hotelAgencia = null)
    {
        $this->hotelAgencia = $hotelAgencia;

        return $this;
    }

    /**
     * Get hotelAgencia
     *
     * @return \AppBundle\Entity\HotelAgencia 
     */
    public function getHotelAgencia()
    {
        return $this->hotelAgencia;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return EmpresaHotelAgencia
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
     * @return EmpresaHotelAgencia
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
     * @return EmpresaHotelAgencia
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
     * @return EmpresaHotelAgencia
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
