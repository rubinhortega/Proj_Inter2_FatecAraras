<?php
    include_once 'classes\desastre.php';
    
    if (!empty($_GET['id']))
    {
        $id = $_GET['id'];

        $D = new Desastre;
        $linhas = $D->DesastreExiste($ID_DESASTRE, $erro);
        if ($erro != '')
        {
            if ($erro != "")
                echo 'Falhou ! <br/> Motivo:<br/>'.$erro;
            else
                echo 'Registro não encontrado.<br/>';
        }
        else
        {
            $linhas = $D->DesastreGet($ID_DESASTRE, $erro);
            foreach ($linhas as $lin)
            {
                $ID_DESASTRE = $lin['$ID_DESASTRE'];
                $TIPO = $lin['TIPO'];
                $DESCRICAO = $lin['DESCRICAO'];
                $DATA = $lin['DATA'];
                $ATIVO = $lin['ATIVO'];
                $CIDADE = $lin['CIDADE'];
                $UF  = $lin['UF'];
            }
        }
    }

    if (isset($_POST['gravar']))
    {
        $ID = $_POST['id'];
        $TIPO = $_POST['tipo'];
        $DESCRICAO = $_POST['descricao'];
        $DATA = $_POST['data'];
        $ATIVO = '';
        $CIDADE = $_POST['cidade'];
        $UF = $_POST['uf'];

        $D = new Desastre;
        if ($D->DesastreUPD($ID_DESASTRE,
                            $TIPO,
                            $DESCRICAO,
                            $DATA,
                            $ATIVO,
                            $CIDADE,
                            $UF,
                            $erro) > 0)
        {
            //echo 'Alterado com sucesso !';
            header("location: index.php");
            //exit;
        }
        else
            echo 'Falhou ! <br/> Motivo:<br/>'.$erro;

        unset($D); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Desastre</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="box">
        <form action="cadastrodesastre_upd.svg" method="POST">
            <fieldset>
                <legend><b>Cadastro de Desastre- Alteração</b></legend>
                <br>
                <div class="input-box">
                    <input type="text" name="tipo" id="tipo"  value="<?php echo $TIPO ?>" required>
                    <label for="tipo">Tipo</label>
                </div>
                <br><br>
                <div class="input-box">
                    <input type="text" name="descricao" id="descricao" value="<?php echo $DESCRICAO ?>" required>
                    <label for="descricao">Descrição</label>
                </div>
                <br><br>
                <div class="input-box">
                    <input type="datetime" name="data" id="data" value="<?php echo $DATA ?>" required>
                    <label for="data">Data e hora</label>
                </div>
                <br><br>
                <div class="input-box">
                    <input type="ativo" name="ativo" id="ATIVO"  value="<?php echo $ATIVO ?>" required>
                    <label for="ATIVO">Ativo</label>
                </div>
                <div class="input-box">
                    <input type="text" name="cidade" id="cidade"  value="<?php echo $CIDADE ?>" required>
                    <label for="cidade">Cidade</label>
                </div>
                <div class="input-box">
                    <input type="text" name="uf" id="uf"  value="<?php echo $UF ?>" required>
                    <label for="uf">UF</label>
                </div>
                <br><br>
                    <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                    <input type="submit" name="gravar" id="gravar" class="btn btnok" value="Gravar">
                    <input type="button" name="cancel" id="cancel" class="btn btnvoltar" value="Voltar" onclick="history.go(-1);">
            </fieldset>
        </form>
    </div>  
</body>
</html>