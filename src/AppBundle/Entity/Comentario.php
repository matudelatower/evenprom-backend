<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * Comentario
 *
 * @ORM\Table(name="comentarios")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ComentarioRepository")
 * @ExclusionPolicy("all")
 */
class Comentario extends BaseClass
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
     * @ORM\Column(name="texto", type="text")
     * @Expose()
     */
    private $texto;

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
	 * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", nullable=false)
	 * @Expose()
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
     * Set texto
     *
     * @param string $texto
     *
     * @return Comentario
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return Comentario
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
     * @return Comentario
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
     * @return Comentario
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
     * @return Comentario
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
     * @return Comentario
     */
    public function setPersona(\AppBundle\Entity\Persona $persona)
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
     * @return Comentario
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
     * @return Comentario
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
