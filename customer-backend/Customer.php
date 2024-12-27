<?php
    abstract class Customer{
        private $customerType;
        private $customerId;
        private $firstName;
        private $lastName;
        private $openingBalance;
        private $memberDate;

        public function __construct($customerId, $firstName, $lastName, $openingBalance){
            $this->customerType = null;
            $this->customerId = $customerId;
            $this->firstName = $firstName;
            $this->lastName = $lastName;
            $this->openingBalance = $openingBalance;
            $this->memberDate = null;
        }

        public function getCustomerType(){
            return $this->customerType;
        }

        public function getCustomerId(){
            return $this->customerId;
        }

        public function getFirstName(){
            return $this->firstName;
        }

        public function getLastName(){
            return $this->lastName;
        }

        public function getFullName(){
            return $this->firstName . " " . $this->lastName;
        }

        public function getOpeningBalance(){
            return $this->openingBalance;
        }

        public function getMemberDate(){
            return $this->memberDate;
        }

        public function setMemberDate($memberDate){
            $this->memberDate = $memberDate;
        }

        public function setCustomerType($customerType){
            $this->customerType = $customerType;
        }

        abstract function longTimeMember();

        public function equals($otherCustomer){
            return $this->customerId == $otherCustomer->getCustomerId();
        }

        public function hashCode(){
            return $this->customerId;
        }
    }