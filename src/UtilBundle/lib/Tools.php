<?php

namespace UtilBundle\lib;

/**
 * Description of Tools
 *
 * @author santiago.semhan
 */
class Tools {

    const SESSION_DOMINIO = 'BigDTools.dominio_interno_id';
    const SESSION_APLICATIVO = 'BigDTools.aplicativo_id';
    const DOMINIO_POSADAS = '1';
    const APLICATIVO_DEFAULT = '1';

    /**
     * Funcion que normaliza campos
     * @param String $field (campo a normalizar)
     * @return String (campo normalizado)
     */
    public static function normalizeField($field, $method = 'soundex') {
        return $method($field);
    }

    /**
     * Funcion que normaliza un array, manteniendo las keys
     * @param String $field (campo a normalizar)
     * @return String (campo normalizado)
     */
    public static function normalizeArray($arr) {
        foreach ($arr as $key => $value) {
            $tempArr[$key] = BigDTools::normalizeField($value);
        }
        return $tempArr;
    }

    public static function removeEmpty(&$array) {
        foreach ($array as $key => $dato) {
            if ($dato == '')
                unset($array[$key]);
        }
    }

    /**
     * @author santiago.semhan
     * 
     * @abstract Retorna un array de la forma clave=>valor, los valores son procesados por medio de 
     * la función trim() de php.
     * Sirve para arrays multidimensionales
     * 
     * @return array
     */
    public static function cleanArray($myArray) {

        $resultArray = array();
        foreach ($myArray as $key => $val) {
            if (is_array($val)) {
                $resultArray[$key] = self::cleanArray($val);
            } else {
                $resultArray[$key] = trim($val);
            }
        }
        return $resultArray;
    }

    public static function pagination_links($base_link, $page, $count, $results_per_page, $each_direction = 5) {

        $total_pages = $count ? ceil($count / $results_per_page) : 1;
        if ($total_pages < 2) {
            return null;
        }
        $page = ((is_numeric($page)) and ($page >= 1) and ($page <= $total_pages)) ? (int) $page : 1;
        $output = null;
        if ($page > 1) {
            $output .= '<li> <a class="page-link" href="' . $base_link . '/1"> &laquo;&nbsp;Primero </a></li>' . "\n";
            $output .= '<li> <a class="page-link" href="' . $base_link . '/' . ($page - 1) . '"> &lt;Anterior </a></li>' . "\n" . "\n";
        }
        for ($i = $page - $each_direction; $i <= $page + $each_direction; $i++) {
            if (($i > 0) and ($i <= $total_pages)) {
                $output .= isset($spacer) ? $spacer : null;
                $spacer = "\n";
                if ($page != $i) {
                    $output .= '<li> <a class="page-link" href="' . $base_link . '/' . $i . '">' . $i . '</a></li>' . "\n";
                } else {
                    $output .= '<li><span class="bold">' . $i . "</span></li>\n";
                }
            }
        }
        if ($page < $total_pages) {
            $output .= "\n" . '<li> <a class="page-link" href="' . $base_link . '/' . ($page + 1) . '">Siguiente ></a></li>' . "\n";
            $output .= "\n" . '<li> <a class="page-link" href="' . $base_link . '/' . $total_pages . '">Ultimo &nbsp;&raquo;</a></li>' . "\n";
        }
        return '<div class="pagination"> <ul>' . "\n" . $output . '</ul></div> ';
    }

    /**
     * Funcion que ordena un array por una columna determinada
     *
     * @param String $arr (array a ordenar)
     * @param String $col (nombre de columna a ordenar)
     * @param String $dir (orden ascendente o descendente)
     */
    public static function arraySortByColumn(&$arr, $col, $dir = SORT_ASC) {
        $sort_col = array();
        foreach ($arr as $key => $row) {
            $sort_col[$key] = $row[$col];
        }

        array_multisort($sort_col, $dir, $arr);
    }

    public static function in_multiarray($elem, $array, $field) {
        $top = sizeof($array) - 1;
        $bottom = 0;
        while ($bottom <= $top) {
            if ($array[$bottom][$field] == $elem)
                return true;
            else
            if (is_array($array[$bottom][$field]))
                if (in_multiarray($elem, ($array[$bottom][$field])))
                    return true;

            $bottom++;
        }
        return false;
    }

    public static function getSessionDominioId() {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        //return isset($_SESSION['_sf2_attributes']['sel_dominio.id']) ? $_SESSION['_sf2_attributes']['sel_dominio.id'] : null;
        return $session->get('sel_dominio.id');
    }

    public static function getSessionUsuarioId() {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();
        //return isset($_SESSION['_sf2_attributes']['usuario.id']) ? $_SESSION['_sf2_attributes']['usuario.id'] : null;
        return $session->get('usuario_log.id');
    }

    public static function getSessionAppIdByAppUrl($appUrl) {
        $session = new \Symfony\Component\HttpFoundation\Session\Session();

        $aplicativos = $session->get('aplicativos');

        if(!$aplicativos) 
            return null;

        foreach ($aplicativos as $aplicativo) {
            if ($aplicativo['prefijoUrl'] == $appUrl) {
                return $aplicativo['id'];
            }
        }
        return null;
        //return isset($_SESSION['_sf2_attributes']['aplicativo.id']) ? $_SESSION['_sf2_attributes']['aplicativo.id'] : null;
        //return $session->get('aplicativo.id');
    }

    public static function getSessionPersonaId() {
        return isset($_SESSION['_sf2_attributes']['persona.id']) ? $_SESSION['_sf2_attributes']['persona.id'] : null;
    }

}
