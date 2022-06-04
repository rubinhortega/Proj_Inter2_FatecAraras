<?php
    if (!empty($_GET['ID_UNIDATENDTO']))
    {
        include_once 'classes\unidatendto.php';

        $id = $_GET['ID_UNIDATENDTO'];

        $U = new UnidAtendto;
        $linhas = $U->UnidAtendtoExiste($ID_UNIDATENDTO, $erro);
        if ($erro != '')
        {
            if ($erro != "")
                echo 'Falhou ! <br/> Motivo:<br/>'.$erro;
            else
                echo 'Registro não encontrado.<br/>';
        }
        else
        {
            if ($U->UnidAtendtoDEL($ID_UNIDATENDTO, $erro) > 0)
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