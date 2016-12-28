<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * NoticiaEmpresaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NoticiaEmpresaRepository extends EntityRepository {

	public function findByNoticiasByEmpresa( $empresa ) {
		$qb = $this->createQueryBuilder( 'ne' );

		$qb->join( 'ne.empresa', 'emp' )
			->join('ne.noticia', 'n')
		   ->where( 'emp = :empresa' )
		   ->setParameter( 'empresa', $empresa )
		   ->andWhere( 'n.visibleDesde <= :fechaActual' )
		   ->andWhere( 'n.visibleHasta >= :fechaActual' );
		$fechaActual = new \DateTime( 'now' );
		$qb->setParameter( 'fechaActual', $fechaActual->format( 'Y-m-d' ) );

		$qb->orderBy( 'n.fechaCreacion', 'DESC' );
		$qb->setMaxResults( 3 );

		return $qb->getQuery()->getResult();

	}
}
