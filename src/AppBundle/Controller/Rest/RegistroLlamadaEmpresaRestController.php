<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\RegistroLlamadaEmpresa;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class RegistroLlamadaEmpresaRestController extends FOSRestController {


	public function postRegistroLlamadaEmpresaAction( Request $request, $empresaId, $personaId = null) {

		$em = $this->getDoctrine()->getManager();

		$empresa = $em->getRepository( "AppBundle:Empresa" )->find( $empresaId );

		$registroLlamadaEmpresa = new RegistroLlamadaEmpresa();
		$registroLlamadaEmpresa->setEmpresa( $empresa );
		if ( $personaId ) {
			$persona = $em->getRepository( "AppBundle:Persona" )->find( $personaId );
			$registroLlamadaEmpresa->setPersona( $persona );
		}


		$em->persist( $registroLlamadaEmpresa );
		$em->flush();

		$vista = $this->view( $registroLlamadaEmpresa,
			200 );

		return $this->handleView( $vista );
	}

	public function postRegistroLlamadaPublicacionAction( Request $request, $publicacionId, $personaId = null) {

		$em = $this->getDoctrine()->getManager();

		$publicacion = $em->getRepository( "AppBundle:Publicacion" )->find( $publicacionId );

		$registroLlamadaEmpresa = new RegistroLlamadaEmpresa();
		$registroLlamadaEmpresa->setPublicacion( $publicacion );
		if ( $personaId ) {
			$persona = $em->getRepository( "AppBundle:Persona" )->find( $personaId );
			$registroLlamadaEmpresa->setPersona( $persona );
		}


		$em->persist( $registroLlamadaEmpresa );
		$em->flush();

		$vista = $this->view( $registroLlamadaEmpresa,
			200 );

		return $this->handleView( $vista );
	}
}
