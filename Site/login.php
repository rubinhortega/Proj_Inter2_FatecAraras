<?php
    include_once 'classes\login.php';

    if (isset($_POST['gravar']))
    {
        $CPF  = $_POST['username'];
        $PASS = $_POST['password'];

        $A = new Login;
        
        $ret  = $A->LogIn($CPF, $PASS, $erro);

        

        if ($erro == '')
        {
            echo "ok</br>";

            foreach ($ret as $lin)
            {
                print_r ($lin);
            }

            echo "</br></br>
                  Tem que gravar o retorno em sessão para direitos</br>
                  nivel = 1  => Oficial</br>
                  nivel = 0 => usuario comum</br></br>
                  oficial tem acesso:</br>
                    - cad desastre</br>
                    - cad unidades de atendimento</br>
                    - cad de vitimas</br></br>
                  usuário comum tem acesso:</br>
                    - listar e procurar vitimas/desastres</br>
                    - alterar um vitimado, apenas colocando/informando q a pessoa já foi encontrada/localizada</br>
                       essa pessoa pode não estar no local do desastre e fora inserida incorretamente</br>
                    - acrescentar uma pessoa/parente que ela sabe/pensa estar no local do desastre</br>
                       (aqui cabe resalvas, mas a intenção é ajudar as equipes de resgate a terem uma ideia da qtde. de pessoas vitimadas)</br>
                  ";
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
    <link rel="stylesheet" href="css/stylelogin.css">
    <title>Login</title>
</head>

<body>
    <div class="main-login">
        <div class="left-login">
            <h1>SADN</h1>
            <p>Sistema de Apoio a Desastre Natural</p>
            <img src="imagens/Tablet login-pana.svg" class="left-login-image"alt="">
        </div>
        <div class="right-login">
            <div class="card-login">
                <h1>LOGIN</h1>
                <div class="textfield">
                    <label for="username">Usuário</label>
                    <input type="text" name="username" placeholder="Usuário">
                </div>
                <div class="textfield">
                    <label for="password">Senha</label>
                    <input type="password" name="password" placeholder="Senha">
                </div>
                <button class="btn-login">Login</button>
                <div class="cadr">
                    <label for="cadr" style="color: #ffff;">Não tem conta?</label>
                    <button type="submit"><a href="cadastropessoas_add.php">Cadastra-se</a></button>
                </div>
                <div>
                    <button type="submit" class="btn-login"><a href="index.php">Voltar</a></button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
