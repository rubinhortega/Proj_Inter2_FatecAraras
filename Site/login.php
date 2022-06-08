

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
                    <input type="password" name=password" placeholder="Senha">
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
