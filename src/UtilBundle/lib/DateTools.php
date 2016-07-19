<?php

namespace UtilBundle\lib;

use DateTime;
use Symfony\Component\Serializer\Exception\Exception;

/**
 * Description of DateTools
 *
 * @author santiago.semhan
 */
class DateTools {

    static $dias = array(
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday',
//                        'lunes' => 'Lunes',
//                        'martes' => 'Martes',
//                        'miercoles' => 'Miércoles',
//                        'jueves' => 'Jueves',
//                        'viernes' => 'Viernes',
//                        'sabado' => 'Sábado',
//                        'domingo' => 'Domingo'
    );

    public static function getDiasSemana() {
        return self::$dias;
    }

    public static function getMinutosTranscurridos($hora_inicio, $hora_fin) {
        $time_inicio = strtotime($hora_inicio);
        $time_fin = strtotime($hora_fin);

        return $time_fin - $time_inicio;
    }

    /**
     * @author Geronimo Morales
     * @abstract Desplaza la fecha hasta que el dia coincida con el dia recibido como parametro.
     */
    public static function getSiguienteDia($fecha, $dia) {
        $dayOfWeek = date('l', strtotime($fecha));

        while ($dayOfWeek != $dia) {
            $fecha = self::sumarDias($fecha);
            $dayOfWeek = date('l', strtotime($fecha));
        }

        return $fecha;
    }

    public static function sumarDias($fecha, $dias = 1) {
        $fecha = date('Y-m-d', strtotime($fecha));

        list($año, $mes, $dia) = explode("-", $fecha);
        $nueva = mktime(0, 0, 0, $mes, $dia, $año) + $dias * 24 * 60 * 60;
        $nuevafecha = date("Y-m-d", $nueva);

        return $nuevafecha;
    }

    public static function sumarMinutos($hora, $minutos = 10) {
        $hora = date('H:i', strtotime($hora));

        list($h, $m) = explode(":", $hora);
        $nueva = mktime($h, $m + $minutos, 0); // + $minutos * 60;
        $nuevaHora = date("H:i", $nueva);

        return $nuevaHora;
    }

    public static function getDiferenciaHorarios($horario_inicio, $horario_fin) {
        if (!$horario_inicio || !$horario_fin)
            return null;

        list($hora_inicio, $minutos_inicio) = explode(":", $horario_inicio);
        list($hora_fin, $minutos_fin) = explode(":", $horario_fin);

        $inicio = ((($hora_inicio * 60) * 60) + ($minutos_inicio * 60));
        $fin = ((($hora_fin * 60) * 60) + ($minutos_fin * 60));

        $diferencia = $fin - $inicio;

        if ($diferencia <= 0) {
            return null;
        }

        $diferencia_h = floor($diferencia / 3600);
        $diferencia_m = floor(($diferencia - ($diferencia_h * 3600)) / 60);

        return date("H:i", mktime($diferencia_h, $diferencia_m, 0));
    }

    public static function ansi($date) {
        return date('Y-m-d', strtotime($date));
    }

    public static function toAnsiDate($value) {
        $date = self::toArray($value);
        return $date['Y'] . '-' . $date['m'] . '-' . $date['d'];
    }

    public static function toEsDate($value) {
        $date = self::toArray($value);
        return $date['d'] . '/' . $date['m'] . '/' . $date['Y'];
    }

    public static function toDateTimeFromFormat($format, $time) {
        return DateTime::createFromFormat($format, $time);
    }

    public static function toArray($value) {
        $value = substr($value, 0, 10);
        if (strpos($value, '/') !== false) {
            $parts = explode('/', $value);
            return array('d' => $parts[0], 'm' => $parts[1], 'Y' => $parts[2]);
        } elseif (strpos($value, '-') !== false) {
            $parts = explode('-', $value);
            return array('d' => $parts[2], 'm' => $parts[1], 'Y' => $parts[0]);
        } else {
            throw new Exception('Formato de fecha no válido.');
        }
    }

    public static function rangosSolapados($desde1, $hasta1, $desde2, $hasta2) {
        return $hasta1 >= $desde2 || $desde1 <= $hasta2;
    }

    public static function between($valor, $inicio, $fin, $strict = false) {
        if ($strict) {
            return $valor > $inicio && $valor < $fin;
        } else {
            return $valor >= $inicio && $valor <= $fin;
        }
    }

    public static function fechasSolapadas($desde1, $hasta1, $desde2, $hasta2) {
        $desde1 = date('Y-m-d', strtotime($desde1));
        $hasta1 = date('Y-m-d', strtotime($hasta1));
        $desde2 = date('Y-m-d', strtotime($desde2));
        $hasta2 = date('Y-m-d', strtotime($hasta2));

        $desdeBetween = self::between($desde1, $desde2, $hasta2) || self::between($desde2, $desde1, $hasta1);
        $hastaBetween = self::between($hasta1, $desde2, $hasta2) || self::between($hasta2, $desde1, $hasta1);

        return $desdeBetween || $hastaBetween;
    }

