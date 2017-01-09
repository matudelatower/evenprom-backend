<?php

namespace AppBundle\Controller\Rest;

use AppBundle\Entity\FotoPersonaEmpresa;
use AppBundle\Entity\RegistroLlamadaEmpresa;
use AppBundle\Form\FotoPersonaEmpresaType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;

class FotoPersonaEmpresaRestController extends FOSRestController {


	public function postFotoPersonaEmpresaAction( Request $request, $empresaId, $personaId ) {


		$appManager = $this->get( 'manager.app' );

		$em = $this->getDoctrine()->getManager();


		$fotoPersonaEmpresa = new FotoPersonaEmpresa();

		$empresa = $em->getRepository('AppBundle:Empresa')->find($empresaId);
		$persona = $em->getRepository('AppBundle:Persona')->find($personaId);

		$imagen = $request->files->get('file');


		$fotoPersonaEmpresa->setEmpresa($empresa);
		$fotoPersonaEmpresa->setPersona($persona);
		$fotoPersonaEmpresa->setImageFile($imagen);


		$form = $this->createForm(FotoPersonaEmpresaType::class, $fotoPersonaEmpresa);

		$form->handleRequest($request);


		$em->persist( $fotoPersonaEmpresa );
		$em->flush();


		$vista = $this->view( $fotoPersonaEmpresa,
			200 );

		return $this->handleView( $vista );
	}


}
