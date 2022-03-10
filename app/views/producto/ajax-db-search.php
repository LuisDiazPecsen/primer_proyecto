<?php

if (isset($_GET['term'])) {
   $con = new Conexion();
   $conn = $con->getConexion();

   $query = "SELECT descripcion FROM marca WHERE descripcion LIKE '{$_GET['term']}%' LIMIT 25";

   $query = $conn->prepare($query);
   $query->execute();
   $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

   $res = array();
   foreach ($resultado as $fila) {
      $res[] = $fila['descripcion'];
   }

   //return json res
   echo json_encode($res);
}
