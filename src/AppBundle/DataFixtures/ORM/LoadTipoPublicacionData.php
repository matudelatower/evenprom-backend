<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 2/5/16
 * Time: 12:33 PM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\TipoPublicacion;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadTipoPublicacionData extends AbstractFixture implements OrderedFixtureInterface {
	public function load( ObjectManager $manager ) {

		$tipoPublicaciones = array(
			array(
				'nombre'             => "Evento",
				'descripcion'        => "Evento",
				"slug"               => 'evento',
				'activo'             => 1,
			),
			array(
				'nombre'             => "Descuento",
				'descripcion'        => "Descuento",
				"slug"               => 'descuento',
				'activo'             => 1,
			),
		);


		foreach ( $tipoPublicaciones as $tipoPublicacion ) {
			$entidadTipoPublicacion = new TipoPublicacion();
			$entidadTipoPublicacion->setNombre( $tipoPublicacion['nombre'] );
			$entidadTipoPublicacion->setDescripcion( $tipoPublicacion['descripcion'] );
			$entidadTipoPublicacion->setSlug( $tipoPublicacion['slug'] );
			
			$manager->persist( $entidadTipoPublicacion );
		}


		$manager->flush();
	}

	public function getOrder() {
		// the order in which fixtures will be loaded
		// the lower the number, the sooner that this fixture is loaded
		return 2;
	}

}