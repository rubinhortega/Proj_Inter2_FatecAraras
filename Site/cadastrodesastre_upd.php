<?php
    include_once 'classes\desastre.php';
    
    if (!empty($_GET['ID_DESASTRE']))
    {
        $id = $_GET['ID_DESASTRE'];

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
        $TIPO = $_POST['tipo'];
        $DESCRICAO = $_POST['nomed'];
        $DATA = $_POST['date'];
        $ATIVO = 'N';
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
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração de Desastre</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="logo">
           <h1><img src="imagens/logo.png" alt="">SADN</h1>
           <p>Sistema de Apoio a Desastre Natural</p>
        </div>
        <div class="form-image">
            <img src="imagens/Firefighter-amico.svg" alt="">
        </div>
        <div class="form">
            <form action="cadastrodesastre_upd.php" method="POST">
                <div class="form-header">
                    <div class="title">
                        <h1>Alterar Cadastro de Desastre</h1>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-box">
                        <label for="named">Nome</label>
                        <input id="named" type="text" name="named" placeholder="Nome do desastre" value="<?php echo $DESCRICAO ?>" required>
                    </div>
                    
                    <div class="input-box">
                        <label class="date" for="date">Data</label>
                        <input  id="date" type="date" name="date" value="<?php echo $DATA ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="cidade">Cidade</label>
                        <input id="cidade" type="text" name="cidade" placeholder="Cidade do desastre" value="<?php echo $CIDADE ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="uf">UF</label>
                        <input id="uf" type="text" name="uf" placeholder="Digite o estado do desastre" value="<?php echo $UF ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="tipo">Tipo de desastre</label>
                        <select name="tipo" id="tipo" aria-placeholder="Tipo de desastre" value="<?php echo $TIPO ?>" required>
                            <option value="1">Afundamento e colapso</option>
                            <option value="2">Ciclones, furacões ou tufões</option>
                            <option value="3">Deslizamento ou escorregamento de terra</option>
                            <option value="4">Inundações</option>
                            <option value="5">Tempestades</option>
                            <option value="6">Tornados</option>
                            <option value="7">Outros fenômenos</option>
                            <option value="X">PROCURADOS</option>
                        </select> 
                    </div>
                    <div class="continue-button ">
                        <button type="submit" name="gravar" id="gravar">Alterar</button>
                        <button type="submit"><a href="index.php">Voltar</a></button>
                        <button type="submit"><a href="cadastrodesastre_del.php">Excluir</a></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
