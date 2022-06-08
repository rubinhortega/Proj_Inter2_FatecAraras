<?php
    include_once 'classes\unidatendto.php';

    if (isset($_POST['gravar']))
    {
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
        if ($U->UnidatendtoADD($NOME,
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
                                $OBS, $erro) > 0)
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
    <title>Cadastro da unidade de atendimento</title>
</head>

<body>
    <div class="container">
        <div class="form-image">
            <img src="img/Hospital building-rafiki.svg" alt="">
        </div>
        <div class="form">
            <form action="cadunidadeatend_add.php" method="POST">
                <div class="form-header">
                    <div class="title">
                        <h1>Cadastrar unidade de atendimento</h1>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-box">
                        <label for="nome">Nome</label>
                        <input id="nome" type="text" name="nome" placeholder="Digite o nome da uniade de atendimento" required>
                    </div>
                    <div class="input-box">
                        <label for="nomeresp">Nome do responsável</label>
                        <input id="nomeresp" type="text" name="nomeresp" placeholder="Nome do responsável" required>
                    </div>
                    <div class="input-box">
                        <label for="emailcua">E-mail</label>
                        <input id="emailcua" type="email" name="emailcua" placeholder="Digite o e-mail" required>
                    </div>
                    <div class="input-box">
                        <label for="log">Logradouro</label>
                        <input id="log" type="text" name="log" placeholder="Digite o logradouro"
                            required>
                    </div>
                    <div class="input-box">
                        <label for="n">Nº</label>
                        <input id="n" type="text" name="n" placeholder="Digite o número do local de atendimento" required>
                    </div>
                    <div class="input-box">
                        <label for="bairro">Bairro</label>
                        <input id="bairro" type="text" name="bairro" placeholder="Digite o bairro" required>
                    </div>
                    <div class="input-box">
                        <label for="cidade">Cidade</label>
                        <input id="cidade" type="text" name="cidade" placeholder="Digite a cidade" required>
                    </div>
                    <div class="input-box">
                        <label for="uf">UF</label>
                        <input id="uf" type="text" name="uf" placeholder="Digite o estado" required>
                    </div>
                    <div class="input-box">
                        <label for="cep">CEP</label>
                        <input id="cep" type="text" name="cep" placeholder="xx.xxx-xxx" required>
                    </div>
                    <div class="input-box">
                        <label for="com">Complemento</label>
                        <input id="com" type="text" name="com" placeholder="Digite informções extras">
                    </div>
                    <div class="input-box">
                        <label for="fone">Contatos</label>
                        <textarea id="fone" type="text" name="fone"> Contatos da unidade de atendimento</textarea><br><br>
                    </div>
                    <div class="input-box">
                        <label for="Obs">Observações</label>
                        <textarea id="Obs" type="text" name="Obs"> Observações</textarea><br><br>
                    </div>
                    <div class="continue-button ">
                        <button id="gravar" name="gravar">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>