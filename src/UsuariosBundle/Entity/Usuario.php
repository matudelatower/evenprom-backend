<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 29/9/15
 * Time: 20:29
 */

namespace UsuariosBundle\Entity;


use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity(repositoryClass="UsuarioRepository")
 * @ORM\Table(name="fos_user")
 * @UniqueEntity("username")
 * @Serializer\ExclusionPolicy("all")
 */
class Usuario extends BaseUser {

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @Serializer\Exclude
	 */
	protected $id;

	public function __construct() {
		parent::__construct();
		// your own logic
		$this->roles   = array( 'ROLE_USER' );
		$this->empresa = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * @var datetime $creado
	 *
	 * @Gedmo\Timestampable(on="create")
	 * @ORM\Column(name="creado", type="datetime")
	 */
	private $creado;

	/**
	 * @var datetime $actualizado
	 *
	 * @Gedmo\Timestampable(on="update")
	 * @ORM\Column(name="actualizado",type="datetime")
	 */
	private $actualizado;

	/**
	 * @var integer $creadoPor
	 *
	 * @Gedmo\Blameable(on="create")
	 * @ORM\ManyToOne(targetEntity="UsuariosBundle\Entity\Usuario")
	 * @ORM\JoinColumn(name="creado_por", referencedColumnName="id", nullable=true)
	 */
	private $creadoPor;

	/**
	 * @var integer $actualizadoPor
	 *
	 * @Gedmo\Blameable(on="update")
	 * @ORM\ManyToOne(targetEntity="UsuariosBundle\Entity\Usuario")
	 * @ORM\JoinColumn(name="actualizado_por", referencedColumnName="id", nullable=true)
	 */
	private $actualizadoPor;


	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Empresa", mappedBy="usuario", cascade={"persist", "remove"})
	 */
	private $empresa;

	/**
	 *
	 * @ORM\OneToMany(targetEntity="AppBundle\Entity\Persona", mappedBy="usuario", cascade={"persist", "remove"})
	 */
	private $persona;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="facebook_id", type="string", nullable=true)
	 */
	protected $facebookId;

	/** @ORM\Column(name="facebook_access_token", type="string", length=255, nullable=true) */
	protected $facebookAccessToken;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="google_id", type="string", nullable=true)
	 */
	protected $googleId;

	/** @ORM\Column(name="google_access_token", type="string", length=255, nullable=true) */
	protected $googleAccessToken;


	/**
	 * @VirtualProperty()
	 * @SerializedName("username")
	 */
	public function getVUsername() {

		$return = $this->username;

		return $return;

	}

	/**
	 * @VirtualProperty()
	 * @SerializedName("persona")
	 */
	public function getVPersona() {

		$return = array();

		if ( $this->getPersona()->first() ) {
			$return= $this->getPersona()->first();
		}

		return $return;

	}

	/**
	 * Set creado
	 *
	 * @param \DateTime $creado
	 *
	 * @return Usuario
	 */
	public function setCreado( $creado ) {
		$this->creado = $creado;

		return $this;
	}

	/**
	 * Get creado
	 *
	 * @return \DateTime
	 */
	public function getCreado() {
		return $this->creado;
	}

	/**
	 * Set actualizado
	 *
	 * @param \DateTime $actualizado
	 *
	 * @return Usuario
	 */
	public function setActualizado( $actualizado ) {
		$this->actualizado = $actualizado;

		return $this;
	}

	/**
	 * Get actualizado
	 *
	 * @return \DateTime
	 */
	public function getActualizado() {
		return $this->actualizado;
	}

	/**
	 * Set creadoPor
	 *
	 * @param \UsuariosBundle\Entity\Usuario $creadoPor
	 *
	 * @return Usuario
	 */
	public function setCreadoPor( \UsuariosBundle\Entity\Usuario $creadoPor = null ) {
		$this->creadoPor = $creadoPor;

		return $this;
	}

	/**
	 * Get creadoPor
	 *
	 * @return \UsuariosBundle\Entity\Usuario
	 */
	public function getCreadoPor() {
		return $this->creadoPor;
	}

	/**
	 * Set actualizadoPor
	 *
	 * @param \UsuariosBundle\Entity\Usuario $actualizadoPor
	 *
	 * @return Usuario
	 */
	public function setActualizadoPor( \UsuariosBundle\Entity\Usuario $actualizadoPor = null ) {
		$this->actualizadoPor = $actualizadoPor;

		return $this;
	}

	/**
	 * Get actualizadoPor
	 *
	 * @return \UsuariosBundle\Entity\Usuario
	 */
	public function getActualizadoPor() {
		return $this->actualizadoPor;
	}


	/**
	 * Add empresa
	 *
	 * @param \AppBundle\Entity\Empresa $empresa
	 *
	 * @return Usuario
	 */
	public function addEmpresa( \AppBundle\Entity\Empresa $empresa ) {
		$this->empresa[] = $empresa;

		return $this;
	}

	/**
	 * Remove empresa
	 *
	 * @param \AppBundle\Entity\Empresa $empresa
	 */
	public function removeEmpresa( \AppBundle\Entity\Empresa $empresa ) {
		$this->empresa->removeElement( $empresa );
	}

	/**
	 * Get empresa
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getEmpresa() {
		return $this->empresa;
	}

	/**
	 * Add persona
	 *
	 * @param \AppBundle\Entity\Persona $persona
	 *
	 * @return Usuario
	 */
	public function addPersona( \AppBundle\Entity\Persona $persona ) {
		$this->persona[] = $persona;

		return $this;
	}

	/**
	 * Remove persona
	 *
	 * @param \AppBundle\Entity\Persona $persona
	 */
	public function removePersona( \AppBundle\Entity\Persona $persona ) {
		$this->persona->removeElement( $persona );
	}

	/**
	 * Get persona
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPersona() {
		return $this->persona;
	}

	/**
	 * Set facebookId
	 *
	 * @param string $facebookId
	 *
	 * @return Usuario
	 */
	public function setFacebookId( $facebookId ) {
		$this->facebookId = $facebookId;

		return $this;
	}

	/**
	 * Get facebookId
	 *
	 * @return string
	 */
	public function getFacebookId() {
		return $this->facebookId;
	}

	/**
	 * Set googleId
	 *
	 * @param string $googleId
	 *
	 * @return Usuario
	 */
	public function setGoogleId( $googleId ) {
		$this->googleId = $googleId;

		return $this;
	}

	/**
	 * Get googleId
	 *
	 * @return string
	 */
	public function getGoogleId() {
		return $this->googleId;
	}

    /**
     * Set facebookAccessToken
     *
     * @param string $facebookAccessToken
     *
     * @return Usuario
     */
    public function setFacebookAccessToken($facebookAccessToken)
    {
        $this->facebookAccessToken = $facebookAccessToken;

        return $this;
    }

    /**
     * Get facebookAccessToken
     *
     * @return string
     */
    public function getFacebookAccessToken()
    {
        return $this->facebookAccessToken;
    }

    /**
     * Set googleAccessToken
     *
     * @param string $googleAccessToken
     *
     * @return Usuario
     */
    public function setGoogleAccessToken($googleAccessToken)
    {
        $this->googleAccessToken = $googleAccessToken;

        return $this;
    }

    /**
     * Get googleAccessToken
     *
     * @return string
     */
    public function getGoogleAccessToken()
    {
        return $this->googleAccessToken;
    }
}
