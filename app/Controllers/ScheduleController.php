<?php

namespace app\Controllers;

use app\Interfaces\ViewControllerInterface;
use app\Models\Event;
use app\Models\Supply;

class ScheduleController implements ViewControllerInterface
{
    public $errors = [];
    public $day;
    public $month;
    public $year;


    public function show()
    {
        $schedule = $this->prepareTable();
        $supply = $this->prepareSupplyTable();
        return view('schedule', [
            'errors' => $this->errors,
            'supply' => $supply,
            'schedule' => $schedule
        ]);
    }

    public function prepareTable() : string
    {
        $week = $this->getMondayAndSunday();
        $threads = [
            'Start',
            'End',
            'Name',
            'Content'
        ];
        $event = new Event;
        $html = "";
        foreach ($week as $day) {
            $rows = $event->getDailyGroupEvents([
                ':group_id' => $_SESSION['user_group_id'],
                ':day' => $day
            ]);
            if(!empty($rows)) {
                $html .= "
                <br><h1>" . $this->getDayName($day) . "</h1><br>
                <table class='table'>
                    <tr>
                ";
                foreach ($threads as $column) {
                    $html .= "<th scope='col' style='text-align:center;'>$column</th>
                    ";
                }
                $html .= "
                </tr>
                ";
                foreach ($rows as $row) {
                    $html .= "<tr>";
                    foreach ($row as $column) {
                        $html .= "
                        <td style='text-align: center;vertical-align: middle;'>$column</td>
                        ";
                    }
                    $html .= "</tr>";
                }
                $html .= "
                </tr>
                ";
            }
            $html .= "
            </table>";
        }
        return $html;
    }

    public function getMondayAndSunday() : array
    {
        $date = new \DateTime(Date("Y-m-d"));
        $date->setISODate($date->format('Y'), $date->format('W'));
      
        $monday = $date->format('Y-m-d');
        $tuesday = $date->modify('+1 days')->format('Y-m-d');
        $wednesday = $date->modify('+1 days')->format('Y-m-d');
        $thursday = $date->modify('+1 days')->format('Y-m-d');
        $friday = $date->modify('+1 days')->format('Y-m-d');
        $saturday = $date->modify('+1 days')->format('Y-m-d');
        $sunday = $date->modify('+1 days')->format('Y-m-d');
      
        return [$monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday];
    }

    public function getDayName($date) {
        $dayOfWeek = date('N', strtotime($date));
        
        $days = [
          1 => 'Monday',
          2 => 'Tuesday',
          3 => 'Wednesday',
          4 => 'Thursday',
          5 => 'Friday',
          6 => 'Saturday',
          7 => 'Sunday'
        ];
        
        return $days[$dayOfWeek];
      }

      public function prepareSupplyTable() : string
      {
          $threads = [
              'Quantity',
              'Item',
              'Expected end'
          ];
          $supply = new Supply;
          $rows = $supply->getSuppliesByGroupID([':group_id' => $_SESSION['user_group_id']]);
          $html = "
          <table class='table' style='text-align:center;>
              <tr scope='col' style='text-align:center;'>
          ";
          foreach ($threads as $column) {
              $html .= "<th>$column</th>
              ";
          }
          $html .= "</tr>
              ";
          foreach ($rows as $row) {
              $html .= "
              <tr>
                  <td>" . $row['quantity'] . "/" . $row['quantity_max'] . "</td>
                  <td>" . $row['name'] . "</td>
                  <td>" . $row['expected_end'] . "</td>
              </tr>
              ";
          }
          $html .= "
          </table>";
          return $html;
      }
}
