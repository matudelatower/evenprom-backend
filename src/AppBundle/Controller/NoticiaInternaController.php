<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\NoticiaInterna;

/**
 * NoticiaInterna controller.
 *
 */
class NoticiaInternaController extends Controller {
	/**
	 * Lists all NoticiaInterna entities.
	 *
	 */
	public function indexAction() {
		$em      = $this->getDoctrine()->getManager();
		$empresa = $this->getUser()->getEmpresa()->first();

		$oIds = $em->getRepository( 'AppBundle:NoticiaInternaEmpresa' )->findByEmpresa( $empresa );
		$ids  = array();
		foreach ( $oIds as $oId ) {
			$ids[] = $oId->getNoticiaInterna()->getId();
		}
		$noticias = $em->getRepository( 'AppBundle:NoticiaInterna' )->getNoticias( $ids );


		return $this->render( 'noticiainterna/index.html.twig',
			array(
				'noticiaInternas' => $noticias,
				'empresa'         => $empresa,
			) );
	}

	/**
	 * Finds and displays a NoticiaInterna entity.
	 *
	 */
	public function showAction( NoticiaInterna $noticiaInterna ) {

		return $this->render( 'noticiainterna/show.html.twig',
			array(
				'noticiaInterna' => $noticiaInterna,
			) );
	}
}
