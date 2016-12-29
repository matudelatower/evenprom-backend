<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 29/12/16
 * Time: 08:57
 */

namespace AppBundle\Services;


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

		$favorito = new Favorito();
		$favorito->setEmpresa( $empresa );
		$favorito->setPersona( $persona );

		$em->persist( $favorito );
		$em->flush();

		return $favorito;
	}

	public function favearPublicacion( $publicacionId, $personaId ) {
		$em          = $this->em;
		$publicacion = $em->getRepository( 'AppBundle:Publicacion' )->find( $publicacionId );
		$persona     = $em->getRepository( 'AppBundle:Persona' )->find( $personaId );

		$favorito = new Favorito();
		$favorito->setPublicacion( $publicacion );
		$favorito->setPersona( $persona );

		$em->persist( $favorito );
		$em->flush();

		return $favorito;
	}

}