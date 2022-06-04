<?php
    if (!empty($_GET['ID_DESASTRE']))
    {
        include_once 'classes\desastre.php';

        $id = $_GET['ID_DESASTRE'];

        $D = new Desastre;
        $linhas = $D->DesastreExiste($ID_DESASTRE, $erro);
        if ($erro != '')
        {
            if ($erro != "")
                echo 'Falhou ! <br/> Motivo:<br/>'.$erro;
            else
                echo 'Registro não encontrado.<br/>';
        }
        else
        {
            if ($D->DesastreDEL($ID_DESASTRE, $erro) > 0)
            {
                echo 'Excluído com sucesso !';
                header("location: index.php");
            }
            else
            {
                if ($erro != "")
                    echo 'Erro ao excluiru ! <br/> Motivo:<br/>'.$erro;
                else
                    echo 'Erro ao excluir.<br/>';
            }
        }

        echo "<p>
                <a href='index.php' class='btn btn-danger'>Voltar</a>
             </p>";
    }
?>