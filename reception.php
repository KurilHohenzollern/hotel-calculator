<?php

require_once 'CHotelModel.php';

$model = new CHotelModel();
if (!empty($_POST)) {
    $action = $_POST["action"];
    switch ($action) {
        case 'delete_interval':
        $model->deleteInterval($_POST['id']);
            break;
        case "addIntervals":    
        $model->addIntervals($_POST['begin'], $_POST['end']); 
            break;
        default:

            die("unknown action");
    }

header("Location:reception.php");

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
      <th scope="col">Начало</th>
      <th scope="col">Конец</th>
      <th scope="col">Операции</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    //перебираем список интервалов
        $intervals = $model->getIntervals();
        foreach ($intervals as $interval) : ?>
    <tr>
      <th scope="row"><?=$interval[0]?></th>
      <td><?=$interval[1]?></td>
      <td><?=$interval[2]?></td>
      <td> 
      <form method="POST" action="/reception.php">
          <input type="hidden" name="id" value="<?=$interval[0]?>"> 
          <input type="submit" value="удалить"> 
          <input type="hidden" name="action" value="delete_interval"> 
      </form> 
      </td>
    </tr>
    <?php 
        endforeach;
    ?>
  </tbody>
</table>
<form method="POST" action="/reception.php">
          <input type="data" name="begin" value="" max="2021-06-30" min="2021-05-01">
          <input type="data" name="end" value="" max="2021-06-30" min="2021-05-01"> 
          <input type="submit" name="button_add" value="добавить"> 
          <input type="hidden" name="action" value="addIntervals"> 
      </form>  
</div>
 </body>
</html>
