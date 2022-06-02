<?php
/*
valores para CMP tipo de desastre

NUMERACAO DA WIKIPÉDIA => https://pt.wikipedia.org/wiki/Desastre_natural#Refer%C3%AAncias  
    1 Afundamento e colapso
    2 Ciclones, furacões ou tufões
    3 Deslizamento ou escorregamento de terra
    4 Inundações
    5 Tempestades
    6 Tornados
    7 Outros fenômenos
    X -> PROCURADOS
*/
    include_once 'classes\desastre.php';

    //if (isset($_POST['gravar']))
    {
        $ID_DESASTRE = 2;
        $TIPO = '3';
        $DESCRICAO = 'Deslizamento de terra na favela Carcará';
        $DATA = '2020-11-21';
        $ATIVO = 'S';
        $CIDADE = 'Rio Grande';
        $UF = 'RN';

        $A = new Desastre;
//        if ($A->DesastreDEL($ID_DESASTRE, $erro) > 0)
        /*if ($A->DesastreADD($TIPO,
        $DESCRICAO,
        $DATA,
        $ATIVO,
        $CIDADE,
        $UF,
            $erro
        ) > 0)*/
        /*if ($A->DesastreUPD($ID_DESASTRE,
        $TIPO,
        $DESCRICAO,
        $DATA,
        $ATIVO,
        $CIDADE,
        $UF, $erro) > 0)*/
/*        {
            //echo 'Inserido com sucesso !';
            echo "ok";
            //exit;
        }
        else
            echo 'Falhou ! <br/> Motivo:<br/>'.$erro;
*/
        

/**/
    $r = $A->DesastreListar($erro);
    foreach ($r as $lin)
    {
        echo $lin['DESCRICAO'];
    }


/**/


    unset($A); 


    }
?>