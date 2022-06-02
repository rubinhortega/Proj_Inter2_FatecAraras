<?php

include_once 'conn.php';

class Desastre
{
    private $erro = ""; //Guarda o erro
    private $DB   = "";

    //*************************************************
    //   SELECTS
    //*************************************************
    private $sql_insORA = 'INSERT INTO DESASTRE(ID_DESASTRE,
                                                TIPO,
                                                DESCRICAO,
                                                DATA,
                                                ATIVO,
                                                CIDADE,
                                                UF)
                                         VALUES(DESASTRE_SEQ.NEXTVAL,
                                                :TIPO,
                                                :DESCRICAO,
                                                :DATA,
                                                :ATIVO,
                                                :CIDADE,
                                                :UF)';

    private $sql_insMYSQL = 'INSERT INTO DESASTRE(ID_DESASTRE,
                                                  TIPO,
                                                  DESCRICAO,
                                                  DATA,
                                                  ATIVO,
                                                  CIDADE,
                                                  UF)
                                           VALUES(NEXT VALUE FOR DESASTRE_SEQ,
                                                  :TIPO,
                                                  :DESCRICAO,
                                                  :DATA,
                                                  :ATIVO,
                                                  :CIDADE,
                                                  :UF)';

    private $sql_upd = 'UPDATE DESASTRE
                           SET TIPO   = :TIPO,
                               DESCRICAO   = :DESCRICAO,
                               DATA   = :DATA,
                               ATIVO  = :ATIVO,
                               CIDADE = :CIDADE,
                               UF     = :UF
                         WHERE ID_DESASTRE = :ID_DESASTRE';

    private $sql_del = 'DELETE 
                          FROM DESASTRE 
                         WHERE ID_DESASTRE = :ID_DESASTRE';
    
    private $sql_loc = 'SELECT COUNT(*) REGS FROM DESASTRE WHERE ID_DESASTRE = :ID_DESASTRE';

    private $sql_get = 'SELECT ID_DESASTRE,
                               TIPO,
                               DESCRICAO,
                               DATA,
                               ATIVO,
                               CIDADE,
                               UF
                          FROM DESASTRE 
                         WHERE ID_DESASTRE = :ID_DESASTRE';

    private $sql_lst = 'SELECT ID_DESASTRE,
                               TIPO,
                               DESCRICAO,
                               DATA,
                               ATIVO,
                               CIDADE,
                               UF
                               FROM DESASTRE';
    //*************************************************

    //*************************************************
    //   MÉTODOS - VALIDAÇÕES
    //*************************************************
    private function DescricaoUnica($DESCRICAO, $ID)
    {
        $sql = 'SELECT COUNT(*) REGS FROM DESASTRE WHERE DESCRICAO = "'.$DESCRICAO.'" ';
        
        if ($ID != null)
            $sql = $sql . ' AND ID_DESASTRE <> '.$ID;
        
        if ($DESCRICAO != null)
            //if ($this->DB->PreparaSQL($sql))
            {
                $dados = $this->DB->OpenQuery($sql, null);
                
                $linhas = $dados->fetchAll();

                foreach($linhas as $lin) 
                {
                    if ($lin['REGS'] > 0)
                    {
                        $this->erro = $this->erro . "Descrição já cadastrada.<br/>";
                        return FALSE;
                    }
                    else
                        return TRUE;
                }
            }
    }


    //*************************************************

    //*************************************************
    //   MÉTODOS 
    //*************************************************
    public function DesastreADD($TIPO,
                                $DESCRICAO,
                                $DATA,
                                $ATIVO,
                                $CIDADE,
                                $UF,
                                &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            //************************************************
            // FAZ VALIDAçÔES
            //************************************************
            $this->DescricaoUnica($DESCRICAO, null);

            if ($this->erro <> "")
            {
              $erro = $this->erro;
              return 0;
            }
            //************************************************
            
            if ($this->DB->getBanco() == "ORACLE")
                $sql = $this->sql_insORA;
            else
                $sql = $this->sql_insMYSQL;

            if ($this->DB->PreparaSQL($sql))
            {
                $rec = $this->DB->Exec_SQL( array (
                                                ':TIPO'      => $TIPO,
                                                ':DESCRICAO' => $DESCRICAO,
                                                ':DATA'      => $DATA,
                                                ':ATIVO'     => $ATIVO,
                                                ':CIDADE'    => $CIDADE,
                                                ':UF'        => $UF
                                            ));
                
                $erro = $this->DB->getErro();

                if ($this->DB->getDebug() == TRUE)
                {
                    if ($rec > 0)
                        echo $rec. " linhas afetadas.<br/>";
                    else
                        echo "Nenhuma linha afetada.<br/>";
                }
                else
                    return $rec;
            }
        } catch(PDOException $e) 
        {
            $this->erro = 'Erro: ' . $e->getMessage();
        }
        unset($this->DB);
    }

    public function DesastreUPD($ID_DESASTRE,
                                $TIPO,
                                $DESCRICAO,
                                $DATA,
                                $ATIVO,
                                $CIDADE,
                                $UF,
                                &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            //************************************************
            // FAZ VALIDAçÔES
            //************************************************
            $this->DescricaoUnica($DESCRICAO, $ID_DESASTRE);

            if ($this->erro <> "")
            {
              $erro = $this->erro;
              return 0;
            }
            //************************************************

            $sql = $this->sql_upd;

            if ($this->DB->PreparaSQL($sql))
            {
                $rec = $this->DB->Exec_SQL( array (
                                        ':ID_DESASTRE' => $ID_DESASTRE,
                                        ':TIPO'        => $TIPO,
                                        ':DESCRICAO'   => $DESCRICAO,
                                        ':DATA'        => $DATA,
                                        ':ATIVO'       => $ATIVO,
                                        ':CIDADE'      => $CIDADE,
                                        ':UF'          => $UF
                            ));
                
                $erro = $this->DB->getErro();
                
                if ($this->DB->getDebug() == TRUE)
                {
                    if ($rec > 0)
                        echo $rec. " linhas afetadas.<br/>";
                    else
                        echo "Nenhuma linha afetada.<br/>";
                }
                else
                    return $rec;
                    
            }
        } catch(PDOException $e) 
        {
            $this->erro = 'Erro: ' . $e->getMessage();
        }
        unset($this->DB);
    }

    public function DesastreDEL($ID_DESASTRE, &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            $sql = $this->sql_del;

            if ($this->DB->PreparaSQL($sql))
            {
                $rec = $this->DB->Exec_SQL( array (
                                        ':ID_DESASTRE' => $ID_DESASTRE
                                    ));
                
                $erro = $this->DB->getErro();

                if ($this->DB->getDebug() == TRUE)
                {
                    if ($rec > 0)
                        echo $rec. " linhas afetadas.<br/>";
                    else
                        echo "Nenhuma linha afetada.<br/>";
                }
                else
                    return $rec;
            }
        } catch(PDOException $e) 
        {
            echo 'Erro: ' . $e->getMessage();
        }
        unset($this->DB);
    }

    public function DesastreListar(&$erro)
    {
        try 
        {
            $this->DB = new Conn;

            $sql = $this->sql_lst;

            $result = $this->DB->OpenQuery($sql, null);
            return $result->fetchAll();
        } catch(PDOException $e) 
        {
            echo 'Erro: ' . $e->getMessage();
        }
        unset($this->DB);
    }

    public function DesastreExiste($ID_DESASTRE, &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            $sql = $this->sql_loc;

            $result = $this->DB->OpenQuery($sql, array (
                                                    ':ID_DESASTRE' => $ID_DESASTRE
                                                    ));
            $result->fetchAll();
        } catch(PDOException $e) 
        {
            echo 'Erro: ' . $e->getMessage();
        }
        unset($this->DB);
    } 

    public function DesastreGet($ID_DESASTRE, &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            $sql = $this->sql_get;

            $result = $this->DB->OpenQuery($sql, array (
                                                    ':ID_DESASTRE' => $ID_DESASTRE
                                                    ));
            $result->fetchAll();
        } catch(PDOException $e) 
        {
            echo 'Erro: ' . $e->getMessage();
        }
        unset($this->DB);
    }     
    //*************************************************
}
?>