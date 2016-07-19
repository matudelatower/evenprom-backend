<?php
namespace UtilBundle\CustomValidators\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */

class UniqueInCollection extends Constraint
{


    public $message = 'Se ha producido un error (with %parameters%)';
    // The property path used to check wether objects are equal
    // If none is specified, it will check that objects are equal
    public $propertyPath = null;



    public function validatedBy()
    {
        return get_class($this).'Validator';
    }

    public function requiredOptions()
    {
        return array('entity', 'property');
    }

    public function targets()
    {
        return self::CLASS_CONSTRAINT;
    }

}