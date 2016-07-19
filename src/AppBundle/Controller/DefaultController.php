<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {
	public function indexAction() {


		if ( ! $this->get( 'security.authorization_checker' )->isGranted( 'IS_AUTHENTICATED_FULLY' ) ) {
			return $this->render( 'AppBundle:Default:index.html.twig' );

		}

		if ( $this->get( 'security.authorization_checker' )->isGranted( 'ROLE_ADMIN' ) ) {
			$this->redirectToRoute( 'easy_admin_bundle' );

		}

		return $this->render( ':empresa:empresa_admin.html.twig',
			array(
				'empresa' => $this->getUser()->getEmpresa()->first(),
			) );

	}
}
