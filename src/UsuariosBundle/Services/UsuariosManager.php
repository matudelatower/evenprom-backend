<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 28/12/16
 * Time: 23:12
 */

namespace UsuariosBundle\Services;

use AppBundle\Entity\Persona;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Doctrine\UserManager;
use UsuariosBundle\Entity\Usuario;


class UsuariosManager {

	private $em;

	private $userManager;

	public function __construct( EntityManager $em, UserManager $userManager ) {
		$this->em = $em;

		$this->userManager = $userManager;
	}

	function crearPerfil( $params ) {
		$email    = $params['email'];
		$nombre   = $params['nombre'];
		$apellido = $params['apellido'];

		$existeUsuario = $this->userManager->findUserByEmail( $email );

		if ( $existeUsuario ) {

			$persona = $existeUsuario->getPersona()->first();

			return $persona;
		}

//		Usuario
		$usuario = new Usuario();

		$usuario->setUsername( $email );

		$usuario->setEmail( $email );

		$bytes = openssl_random_pseudo_bytes( 2 );

		$pwd = bin2hex( $bytes );

		$usuario->setPlainPassword( $pwd );

		$usuario->setEnabled( true );

		$usuario->addRole( 'ROLE_PERSONA' );
		$fbId = isset( $params['fbId'] ) ? $params['fbId'] : null;

		$usuario->setFacebookId( $fbId );

		$fbAccessToken = isset( $params['facebookAccessToken'] ) ? $params['facebookAccessToken'] : null;

		$usuario->setFacebookAccessToken( $fbAccessToken );

		$gId = isset( $params['gId'] ) ? $params['gId'] : null;

		$usuario->setGoogleId( $gId );

		$gAccessToken = isset( $params['googleAccessToken'] ) ? $params['googleAccessToken'] : null;

		$usuario->setFacebookAccessToken( $gAccessToken );

//		Persona

		$persona = new Persona();

		$persona->setNombre( $nombre );
		$persona->setApellido( $apellido );
		$persona->setUsuario( $usuario );

		$usuario->addPersona( $persona );

//		persist

		$this->em->persist( $persona );

		$this->userManager->updateUser( $usuario );

		return $persona;


	}

}