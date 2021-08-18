<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <title>HTML5</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<?php

require_once 'CHotelModel.php';

$model = new CHotelModel();

if(!empty($_POST)) {
	$action = $_POST["action"];
	switch ($action) {
		case 'getDates':
		$model->getDates($_POST['startTime'], $_POST['endTime']);
			break;
		
		default:
			// code...
			break;
	}
}
?>
	 
<form method="POST" action="interface.php">
<label for="limit">Въезд:</label>
<input type="data" name="startTime" value="">
<label for="limit">Отъезд:</label>
<input type="data" name="endTime" value=""> 
<input type="hidden" name="action" value="getDates"> 

<form method="POST" action="interface.php">
<select name="class">
<option disabled>Выберите класс</option>
<option name="class" selected value="luxe">Люкс</option>
<option name="class" value="standart">Стандарт</option>
<option name="class" value="economy">Эконом</option>
</select>

<label for="limit">Мест:</label>
<input type="number" size="1" name="limit" min="1" max="10" value="1">
<input type="submit" value="Указать"> 
<input type="hidden" name="action" value=""> 
