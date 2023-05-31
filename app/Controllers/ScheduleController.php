<?php

namespace app\Controllers;

class ScheduleController
{
    public $day;
    public $month;
    public $year;

    // public function __construct()
    // {
    //     $this->day = date('d');
    //     $this->month = date('m');
    //     $this->year = date('Y');
    //     $this->_setDateCookie();
    // }

    public function show()
    {
        return view('schedule.php');
    }

	private function _setDateCookie()
	{
		setcookie('today', json_encode($this->day), time() + 3600);
		setcookie('month', json_encode($this->month), time() + 3600);
		setcookie('year', json_encode($this->year), time() + 3600);
	}

}
