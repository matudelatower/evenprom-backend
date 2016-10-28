<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * NoticiaInternaEmpresa
 *
 * @ORM\Table(name="noticias_internas_empresas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NoticiaInternaEmpresaRepository")
 */
class NoticiaInternaEmpresa extends BaseClass {
	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="leido", type="boolean", nullable=true)
	 */
	private $leido;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="leido_el", type="datetime", nullable=true)
	 */
	private $leidoEl;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa")
	 * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
	 */
	private $empresa;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\NoticiaInterna", inversedBy="noticiaInternaEmpresa")
	 * @ORM\JoinColumn(name="noticia_interna_id", referencedColumnName="id")
	 */
	private $noticiaInterna;

	/**
	 * @var bool
	 *
	 * @ORM\Column(name="volver_a_mostrar", type="boolean", nullable=true)
	 */
	private $volverAMostrar;


	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set leido
	 *
	 * @param boolean $leido
	 *
	 * @return NoticiaInternaEmpresa
	 */
	public function setLeido( $leido ) {
		$this->leido = $leido;

		return $this;
	}

	/**
	 * Get leido
	 *
	 * @return bool
	 */
	public function getLeido() {
		return $this->leido;
	}

	/**
	 * Set leidoEl
	 *
	 * @param \DateTime $leidoEl
	 *
	 * @return NoticiaInternaEmpresa
	 */
	public function setLeidoEl( $leidoEl ) {
		$this->leidoEl = $leidoEl;

		return $this;
	}

	/**
	 * Get leidoEl
	 *
	 * @return \DateTime
	 */
	public function getLeidoEl() {
		return $this->leidoEl;
	}

    /**
     * Set volverAMostrar
     *
     * @param boolean $volverAMostrar
     *
     * @return NoticiaInternaEmpresa
     */
    public function setVolverAMostrar($volverAMostrar)
    {
        $this->volverAMostrar = $volverAMostrar;

        return $this;
    }

    /**
     * Get volverAMostrar
     *
     * @return boolean
     */
    public function getVolverAMostrar()
    {
        return $this->volverAMostrar;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return NoticiaInternaEmpresa
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
     * @return NoticiaInternaEmpresa
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
     *
     * @return NoticiaInternaEmpresa
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
     * Set noticiaInterna
     *
     * @param \AppBundle\Entity\NoticiaInterna $noticiaInterna
     *
     * @return NoticiaInternaEmpresa
     */
    public function setNoticiaInterna(\AppBundle\Entity\NoticiaInterna $noticiaInterna = null)
    {
        $this->noticiaInterna = $noticiaInterna;

        return $this;
    }

    /**
     * Get noticiaInterna
     *
     * @return \AppBundle\Entity\NoticiaInterna
     */
    public function getNoticiaInterna()
    {
        return $this->noticiaInterna;
    }

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     *
     * @return NoticiaInternaEmpresa
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
     * @return NoticiaInternaEmpresa
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
