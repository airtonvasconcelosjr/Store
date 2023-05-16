<?php
    session_start();
    require_once("servidor.php");

    if(isset($_GET['enviar'])) {
        if(!empty($_GET['nomeproduto']) || !empty($_GET['preco']) || !empty($_GET['codigo'])) {
            $nome=$_GET['nomeproduto'];
            $preco=$_GET['preco'];
            $codigo=$_GET['codigo'];
            $extrafield=$_GET['extrafield'];

            $comando="INSERT INTO produtos(nome, preco, codigo, extrafield) VALUES ('$nome', '$preco', '$codigo', '$extrafield')";
            $enviar=mysqli_query($conn, $comando);

            if($enviar) {
                header("location:index.php");
                exit;
            }else{
                header("location:index.php");
                exit;
            }
            
        }
    }

?>