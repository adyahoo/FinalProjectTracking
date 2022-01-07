<?php
namespace App\Traits;

use DateTime;

trait DateTrait
{
    public function findInterval($firstDateStr, $secondDateStr) {
        $firstDate  = new DateTime($firstDateStr);
        $secondDate = new DateTime($secondDateStr);
        $interval   = $firstDate->diff($secondDate);

        return $interval;
    }
}
