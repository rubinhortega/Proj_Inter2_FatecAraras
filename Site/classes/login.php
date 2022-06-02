<?php

include_once 'conn.php';

class Login
{
    private $erro = ""; //Guarda o erro
    private $DB   = "";

    //*************************************************
    //   SELECTS--COUNT(*) REGS,
    //*************************************************
    private $sql_loc = 'SELECT COUNT(*) REGS,
                               CASE 
                                 WHEN EHOFICIAL = "N" THEN 0
                               ELSE 1
                               END AS NIVEL,
                               ID_PESSOA,
                               ATIVO
                          FROM PESSOA 
                         WHERE CPF   = :CPF
                           AND SENHA = :PASS';
    //*************************************************

    //*************************************************

    //*************************************************
    //   MÉTODOS 
    //*************************************************
    public function LogIn($CPF, $PASS, &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            $sql = $this->sql_loc;
            
            $result = $this->DB->OpenQuery($sql, array (
                                                    ':CPF'   => $CPF,
                                                    ':PASS' => $PASS
                                                    ));
            
            if ($result != null)
              $result = $result->fetchAll();
            foreach ($result as $lin)
            {
                if ($lin['REGS'] <= '0')
                {
                  echo '</br>1';
                  $result = 0;
                  echo '2';
                  $erro   = 'Usuário ou senha inválido.';
                  echo '3';
                }
                if ($lin['ATIVO'] == 'N')
                {
                  $result = 0;
                  $erro   = 'Usuário inativo.';
                }
                if ($lin['ATIVO'] == 'B')
                {
                  $result = 0;
                  $erro   = 'Usuário bloqueado.';
                }
                if ($lin['ATIVO'] == 'S')
                {
                  $result = array('NIVEL', $lin['NIVEL']);
                }
            }

            return $result;
        } catch(PDOException $e) 
        {
            echo 'Erro: ' . $e->getMessage();
        }
        unset($this->DB);
    } 
    //*************************************************
}
?>