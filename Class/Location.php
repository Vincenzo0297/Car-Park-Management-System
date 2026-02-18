<?php
    class Location {
        public $LocationName;
        public $LocationDescription;
        public $Capacity;
        public $ParkingSpaces;
        public $CostPerHr;
        public $LateCostPerHr;
        public function __construct($LocationName, $LocationDescription, $Capacity, $ParkingSpaces, $CostPerHr, $LateCostPerHr) {
            $this->LocationName = $LocationName;
            $this->LocationDescription = $LocationDescription;
            $this->Capacity = $Capacity;
            $this->ParkingSpaces = $ParkingSpaces;
            $this->CostPerHr = $CostPerHr;
            $this->LateCostPerHr = $LateCostPerHr;
        }

        public function getLocationName() {
            return $this->LocationName;
        }

        public function getLocationDescription() {
            return $this->LocationDescription;
        }

        public function getCapacity() {
            return $this->Capacity;
        }

        public function getParkingSpaces() {
            return $this->ParkingSpaces;
        }

        public function getCostPerHr() {
            return $this->CostPerHr;
        }

        public function getLateCostPerHr() {
            return $this->LateCostPerHr;
        }

        public function setLocationName($LocationName) {
            $this->LocationName = $LocationName;
        }

        public function setLocationDescription($LocationDescription) {
            $this->LocationDescription = $LocationDescription;
        }

        public function setCapacity($Capacity) {
            $this->Capacity = $Capacity;
        }

        public function setParkingSpaces($ParkingSpaces) {
            $this->ParkingSpaces = $ParkingSpaces;
        }

        public function setCostPerHr($CostPerHr) {
            $this->CostPerHr = $CostPerHr;
        }

        public function setLateCostPerHr($LateCostPerHr) {
            $this->LateCostPerHr = $LateCostPerHr;
        }
    }

?>