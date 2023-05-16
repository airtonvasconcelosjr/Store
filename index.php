<?php
    session_start();
    require_once("servidor.php");
    if(!empty($_SESSION['mensagem'])) {
        echo $_SESSION['mensagem'];
        unset($_SESSION['mensagem']);
    }

?>
<head>
    <link rel="stylesheet" href="style.css">
</head>

<form action="listar.php" method="get" accept-charset="utf-8">
    <div class="button-container">
        <button type="submit" name="add-button" class="add-button">Listar</button>
        <button type="submit" id="delete-product-btn" name="delete-button" class="delete-product-btn">Mass delete</button>
    </div>
    <div class="title">Lista de Produtos</div>
    <hr>
   <label>
       Nome: <input type="text" name="nomeproduto">
   </label>
   <label>
       Preço: <input type="text" name="preco">
   </label>
   <label>
       Código: <input type="number" name="codigo">
   </label>
   <label>
       Tipo:
       <select name="tipo" onchange="showExtraFields(this.value)">
           <option value="">Selecione</option>
           <option value="DVD">DVD</option>
           <option value="Forniture">Forniture</option>
           <option value="Book">Book</option>
       </select>
   </label>
   <div id="extraFields" style="display: none;">
       <label id="extraLabel"></label>
       <input type="text" name="extrafield" id="extraInput">
   </div>
   <input type="submit" name="enviar">
</form>

<script>
   function showExtraFields(value) {
       const extraFieldsDiv = document.getElementById("extraFields");
       const extraLabel = document.getElementById("extraLabel");
       const extraInput = document.getElementById("extraInput");

       extraFieldsDiv.style.display = value ? "block" : "none";

       switch (value) {
           case "DVD":
               extraLabel.innerText = "Tamanho (em MB):";
               extraInput.type = "number";
               break;
           case "Forniture":
               extraLabel.innerText = "Medidas (HxWxL):";
               extraInput.type = "text";
               break;
           case "Book":
               extraLabel.innerText = "Peso do livro (KG):";
               extraInput.type = "number";
               break;
           default:
               extraLabel.innerText = "";
               extraInput.type = "text";
               break;
       }
   }
</script>


<a href="lista.php">Listagem</a>