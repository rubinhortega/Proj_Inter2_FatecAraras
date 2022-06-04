<?php
    if (!empty($_GET['$ID_PESSOA']))
    {
        include_once 'classes\pessoa.php';

        $id = $_GET['$ID_PESSOA'];

        $P = new Pessoa;
        $linhas = $P->PessoaExiste($ID_PESSOA, $erro);
        if ($erro != '')
        {
            if ($erro != "")
                echo 'Falhou ! <br/> Motivo:<br/>'.$erro;
            else
                echo 'Registro não encontrado.<br/>';
        }
        else
        {
            if ($P->PessoaDEL($ID_PESSOA, $erro) > 0)
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