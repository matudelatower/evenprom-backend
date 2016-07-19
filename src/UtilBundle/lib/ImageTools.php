<?php

namespace UtilBundle\lib;

use Exception;

/**
 * Description of Tools
 *
 * @author santiago.semhan
 */
class ImageTools {

    /**
     * Funcion que redimensiona una imágen
     * @return Boolean True | False en caso de éxito o fallo
     */
    public static function redimensionar($file, $width, $height, $proportional = 1) {
        try {
            $obj = new ImageResizeClass($file);
            $obj->setNewSize($height, $width);
            $obj->setProportional($proportional);
            $obj->make();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Funcion que convierte cualquier imágen gif, png a jpg 
     */
    public static function convertirJPG($file) {
        $imagen = getimagesize($file); //obtenemos el tipo 
        $ext = image_type_to_extension($imagen[2], false); //aqui obtenemos la extencion de la imagen 
        $imagecreate = "imagecreatefrom" . $ext; //generamos el nombre de la funcion a la que hay que llamar 
        $nimagent = $imagecreate($file); //creamos la imagen con la funcion creada 
        imagejpeg($nimagent, $file);
    }

}