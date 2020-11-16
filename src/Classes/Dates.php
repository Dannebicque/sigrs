<?php


namespace App\Classes;


use Carbon\Carbon;

class Dates
{
    public function genereProchainsJours(int $nbJours)
    {
        $i = 0;
        while ($i <= $nbJours) {
            $tab[$i] = Carbon::now()->addDays($i);
            $i++;
        }

        return $tab;
    }
}
