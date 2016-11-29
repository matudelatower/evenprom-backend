<?php

namespace UsuariosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {
	public function indexAction( $name ) {
		return $this->render( 'UsuariosBundle:Default:index.html.twig', array( 'name' => $name ) );
	}

}
