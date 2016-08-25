<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Empresa;
use Doctrine\ORM\EntityRepository;

/**
 * NoticiaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NoticiaRepository extends EntityRepository {

	public function findAllByEmpresa( $empresa ) {
		$qb = $this->createQueryBuilder( 'p' );

		$qb->join( 'p.noticiaEmpresa', 'ne' );

		if ( is_integer( $empresa ) ) {
			$qb->join( 'ne.empresa', 'e' )
			   ->where( 'e.id = :empresa' )
			   ->setParameter( 'empresa', $empresa );
		} else if ( $empresa instanceof Empresa ) {
			$qb->where( 'ne.empresa = :empresa' )
			   ->setParameter( 'empresa', $empresa );
		}


		return $qb->getQuery()->getResult();

	}

}
