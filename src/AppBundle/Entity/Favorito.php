<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * Favorito
 *
 * @ORM\Table(name="favoritos")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FavoritoRepository")
 */
class Favorito extends BaseClass
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
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa")
	 * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id", nullable=true)
	 */
	private $empresa;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Publicacion")
	 * @ORM\JoinColumn(name="publicacion_id", referencedColumnName="id", nullable=true)
	 */
	private $publicacion;

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
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     *
     * @return Favorito
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
     * Set publicacion
     *
     * @param \AppBundle\Entity\Publicacion $publicacion
     *
     * @return Favorito
     */
    public function setPublicacion(\AppBundle\Entity\Publicacion $publicacion = null)
    {
        $this->publicacion = $publicacion;

        return $this;
    }

    /**
     * Get publicacion
     *
     * @return \AppBundle\Entity\Publicacion
     */
    public function getPublicacion()
    {
        return $this->publicacion;
    }

    /**
     * Set persona
     *
     * @param \AppBundle\Entity\Persona $persona
     *
     * @return Favorito
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Favorito
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
     * @return Favorito
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
     * @return Favorito
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
     * @return Favorito
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
