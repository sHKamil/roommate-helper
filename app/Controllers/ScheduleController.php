<?php


class ScheduleController
{
    public $day;
    public $month;
    public $year;

    public function __construct()
    {
        $this->day = date('d');
        $this->month = date('m');
        $this->year = date('Y');
    }



}
