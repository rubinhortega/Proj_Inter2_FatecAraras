<?php
    include_once 'classes\vitima.php';

    //if (isset($_POST['gravar']))
    {
        $ID_LISTA       = 3;
        $ID_DESASTRE    = 7;  //FK
        $ID_UNIDATENDTO = null;  //FK
        /*D-DEFESA CIVIL,ORGÃO | P-PESSOA,PERENTE,CONHECIDO*/        
        $INSERIDOPOR    = 'D';
        $NOME           = 'Joana Paulino';
        $CPF            = NULL;
        $IDADE          = 11;
        $OBTO           = "N";
        $ENCERRADO      = "N";
        $DATA_HORA      = "2022-03-12 18:01:15";
        $CARACTERISTICAS = 'criança menor de idade, morena, com sobrepeso, cabelo liso, mancha nas costas, pinta no rosto lado direito queixo';


        $A = new Vitima;
        if ($A->VitimaDEL($ID_LISTA, $erro) > 0)
        /*if ($A->VitimaADD($ID_DESASTRE,
        $ID_UNIDATENDTO,
        $INSERIDOPOR,
        $NOME,
        $CPF,
        $IDADE,
        $OBTO,
        $ENCERRADO,
        $DATA_HORA,
        $CARACTERISTICAS,
            $erro
        ) > 0)*/
        /*if ($A->VitimaUPD($ID_LISTA,
                              $ID_UNIDATENDTO,
                              $NOME,
                              $CPF,
                              $IDADE,
                              $OBTO,
                              $ENCERRADO,
                              $CARACTERISTICAS, $erro) > 0)*/
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