<?php 
 
namespace UtilBundle\Form\DataTransformer;
 
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
 /**
  * 
  * Tranforma una Entidad del modelo a un Integer (buscando su id)
  * 
  * @author juan.baracat <juatobaracat@gmail.com>
  * 
  */
class EntityToIntTransformer implements DataTransformerInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */
    private $om;
    private $entityClass;
    private $entityType;
    private $entityRepository;
 
    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }
 
    /**
     * @param mixed $entity
     *
     * @throws \Symfony\Component\Form\Exception\TransformationFailedException
     *
     * @return integer
     */
    public function transform($entity)
    {

        //TODO: analizar si capturar la excepcion o mandar un null
        //if (null === $entity || ($entity instanceof $this->entityClass) == false) {
        //    throw new TransformationFailedException($this->entityType." no esta definida");
        //}

        // Compruebo que sea una instancia de un objeto o que no sea nulo
        if (null === $entity || !$entity instanceof $this->entityClass) {
            return null;
        }
        return $entity->getId();
    }
 
    /**
     * @param mixed $id
     *
     * @throws \Symfony\Component\Form\Exception\TransformationFailedException
     *
     * @return mixed|object
     */
    public function reverseTransform($id)
    {
        if (!$id) {
            throw new TransformationFailedException("El id de ".$this->entityType." no esta definido");
        }
 
        $entity = $this->om->getRepository($this->entityRepository)->findOneBy(array("id" => $id));
 
        if (null === $entity) {
            throw new TransformationFailedException(sprintf(
                'A %s con el id "%s" no existe!',
                $this->entityType,
                $id
            ));
        }
 
        return $entity;
    }
 
    public function setEntityType($entityType)
    {
        $this->entityType = $entityType;
    }
 
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;
    }
 
    public function setEntityRepository($entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }
 
}