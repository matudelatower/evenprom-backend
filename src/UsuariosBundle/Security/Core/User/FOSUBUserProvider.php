<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 22/11/16
 * Time: 16:22
 */

namespace UsuariosBundle\Security\Core\User;

use AppBundle\Entity\Persona;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\User\UserInterface;

class FOSUBUserProvider extends BaseClass {


	/**
	 * {@inheritDoc}
	 */
	public function connect( UserInterface $user, UserResponseInterface $response ) {
		$property = $this->getProperty( $response );
		$username = $response->getUsername();
		//on connect - get the access token and the user ID
		$service      = $response->getResourceOwner()->getName();
		$setter       = 'set' . ucfirst( $service );
		$setter_id    = $setter . 'Id';
		$setter_token = $setter . 'AccessToken';
		//we "disconnect" previously connected users
		if ( null !== $previousUser = $this->userManager->findUserBy( array( $property => $username ) ) ) {
			$previousUser->$setter_id( null );
			$previousUser->$setter_token( null );
			$this->userManager->updateUser( $previousUser );
		}
		//we connect current user
		$user->$setter_id( $username );
		$user->$setter_token( $response->getAccessToken() );
		$this->userManager->updateUser( $user );
	}

	/**
	 * {@inheritdoc}
	 */
	public function loadUserByOAuthUserResponse( UserResponseInterface $response ) {
		$username = $response->getUsername();
//		$user     = $this->userManager->findUserBy( array( $this->getProperty( $response ) => $username ) );
		$user = $this->userManager->findUserByEmail( $response->getEmail() );
		//when the user is registrating
		if ( null === $user ) {
			$service      = $response->getResourceOwner()->getName();
			$setter       = 'set' . ucfirst( $service );
			$setter_id    = $setter . 'Id';
			$setter_token = $setter . 'AccessToken';
			// create new user here
			$user = $this->userManager->createUser();
			$user->$setter_id( $username );
			$user->$setter_token( $response->getAccessToken() );
			//I have set all requested data with the user's username
			//modify here with relevant data
			$user->setUsername( $response->getEmail() );
			$user->setEmail( $response->getEmail() );
			$user->setPassword( $username );
			$user->setEnabled( true );

			// Persona
			$persona = new Persona();
			$persona->setNombre( $response->getFirstName() );
			$persona->setApellido( $response->getLastName() );
			$persona->setUsuario( $user );

			$user->addRole( 'ROLE_PERSONA' );
			$user->addPersona( $persona );


			$this->userManager->updateUser( $user );

			return $user;
		} else {
			$service      = $response->getResourceOwner()->getName();
			$setter       = 'set' . ucfirst( $service );
			$setter_id    = $setter . 'Id';
			$setter_token = $setter . 'AccessToken';
			// create new user here

			$user->$setter_id( $username );
			$user->$setter_token( $response->getAccessToken() );

			$this->userManager->updateUser( $user );
		}
		//if user exists - go with the HWIOAuth way
		$user        = parent::loadUserByOAuthUserResponse( $response );
		$serviceName = $response->getResourceOwner()->getName();
		$setter      = 'set' . ucfirst( $serviceName ) . 'AccessToken';
		//update access token
		$user->$setter( $response->getAccessToken() );

		return $user;
	}
}