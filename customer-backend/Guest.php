<?php
    class Guest extends Customer{

        public function __construct($customerId, $firstName, $lastName, $openingBalance){
            parent::__construct($customerId, $firstName, $lastName, $openingBalance);
            $this->setCustomerType("Guest");
            $this->setMemberDate(null);
        }
        public function longTimeMember() {
            // Implement the method logic here
        }
    }