<?php
    include_once 'classes\login.php';

    //if (isset($_POST['gravar']))
    {
        $CPF  = "123";
        $PASS = "123";

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