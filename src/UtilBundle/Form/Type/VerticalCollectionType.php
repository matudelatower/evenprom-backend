<?php

namespace UtilBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Exception\FormException;

/**
 * Description of R2CollectionType
 *
 * @author santiago.semhan
 */
class VerticalCollectionType extends AbstractType {
    

    public function getParent() {
        return BootstrapCollectionType::class;
    }

    public function getBlockPrefix() {
        return 'verticalcollection';
    }

}
