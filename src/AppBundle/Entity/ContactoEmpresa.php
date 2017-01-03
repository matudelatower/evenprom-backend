<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;

/**
 * ContactoEmpresa
 *
 * @ORM\Table(name="contactos_empresas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactoEmpresaRepository")
 */
class ContactoEmpresa extends BaseClass
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Empresa", inversedBy="contactoEmpresa")
     * @ORM\JoinColumn(name="empresa_id", referencedColumnName="id")
     */
    private $empresa;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Contacto", cascade={"persist"})
     * @ORM\JoinColumn(name="contacto_id", referencedColumnName="id")
     */
    private $contacto;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="responsable_contacto", type="string", length=255, nullable=true)
	 */
	private $responsableContacto;


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
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     * @return ContactoEmpresa
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
     * Set contacto
     *
     * @param \AppBundle\Entity\Contacto $contacto
     * @return ContactoEmpresa
     */
    public function setContacto(\AppBundle\Entity\Contacto $contacto = null)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get contacto
     *
     * @return \AppBundle\Entity\Contacto 
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    public function addEmpresa( Empresa $empresa ) {
        if ( ! $this->empresa->contains( $empresa ) ) {
            $this->empresa->add( $empresa );
        }
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     * @return ContactoEmpresa
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
     * @return ContactoEmpresa
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
     * @return ContactoEmpresa
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
     * @return ContactoEmpresa
     */
    public function setActualizadoPor(\UsuariosBundle\Entity\Usuario $actualizadoPor = null)
    {
        $this->actualizadoPor = $actualizadoPor;

        return $this;
    }

    /**
     * Set responsableContacto
     *
     * @param string $responsableContacto
     *
     * @return ContactoEmpresa
     */
    public function setResponsableContacto($responsableContacto)
    {
        $this->responsableContacto = $responsableContacto;

        return $this;
    }

    /**
     * Get responsableContacto
     *
     * @return string
     */
    public function getResponsableContacto()
    {
        return $this->responsableContacto;
    }
}
