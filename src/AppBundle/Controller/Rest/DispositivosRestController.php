<?php

namespace AppBundle\Controller\Rest;


use AppBundle\Entity\Dispositivo;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class DispositivosRestController extends FOSRestController {


	public function postDispositivoAction( Request $request, $personaId ) {

		$em = $this->getDoctrine()->getManager();

		$persona = $em->getRepository( 'AppBundle:Persona' )->findOneById( $personaId );

		if ( ! $persona ) {
			throw new HttpException( 404, "La persona no existe" );
		}

		$params = $request->request->all();

		$criteria = array(
			'persona'  => $persona,
			'playerId' => $params['player_id']
		);

		$dispositivo = $em->getRepository( 'AppBundle:Dispositivo' )->findOneBy( $criteria );

		if ( ! $dispositivo ) {
			$dispositivo = new Dispositivo();

		}

		$dispositivo->setPersona( $persona );
		$dispositivo->setPlayerId( $params['player_id'] );

		$em->persist($dispositivo);
		$em->flush();

		$vista = $this->view( $dispositivo,
			200 );

		return $this->handleView( $vista );
	}

}
