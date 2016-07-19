<?php

namespace UtilBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;


/**
 *
 * Transforma una entidad generica a un Integer (util para mostrar los m2one en un hidden)
 *
 * @author juan.cabral
 */
class ObjectToIdTransformer implements DataTransformerInterface {

    /**
     * @var ObjectManager
     */
    private $om;
    private $id;
    private $class;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om, $id, $class) {
        $this->om = $om;
        $this->id = $id;
        $this->class = $class;
    }

    /**
     * Transforms an object (usuario) to a string (id).
     *
     * @param  entity|null $entity
     * @return string
     */
    public function transform($entity) {

        if (null === $entity) {
            return $this->id;
        }

        return $entity->getId();
    }

    /**
     * Transforms a string (id) to an object (Entity).
     *
     * @param  string $id
     * @return Entity|null
     * @throws TransformationFailedException if object (entity) is not found.
     */
    public function reverseTransform($id) {

        if (!$id) {
            return null;
        }

        $entity = $this->om
                ->getRepository($this->class)
                ->find($id)
        ;

        if (null === $entity) {
            throw new TransformationFailedException(sprintf(
                            'No existe el objeto para el id "%s" especificado!', $id
            ));
        }

        return $entity;
    }

}