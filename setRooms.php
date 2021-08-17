<?php

require_once 'CHotelModel.php';

$model = new CHotelModel();
if (!empty($_POST)) {
    $action = $_POST["action"];
    switch ($action) {
        case 'delete_interval':
        $model->deleteInterval($_POST['id']);
            break;
        case 'addIntrevals':
        $model->addIntervals($_POST['begin'], $_POST['end']);
            break;
        case'setRoomParams':
        $model->setRoomParams($_POST['class'], $_POST['price'], $_POST['limit']);
            break;    
        default:
            die("unknown action");
    }
}
 
?>



<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <title>HTML5</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

 </head>
 <body>
    <div class="container">
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Класс</th>
      <th scope="col">Цена</th>
      <th scope="col">Лимит</th>
    </tr>
  </thead>
  <tbody>
    <?php
    //перебираем параметры комнат
        $parameters = $model->getRoomParams();
        foreach ($parameters as $parameter) : ?>
    <tr>
      <th scope="row"><?=$parameter[0]?></th>
      <td><?=$parameter[1]?></td>
      <td><?=$parameter[2]?> ₽</td>
      <td><?=$parameter[3]?></td> 
    </tr>
    <?php 
        endforeach;
    ?>
  </tbody>
  <body>
    <div class="container">
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <td></td>
    </tr>
  </thead>  
</table>
<tr>
  <th scope="row">
<h3>Установить цену</h3>
    <form method="POST" action="setRooms.php">
        <div>
           <tr> <label for="class">Выберите класс:</label>
            <select name="class">
            <option disabled>Выберите класс</option>
            <option name="class" selected value="luxe">Люкс</option>
            <option name="class" value="standart">Стандарт</option>
            <option name="class" value="economy">Эконом</option>
            </select> </tr>
        </div>
        <div>
            <label for="price">Стоимость:</label>
            <input type="text" size="4" name="price" value="">
        </div>
        <div>
            <label for="limit">Укажите количество человек:</label>
            <input type="number" size="1" name="limit" min="1" max="10" value="1">
        </div>
        <input type="submit" value="Назначть"> 
        <input type="hidden" name="action" value="setRoomParams"> 
    </form>
</th>
</tr>

 </body>
</html> 