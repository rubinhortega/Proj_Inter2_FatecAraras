<?php
    include_once 'classes\pessoa.php';

    //if (isset($_POST['gravar']))
    {
        $ID_PESSOA = 7;
        $CPF = 12346;
        $NOME = "TESTES 2222222";
        $FONE = "19-555-99999";
        $EHWHATS = "S";
        $SENHA = "123";
        $EMAIL = "dani@uol.com";
        $ATIVO = "S";
        $EHOFICIAL = "S";
        $LIB_CADDESASTRE = "N";
        $REGISTRO_OFICIAL = "455-klo-888";
        $CONTATOS = "";
        $END_LOG = "Rua 1";
        $END_NUM = 987;
        $END_BAI = "Bela vista";
        $END_CID = "Araras";
        $END_CEP = 13598;
        $END_COM = "apto 25";
        $END_UF = "SP";

        $A = new Pessoa;
        //if ($A->PessoaDEL($ID_PESSOA, $erro) > 0)
        if ($A->PessoaADD(
            $CPF,
            $NOME,
            $FONE,
            $EHWHATS,
            $SENHA,
            $EMAIL,
            $ATIVO,
            $EHOFICIAL,
            $LIB_CADDESASTRE,
            $REGISTRO_OFICIAL,
            $CONTATOS,
            $END_LOG,
            $END_NUM,
            $END_BAI,
            $END_CID,
            $END_CEP,
            $END_COM,
            $END_UF,
            $erro
        ) > 0)
      /*  if ($A->PessoaUPD(6,
        $NOME,
        $FONE,
        $EHWHATS,
        $EMAIL,
        $ATIVO,
        $EHOFICIAL,
        $LIB_CADDESASTRE,
        $REGISTRO_OFICIAL,
        $CONTATOS,
        $END_LOG,
        $END_NUM,
        $END_BAI,
        $END_CID,
        $END_CEP,
        $END_COM,
        $END_UF, $erro) > 0)*/
        {
            //echo 'Inserido com sucesso !';
            echo "ok";
            //exit;
        }
        else
            echo 'Falhou ! <br/> Motivo:<br/>'.$erro;

        unset($A); 
    }
?>