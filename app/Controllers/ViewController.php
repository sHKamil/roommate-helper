<?php

require_once 'LoginController.php';
// require_once 'RegisterController.php';
require_once  $_SESSION['BASE_PATH'].'/app/Views/Login.php';
// require_once  $_SESSION['BASE_PATH'].'/app/Views/register.php';
require_once  $_SESSION['BASE_PATH'].'/app/Views/Schedule.php';



class ViewController
{
    private $id;
    private $html;
    private $view;

    public function __construct() 
    {
        $this->_chooseView();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $this->view == "login") $this->_loginAttempt();
        echo $this->html;
    }

    private function _chooseView(): void
    {
        if(!$this->_loggedIn())
        {
            $login_view = new LoginView;
            $this->html = $login_view->html;
            $this->view = "login";
        }elseif($this->_loggedIn())
        {
            $schedule_view = new ScheduleView;
            $this->html = $schedule_view->html;
            $this->view = "schedule";
        }
        return;
    }

    private function _loggedIn (): bool
    {
        if(isset($_SESSION['id'])) {
            $this->id = $_SESSION['id'];
            return true;
        }
        return false;
    }

    private function _loginAttempt(): void
    {
        $login = new LoginController;
        $login->login();
        return;
    }
}
