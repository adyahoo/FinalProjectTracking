<?php
namespace App\Traits;

trait NumberFormatTrait
{
    function getAmount($input){ 
        $input       = number_format($input); 
        $input_count = substr_count($input, ','); 
        
        if($input_count != '0') { 
            if($input_count == '1') { 
                return substr($input, 0, -4).'k'; 
            } else if($input_count == '2') { 
                return substr($input, 0, -8).'M'; 
            } else if($input_count == '3') { 
                return substr($input, 0, -12).'B'; 
            } else { 
                return; 
            } 
        } else { 
            return $input; 
        } 
    }
}
