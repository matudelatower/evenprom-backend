<?php
/**
 * Created by Santiago Semhan.
 */

namespace AppBundle\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use UsuariosBundle\Entity\Usuario;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Class BaseClass
 * @package AppBundle\Entity\Base
 * @ExclusionPolicy("all")
 */
abstract class BaseClass
{

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean")
     */
    protected $activo = true;

    /**
     * @var \DateTime $fechaCreacion
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    protected $fechaCreacion;
    /**
     * @var \DateTime $fechaActualizacion
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    protected $fechaActualizacion;

    /**
     * @var string $creadoPor
     *
     * @Gedmo\Blameable(on="create")
     *
     * @ORM\ManyToOne(targetEntity="UsuariosBundle\Entity\Usuario")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $creadoPor;

    /**
     * @var string $actualizadoPor
     *
     * @Gedmo\Blameable(on="update")
     *
     * @ORM\ManyToOne(targetEntity="UsuariosBundle\Entity\Usuario")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    protected $actualizadoPor;


    /**
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * @param boolean $activo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    /**
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }


    /**
     * @return \DateTime
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    public function getCreadoPor()
    {
        return $this->creadoPor;
    }


    public function getActualizadoPor()
    {
        return $this->actualizadoPor;
    }


}