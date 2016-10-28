<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
	public function indexAction( Request $request ) {


		if ( ! $this->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) ) {
			return $this->render( 'AppBundle:Default:index.html.twig' );

		}

		if ( $this->get( 'security.authorization_checker' )->isGranted( 'ROLE_ADMIN' ) ) {
			return $this->redirectToRoute( 'easyadmin' );

		}

		$empresa = $this->getUser()->getEmpresa()->first();

		$em                      = $this->getDoctrine();
		$noticias                = $em->getRepository( 'AppBundle:NoticiaInterna' )->getNoticiasActuales();
		$noticiasInternasEmpresa = $em->getRepository( 'AppBundle:NoticiaInternaEmpresa' )->findByEmpresa( $empresa );

		return $this->render( ':empresa:empresa_admin.html.twig',
			array(
				'empresa'                 => $empresa,
				'noticias'                => $noticias,
				'noticiasInternasEmpresa' => $noticiasInternasEmpresa,
			) );

	}
}
