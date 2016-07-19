<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DireccionEmpresa
 *
 * @ORM\Table(name="direcciones_empresas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DireccionEmpresaRepository")
 */
class DireccionEmpresa {
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
}
