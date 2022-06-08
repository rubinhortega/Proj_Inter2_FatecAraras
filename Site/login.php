<?php
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    session_start();
    if($_POST['username'] == 'orlando' and $_POST['password'] == '123mudar'){
        $_SESSION['loggedin'] = TRUE;
        $_SESSION["username"] = 'Orlando Saraiva';
         header("location: welcome.php");
    } else {
        $_SESSION['loggedin'] = FALSE;
    }
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
            <img src="img/Tablet login-pana.svg" class="left-login-image"alt="">
        </div>
        <div class="right-login">
            <div class="card-login">
                <h1>LOGIN</h1>
                <div class="textfield">
                    <label for="usuario">Usuário</label>
                    <input type="text" name="usuario" placeholder="Usuário">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha">
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