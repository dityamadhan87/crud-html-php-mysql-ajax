<?php
class PercentOffPromo extends Promotion{
    public function __construct($promoCode, $startDate, $endDate, $percentDiscount, $maxDiscount, $minPurchase){
        parent::__construct($promoCode, $startDate, $endDate, $percentDiscount, $maxDiscount, $minPurchase);
        $this->setPromoType("Discount");
    }
}