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
        header("Location: lista.php");
        exit;
    }

?>
<head>
    <link rel="stylesheet" href="style.css">
</head>

<form action="listar.php" class="form" id="product_form" method="get" accept-charset="utf-8">
    <div class="button-container">
        <button type="submit" name="enviar" class="list-button">Save</button>
        <button type="button" onclick="window.location.href = '/Store/lista.php';" class="list-button">Cancel</button>
    </div>
    <div class="title">Lista de Produtos</div>
    <hr>
   <label>
       SKU: 
        <input 
            type="number" 
            name="sku"
            required=True
        >
   </label>
   <label>
       Nome: 
        <input 
            type="text" 
            name="nomeproduto"
            required=True
        >
   </label>
   <label>
       Preço: 
        <input 
            type="text" 
            name="preco"
            required=True
        >
   </label>
   <label>
       Tipo:
       <select name="tipo" class="opcoes" onchange="showExtraFields(this.value)" required="true">
           <option value="">Selecione</option>
           <option value="DVD">DVD</option>
           <option value="Forniture">Forniture</option>
           <option value="Book">Book</option>
       </select>
   </label>
   
   <div id="extraFields" style="display: none;">
       <label id="extraLabel"></label>
        <input 
            type="text" 
            name="extrafield" 
            id="extraInput"
            required=True
        ><br>
        <a id="extraInfo"></a>
   </div>
</form>

<div class="footer">
    <hr><h1>Scandiweb Test assignment &copy; <?php echo date("Y"); ?> 
</div>
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
                <label>Altura:
                    <input type="text" name="altura" value="" required>
                </label>
                <label>Largura:
                    <input type="text" name="largura" value="" required>
                </label>
                <label>Comprimento:
                    <input type="text" name="comprimento" value="" required>
                </label>
                <a> Provide measures in cm </a>`;
            return;
        case "Book":
            extraInfo.innerText = "Provide book weith in kg" 
            extraLabel.innerText = "Peso (KG):";
            extraInput.type = "text";
            break;
    }

        const tipoInput = document.getElementById("tipoInput");
        tipoInput.value = value;
    }


</script>

