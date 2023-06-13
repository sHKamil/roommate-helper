<?php

namespace app\Controllers;

use app\Interfaces\ViewControllerInterface;

class ScheduleController implements ViewControllerInterface
{
    public $errors = [];
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
        return view('schedule', ['errors' => $this->errors]);
    }

	private function _setDateCookie()
	{
		setcookie('today', json_encode($this->day), time() + 3600);
		setcookie('month', json_encode($this->month), time() + 3600);
		setcookie('year', json_encode($this->year), time() + 3600);
	}

}
