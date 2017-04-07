<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface {
	use ContainerAwareTrait;

	public function mainMenu( FactoryInterface $factory, array $options ) {
//		$menu = $factory->createItem('root');
//
//		$menu->addChild('Home', array('route' => 'app_homepage'));

		$menu = $factory->createItem(
			'root',
			array(
				'childrenAttributes' => array(
					'class' => 'sidebar-menu',
				),
			)
		);

		$menu->addChild(
			'MENU PRINCIPAL'
		)->setAttribute( 'class', 'header' );


		if ( $this->container->get( 'security.authorization_checker' )->isGranted( 'ROLE_EMPRESA' ) ) {

			$keyEmpresa = 'EMPRESA';
			$menu->addChild(
				$keyEmpresa,
				array(
					'childrenAttributes' => array(
						'class' => 'treeview-menu',
					),
				)
			)
			     ->setUri( '#' )
			     ->setExtra( 'icon', 'fa fa-building' )
			     ->setAttribute( 'class', 'treeview' );

			$menu[ $keyEmpresa ]
				->addChild(
					$this->container->get( 'translator' )->trans( 'menu.empresa.profile',
						array(),
						'app' ),
					array(
						'route' => 'empresa_perfil',
					)
				);

			$menu[ $keyEmpresa ]
				->addChild(
					$this->container->get( 'translator' )->trans( 'menu.empresa.nuevo_evento',
						array(),
						'app' ),
					array(
						'route' => 'evento_new',
					)
				);
			$menu[ $keyEmpresa ]
				->addChild(
					$this->container->get( 'translator' )->trans( 'menu.empresa.nueva_oferta',
						array(),
						'app' ),
					array(
						'route' => 'oferta_new',
					)
				);

			$menu[ $keyEmpresa ]
				->addChild(
					$this->container->get( 'translator' )->trans( 'menu.empresa.noticias_recientes',
						array(),
						'app' ),
					array(
						'route' => 'noticias_index',
					)
				);

			$menu[ $keyEmpresa ]
				->addChild(
					$this->container->get( 'translator' )->trans( 'menu.empresa.publicaciones_recientes',
						array(),
						'app' ),
					array(
						'route' => 'publicaciones_index',
					)
				);

			$menu[ $keyEmpresa ]
				->addChild(
					$this->container->get( 'translator' )->trans( 'menu.empresa.noticias_internas',
						array(),
						'app' ),
					array(
						'route' => 'noticia_interna_index',
					)
				);

			$menu[ $keyEmpresa ]
				->addChild(
					$this->container->get( 'translator' )->trans( 'menu.empresa.suscripcion',
						array(),
						'app' ),
					array(
						'route' => 'plan_empresa_index',
					)
				);

			$menu[ $keyEmpresa ]
				->addChild(
					$this->container->get( 'translator' )->trans( 'menu.empresa.promo_calendario',
						array(),
						'app' ),
					array(
						'route' => 'promocion_calendario_index',
					)
				);

			$menu[ $keyEmpresa ]
				->addChild(
					$this->container->get( 'translator' )->trans( 'menu.empresa.comentarios',
						array(),
						'app' ),
					array(
						'route' => 'comentarios_index',
					)
				);

//			$menu[ $keyEmpresa ]
//				->addChild(
//					$this->container->get( 'translator' )->trans( 'menu.empresa.publicaciones',
//						array(),
//						'app' ),
//					array(
//						'route' => 'publicaciones_index',
//					)
//				);
//			$menu[ $keyEmpresa ]
//				->addChild(
//					$this->container->get( 'translator' )->trans( 'menu.empresa.noticias',
//						array(),
//						'app' ),
//					array(
//						'route' => 'noticias_index',
//					)
//				);
		}

		return $menu;
	}
}
