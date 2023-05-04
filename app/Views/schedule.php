<?php

if (!isset($_SESSION)) {
  session_start();
}

require_once $_SESSION['BASE_PATH'] . "/app/Controllers/ProfileController.php";
require_once $_SESSION['BASE_PATH'] . "/app/Controllers/ScheduleController.php";
require_once $_SESSION['BASE_PATH'] . "/app/Services/HtmlBuilder.php";

class ScheduleView extends HtmlBuilder
{
	public $html;

	public function __construct()
	{
		new ScheduleController;
		$this->_buildScheduleView();
	}

	private function _buildScheduleView(): void
	{
		$user = new ProfileController($_SESSION['id']);

		$this->buildHeader("Rhelper - Schedule", "../../app/Views/assets/css/schedule.css");
		$this->buildFooter();
		$this->html = $this->head;
		$this->html .= '
				<body>
				'.'Zostałeś zalogowany jako ' . $user->model->name . '
					<form method="POST" action="../../logout.php">
						<div>
							<button type="submit">Wyloguj</button>
						</div>
					</form>';
		$this->html .= '
					<div class="container text-center">
						<div class="row justify-content-md-center bg-dark mt-3">
						<div class="col col-lg-4 text-center bg-secondary">
							<button class="btn btn-dark"><i class="bi bi-arrow-left"></i></button>
						</div>
						<div id="actual_date" class="col-lg-4 text-light">
							Data dzisiejsza
						</div>
						<div class="col col-lg-4 bg-secondary">
							<button class="btn btn-dark"><i class="bi bi-arrow-right"></i></button>
						</div>
						<table class="table table-bordered table-lf text-light" style="table-layout: fixed;">
							<thead>
							<tr>
								<th scope="col">Poniedziałek</th>
								<th scope="col">Wtorek</th>
								<th scope="col">Środa</th>
								<th scope="col">Czwartek</th>
								<th scope="col">Piątek</th>
								<th scope="col">Sobota</th>
								<th scope="col">Niedziela</th>
							</tr>
							</thead>
							<tbody>
							<tr class="schedule-rows">
								<td class="actual_day" id="d01">1</td>
								<td id="d02">2</td>
								<td id="d03">3</td>
								<td id="d04">4</td>
								<td id="d05">5</td>
								<td id="d06">6</td>
								<td id="d07">7</td>
							</tr>
							<tr class="schedule-rows">
								<td id="d08">8</td>
								<td id="d09">9</td>
								<td id="d10">10</td>
								<td id="d11">11</td>
								<td id="d12">12</td>
								<td id="d13">13</td>
								<td id="d14">14</td>
							</tr>
							<tr class="schedule-rows">
								<td id="d15">15</td>
								<td id="d16">16</td>
								<td id="d17">17</td>
								<td id="d18">18</td>
								<td id="d19">19</td>
								<td id="d20">20</td>
								<td id="d21">21</td>
							</tr>
							<tr class="schedule-rows">
								<td id="d22">22</td>
								<td id="d23">23</td>
								<td id="d24">24</td>
								<td id="d25">25</td>
								<td id="d26">26</td>
								<td id="d27">27</td>
								<td id="d28">28</td>
							</tr>
							<tr class="schedule-rows">
								<td id="d29">29</td>
								<td id="d30">30</td>
								<td id="d31">31</td>
								<td id="d32">32</td>
								<td id="d33">33</td>
								<td id="d34">34</td>
								<td id="d35">35</td>
							</tr>
							</tbody>
						</table>
						</div>
					</div>
		';
		$this->html .= $this->footer;
		$this->html .= '
		<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
		<script src="../../app/Views/assets/js/schedule.js"></script>
		<script src="../../bootstrap/js/bootstrap.min.js"></script>
	  </body>
	  </html>
		';
		return;
	}
}
