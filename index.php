<!DOCTYPE html>
<?php 
   include_once "conf/default.inc.php";
   require_once "conf/Conexao.php";
   $title = "Carros";
   $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
   $busca = isset($_POST["busca"]) ? $_POST["busca"] : "id";
?>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
       body {
            right: 200px;
       } 
    </style>
</head>
<body class="">
    <?php include "menu.php"; ?>
    <form method="post">
        <input type="radio" id="nome" name="busca" value="nome" <?php if($busca == "nome"){echo "checked";}?>>
        <label for="huey"><h3>Nome</h3></label><br>
        <input type="radio" id="valor" name="busca" value="valor" <?php if($busca == "valor"){echo "checked";}?>>
        <label for="huey"><h3>Valor</h3></label><br> 
        <input type="radio" id="km" name="busca" value="km" <?php if($busca == "km"){echo "checked";}?>>
        <label for="huey"><h3>KM</h3></label><br>
        <br><br>
        <div class="" style="padding-left: 10%;">
            <legend>Procurar: </legend>
            <input type="text"   name="procurar" id="procurar" size="37" value="<?php echo $procurar;?>">
            <button type="submit" class="btn btn-dark" name="acao" id="acao">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
            </svg>
            </button>
            <br><br>
        </div>
            <div class="">
            <table class="table table-striped">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>
                        <th scope="col">KM</th>
                        <th scope="col">Data de fabricação</th>
                        <th scope="col">Anos de uso</th>
                        <th scope="col">Média de km por ano</th>
                        <th scope="col">Valor de revenda</th>
                    </tr>
                </thead>
                <tbody>
    <?php
        $pdo = Conexao::getInstance(); 
        if($busca == "id"){
            $consulta = $pdo->query("SELECT * FROM carro 
                                 WHERE nome LIKE '%$procurar%' 
                                 ORDER BY id");
        }
        else if($busca == "nome"){
            $consulta = $pdo->query("SELECT * FROM carro 
                                 WHERE nome LIKE '%$procurar%' 
                                 ORDER BY nome");
        } else if($busca == "valor"){
            $consulta = $pdo->query("SELECT * FROM carro 
                                 WHERE valor <= $procurar 
                                 ORDER BY valor");
        } else if($busca == "km"){
            $consulta = $pdo->query("SELECT * FROM carro 
                                 WHERE km <= $procurar 
                                 ORDER BY km");
        }
        
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $anosUso = date("Y")-date("Y", strtotime($linha['dataFabricacao']));
            $mediaKm = $linha['km']/$anosUso;
            $valorRevenda = $linha['valor'];
            $cor = "black";
            if($anosUso >= 10){
                $valorRevenda = $valorRevenda-($linha['valor']*0.1);
                $cor = "red";
            }
            if($linha['km'] >= 100000){
                $valorRevenda = $valorRevenda-($linha['valor']*0.1);
                $cor = "red";
            }
    ?>
                    <tr>
                        <th scope="row"><?php echo $linha['id'];?></th>
                        <td><?php echo $linha['nome'];?></td>
                        <td><?php echo number_format($linha['valor'], 1, ',', '.');?></td>
                        <td><?php echo number_format($linha['km'], 1, ',', '.');?></td>
                        <td><?php echo date("d/m/Y", strtotime($linha['dataFabricacao']));?></td>
                        <td><?php echo $anosUso;?></td>
                        <td><?php echo number_format($mediaKm, 1, ',', '.');?></td>
                        <td style="color:<?php echo $cor; ?>;"><?php echo number_format($valorRevenda, 1, ',', '.');?></td>
                    </tr>
    <?php } ?> 
                </tbody>
            </table>
            </div>
    </form>
</body>
</html>