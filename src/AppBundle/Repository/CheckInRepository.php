<?php

namespace AppBundle\Repository;

/**
 * CheckInRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CheckInRepository extends \Doctrine\ORM\EntityRepository {

	public function findPublicacionesCheckIns( $persona ) {
		$qb = $this->createQueryBuilder( 'c' )
		;

		$qb->join( 'c.publicacion', 'p' );

		$qb->where( 'p.fechaInicio <= :fechaActualMax' )
		   ->andWhere( 'p.fechaFin >= :fechaActualMin' )
		   ->andWhere( 'p.publicado = true' )
		   ->andWhere( 'c.persona = :persona' );

		$fechaActual = new \DateTime( 'now' );

		$qb->setParameter( 'fechaActualMax', $fechaActual->format( 'Y-m-d' ) . " 23:59:59" );
		$qb->setParameter( 'fechaActualMin', $fechaActual->format( 'Y-m-d' ) . " 00:00:00" );
		$qb->setParameter( 'persona', $persona );

		return $qb->getQuery()->getResult();
	}

	public function findEmpresasCheckIns( $persona ) {
		$qb = $this->createQueryBuilder( 'c' )
		;

		$qb->join( 'c.empresa', 'e' );

		$qb
		   ->andWhere( 'c.persona = :persona' );

		$fechaActual = new \DateTime( 'now' );

		$qb->setParameter( 'persona', $persona );

		return $qb->getQuery()->getResult();
	}
}
