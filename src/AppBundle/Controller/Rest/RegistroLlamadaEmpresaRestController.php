<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\RegistroLlamadaEmpresa;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class RegistroLlamadaEmpresaRestController extends FOSRestController {


	public function postRegistrollamadaempresaAction( Request $request, $empresaId, $clienteId = null ) {

		$em = $this->getDoctrine()->getManager();

		$empresa = $em->getRepository( "AppBundle:Empresa" )->find( $empresaId );

		$registroLlamadaEmpresa = new RegistroLlamadaEmpresa();
		$registroLlamadaEmpresa->setEmpresa( $empresa );

		$em->persist( $registroLlamadaEmpresa );
		$em->flush();

		$vista = $this->view( $registroLlamadaEmpresa,
			200 );

		return $this->handleView( $vista );
	}
}
