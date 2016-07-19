<?php

/* CONSTRAINT QUE COMPRUEBA QUE SE REPITA EL MISMO REGISTRO */

namespace UtilBundle\CustomValidators\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Form\Util\PropertyPath;

class UniqueInCollectionValidator extends ConstraintValidator {

    // Se mantiene un array con los valores previamente de la coleccion
    private $collectionValues = array();

    public function validate($value, Constraint $constraint) {
        // Aplica la ruta de la propiedad si es especificada
        if ($constraint->propertyPath) {
            $propertyPath = new PropertyPath($constraint->propertyPath);
            $value = $propertyPath->getValue($value);
        }

        // Chequea que el valor no esta en el array
        foreach ($this->collectionValues as $aValue) {
            if (spl_object_hash($value) == spl_object_hash($aValue) ) {
                $this->context->addViolation($constraint->message, array());
            }
        }
        //if(in_array($value, $this->collectionValues))
        //  $this->context->addViolation($constraint->message, array());
        // Agrega el valor en el array para los siguientes items de la validacion
        $this->collectionValues[] = $value;
    }

}
