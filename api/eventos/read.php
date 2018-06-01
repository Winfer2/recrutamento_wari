<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/eventos.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog Eventos object
  $eventos = new Eventos($db);

  // Blog Eventos query
  $result = $eventos->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any Eventos
  if($num > 0) {
    // Eventos array
    $eventos_arr = array();
    $eventos_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $eventos_item = array(
        'ID' => $ID,
        'Titulo' => $Titulo,
        'Descricao' => html_entity_decode($Descricao),
        'Data' => html_entity_decode($Data),
        'Local' => html_entity_decode($Local),
        
      );
      //'Imagem' => html_entity_decode($Imagem)
      // Push to "data"
      array_push($eventos_arr['data'], $eventos_item);
    }

    // Turn to JSON & output
    echo json_encode($eventos_arr);

  } else {
    // No Eventos
    echo json_encode(
      array('message' => 'No Eventos Found')
    );
  }
