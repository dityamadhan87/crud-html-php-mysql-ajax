<?php
    class Member extends Customer{

        public function __construct($customerId, $firstName, $lastName, $memberDate, $openingBalance){
            parent::__construct($customerId, $firstName, $lastName, $openingBalance);
            $this->setCustomerType("Member");
            $this->setMemberDate($memberDate);
        }
        public function longTimeMember() {
            // Implement the method logic here
        }
    }