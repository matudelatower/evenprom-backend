<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 29/12/16
 * Time: 08:57
 */

namespace AppBundle\Services;


use AppBundle\Entity\CheckIn;
use AppBundle\Entity\Comentario;
use AppBundle\Entity\Favorito;
use Doctrine\ORM\EntityManager;


class AppManager {

	private $em;


	public function __construct( EntityManager $em ) {
		$this->em = $em;
	}

	public function favearEmpresa( $empresaId, $personaId ) {
		$em      = $this->em;
		$empresa = $em->getRepository( 'AppBundle:Empresa' )->find( $empresaId );
		$persona = $em->getRepository( 'AppBundle:Persona' )->find( $personaId );

		$criteria = array(
			'persona' => $persona,
			'empresa' => $empresa,
		);
		$favorito = $em->getRepository( 'AppBundle:Favorito' )->findOneBy( $criteria );

		if ( $favorito ) {
			$favorito->setActivo( ! $favorito->getActivo() );
		} else {
			$favorito = new Favorito();
			$favorito->setEmpresa( $empresa );
			$favorito->setPersona( $persona );
		}

		$em->persist( $favorito );
		$em->flush();

		return $favorito;
	}

	public function favearPublicacion( $publicacionId, $personaId ) {
		$em          = $this->em;
		$publicacion = $em->getRepository( 'AppBundle:Publicacion' )->find( $publicacionId );
		$persona     = $em->getRepository( 'AppBundle:Persona' )->find( $personaId );

		$criteria = array(
			'persona'     => $persona,
			'publicacion' => $publicacion,
		);

		$favorito = $em->getRepository( 'AppBundle:Favorito' )->findOneBy( $criteria );

		if ( $favorito ) {
			$favorito->setActivo( ! $favorito->getActivo() );
		} else {
			$favorito = new Favorito();
			$favorito->setPublicacion( $publicacion );
			$favorito->setPersona( $persona );
		}

		$em->persist( $favorito );
		$em->flush();

		return $favorito;
	}

	public function comentarEmpresa( $empresaId, $personaId, $texto ) {
		$em      = $this->em;
		$empresa = $em->getRepository( 'AppBundle:Empresa' )->find( $empresaId );
		$persona = $em->getRepository( 'AppBundle:Persona' )->find( $personaId );

		$favorito = new Comentario();
		$favorito->setEmpresa( $empresa );
		$favorito->setPersona( $persona );
		$favorito->setTexto( $texto );

		$em->persist( $favorito );
		$em->flush();

		return $favorito;
	}

	public function comentarPublicacion( $publicacionId, $personaId, $texto ) {
		$em          = $this->em;
		$publicacion = $em->getRepository( 'AppBundle:Publicacion' )->find( $publicacionId );
		$persona     = $em->getRepository( 'AppBundle:Persona' )->find( $personaId );

		$favorito = new Comentario();
		$favorito->setPublicacion( $publicacion );
		$favorito->setPersona( $persona );
		$favorito->setTexto( $texto );

		$em->persist( $favorito );
		$em->flush();

		return $favorito;
	}

	public function checkInEmpresa( $empresaId, $personaId ) {
		$em      = $this->em;
		$empresa = $em->getRepository( 'AppBundle:Empresa' )->find( $empresaId );
		$persona = $em->getRepository( 'AppBundle:Persona' )->find( $personaId );

		$criteria = array(
			'persona' => $persona,
			'empresa' => $empresa,
		);
		$checkIn = $em->getRepository( 'AppBundle:CheckIn' )->findOneBy( $criteria );

		if ( $checkIn ) {
			$checkIn->setActivo( ! $checkIn->getActivo() );
		} else {
			$checkIn = new CheckIn();
			$checkIn->setEmpresa( $empresa );
			$checkIn->setPersona( $persona );
		}

		$em->persist( $checkIn );
		$em->flush();

		return $checkIn;
	}

	public function checkInPublicacion( $publicacionId, $personaId ) {
		$em          = $this->em;
		$publicacion = $em->getRepository( 'AppBundle:Publicacion' )->find( $publicacionId );
		$persona     = $em->getRepository( 'AppBundle:Persona' )->find( $personaId );

		$criteria = array(
			'persona'     => $persona,
			'publicacion' => $publicacion,
		);

		$checkIn = $em->getRepository( 'AppBundle:CheckIn' )->findOneBy( $criteria );

		if ( $checkIn ) {
			$checkIn->setActivo( ! $checkIn->getActivo() );
		} else {
			$checkIn = new CheckIn();
			$checkIn->setPublicacion( $publicacion );
			$checkIn->setPersona( $persona );
		}

		$em->persist( $checkIn );
		$em->flush();

		return $checkIn;
	}

}