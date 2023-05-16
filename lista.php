<?php
    session_start();
    require_once("servidor.php");
    if (isset($_POST['delete-button'])) {
        $selectedProducts = isset($_POST['selected_products']) ? $_POST['selected_products'] : array();

        if (!empty($selectedProducts)) {
            $productIds = implode(',', $selectedProducts);
            $deleteQuery = "DELETE FROM produtos WHERE id IN ($productIds)";
            $deleteResult = mysqli_query($conn, $deleteQuery);

            if ($deleteResult) {
                $_SESSION['mensagem'] = "Produtos excluídos com sucesso";
                echo '<script>alert("Produtos excluídos com sucesso"); window.location.href = "'.$_SERVER['PHP_SELF'].'";</script>';
                exit;
            } else {
                $_SESSION['mensagem'] = "Erro ao excluir produtos";
                echo '<script>alert("Erro na exclusão...");</script>';
                exit;
            }
        }
    }

    if (isset($_POST['add-button'])) {
        header("Location: index.php");
        exit;
    }
    $comando = "SELECT * FROM produtos ORDER BY id DESC";
    $enviar = mysqli_query($conn, $comando);
    $resultado = mysqli_fetch_all($enviar, MYSQLI_ASSOC);
?>

<head>
    <link rel="stylesheet" href="style.css">
</head>



<form action="" method="post">
    <div class="button-container">
        <button type="submit" name="add-button" class="add-button">Add</button>
        <button type="submit" id="delete-product-btn" name="delete-button" class="delete-product-btn">MASS DELETE</button>
    </div>
    <div class="title">Lista de Produtos</div>
    <hr>
    <div class="card-container">
        <?php if (empty($resultado)) { ?>
            <div class="no-items-message">
                Nenhum item cadastrado
            </div>
        <?php } else { ?>
            <?php foreach ($resultado as $produto) { ?>
                <div class="card">
                    <div class="card-header">
                        <input type="checkbox" class="delete-checkbox" name="selected_products[]" value="<?= $produto['id'] ?>">
                    </div>
                    <div class="card-content">
                        <span>Código: <?= $produto['codigo'] ?></span>
                        <p>Nome: <?= $produto['nome'] ?></p>
                        <p>Preço: $ <?= $produto['preco'] ?></p>
                        <p><?= $produto['disponibilidade'] == "1" ? "Disponível" : "Indisponível" ?></p>
                        <?php if (isset($produto['extrafield'])) { ?>
                            <p><?= $produto['extrafield'] ?></p>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</form>
<hr>

<div class="footer">
    <hr><h1>Scandiweb Test assignment &copy; <?php echo date("Y"); ?> 
</div>




