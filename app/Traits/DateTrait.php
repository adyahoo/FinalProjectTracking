<?php
namespace App\Traits;

use DateTime;

trait DateTrait
{
    public function findInterval($firstDateStr, $secondDateStr) {
        $firstDate  = new DateTime($firstDateStr->format('d-m-Y'));
        $secondDate = new DateTime($secondDateStr->format('d-m-Y'));
        $interval   = $firstDate->diff($secondDate);

        return $interval;
    }
}
