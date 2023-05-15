<?php
    session_start();
    require_once("servidor.php");
    if(!empty($_SESSION['mensagem'])) {
        echo $_SESSION['mensagem'];
        unset($_SESSION['mensagem']);
    }

?>

<form action="listar.php" method="get" accept-charset="utf-8">
   nome <input type="text" name="nomeproduto">
   preco <input type="text" name="preco">
    codigo <input type="number" name="codigo">
    <input type="submit" name="enviar">

</form>

<a href="lista.php">Listagem</a>