<?php
    include_once 'classes\inidatendto.php';
    
    if (!empty($_GET['id']))
    {
        $id = $_GET['id'];

        $U = new UnidAtendto;
        $linhas = $U->UnidAtendtoExiste($ID_UNIDATENDTO, $erro);
        if ($erro != '')
        {
            if ($erro != "")
                echo 'Falhou ! <br/> Motivo:<br/>'.$erro;
            else
                echo 'Registro não encontrado.<br/>';
        }
        else
        {
            $linhas = $U->UnidAtendtoGet($ID_UNIDATENDTO, $erro);
            foreach ($linhas as $lin)
            {
                $ID_UNIDATENDTO = $lin['ID_UNIDATENDTO'];
                $NOME = $lin['NOME'];
                $ATIVO = $lin['ATIVO'];
                $FONES = $lin['FONES'];
                $EMAIL = $lin['EMAIL'];
                $SITE  = $lin['SITE'];
                $NOME_RESP = $lin['NOME_RESP'];
                $END_LOG  = $lin['END_LOG'];
                $END_NUM  = $lin['END_NUM'];
                $END_BAI  = $lin['END_BAI'];
                $END_CID  = $lin['END_CID'];
                $END_CEP  = $lin['END_CEP'];
                $END_COM  = $lin['END_COM'];
                $END_UF   = $lin['END_UF'];
                $OBS      = $lin['OBS'];
            }
        }
    }

    if (isset($_POST['gravar']))
    {
        $ID = $_POST['ID_UNIDATENDTO'];
        $NOME   = $_POST['nome'];
        $ATIVO  = 'S';
        $FONES  = $_POST['fone'];
        $EMAIL  = $_POST['email'];
        $SITE   = $_POST['site'];
        $NOME_RESP = $_POST['nomeresp'];
        $END_LOG  = $_POST['log'];
        $END_NUM  = $_POST['n'];
        $END_BAI  = $_POST['bairro'];
        $END_CID  = $_POST['cidade'];
        $END_CEP  = $_POST['cep'];
        $END_COM  = $_POST['com'];
        $END_UF   = $_POST['uf'];
        $OBS     = $_POST['obs'];
        

        $U = new UnidAtendto;
        if ($U->UnidAtendtoUPD($ID_UNIDATENDTO,
                               $NOME,
                               $ATIVO,
                               $FONES,
                               $EMAIL,
                               $SITE,
                               $NOME_RESP,
                               $END_LOG,
                               $END_NUM,
                               $END_BAI,
                               $END_CID,
                               $END_CEP,
                               $END_COM,
                               $END_UF,
                               $OBS,$erro) > 0)
        {
            //echo 'Alterado com sucesso !';
            header("location: index.php");
            //exit;
        }
        else
            echo 'Falhou ! <br/> Motivo:<br/>'.$erro;

        unset($A); 
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Atualização no cadastro da unidade de atendimento</title>
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="img/Hospital building-rafiki.svg" alt="">
        </div>
        <div class="form">
            <form action="cadunidadeatend_upd.php" method="POST">
                <FIEldset>
                    <div class="form-header">
                        <div class="title">
                            <h1>Atualizar unidade de atendimento</h1>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="input-box">
                            <label for="nome">Nome</label>
                            <input id="nome" type="text" name="nome" placeholder="Digite o nome da uniade de atendimento" value="<?php echo $NOME?>"required>
                        </div>
                        <div class="input-box">
                            <label for="nomeresp">Nome do responsável</label>
                            <input id="nomeresp" type="text" name="nomeresp" placeholder="Nome do responsável" value="<?php echo $NOME_RESP ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="emailcua">E-mail</label>
                            <input id="emailcua" type="email" name="emailcua" placeholder="Digite o e-mail" value="<?php echo $EMAIL ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="log">Logradouro</label>
                            <input id="log" type="text" name="log" placeholder="Digite o logradouro" value="<?php echo $END_LOG ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="n">Nº</label>
                            <input id="n" type="text" name="n" placeholder="Digite o número do local de atendimento" value="<?php echo $END_NUM ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="bairro">Bairro</label>
                            <input id="bairro" type="text" name="bairro" placeholder="Digite o bairro" value="<?php echo $END_BAI ?>"required>
                        </div>
                        <div class="input-box">
                            <label for="cidade">Cidade</label>
                            <input id="cidade" type="text" name="cidade" placeholder="Digite a cidade" value="<?php echo $END_CID ?>"required>
                        </div>
                        <div class="input-box">
                            <label for="uf">UF</label>
                            <input id="uf" type="text" name="uf" placeholder="Digite o estado" value="<?php echo $END_UF ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="cep">CEP</label>
                            <input id="cep" type="text" name="cep" placeholder="xx.xxx-xxx" value="<?php echo $END_UF ?>" required>
                        </div>
                        <div class="input-box">
                            <label for="com">Complemento</label>
                            <input id="com" type="text" name="com" value="<?php echo $END_COM ?>" placeholder="Digite informções extras">
                        </div>
                        <div class="input-box">
                            <label for="fone">Contatos</label>
                            <textarea id="fone" type="text" name="fone" value="<?php echo $FONES ?>"> Contatos da unidade de atendimento</textarea><br><br>
                        </div>
                        <div class="input-box">
                            <label for="Obs">Observações</label>
                            <textarea id="Obs" type="text" name="Obs" value="<?php echo $OBS ?>"> Observações</textarea><br><br>
                        </div>
                        <div class="continue-button ">
                            <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                            <input type="submit" name="gravar" id="gravar" class="btn btnok" value="Gravar">
                            <input type="button" name="cancel" id="cancel" class="btn btnvoltar" value="Voltar" onclick="history.go(-1);">
                        </div>
                    </div>
                </FIEldset>
            </form>
        </div>
    </div>
</body>
</html>