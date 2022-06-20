<?php
if (!isset($_GET['desastre'])) {
	header("Location: informações.php");
	exit;
}
 
$nome = "%".trim($_GET['Id_DESASTRE'])."%";
 
$dbh = new PDO('mysql:host=127.0.0.1;dbname='FATECPROJ2', 'DESASTRE', 'FATEC2SEM'');
 
$sth = $dbh->prepare('SELECT * FROM `DESASTRE` WHERE `nome` LIKE :nome');
$sth->bindParam(':nome', $NOME, PDO::PARAM_STR);
$sth->execute();
 
$resultados = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
 
<!DOCTYPE html>
<html>
<head>
	<title>Resultado da busca</title>
</head>
<body>
<h2>Resultado da busca</h2>
<?php
if (count($resultados)) {
	foreach($resultados as $Resultado) {
?>
<label><?php echo $Resultado['ID_DESASTRE']; ?> - <?php echo $Resultado['NOME']; ?></label>
<br>
<?
} } else {
?>
<label>Não foram encontrados resultados pelo termo buscado.</label>
<?php
}<!DOCTYPE html>



<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="font-awesome.min.css" />
    <link rel="stylesheet" href="jquery-ui.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <title>Projeto_09</title>
</head>

<body>
    <section class="header-master">
        <header>
            <div class="container">
                <div class="logo">
                <img src="imagens/logo.png">
                </div>
                <nav class="desktop">
                    <ul>
                        <li class="select"><span></span><a href="#zero">Home</a></li>
                        <li><span></span><a href="#one">Informações</a></li>
                        <li><span></span><a href="#two">Comunidades</a></li>
                        <li><span></span><a href="#tree"></a>Orientações</li>
                    </ul>
                </nav>
                <nav class="mobile">
                    <i class="fa fa-bars"></i>
                    <div class="clear"></div>
                    <ul>
                        <li><span></span><a href="#zero">Home</a></li>
                        <li><span></span><a href="#one">Informações</a></li>
                        <li><span></span><a href="#two">Comunidades</a></li>
                        <li><span></span><a href="#tree">Duvidas</a></li>
                        <li><span></span><a href="#four">Login</a></li>
                    </ul>
                </nav>
                <div class="telefone-header">
                    <li><span></span><a href="#one">Login</a></li>
                </div>
                <div class="clear"></div>
                <!--Telefone-->
            </div>
            <!--container-->
        </header>
        <!--header-->
        <div class="content-header">
            <div class="container1">
                <div class="one">
                    <form>
                        <input type="pesquisa" name="pesquisa" placeholder="Digite sua busca!" />
                        <input type="submit" name="acao" value="Pesquisar">
                    </form>
                </div>
            </div>
        </div>
    <footer>
        <img src="imagens/logo.png">
    </footer>

    <script src="https://kit.fontawesome.com/3c8e4257f7.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="script.js"></script>
</body>

</html>
