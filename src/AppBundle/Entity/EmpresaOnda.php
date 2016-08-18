<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * EmpresaOnda
 *
 * @ORM\Table(name="empresa_ondas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmpresaOndaRepository")
 */
class EmpresaOnda extends BaseClass{
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
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa", inversedBy="empresaOnda")
	 * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
	 */
	private $empresa;


	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Onda", inversedBy="empresaOnda")
	 * @ORM\JoinColumn(name="onda_id", referencedColumnName="id")
	 */
	private $onda;

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return EmpresaOnda
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
     * @return EmpresaOnda
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
     * @return EmpresaOnda
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
     * Set onda
     *
     * @param \AppBundle\Entity\Onda $onda
     * @return EmpresaOnda
     */
    public function setOnda(\AppBundle\Entity\Onda $onda = null)
    {
        $this->onda = $onda;

        return $this;
    }

    /**
     * Get onda
     *
     * @return \AppBundle\Entity\Onda 
     */
    public function getOnda()
    {
        return $this->onda;
    }

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     * @return EmpresaOnda
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
     * @return EmpresaOnda
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }


	public function addEmpresa( Empresa $empresa ) {
		if ( ! $this->empresa->contains( $empresa ) ) {
			$this->empresa->add( $empresa );
		}
	}
}
