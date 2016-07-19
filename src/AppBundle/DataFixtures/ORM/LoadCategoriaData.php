<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 2/5/16
 * Time: 12:33 PM
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Categoria;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadCategoriaData extends AbstractFixture implements OrderedFixtureInterface {
	public function load( ObjectManager $manager ) {

		$categorias = array(
			array(
				'nombre'             => "Gastronomía",
				'descripcion'        => "Gastronomía",
				"slug"               => 'gastronomia',
				'activo'             => 1,
			),
			array(
				'nombre'             => "Recreación",
				'descripcion'        => "Recreación",
				"slug"               => 'recreacion',
				'activo'             => 1,
			),
			array(
				'nombre'             => "Compras",
				'descripcion'        => "Compras",
				"slug"               => 'compras',
				'activo'             => 1,
			),
			array(
				'nombre'             => "Hoteles",
				'descripcion'        => "Hoteles",
				"slug"               => 'hoteles',
				'activo'             => 1,
			),
			array(
				'nombre'             => "Agencias",
				'descripcion'        => "Agencias",
				"slug"               => 'agencias',
				'activo'             => 1,
			),
		);


		foreach ( $categorias as $categoria ) {
			$entidadCategoria = new Categoria();
			$entidadCategoria->setNombre( $categoria['nombre'] );
			$entidadCategoria->setDescripcion( $categoria['descripcion'] );
			$entidadCategoria->setSlug( $categoria['slug'] );

			$manager->persist( $entidadCategoria );
		}


		$manager->flush();
	}

	public function getOrder() {
		// the order in which fixtures will be loaded
		// the lower the number, the sooner that this fixture is loaded
		return 1;
	}

}