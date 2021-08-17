<?php


class CHotelModel
{
	//соединяемся с базой данных
	protected $host = "localhost";
	protected $dbname = "project_db";
	protected $username = "root";
	protected $password = "root";
	protected $conn;
	protected $error;


	 public function __construct() {
	 	$this->connection();
	 }

	 public function connection() {
	 	$this->conn = new \mysqli($this->host, $this->username, $this->password, $this->dbname);

	 	if(!$this->conn) {
	 		$this->error = "Connection failed";
	 	}
	 }

	 // устанавливаем сезонный период
	 public function addIntervals($begin, $end) {
	 	$this->conn->query("INSERT INTO `seasons`(`start`, `finish`) VALUES ('$begin', '$end')");
	 }

	 // получаем сезоны
	 public function getIntervals() {

	 	$data = [];
		if ($result = $this->conn-> query("SELECT `id`, `start`, `finish` FROM `seasons` WHERE 1")) {
  			while ($row = $result ->fetch_row()) {
    			$data[]=$row;
  			}
  				$result -> free_result();
			}
		return $data;
	 }

	 // удаляем сезон
	 public function deleteInterval($id) {
	 	$this->conn->query("DELETE FROM `seasons` WHERE id= $id");
	 }

	 // указываем цену, лимит посетителей в комнатах определённого класса
	 public function setRoomParams($class, $price, $limit) {
	 	$this->conn->query("UPDATE `rooms_types` SET `class_rooms` = '$class', `price`='$price',`limits_to_visitors`='$limit' WHERE `class_rooms` = '$class'");
	 }

	// получаем параметры комнат
	 public function getRoomParams() {
	 	$data = [];
		if ($result = $this->conn-> query("SELECT * FROM `rooms_types` WHERE 1")) {
  			while ($row = $result ->fetch_row()) {
    			$data[]=$row;
  			}
  				$result -> free_result();
			}
		return $data;
	 }

	 // получаем цену и лимит комнаты
	 public function getPrice($class) {
	 	$data = [];
		if ($result = $this->conn-> query("SELECT `price`, `limits_to_visitors` FROM `rooms_types` WHERE `class_rooms` = '$class'")) {
  			while ($row = $result ->fetch_row()) {
    			$data[]=$row;
  			}
  				$result -> free_result();
			}
		return $data;
	 }

	 //фильтруем интервалы
	 public function filterIntervals($begin, $end) {
	 	$data = []; 

		if ($result = $this->conn-> query("SELECT  DISTINCT start, finish FROM seasons WHERE ('$begin'>=`start` AND '$begin'<=`finish`) OR ('$end'>=`start` AND '$end'<=`finish`)")) {
  			while ($row = $result ->fetch_row()) {
    			$data[]=$row;
  			}
  				$result -> free_result();
			}
		return $data;
	 }
	
	//собираем дни в интервалах
	 public function getDates($startTime, $endTime) {
		$day = 86400;
    	$format = 'Y-m-d';
    	$startTime = strtotime($startTime);
    	$endTime = strtotime($endTime);
    //$numDays = round(($endTime - $startTime) / $day) + 1;
    	$numDays = round(($endTime - $startTime) / $day); // без +1
    	$days = array();
    	for ($i = 1; $i < $numDays; $i++) {
        $days[] = date($format, ($startTime + ($i * $day)));
    }
    	return $days;

	}   
	
}