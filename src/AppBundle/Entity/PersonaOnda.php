<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Base\BaseClass;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * PersonaOnda
 *
 * @ORM\Table(name="personas_ondas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PersonaOndaRepository")
 * @ExclusionPolicy("all")
 */
class PersonaOnda extends BaseClass
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
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Onda", inversedBy="personaOnda")
	 * @ORM\JoinColumn(name="onda_id", referencedColumnName="id")
	 * @Expose()
	 */
	private $onda;

	/**
	 * @var
	 *
	 * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona", inversedBy="personaOnda")
	 * @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
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
     * Set onda
     *
     * @param \AppBundle\Entity\Onda $onda
     *
     * @return PersonaOnda
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
     * Set persona
     *
     * @param \AppBundle\Entity\Persona $persona
     *
     * @return PersonaOnda
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
}
