<!DOCTYPE html>
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
                <div class="logo"></div>
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
                    <h2>
                        Comunidades!
                    </h2>
                    <p>
                    <li><a href="ComunidadeAjuda.php">Comunidade Ajuda</a></li><br>
		         <li><a href="MaosAjudam.php">Comunidade Mãos Que Ajudam</a></li><br>
		<li><a href=ComunidadeAnjos.php>Comunidade Anjos</a></li><br>
		<li><a href="ComunidadeArcanjo.php">Comunidade Arcanjo</a></li><br>
		<li><a href="ComunidadeFraternal.php">Comunidade Fraternal</a></li><br>
                    </p>
             
                </div>
                <!--one-->
                <div class="two">
                    <br>
                <p style="text-align: justify;">Mãos que Ajudam é um programa permanente de ajuda humanitária e de serviço comunitário, que mobiliza milhares de voluntários de todas as idades, membros de A Igreja de Jesus Cristo dos Santos dos Últimos Dias, no Brasil, estendendo a mão a quem precisa.

                Em agosto de 2000, foi criado no Brasil o programa Mãos que Ajudam, uma proposta permanente de ajuda humanitária e de serviço comunitário que mobiliza milhares de voluntários, membros e amigos de A Igreja de Jesus Cristo dos Santos dos Últimos Dias, em parceria com empresas privadas, órgãos governamentais, veículos de comunicação, ONGs e instituições religiosas. As ações realizadas pela Igreja já beneficiaram todas as capitais da federação e cerca de 200 outras cidades. </p>
                <img src="imagens/comunidade1.jpg">
                <img src="imagens/comunidade2.jpeg">

                    <div class="clear"></div>
                </div>
                <!--two-->
                <div class="clear"></div>
            </div>
            <!--container-->
        </div>
        <!--content-header-->
    </section>
    <!--section-->

    
    
    <section class="contato" id="tree">
        <div class="container">
            <h2>Entre em contato</h2>
            <div class="box">
                <p>Telefone: (xx) xxxx-xxxx</p>
                <p>Email: contato@gamil.com</p>
                <p>Endereço: Rua Jarbas Leme de Godoy
                    <br>
                 José Ometto- Araras/SP
                </p>
        </div>
            <form>
                <div class="form-group">
                    <input type="text" name="nome" required placeholder="Digite seu nome">
                </div>
                <div
                 class="form-group">
                    <input type="text" name="email" required placeholder="Digite seu email">
                </div>
                <div class="form-group">
                    <input type="text" name="telefone" placeholder="Digite seu telefone">
                </div>
                <div class="form-group">
                    <textarea name="mensagem" placeholder="Digite sua mensagem"></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="enviar" value="Enviar">
                </div>
            </form>
        </div>
    </section>

    <footer>
        <img src="imagens/logo.png">
    </footer>

    <script src="https://kit.fontawesome.com/3c8e4257f7.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="script.js"></script>
</body>

</html>