<?php
session_start();
require_once("servidor.php");

if (isset($_GET['enviar'])) {
    if (!empty($_GET['nomeproduto']) || !empty($_GET['preco']) || !empty($_GET['sku'])) {
        $nome = $_GET['nomeproduto'];
        $preco = $_GET['preco'];
        $sku = $_GET['sku'];
        $extrafield = $_GET['extrafield'];

        if (isset($_GET['tipo'])) {
            $tipo = $_GET['tipo'];

            if ($tipo === "Forniture") {
                if (!empty($_GET['altura'])) {
                    $altura = $_GET['altura'];
                } else {
                    $altura = "";
                }

                if (!empty($_GET['largura'])) {
                    $largura = $_GET['largura'];
                } else {
                    $largura = "";
                }

                if (!empty($_GET['comprimento'])) {
                    $comprimento = $_GET['comprimento'];
                } else {
                    $comprimento = "";
                }
            } else {
                $altura = "";
                $largura = "";
                $comprimento = "";
            }

            // Verificar se o SKU já existe no banco de dados
            $verificarSku = mysqli_query($conn, "SELECT sku FROM produtos WHERE sku = '$sku'");
            if (mysqli_num_rows($verificarSku) > 0) {
                echo '<script>alert("O SKU informado já existe no banco de dados. Por favor, escolha outro SKU."); window.history.back();</script>';
            } else {
                $comando = "INSERT INTO produtos (nome, preco, sku, tipo, extrafield, altura, largura, comprimento) VALUES ('$nome', '$preco', '$sku', '$tipo', '$extrafield', '$altura', '$largura', '$comprimento')";
                $enviar = mysqli_query($conn, $comando);

                if ($enviar) {
                    header("location:index.php");
                    exit;
                } else {
                    header("location:index.php");
                    exit;
                }
            }
        }
    }
}
?>
