<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\NotificacionPersona;
use AppBundle\Entity\PersonaOnda;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PersonasRestController extends FOSRestController {

	public function getPersonasAction( Request $request ) {

		$categorias = $this->getDoctrine()->getRepository( "AppBundle:Persona" )->findAll();


		$vista = $this->view( $categorias,
			200 );

		return $this->handleView( $vista );
	}

	public function getPersonaAction( Request $request, $id ) {

		$persona = $this->getDoctrine()->getRepository( "AppBundle:Persona" )->findOneById( $id );

		if ( ! $persona ) {
			throw new HttpException( 404, "La persona no existe" );
		}

		$vista = $this->view( $persona,
			200 );

		return $this->handleView( $vista );
	}

	public function postPersonaAction( Request $request, $id ) {

		$persona = $this->getDoctrine()->getRepository( "AppBundle:Persona" )->findOneById( $id );

		if ( ! $persona ) {
			throw new HttpException( 404, "La persona no existe" );
		}

		$ondas = $request->get( 'ondas' );

		foreach ( $ondas as $ondaId ) {
			$personaOnda = new PersonaOnda();
			$onda        = $this->getDoctrine()->getRepository( "AppBundle:Onda" )->findOneById( $ondaId );
			$personaOnda->setOnda( $onda );
			$persona->addPersonaOnda( $personaOnda );
		}

		$this->getDoctrine()->getManager()->persist( $persona );

		$vista = $this->view( $persona,
			200 );

		return $this->handleView( $vista );
	}

	public function getPerfilPersonaAction( Request $request, $personaId ) {

		$persona = $this->getDoctrine()->getRepository( "AppBundle:Persona" )->find( $personaId );

//		$perfilPersona = $this->getDoctrine()->getRepository( "AppBundle:PerfilPersona" )->findByPersona( $persona );


		$vista = $this->view( $persona,
			200 );

		return $this->handleView( $vista );
	}

	public function postPerfilPersonaAction( Request $request, $personaId ) {


		$datos = json_decode( $request->get( 'perfil' ) );

		$persona = $this->getDoctrine()->getRepository( "AppBundle:Persona" )->find( $personaId );

		$perfilPersona = $this->getDoctrine()->getRepository( "AppBundle:PerfilPersona" )->findByPersona( $persona );


		$vista = $this->view( $perfilPersona,
			200 );

		return $this->handleView( $vista );
	}

	public function postNotificacionesPersonaAction( Request $request, $personaId ) {

		$em     = $this->getDoctrine()->getManager();
		$params = $request->request->all();

		$persona = $em->getRepository( "AppBundle:Persona" )->find( $personaId );

		$notificacionPersona = $em->getRepository( "AppBundle:NotificacionPersona" )->findOneByPersona( $persona );

		if ( ! $notificacionPersona ) {
			$notificacionPersona = new NotificacionPersona();
			$notificacionPersona->setPersona( $persona );
		}

		if ( $params['onda'] ) {
			$notificacionPersona->setOnda( $params['onda'] );
		}
		if ( $params['rubro'] ) {
			$notificacionPersona->setRubro( $params['rubro'] );
		}
		if ( $params['entretenimiento'] ) {
			$notificacionPersona->setEntretenimiento( $params['entretenimiento'] );
		}
		if ( $params['compras'] ) {
			$notificacionPersona->setCompra( $params['compras'] );
		}
		if ( $params['gastronomia'] ) {
			$notificacionPersona->setGastronomico( $params['gastronomia'] );
		}
		if ( $params['empresa'] ) {
			$notificacionPersona->setEmpresa( $params['empresa'] );
		}
		if ( $params['eventos'] ) {
			$notificacionPersona->setEvento( array( $params['eventos'] ) );
		}
		if ( $params['descuentos'] ) {
			$notificacionPersona->setDescuento( $params['descuentos'] );
		}
		if ( $params['localidad'] ) {
			$notificacionPersona->setLocalidad( $params['localidad'] );
		}


		$em->persist( $notificacionPersona );
		$em->flush();


		$vista = $this->view( $notificacionPersona,
			200 );

		return $this->handleView( $vista );


	}
}
