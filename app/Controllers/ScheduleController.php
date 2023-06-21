<?php

namespace app\Controllers;

use app\Interfaces\ViewControllerInterface;

class ScheduleController implements ViewControllerInterface
{
    public $errors = [];
    public $day;
    public $month;
    public $year;


    public function show()
    {
        return view('schedule', ['errors' => $this->errors]);
    }

}
