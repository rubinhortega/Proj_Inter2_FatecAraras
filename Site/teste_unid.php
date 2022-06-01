<?php
    include_once 'classes\unidatendto.php';

    //if (isset($_POST['gravar']))
    {
        $ID_UNIDATENDTO = 2;
        $ATIVO = "S";
        $NOME = "são leopoldo";
        $FONES = "19-6666-77777";
        $EMAIL = "eu@uol.com.br";
        $SITE = "www.sitebla.com";
        $NOME_RESP = "tião";
        $END_LOG = "Rua 2";
        $END_NUM = 123;
        $END_BAI = "bairro jd azul";
        $END_CID = "araras";
        $END_CEP = 123654;
        $END_COM = "casa";
        $END_UF = "SP";
        $OBS = "observacao";

        $A = new UnidAtendto;
        if ($A->UnidAtendtoDEL($ID_UNIDATENDTO, $erro) > 0)
       /* if ($A->UnidAtendtoADD($ATIVO,
        $NOME,
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
        $OBS,
            $erro
        ) > 0)*/
       /* if ($A->UnidAtendtoUPD(ID_UNIDATENDTO,
        $ATIVO,
        $NOME,
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
        $OBS, $erro) > 0)*/
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