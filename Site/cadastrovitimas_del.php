<?php
    if (!empty($_GET['$ID_LISTA']))
    {
        include_once 'classes\vitima.php';

        $id = $_GET['$ID_LISTA'];

        $V = new Vitima;
        $linhas = $V->VitimaExiste($ID_LISTA, $erro);
        if ($erro != '')
        {
            if ($erro != "")
                echo 'Falhou ! <br/> Motivo:<br/>'.$erro;
            else
                echo 'Registro não encontrado.<br/>';
        }
        else
        {
            if ($V->VitimaDEL($ID_LISTA, $erro) > 0)
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