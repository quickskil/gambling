<?php
namespace App\Models;
class Contact{
    public function __construct() {

        $this->office_latitude = 53.3340285;
        $this->office_longitude = -6.2535495;


    }


    /**
     * Calculates the great-circle distance between two points, with
     * the Haversine formula.
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @return float Distance between points in [KM] (same as earthRadius)
     */

    public function haversineGreatCircleDistance($latitudeTo, $longitudeTo )
    {
        $earthRadius = 6371000;
        $contact = new Contact();

        // convert from degrees to radians
        $latFrom = deg2rad($contact->office_latitude);
        $lonFrom = deg2rad($contact->office_longitude);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return ($angle * $earthRadius)/ 1000;
    }

    /**
     * Returns a list of contacts filter by distance to the office
     * the Haversine formula.
     * @param integer $distance distance in km from the client to the office Default = 40000 ( max possible distance in km between 2 points on earth)
     * @return array List of contacts filtered by distance param
     */

    public function getContactsByOfficeDistance($distance=40000){

        $path = storage_path() . "/json/affiliates.txt";
        $affiliates = json_decode(file_get_contents($path),true);
        $contacts =[];

        foreach($affiliates  as $contact){

            // calculate distance
            $distanceFromOffice=Contact::haversineGreatCircleDistance( $contact['latitude'], $contact['longitude'] );

            if($distanceFromOffice<= $distance){

                $contact['distance_km'] = $distanceFromOffice;
                $contacts[]=$contact;
            }

        }

        return $contacts;

    }
}