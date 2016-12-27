<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * DireccionEmpresa
 *
 * @ORM\Table(name="direcciones_empresas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DireccionEmpresaRepository")
 */
class DireccionEmpresa extends BaseClass {
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
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa", inversedBy="direccionEmpresa")
	 * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
	 */
	private $empresa;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Direccion", cascade={"persist"})
	 * @ORM\JoinColumn(name="direccion_id", referencedColumnName="id")
	 */
	private $direccion;

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set empresa
	 *
	 * @param \AppBundle\Entity\Empresa $empresa
	 *
	 * @return DireccionEmpresa
	 */
	public function setEmpresa( \AppBundle\Entity\Empresa $empresa = null ) {
		$this->empresa = $empresa;

		return $this;
	}

	/**
	 * Get empresa
	 *
	 * @return \AppBundle\Entity\Empresa
	 */
	public function getEmpresa() {
		return $this->empresa;
	}

	/**
	 * Set direccion
	 *
	 * @param \AppBundle\Entity\Direccion $direccion
	 *
	 * @return DireccionEmpresa
	 */
	public function setDireccion( \AppBundle\Entity\Direccion $direccion = null ) {
		$this->direccion = $direccion;

		return $this;
	}

	/**
	 * Get direccion
	 *
	 * @return \AppBundle\Entity\Direccion
	 */
	public function getDireccion() {
		return $this->direccion;
	}

	public function addEmpresa( Empresa $empresa ) {
		if ( $this->empresa  ) {
			$this->empresa =  $empresa ;
		}
	}

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return DireccionEmpresa
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
     * @return DireccionEmpresa
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
     *
     * @return DireccionEmpresa
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
     * @return DireccionEmpresa
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
