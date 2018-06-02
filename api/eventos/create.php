<?php 
  /*
  http://localhost/php_rest_myblog/api/eventos/create.php
  Headers: 
  Key: Content-Type
  Value: application/json
  Body: *raw*

  {
	"Titulo" : "eventoC",
	"Descricao" : "corpo",
	"Data" : "2018-08-30",
	"Local" : ""
  }

  */

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: eventos');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Eventos.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $post = new Eventos($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $post->Titulo = $data->Titulo;
  $post->Descricao = $data->Descricao;
  $post->Data = $data->Data;
  $post->Local = $data->Local;

  // Create post
  if($post->create()) {
    echo json_encode(
      array('message' => 'Evento criado')
    );
  } else {
    echo json_encode(
      array('message' => 'Falha ao criar evento')
    );
  }

