<?php
    Class Menu{
        private $menuId;
        private $menuName;
        private $menuPrice;

        public function __construct($menuId, $menuName, $menuPrice){
            $this->menuId = $menuId;
            $this->menuName = $menuName;
            $this->menuPrice = $menuPrice;
        }

        public function getMenuId(){
            return $this->menuId;
        }

        public function getMenuName(){
            return $this->menuName;
        }

        public function getMenuPrice(){
            return $this->menuPrice;
        }

        public function equals($otherMenu){
            return $this->menuId == $otherMenu->getMenuId();
        }

        public function hashCode(){
            return $this->menuId;
        }
    }