    public static function horasSolapadas($desde1, $hasta1, $desde2, $hasta2) {
        $desde1 = date('H:i:s', strtotime($desde1));
        $hasta1 = date('H:i:s', strtotime($hasta1));
        $desde2 = date('H:i:s', strtotime($desde2));
        $hasta2 = date('H:i:s', strtotime($hasta2));

        $desdeBetween = self::between($desde1, $desde2, $hasta2) || self::between($desde2, $desde1, $hasta1);
        $hastaBetween = self::between($hasta1, $desde2, $hasta2) || self::between($hasta2, $desde1, $hasta1);

        return $desdeBetween || $hastaBetween;
    }

    public static function getRangoDeConflicto($desde1, $hasta1, $desde2, $hasta2) {
        $d1 = self::between($desde1, $desde2, $hasta2);
        $d2 = self::between($desde2, $desde1, $hasta1);
        $h1 = self::between($hasta1, $desde2, $hasta2);
        $h2 = self::between($hasta2, $desde1, $hasta1);

        if ($d2 && !$h2)
            return array('desde' => $desde2, 'hasta' => $hasta1);
        if ($d1 && !$h1)
            return array('desde' => $desde1, 'hasta' => $hasta2);
        if ($d1 && $h1)
            return array('desde' => $desde1, 'hasta' => $hasta1);
        if ($d2 && $h2)
            return array('desde' => $desde2, 'hasta' => $hasta2);

        return null;
    }

    public static function getSemana($fecha) {
        $dayOfWeek = date('l', strtotime($fecha));
        if ($dayOfWeek == 'lunes') {
            return array('desde' => $fecha, 'hasta' => self::sumarDias($fecha, 6));
        }

        while ($dayOfWeek != 'lunes') {
            $fecha = self::sumarDias($fecha, -1);
            $dayOfWeek = date('l', strtotime($fecha));
        }

        return array('desde' => $fecha, 'hasta' => self::sumarDias($fecha, 6));
    }

    public static function getArrayDias($desde, $hasta) {
        $dias = array();
        while ($desde <= $hasta) {
            $dias[] = $desde;
            $desde = self::sumarDias($desde, 1);
        }
        return $dias;
    }

    public static function getArrayHoras($desde, $hasta, $minutos) {
        $horas = array();
        while ($desde <= $hasta) {
            $horas[] = $desde;
            $desde = self::sumarMinutos($desde, $minutos);
        }
        return $horas;
    }

    public static function getFechaFormatoLargo($fecha) {
        $nombreDia = self::getNombreDiaEspañol($fecha);
        $numeroDia = date('d', strtotime($fecha));
        $nombreMes = self::getNombreMes($fecha);
        $año = date('Y', strtotime($fecha));
        return $nombreDia . ", " . $numeroDia . " DE " . $nombreMes . " DEL " . $año;
    }

    public static function getNombreDiaEspañol($fecha) {
        $dia = date('l', strtotime($fecha));
        switch ($dia) {
            case 'lunes': return'LUNES';
            case 'martes': return'MARTES';
            case 'miercoles': return'MIERCOLES';
            case 'jueves': return'JUEVES';
            case 'viernes': return'VIERNES';
            case 'sabado': return'SABADO';
            case 'domingo': return'DOMINGO';
        }
    }

    public static function getNombreEspañol($dia) {
        switch ($dia) {
            case 'lunes': return'LUNES';
            case 'martes': return'MARTES';
            case 'miercoles': return'MIERCOLES';
            case 'jueves': return'JUEVES';
            case 'viernes': return'VIERNES';
            case 'sabado': return'SABADO';
            case 'domingo': return'DOMINGO';
        }
    }

    public static function getNombreDiaEspanolPorFecha($fecha) {
        $dia = date('l', strtotime($fecha));
        switch ($dia) {
            case 'Monday': return'lunes';
            case 'Tuesday': return'martes';
            case 'Wednesday': return'miercoles';
            case 'Thursday': return'jueves';
            case 'Friday': return'viernes';
            case 'Saturday': return'sabado';
            case 'Sunday': return'domingo';
        }
    }

    public static function getNombreMes($fecha) {
        $numero = date('m', strtotime($fecha));
        switch ($numero) {
            case 1: return 'ENERO';
            case 2: return 'FEBRERO';
            case 3: return 'MARZO';
            case 4: return 'ABRIL';
            case 5: return 'MAYO';
            case 6: return 'JUNIO';
            case 7: return 'JULIO';
            case 8: return 'AGOSTO';
            case 9: return 'SEPTIEMBRE';
            case 10: return 'OCTUBRE';
            case 11: return 'NOVIEMBRE';
            case 12: return 'DICIEMBRE';
            default: return '';
        }
    }

    public static function getFechaMinima() {
        return '1800-01-01';
    }

    public static function getFechaMaxima() {
        return self::sumarDias(date('d-m-Y'));
    }

}
