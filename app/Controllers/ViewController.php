<?php

require_once 'LoginController.php';
// require_once 'RegisterController.php';
require_once  $_SESSION['BASE_PATH'].'/app/Views/Login.php';
// require_once  $_SESSION['BASE_PATH'].'/app/Views/register.php';
require_once  $_SESSION['BASE_PATH'].'/app/Views/schedule.php';



class ViewController
{
    private $id;
    private $html;
    private $view;

    public function __construct() 
    {
        $this->chooseView();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $this->view == "login") $this->loginAttempt();
        echo $this->html;
    }

    private function chooseView(): void
    {
        if(!$this->loggedIn())
        {
            $login_view = new LoginView;
            $this->html = $login_view->html;
            $this->view = "login";
        }elseif($this->loggedIn())
        {
            $schedule_view = new ScheduleView;
            $this->html = $schedule_view->html;
            $this->view = "schedule";
        }
        return;
    }

    private function loggedIn (): bool
    {
        if(isset($_SESSION['id'])) {
            $this->id = $_SESSION['id'];
            return true;
        }
        return false;
    }

    private function loginAttempt(): void
    {
        $login = new LoginController;
        $login->login();
        return;
    }
}
