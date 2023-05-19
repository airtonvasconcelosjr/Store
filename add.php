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
    
    <form action="listar.php" class="form" id="product_form" method="get" accept-charset="utf-8">
        <div class="button-container">
        <button type="submit" name="enviar" class="list-button">Save</button>
        <button type="button" onclick="window.location.href = '/Store/index.php';" class="list-button">Cancel</button>
    </div>
    <div class="title">Lista de Produtos</div>
    <hr>
   <label class="mt-4">SKU:</label>
        <input 
            type="number" 
            name="sku"
            required=True
            >
   <label>Name:</label>
   <input 
            type="text" 
            name="nomeproduto"
            required=True
            >
            <label>Preço:</label>
            <input 
            type="text" 
            name="preco"
            required=True
            >
   <label>Tipo: </label>
        <select name="tipo" class="opcoes" onchange="showExtraFields(this.value)" required="true">
           <option value="">Selecione</option>
           <option value="DVD">DVD</option>
           <option value="Forniture">Forniture</option>
           <option value="Book">Book</option>
         </select>
  
   
   <div id="extraFields" style="display: none;">
       <label id="extraLabel"></label>
        <input 
            type="text" 
            name="extrafield" 
            id="extraInput"
            required=True
            ><br>
            <p class="info-label" id="extraInfo"></p>
        </div>
    </form>
    
    <div class="footer">
        <hr><h6>Scandiweb Test assignment &copy; <?php echo date("Y"); ?> 
    </div>

</body>
    <script>
    

</script>
<script>

    function showExtraFields(value) {
        const extraFieldsDiv = document.getElementById("extraFields");
        const extraLabel = document.getElementById("extraLabel");
        const extraInput = document.getElementById("extraInput");

        extraFieldsDiv.style.display = value !== "" ? "block" : "none";

        switch (value) {
        case "DVD":
            extraLabel.innerText = "Size (MB):";
            extraInput.type = "number";
            extraInfo.innerText = "Provide dvd capacity in MB" 
            break;
        case "Forniture":
            extraLabel.innerText = "Medidas (HxWxL):";
            extraInput.type = "text";
            extraFieldsDiv.innerHTML = `
                <label class="ml-4">Altura:</label>
                    <input type="text" name="altura" value="" required>
                <label>Largura:</label>
                    <input type="text" class="forniture-label" name="largura" value="" required>
                <label>Comprimento:</label>
                    <input type="text" class="forniture-label" name="comprimento" value="" required>
                <p class="info-label"> Provide measures in cm </p>`;
            return;
        case "Book":
            extraInfo.innerText = "Provide book weight in kg" 
            extraLabel.innerText = "Peso (KG):";
            extraInput.type = "text";
            break;
    }

        const tipoInput = document.getElementById("tipoInput");
        tipoInput.value = value;
    }


</script>

