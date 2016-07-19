<?php

namespace UtilBundle\Twig\Extension;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Description of FileGetContentsExtension
 *
 * @author santiago.semhan
 */
class FileGetContentsExtension extends Twig_Extension {

    public function getFunctions() {
        return array(
            new Twig_SimpleFunction('file_get_contents', '@file_get_contents'),
        );
    }

    public function getName() {
        return 'file_get_contents';
    }

}

?>
