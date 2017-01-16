<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * PerfilPersona
 *
 * @ORM\Table(name="notificaciones_personas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PerfilPersonaRepository")
 * @ExclusionPolicy("all")
 */
class NotificacionPersona extends BaseClass
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
	 * @var
	 * @ORM\Column(name="localidad", type="json_array", nullable=true)
	 * @Expose()
	 */
	private $localidad;

	/**
	 * @var
	 * @ORM\Column(name="empresa", type="json_array", nullable=true)
	 * @Expose()
	 */
	private $empresa;

	/**
	 * @var
	 * @ORM\Column(name="entretenimiento", type="json_array", nullable=true)
	 * @Expose()
	 */
	private $entretenimiento;

	/**
	 * @var
	 * @ORM\Column(name="descuento", type="json_array", nullable=true)
	 * @Expose()
	 */
	private $descuento;

	/**
	 * @var
	 * @ORM\Column(name="gastronomico", type="json_array", nullable=true)
	 * @Expose()
	 */
	private $gastronomico;

	/**
	 * @var
	 * @ORM\Column(name="turistico", type="json_array", nullable=true)
	 * @Expose()
	 */
	private $turistico;

	/**
	 * @var
	 * @ORM\Column(name="evento", type="json_array", nullable=true)
	 * @Expose()
	 */
	private $evento;

	/**
	 * @var
	 * @ORM\Column(name="compra", type="json_array", nullable=true)
	 * @Expose()
	 */
	private $compra;

	/**
	 * @var
	 * @ORM\Column(name="onda", type="json_array", nullable=true)
	 * @Expose()
	 */
	private $onda;

	/**
	 * @var
	 * @ORM\Column(name="rubro", type="json_array", nullable=true)
	 * @Expose()
	 */
	private $rubro;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona")
	 * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", nullable=true)
	 */
	private $persona;

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
     * Set localidad
     *
     * @param array $localidad
     *
     * @return PerfilPersona
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;

        return $this;
    }

    /**
     * Get localidad
     *
     * @return array
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set empresa
     *
     * @param array $empresa
     *
     * @return PerfilPersona
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return array
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set entretenimiento
     *
     * @param array $entretenimiento
     *
     * @return PerfilPersona
     */
    public function setEntretenimiento($entretenimiento)
    {
        $this->entretenimiento = $entretenimiento;

        return $this;
    }

    /**
     * Get entretenimiento
     *
     * @return array
     */
    public function getEntretenimiento()
    {
        return $this->entretenimiento;
    }

    /**
     * Set descuento
     *
     * @param array $descuento
     *
     * @return PerfilPersona
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return array
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set gastronomico
     *
     * @param array $gastronomico
     *
     * @return PerfilPersona
     */
    public function setGastronomico($gastronomico)
    {
        $this->gastronomico = $gastronomico;

        return $this;
    }

    /**
     * Get gastronomico
     *
     * @return array
     */
    public function getGastronomico()
    {
        return $this->gastronomico;
    }

    /**
     * Set turistico
     *
     * @param array $turistico
     *
     * @return PerfilPersona
     */
    public function setTuristico($turistico)
    {
        $this->turistico = $turistico;

        return $this;
    }

    /**
     * Get turistico
     *
     * @return array
     */
    public function getTuristico()
    {
        return $this->turistico;
    }

    /**
     * Set evento
     *
     * @param array $evento
     *
     * @return PerfilPersona
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get evento
     *
     * @return array
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set compra
     *
     * @param array $compra
     *
     * @return PerfilPersona
     */
    public function setCompra($compra)
    {
        $this->compra = $compra;

        return $this;
    }

    /**
     * Get compra
     *
     * @return array
     */
    public function getCompra()
    {
        return $this->compra;
    }

    /**
     * Set onda
     *
     * @param array $onda
     *
     * @return PerfilPersona
     */
    public function setOnda($onda)
    {
        $this->onda = $onda;

        return $this;
    }

    /**
     * Get onda
     *
     * @return array
     */
    public function getOnda()
    {
        return $this->onda;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return PerfilPersona
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
     * @return PerfilPersona
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Set persona
     *
     * @param \AppBundle\Entity\Persona $persona
     *
     * @return PerfilPersona
     */
    public function setPersona(\AppBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;

        return $this;
    }

    /**
     * Get persona
     *
     * @return \AppBundle\Entity\Persona
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     *
     * @return PerfilPersona
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
     * @return PerfilPersona
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }

    /**
     * Set rubro
     *
     * @param array $rubro
     *
     * @return NotificacionPersona
     */
    public function setRubro($rubro)
    {
        $this->rubro = $rubro;

        return $this;
    }

    /**
     * Get rubro
     *
     * @return array
     */
    public function getRubro()
    {
        return $this->rubro;
    }
}
