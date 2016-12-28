<?php

namespace AppBundle\Repository;

/**
 * PromocionCalendarioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PromocionCalendarioRepository extends \Doctrine\ORM\EntityRepository {

	public function findActuales() {
		$qb = $this->createQueryBuilder( 'pc' );

		$qb->where( 'pc.disponibleDesde <= :fechaActual' )
		   ->andWhere( 'pc.disponibleHasta >= :fechaActual' );
		$fechaActual = new \DateTime( 'now' );
		$qb->setParameter( 'fechaActual', $fechaActual->format( 'Y-m-d' ) );


		return $qb->getQuery()->getResult();

	}


	public function findPromosByEmpresa( $empresa ) {
		$qb = $this->createQueryBuilder( 'pc' );

		$qb->join( 'pc.empresa', 'emp' )
		   ->where( 'emp = :empresa' );


		$qb->andwhere( 'pc.disponibleDesde <= :fechaActual' )
		   ->andWhere( 'pc.disponibleHasta >= :fechaActual' );
		$fechaActual = new \DateTime( 'now' );

		$qb->setParameter( 'fechaActual', $fechaActual->format( 'Y-m-d' ) )
		   ->setParameter( 'empresa', $empresa );

		$qb->setMaxResults(10);


		return $qb->getQuery()->getResult();
	}

	public function findActualesAdquiridas() {
		$qb = $this->createQueryBuilder( 'pc' );

		$qb->where( 'pc.disponibleDesde <= :fechaActual' )
		   ->andWhere( 'pc.disponibleHasta >= :fechaActual' )
		->andWhere('pc.empresa is not null');

		$fechaActual = new \DateTime( 'now' );

		$qb->setParameter( 'fechaActual', $fechaActual->format( 'Y-m-d' ) );


		return $qb->getQuery()->getResult();

	}
}
