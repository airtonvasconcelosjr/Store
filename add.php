<?php
    session_start();
    require_once("servidor.php");
    if (isset($_POST['cancel-button'])) {
    }

    if(!empty($_SESSION['mensagem'])) {
        echo $_SESSION['mensagem'];
        unset($_SESSION['mensagem']);
        exit;
    }
    if (isset($_POST['list-button'])) {
        header("Location: add.php");
        exit;
    }

?>
<head>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body class="custom-background">
    <div class="container">
        <div class="a">
            <div class="">
                <form action="listar.php" class="form" id="product_form" method="get" accept-charset="utf-8">
                    <div class="button-container">
                        <button type="submit" name="enviar" class="list-button">Save</button>
                        <button type="button" onclick="window.location.href = '/index.php';" class="cancel-product-btn">Cancel</button>
                    </div>
                    <div class="title">Products List</div>
                    <hr>
                    <label class="mt-2 text-center">SKU</label>
                    <input 
                        type="text" 
                        name="sku"
                        id="sku"
                        required
                    >
                    <label>Name</label>
                    <input 
                        type="text" 
                        name="nomeproduto"
                        id="name"
                        required
                    >
                    <label>Price</label>
                    <input 
                        type="text" 
                        name="preco"
                        id="price"
                        required
                        pattern="[0-9,\.]+"
                        onblur="validatePrice()"
                        >
                        <div id="priceError" class="info-label"></div>
                    <label>Type </label>
                    <select name="tipo" class="opcoes" id="productType" onchange="showExtraFields(this.value)" required>
                        <option value="">Select</option>
                        <option value="DVD">DVD</option>
                        <option value="Furniture">Furniture</option>
                        <option value="Book">Book</option>
                    </select>

                    <div id="extraFields" style="display: none;">
                        <label id="extraLabel"></label>
                        <input 
                            type="text" 
                            name="extrafield" 
                            id="extraInput"
                        ><br>
                        <p class="info-label" id="extraInfo"></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

<div class="footer">
    <hr><h6>Scandiweb Test assignment &copy; <?php echo date("Y"); ?> 
</div>

<script>
    function showExtraFields(value) {
        const extraFieldsDiv = document.getElementById("extraFields");
        const extraLabel = document.getElementById("extraLabel");
        const extraInput = document.getElementById("extraInput");
        const extraInfo = document.getElementById("extraInfo");

        extraFieldsDiv.style.display = value !== "" ? "block" : "none";

        switch (value) {
            case "DVD":
                extraLabel.innerText = "Size";
                extraInput.setAttribute("id", "size");
                extraInput.setAttribute("type", "number");
                extraInfo.innerText = "Provide DVD capacity in MB";
                break;
            case "Furniture":
                extraLabel.innerText = "Medidas (HxWxL)";
                extraInput.setAttribute("type", "text");
                extraFieldsDiv.innerHTML = `
                    <label>Height</label>
                    <input type="text" class="forniture-label name="altura" id="height" value="" required pattern="[0-9,\.]+" onblur="validateHeight()">
                    <div id="heightError" class="info-label"></div>
                    <label>Width </label>
                    <input type="text" class="forniture-label"  name="largura" id="width" value="" required pattern="[0-9,\.]+" onblur="validateWidth()">
                    <div id="widthError" class="info-label"></div>
                    <label>Length</label>
                    <input type="text" class="forniture-label" name="comprimento" id="length" value="" required pattern="[0-9,\.]+" onblur="validateLength()">
                    <div id="lengthError" class="mb-2 info-label"></div>
                    <p class="info-label"> Provide measures in cm </p>`;
                break;
            case "Book":
                extraLabel.innerText = "Weight";
                extraInput.setAttribute("id", "weight");
                extraInput.setAttribute("type", "text");
                extraInfo.innerText = "Provide book weight in kg";
                break;
            default:
                extraFieldsDiv.innerHTML = "";
                break;
        }
    }

    function validatePrice() {
        const priceInput = document.getElementById("price");
        const priceError = document.getElementById("priceError");

        if (!priceInput.checkValidity()) {
            priceError.textContent = "Please enter a valid price";
        } else {
            priceError.textContent = "";
        }
    }

    function validateHeight() {
        const priceInput = document.getElementById("height");
        const priceError = document.getElementById("heightError");

        if (!priceInput.checkValidity()) {
            priceError.textContent = " Insert height only numbers, in cm";
        } else {
            priceError.textContent = "";
        }
    }

    function validateWidth() {
        const priceInput = document.getElementById("width");
        const priceError = document.getElementById("widthError");

        if (!priceInput.checkValidity()) {
            priceError.textContent = " Insert width only numbers, in cm";
        } else {
            priceError.textContent = "";
        }
    }

    function validateLength() {
        const priceInput = document.getElementById("length");
        const priceError = document.getElementById("lengthError");

        if (!priceInput.checkValidity()) {
            priceError.textContent = " Insert length only numbers, in cm";
        } else {
            priceError.textContent = "";
        }
    }
</script>
