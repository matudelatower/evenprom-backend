<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * DescuentoPublicacion
 *
 * @ORM\Table(name="descuentos_publicaciones")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DescuentoPublicacionRepository")
 */
class DescuentoPublicacion extends BaseClass
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Publicacion", inversedBy="descuentoPublicacion")
     * @ORM\JoinColumn(name="publicacion_id", referencedColumnName="id")
     */
    private $publicacion;


    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Descuento", inversedBy="descuentoPublicacion")
     * @ORM\JoinColumn(name="descuento_id", referencedColumnName="id")
     */
    private $descuento;



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
     * @return DescuentoPublicacion
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
     * @return DescuentoPublicacion
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }

    /**
     * Set publicacion
     *
     * @param \AppBundle\Entity\Publicacion $publicacion
     * @return DescuentoPublicacion
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
     * Set descuento
     *
     * @param \AppBundle\Entity\Descuento $descuento
     * @return DescuentoPublicacion
     */
    public function setDescuento(\AppBundle\Entity\Descuento $descuento = null)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return \AppBundle\Entity\Descuento 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set creadoPor
     *
     * @param \UsuariosBundle\Entity\Usuario $creadoPor
     * @return DescuentoPublicacion
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
     * @return DescuentoPublicacion
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }
}
