<?php
/**
 * Noted : This Interface Defination To the Service Provider 
 * its Include The parameter Function To be Used in Calculating
 * The Orignal Surcharge to be added After Leaving NHS
 */
namespace App\Service;
interface ToolTaxCalServiceInterface
{
   # This function calculate the TotalTax to be return array
    public function calToolTax();

   # This function calculate the Discount to be return int
    public function applyDiscount();

   # This function calculate the Surcharge to be return Sat,Sun Boolean
    public function addSurcharge();

    # This function calculate the SubTotal to be return Type Float
    public function calSubTotal();

    # This function calculate the totalTax to be return Type Float
    public function totalTax();
}