<?php
abstract class Promotion
{
    private $promoType;
    private $promoCode;
    private $startDate;
    private $endDate;
    private $percentDiscount;
    private $maxDiscount;
    private $minPurchase;

    public function __construct($promoCode, $startDate, $endDate, $percentDiscount, $maxDiscount, $minPurchase)
    {
        $this->promoType = "-";
        $this->promoCode = $promoCode;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->percentDiscount = $percentDiscount;
        $this->maxDiscount = $maxDiscount;
        $this->minPurchase = $minPurchase;
    }
    public function getPromoType()
    {
        return $this->promoType;
    }
    public function getPromoCode()
    {
        return $this->promoCode;
    }
    public function getStartDate()
    {
        return $this->startDate;
    }
    public function getEndDate()
    {
        return $this->endDate;
    }
    public function getPercentDiscount()
    {
        return $this->percentDiscount;
    }
    public function getMaxDiscount()
    {
        return $this->maxDiscount;
    }
    public function getMinPurchase()
    {
        return $this->minPurchase;
    }
    public function setPromoType($promoType)
    {
        $this->promoType = $promoType;
    }
    public function equals($otherPromo)
    {
        return $this->promoCode == $otherPromo->getPromoCode();
    }
    public function hashCode()
    {
        return $this->promoCode;
    }
}