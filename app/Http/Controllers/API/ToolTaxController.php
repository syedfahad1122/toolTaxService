<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Service\ToolTaxCalServiceInterface;

class ToolTaxController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function toolTaxExitSurcharge(Request $request,ToolTaxCalServiceInterface $toolTaxService)
    {
        $validator = Validator::make($request->post(),[
            'number_plate' => 'required|regex:/[A-Z]{1,3}-[0-9]{1,3}/',
            'interchange' => 'required|numeric|regex:/[0-4]{1}/',
           'request_date' => 'required|date_format:Y-m-d' 
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());       
        }
         return response()->json(["data" => $toolTaxService->calToolTax($request->post())], 200);
    }

    
}
