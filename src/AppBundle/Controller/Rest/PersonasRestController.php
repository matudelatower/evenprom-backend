<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\NotificacionPersona;
use AppBundle\Entity\PersonaOnda;
use Doctrine\Common\Collections\ArrayCollection;
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

	public function putPersonaAction( Request $request, $id ) {

		$em = $this->getDoctrine();

		$persona = $em->getRepository( "AppBundle:Persona" )->findOneById( $id );

		if ( ! $persona ) {
			throw new HttpException( 404, "La persona no existe" );
		}

		$ondasOriginales = new ArrayCollection();

		foreach ( $persona->getPersonaOnda() as $personaOndaO ) {
			$ondasOriginales->add( $personaOndaO );
		}

		$ondas = $request->get( 'ondas' );

//		pregunto si hay candidatas a eliminar
		if ( $ondasOriginales->count() > count( $ondas ) ) {
			foreach ( $ondasOriginales as $ondasOriginale ) {
				$idOndasOriginales[] = $ondasOriginale->getOnda()->getId();
			}
			$result = array_diff( $idOndasOriginales, $ondas );
			foreach ( $result as $item ) {
				$onda = $this->getDoctrine()->getRepository( "AppBundle:Onda" )->findOneById( $item );
				$criteria    = array(
					'persona' => $persona
				);
				$personaOnda = $this->getDoctrine()->getRepository( "AppBundle:PersonaOnda" )->findBy( $criteria );
				foreach ( $personaOnda as $item ) {
					if($item->getOnda()->getId() == $onda->getId()){
						$em->getManager()->remove($item);
					}
				}
			}
		}

		foreach ( $ondas as $ondaId ) {
			$onda        = $this->getDoctrine()->getRepository( "AppBundle:Onda" )->findOneById( $ondaId );
			$criteria    = array(
				'onda'    => $onda,
				'persona' => $persona
			);
			$personaOnda = $this->getDoctrine()->getRepository( "AppBundle:PersonaOnda" )->findBy( $criteria );
			if ( ! $personaOnda ) {
				$personaOnda = new PersonaOnda();
				$personaOnda->setOnda( $onda );
				$persona->addPersonaOnda( $personaOnda );
			}
		}

		$this->getDoctrine()->getManager()->flush();

		$vista = $this->view( $persona,
			200 );

		return $this->handleView( $vista );
	}

	public function getPerfilPersonaAction( Request $request, $personaId ) {

		$persona = $this->getDoctrine()->getRepository( "AppBundle:Persona" )->find( $personaId );

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

	public function putNotificacionesAction( Request $request, $personaId ) {

		$em     = $this->getDoctrine()->getManager();
		$params = $request->request->all();

		$persona = $em->getRepository( "AppBundle:Persona" )->find( $personaId );

		if ( ! $persona ) {
			throw new HttpException( 404, "La persona no existe" );
		}

		$notificacionPersona = $em->getRepository( "AppBundle:NotificacionPersona" )->findOneByPersona( $persona );

		if ( ! $notificacionPersona ) {
			$notificacionPersona = new NotificacionPersona();
			$notificacionPersona->setPersona( $persona );
		}

		if ( isset($params['onda']) && $params['onda'] ) {
			$notificacionPersona->setOnda( $params['onda'] );
		}
		if ( isset($params['rubro']) && $params['rubro'] ) {
			$notificacionPersona->setRubro( $params['rubro'] );
		}
		if ( isset($params['entretenimiento']) && $params['entretenimiento'] ) {
			$notificacionPersona->setEntretenimiento( $params['entretenimiento'] );
		}
		if ( isset($params['compras']) && $params['compras'] ) {
			$notificacionPersona->setCompra( $params['compras'] );
		}
		if ( isset($params['gastronomia']) && $params['gastronomia'] ) {
			$notificacionPersona->setGastronomico( $params['gastronomia'] );
		}
		if ( isset($params['empresa']) && $params['empresa'] ) {
			$notificacionPersona->setEmpresa( $params['empresa'] );
		}
		if ( isset($params['eventos']) && $params['eventos'] ) {
			$notificacionPersona->setEvento( array( $params['eventos'] ) );
		}
		if ( isset($params['descuentos']) && $params['descuentos'] ) {
			$notificacionPersona->setDescuento( $params['descuentos'] );
		}
		if ( isset($params['localidad']) && $params['localidad'] ) {
			$notificacionPersona->setLocalidad( $params['localidad'] );
		}


		$em->persist( $notificacionPersona );
		$em->flush();


		$vista = $this->view( $notificacionPersona,
			200 );

		return $this->handleView( $vista );
	}

	public function getNotificacionesAction( $personaId ) {
		$em     = $this->getDoctrine()->getManager();

		$persona = $em->getRepository( "AppBundle:Persona" )->find( $personaId );

		if ( ! $persona ) {
			throw new HttpException( 404, "La persona no existe" );
		}

		$notificacionPersona = $em->getRepository( "AppBundle:NotificacionPersona" )->findOneByPersona( $persona );

		$vista = $this->view( $notificacionPersona,
			200 );

		return $this->handleView( $vista );
	}
}
