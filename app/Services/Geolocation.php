<?php

	namespace App\Services;

	class Geolocation
	{
        private $map;
        private $satellite;

        public function __construct(Map $map, Satellite $satellite)
        {
            $this->map = $map;
            $this->satellite = $satellite;
        }

        public function search(string $name): array
        {
            //--
            $locationInfo = $this->map->findAddress($name);
            return $this->satellite->pinpoint($locationInfo);
        }
    }
