<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * LikesSharePorElemento
 *
 * @ORM\Table(name="likes_share_por_elemento")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LikesSharePorElementoRepository")
 */
class LikesSharePorElemento extends BaseClass
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
     * @var int
     *
     * @ORM\Column(name="visita", type="integer", nullable=true)
     */
    private $visita;

    /**
     * @var int
     *
     * @ORM\Column(name="likes", type="integer", nullable=true)
     */
    private $likes;

    /**
     * @var int
     *
     * @ORM\Column(name="share", type="integer", nullable=true)
     */
    private $share;

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
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Publicacion", inversedBy="likeSharePorElemento")
	 * @ORM\JoinColumn(name="publicacion_id", referencedColumnName="id", nullable=true)
	 */
	private $publicacion;


	/**
	 * @var int
	 *
	 * @ORM\Column(name="certificado", type="integer", nullable=true)
	 */
	private $certificado;


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
     * Set visita
     *
     * @param integer $visita
     *
     * @return LikesSharePorElemento
     */
    public function setVisita($visita)
    {
        $this->visita = $visita;

        return $this;
    }

    /**
     * Get visita
     *
     * @return int
     */
    public function getVisita()
    {
        return $this->visita;
    }

    /**
     * Set likes
     *
     * @param integer $likes
     *
     * @return LikesSharePorElemento
     */
    public function setLikes($likes)
    {
        $this->likes = $likes;

        return $this;
    }

    /**
     * Get likes
     *
     * @return int
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * Set share
     *
     * @param integer $share
     *
     * @return LikesSharePorElemento
     */
    public function setShare($share)
    {
        $this->share = $share;

        return $this;
    }

    /**
     * Get share
     *
     * @return int
     */
    public function getShare()
    {
        return $this->share;
    }

    /**
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     *
     * @return LikesSharePorElemento
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
     * @return LikesSharePorElemento
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
     * Set certificado
     *
     * @param integer $certificado
     *
     * @return LikesSharePorElemento
     */
    public function setCertificado($certificado)
    {
        $this->certificado = $certificado;

        return $this;
    }

    /**
     * Get certificado
     *
     * @return integer
     */
    public function getCertificado()
    {
        return $this->certificado;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return LikesSharePorElemento
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
     * @return LikesSharePorElemento
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
     * @return LikesSharePorElemento
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
     * @return LikesSharePorElemento
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
