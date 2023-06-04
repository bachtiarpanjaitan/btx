<?php

namespace Btx\Common;

use Exception;

/**
 * Map Calculation
 * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
 */
class Map {

    private static $_earthRadius = 6371000;
    /**
     * To determine the coordinates are within a predetermined radius in meter
     * @param Array $needle coordinate [lat, lng]
     * @param Array $haystack coordinates 
     * [radius: 0, lat: 0.0, lng: 0.0]
     * 
     */
    public static function onCoordinateRadius(array $needle, array $haystack) : bool{
        $result = false;
        try {
            $radius = (int) $haystack['radius'];
            $centerX = (double)$haystack['lat'];
            $centerY = (double) $haystack['lng'];
            $distance = (float) self::distanceInMeter((double) $needle[0],(double) $needle[1],$centerX,$centerY);
            if ($distance <= $radius) $result = true;
            return $result;
        }catch(Exception $e){
            throw $e;
        }
    }

    /**
     * Calculates the distance between two coordinate points in meters using the Haversine formula
     * @author bachtiarpanjaitan <bachtiarpanjaitan0@gmail.com>
     * @return double
     */
    private function distanceInMeter($lat1, $lon1, $lat2, $lon2) {
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = self::$_earthRadius * $c;
        return $distance;   
    }

}