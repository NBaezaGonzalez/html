<?php
    require_once("Modelo/Prod_mod.php");
    //require_once '../MVC/Modelo/Prod_mod.php';
    $producto = new Productos_modelo();
    $matrizProductos = $producto->get_productos();

    require_once("Vista/Prod_vista.php");
    //require_once '../MVC/Vista/Prod_vista.php';
    

?>