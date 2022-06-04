
<?php
    include_once 'classes\desastre.php';

    if (isset($_POST['gravar']))
    {
        $NAME  = $_POST['named'];
        $TIPO  = $_POST['tipo'];
        $DATA  = $_POST['date'];
        $ATIVO =   'S';
        $CIDADE= $_POST['cidade'];
        $UF    = $_POST['uf'];
        

        $D = new Desastre;
        if ($D->DesastreADD($NAME, $TIPO, $DATA, $ATIVO, $CIDADE, $UF, $erro) > 0)
        {
            //echo 'Inserido com sucesso !';
            header("location: index.php");
            //exit;
        }
        else
            echo 'Falhou ! <br/> Motivo:<br/>'.$erro;

        unset($D); 
    }
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Formulario de cadastro de desastres</title>
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="img/Firefighter-amico.png" alt="">
        </div>
        <div class="form">
            <form action="cadastrodesastre_add.php" method="POST">
                <div class="form-header">
                    <div class="title">
                        <h1>Cadastro de Desastres</h1>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-box">
                        <label for="named">Nome</label>
                        <input id="named" type="text" name="named" placeholder="Nome do desastre" required>
                    </div>
                    
                    <div class="input-box">
                        <label class="date" for="date">Data</label>
                        <input  id="date" type="date" name="date" required>
                    </div>
                    <div class="input-box">
                        <label for="cidade">Cidade</label>
                        <input id="cidade" type="text" name="cidade" placeholder="Cidade do desastre" required>
                    </div>
                    <div class="input-box">
                        <label for="uf">UF</label>
                        <input id="uf" type="text" name="uf" placeholder="Digite o estado do desastre" required>
                    </div>
                    <div class="continue-button ">
                        <button id="gravar" name="gravar"><input type="submit" name="gravar" id="gravar" value="gravar"></button>
                    </div>
                    <div class="input-box">
                        <label for="tipo">Tipo de desastre</label>
                        <select name="tipo" id="tipo" aria-placeholder="Tipo de desastre">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>