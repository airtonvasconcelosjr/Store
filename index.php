<?php
    session_start();
    require_once("servidor.php");

    if (isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];
    }
    if (isset($_POST['delete-button'])) {
        $selectedProducts = isset($_POST['selected_products']) ? $_POST['selected_products'] : array();

        if (!empty($selectedProducts)) {
            $productIds = implode(',', $selectedProducts);
            $deleteQuery = "DELETE FROM produtos WHERE id IN ($productIds)";
            $deleteResult = mysqli_query($conn, $deleteQuery);

            if ($deleteResult) {
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
        header("Location: add.php");
        exit;
    }
    $comando = "SELECT * FROM produtos ORDER BY id";
    $enviar = mysqli_query($conn, $comando);
    $resultado = mysqli_fetch_all($enviar, MYSQLI_ASSOC);
?>

<head>
    <link rel="stylesheet" href="style.css"></link>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class="custom-background">
    
    <form action="" method="post">
        <div class="button-container">
            <button type="submit" name="add-button" class="add-button">Add</button>
        <button type="submit" id="delete-product-btn" name="delete-button" class="delete-product-btn">MASS DELETE</button>
    </div>
    <div class="title">
        <p>Lista de Produtos</p>
    </div>
    <hr>
    <div class="card-container">
        <?php if (empty($resultado)) { ?>
            <div class="no-items-message">
                Nenhum item cadastrado
            </div>
        <?php } else { ?>
            <?php foreach ($resultado as $produto) { ?>
                <div class="card">
            <div class="card-header bg-white custom-card-header">
                <input type="checkbox" class="delete-checkbox" name="selected_products[]" value="<?= $produto['id'] ?>">
            </div>
                <?php if ($produto['tipo'] === 'Forniture') { ?>
                    <div class="card-content mb-2 mt-2 d-flex flex-column justify-content-center align-items-center">
                        <span class="mb-1">SKU: <?= $produto['sku'] ?></span>
                        <p>Name: <?= $produto['nome'] ?></p>
                        <p>Price: $ <?= $produto['preco'] ?></p>
                        <p>Height: <?= $produto['altura'] ?> cm</p>
                        <p>Width: <?= $produto['largura'] ?> cm</p>
                        <p>Length: <?= $produto['comprimento'] ?> cm</p>
                    </div>
                <?php } elseif ($produto['tipo'] === 'Book') { ?>
                    <div class="card-content mb-2 mt-5 d-flex flex-column justify-content-center align-items-center">
                        <span class="mb-1">SKU: <?= $produto['sku'] ?></span>
                        <p>Name: <?= $produto['nome'] ?></p>
                        <p>Price: $ <?= $produto['preco'] ?></p>
                        <p>Weight: <?= $produto['extrafield'] ?> Kg</p>
                    </div>
                <?php } elseif (isset($produto['extrafield'])) { ?>
                    <div class="card-content mb-2 mt-5 d-flex flex-column justify-content-center align-items-center">
                        <span class="mb-1">SKU: <?= $produto['sku'] ?></span>
                        <p>Name: <?= $produto['nome'] ?></p>
                        <p>Price: $ <?= $produto['preco'] ?></p>
                        <p>Capacity: <?= $produto['extrafield'] ?> Mb</p>
                    </div>
                <?php } ?>
            </div>

            <?php } ?>
        <?php } ?>
    </div>
</form>


<div class="footer">
    <h6><hr>Scandiweb Test assignment &copy; <?php echo date("Y"); ?> 
</div>

</body>




