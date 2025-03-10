<?php
    include_once 'classes\vitima.php';

    if (isset($_POST['gravar']))
    {   
        $INSERIDOPOR = $_POST['nomein'];
        $NOME = $_POST['nomevit'];
        $CPF  = $_POST['cpf'];
        $IDADE = $_POST['idade'];
        $OBTO = $_POST['obto'];
        if (empty($OBTO)) {
            $OBTO = 'N';
        }
        $ENCERRADO = 'N';
        $DATA_HORA = $_POST['datevit'];
        $CARACTERISTICAS = $_POST['caract'];
     

        $V = new Vitima;
        
        if ($V->VitimaADD($ID_DESASTRE, $ID_UNIDATENDTO, $INSERIDOPOR, $NOME, $CPF, $IDADE, $OBTO, $ENCERRADO, $DATA_HORA, $CARACTERISTICAS, $erro) > 0)
        {
            //echo 'Inserido com sucesso !';
            header("location: index.php");
            //exit;
        }
        else
            echo 'Falhou ! <br/> Motivo:<br/>'.$erro;

        unset($V); 
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Cadastro de vítimas</title>
</head>
<body>
    <div class="container">
        <div class="logo">
           <h1><img src="imagens/logo.png" alt="">SADN</h1>
           <p>Sistema de Apoio a Desastre Natural</p>
        </div>
        <div class="form-image">
            <img src="imagens/Hospital bed-amico.svg" alt="">
        </div>
        <div class="form">
            <form action="cadastrovitimas_add.php" method="POST">
                <div class="form-header">
                    <div class="title">
                        <h1>Cadastrar Vitima</h1>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-box">
                        <label for="nomein">Nome do Inseridor</label>
                        <input id="nomein" type="text" nome="nomein" placeholder="Digite o nome do desastre" required>
                    </div>
                    <div class="input-box">
                        <label for="name">Nome da vitima</label>
                        <input id="namevi" type="text" name="namevi" placeholder="Digite o nome da vitíma" required>
                    </div>
                    <div class="input-box">
                        <label for="cpf">CPF</label>
                        <input id="cpf" type="text" name="cpf" placeholder="xxx.xxx.xxx-xx" required>
                    </div>
                    <div class="input-box">
                        <label for="idadevit">Idade</label>
                        <input id="idadevit" type="text" name="idadevit" placeholder="Digite a idade da vitima" required>
                    </div>
                    <div class="input-box">
                        <label for="datevit">Data e hora</label>
                        <input id="datevit" type="date" name="datevit" required>
                    </div>
                    <div class="input-box">
                        <label for="cidade">Cidade</label>
                        <input id="cidade" type="text" name="cidade" placeholder="Digite sua cidade" required>
                    </div>
                    <div class="input-box">
                        <label for="uf">UF</label>
                        <input id="uf" type="text" name="uf" placeholder="Digite seu estado" required>
                    </div>
                    <div class="input-box">
                        <label for="obito" style="color: #fff;">Óbito?</label>
                        <input type="checkbox" id="obito" name="obito">
                    </div>
                    <div class="input-box">
                        <label for="unidatend">Unidade de Atendimento</label>
                        <select name="unidatend" id="unidatend" placeholder="Unidade de Atendimento">
                            <option value="">Santa Casa</option>
                            <option value="">Unimed</option>
                            <option value="">Amor saúde</option>
                            <option value="">Pró-saúde</option>
                            <option value="">UPA</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label for="caract">Caracteristicas</label>
                        <textarea id="caract" type="text" name="caract" placeholder="Digite as Caracteristicas da vitima"></textarea>
                    </div>
                    <div class="continue-button ">
                       <button type="submit" name="gravar" id="gravar">Cadastrar</button>
                       <button type="submit"><a href="index.php">Voltar</a></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
