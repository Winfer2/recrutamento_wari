<?php 
  class Eventos {
    // DB stuff
    private $conn;
    private $table = 'eventos';

    // Eventos Properties
    public $ID;
    public $Titulo;
    public $Descricao;
    public $Data;
    public $Local;
    public $Imagem;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Eventos
    public function read() {
      // Create query
      $query = 'SELECT 
            p.ID,
            p.Titulo,
            p.Descricao,
            p.Data,
            p.Local
          FROM
            ' . $this->table . ' p
          ORDER BY
            p.ID DESC';
      //            p.Imagem
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Eventos
    public function read_title() {
       // Create query
       $query = 'SELECT 
            p.ID,
            p.Titulo,
            p.Descricao,
            p.Data,
            p.Local
      FROM
        ' . $this->table . ' p
      WHERE
        p.Titulo = ?';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind Titulo
      $stmt->bindParam(1, $this->Titulo);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    public function read_data() {
      // Create query
      $query = 'SELECT 
           p.ID,
           p.Titulo,
           p.Descricao,
           p.Data,
           p.Local
     FROM
       ' . $this->table . ' p
     WHERE
       p.Data = ?';

     // Prepare statement
     $stmt = $this->conn->prepare($query);

     // Bind Data
     $stmt->bindParam(1, $this->Data);

     // Execute query
     $stmt->execute();

     return $stmt;
   }
 }