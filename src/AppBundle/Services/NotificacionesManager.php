<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 29/12/16
 * Time: 08:57
 */

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;
use OneSignal\OneSignal;


class NotificacionesManager {

	private $em;
	private $oneSignal;


	public function __construct( EntityManager $em, OneSignal $oneSignal ) {
		$this->em        = $em;
		$this->oneSignal = $oneSignal;
	}

	public function enviarNotificaciones() {
		$clientes = $this->em->getRepository( 'AppBundle:Dispositivo' )->findAll();

		$clientesToSend = array();

		foreach ( $clientes as $cliente ) {
			$clientesToSend[] = $cliente->getPlayerId();
		}

		$this->oneSignal->notifications->add( [
			'headings'           => [
				'en' => 'EvenProm',
				'es' => 'EvenProm',
				'pt' => 'EvenProm',
			],
			'contents'           => [
				'en' => 'New Offer!',
				'es' => 'Nueva Oferta',
				'pt' => 'Nova Oferta',
			],
//			'included_segments' => ['All'],
			'include_player_ids' => $clientesToSend,
//			'url'                => 'https://evenprom.com/publicacion/16',
			'url'                => 'https://evenprom.com/test/es/2/sitios',
//			'url' => 'https://evenprom.com/favoritos',
//			'small_icon'=> 'http://evenprom.com/bundles/app/img/16x16.png',
//			'large_icon'=> 'http://evenprom.com/bundles/app/img/120x120.png',
//			'adm_small_icon'=> 'http://evenprom.com/bundles/app/img/120x120.png',
//			'adm_large_icon'=> 'http://evenprom.com/bundles/app/img/120x120.png',
//			'big_picture'=> 'http://evenprom.com/bundles/app/img/120x120.png',

		] );

	}

	public function notificarEventos() {

	}

}