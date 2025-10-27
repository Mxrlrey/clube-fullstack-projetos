<?php

function connect() {
    try {
        $pdo = new PDO(
            "mysql:host=mysql_db;dbname=clube-fullstack;charset=utf8mb4",
            "root",
            "root"
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro ao conectar: " . $e->getMessage());
    }
}

function create($table, $fields){

   if (!is_array($fields)) {
       $fields = (array) $fields;
   }

   $sql = "insert into {$table}";
   $sql .= "(" . implode(',', array_keys($fields)) . ")";
   $sql .= " values(" . ":". implode(',:', array_keys($fields)) . ")";

   $pdo = connect();

   $insert = $pdo->prepare($sql);

   return $insert->execute($fields);

}