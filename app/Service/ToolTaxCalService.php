<?php

namespace App\Service;
class ToolTaxCalService implements ToolTaxCalServiceInterface
{
    /**
     * @param private currentDay String e.g Monday
     * @param private interchangeNo number e.g 1 ,2 ,3
     * @param private carNumber number
     * @param private date  date
     * @param private discPerc number
     * @param private numberPlate number
     * @param private surcharge boolean
     * @param private baseRate number
     * @param private discountApply string
     * @param private interchange number indexing 
     * @param private subTotal float
     * @param private Total float
     */
    public $currentDay ;
    private $interchangeNo ;
    private $carNumber ;
    private $date ;
    private $discPerc = 0 ;
    private $numberPlate ;
    private $surcharge = false;
    private $baseRate = 20;
    private $discountApply ;

    private $interchange = ["0","5","10","17","24","29","34"];
    private $subTotal;
    private $total;

    /**
     *  @param return baseCalculationPayload
    */

    public function calToolTax($data = [])
    {
        $this->currentDay =   date("l",strtotime($data['request_date']));
        $this->date = $data['request_date'];
        $this->carNumber = $data['number_plate'];
        $this->interchangeNo = $data['interchange'];
        $this->numberPlate = explode("-",$data['number_plate'])[1];
        $this->applyDiscount();
        $tootTaxExitPayload = [
            "baseRate" => $this->baseRate,
            "discount_breakDown" => $this->discountApply ?? "N/A",
            "SubTotal" => $this->subTotal,
            "Discount_Other" => $this->discPerc,
            "total_surcharge" => $this->total
        ];
          return $tootTaxExitPayload;
    }

    /**
     * @param $date calculate Discount on some Basis
     */

    public function applyDiscount()
    {
        if(in_array($this->currentDay,["Monday","Wednesday"]) && $this->numberPlate % 2 == 0){
            $this->discPerc += 10;
            $this->discountApply .= " 10 % On ".$this->currentDay;
        }

        if(in_array($this->currentDay,["Thursday","Tuesday"]) && $this->numberPlate % 2 != 0){
            $this->discPerc += 10;
            $this->discountApply .= " 10 % On ".$this->currentDay;
        }
        
        if (date("F",strtotime($this->date)) == "March" && date("F",strtotime($this->date)) == "23" ){
            $this->discPerc += 50;
            $this->discountApply .= " 10 % On ".date("F",strtotime($this->date))." " .date("F",strtotime($this->date));
        }

        if (date("F",strtotime($this->date)) == "August" && date("F",strtotime($this->date)) == "14" ){
            $this->discPerc += 50;
            $this->discountApply .= " 10 % On ".date("F",strtotime($this->date))." " .date("F",strtotime($this->date));
        }

        if (date("F",strtotime($this->date)) == "December" && date("F",strtotime($this->date)) == "25" ){
            $this->discPerc += 50;
            $this->discountApply .= " 10 % On ".date("F",strtotime($this->date))." " .date("F",strtotime($this->date));
        }
        $this->addSurcharge();
        $this->calSubTotal();
        $this->totalTax();
    }

    /**
     * @param Boolean return Type of surcharge added or not
     */

    public function addSurcharge()
    {
        if(in_array($this->currentDay,["Saturday","Sunday"])){
            $this->surcharge = true;
        }
    }

    /**
     * @param Type Float return SubTotal
     */

     public function calSubTotal()
     {
        $cal  = @($this->interchange[$this->interchangeNo] * 0.2 )  + @$this->baseRate;
        $this->subTotal =  $cal;
     }

     /**
      * @param Type Float return Total
      */
      
     public function totalTax()
     {
        $totalTax = @$this->subTotal * @($this->discPerc/100);
        $this->total = $this->surcharge ?  1.5*(@$this->subTotal - @$totalTax) : @$this->subTotal - @$totalTax;
     }
}