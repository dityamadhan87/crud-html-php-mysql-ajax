<?php
class FreeShippingPromo extends Promotion{
    public function __construct($promoCode, $startDate, $endDate, $percentDiscount, $maxDiscount, $minPurchase){
        parent::__construct($promoCode, $startDate, $endDate, $percentDiscount, $maxDiscount, $minPurchase);
        $this->setPromoType("Delivery");
    }
}