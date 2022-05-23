<?php

include_once 'conn.php';

class UnidAtendto
{
    private $erro = ""; //Guarda o erro
    private $DB   = "";

    //*************************************************
    //   SELECTS
    //*************************************************
    private $sql_insORA = 'INSERT INTO UNIDATENDTO(ID_UNIDATENDTO,
                                                   ATIVO,
                                                   FONES,
                                                   EMAIL,
                                                   SITE,
                                                   NOME_RESP,
                                                   END_LOG,
                                                   END_NUM,
                                                   END_BAI,
                                                   END_CID,
                                                   END_CEP,
                                                   END_COM,
                                                   END_UF,
                                                   OBS)
                                            VALUES(UNIDATENDTO_SEQ.NEXTVAL,
                                                   :ATIVO,
                                                   :FONES,
                                                   :EMAIL,
                                                   :SITE,
                                                   :NOME_RESP,
                                                   :END_LOG,
                                                   :END_NUM,
                                                   :END_BAI,
                                                   :END_CID,
                                                   :END_CEP,
                                                   :END_COM,
                                                   :END_UF,
                                                   TO_BLOB(UTL_RAW.CAST_TO_RAW(:OBS)))';
    
    private $sql_insMYSQL = 'INSERT INTO UNIDATENDTO(ID_UNIDATENDTO,
                                                     ATIVO,
                                                     FONES,
                                                     EMAIL,
                                                     SITE,
                                                     NOME_RESP,
                                                     END_LOG,
                                                     END_NUM,
                                                     END_BAI,
                                                     END_CID,
                                                     END_CEP,
                                                     END_COM,
                                                     END_UF,
                                                     OBS)
                                              VALUES(NEXT VALUE FOR UNIDATENDTO_SEQ,
                                                     :ATIVO,
                                                     :FONES,
                                                     :EMAIL,
                                                     :SITE,
                                                     :NOME_RESP,
                                                     :END_LOG,
                                                     :END_NUM,
                                                     :END_BAI,
                                                     :END_CID,
                                                     :END_CEP,
                                                     :END_COM,
                                                     :END_UF,
                                                     :OBS)';

    private $sql_updORA = 'UPDATE UNIDATENDTO
                              SET ATIVO     = :ATIVO,
                                  FONES     = :FONES,
                                  EMAIL     = :EMAIL,
                                  SITE      = :SITE,
                                  NOME_RESP = :NOME_RESP,
                                  END_LOG   = :END_LOG,
                                  END_NUM   = :END_NUM,
                                  END_BAI   = :END_BAI,
                                  END_CID   = :END_CID,
                                  END_CEP   = :END_CEP,
                                  END_COM   = :END_COM,
                                  END_UF    = :END_UF,
                                  OBS       = TO_BLOB(UTL_RAW.CAST_TO_RAW(:OBS))
                            WHERE ID_UNIDATENDTO = :ID_UNIDATENDTO';

    private $sql_updMYSQL = 'UPDATE UNIDATENDTO
                                SET ATIVO     = :ATIVO,
                                    FONES     = :FONES,
                                    EMAIL     = :EMAIL,
                                    SITE      = :SITE,
                                    NOME_RESP = :NOME_RESP,
                                    END_LOG   = :END_LOG,
                                    END_NUM   = :END_NUM,
                                    END_BAI   = :END_BAI,
                                    END_CID   = :END_CID,
                                    END_CEP   = :END_CEP,
                                    END_COM   = :END_COM,
                                    END_UF    = :END_UF,
                                    OBS       = :OBS
                              WHERE ID_UNIDATENDTO = :ID_UNIDATENDTO';

    private $sql_del = 'DELETE 
                          FROM UNIDATENDTO 
                         WHERE ID_UNIDATENDTO = :ID_UNIDATENDTO';
    
    private $sql_loc = 'SELECT COUNT(*) REGS FROM UNIDATENDTO WHERE ID_UNIDATENDTO = :ID_UNIDATENDTO';

    private $sql_get = 'SELECT ID_UNIDATENDTO,
                               ATIVO,
                               FONES,
                               EMAIL,
                               SITE,
                               NOME_RESP,
                               END_LOG,
                               END_NUM,
                               END_BAI,
                               END_CID,
                               END_CEP,
                               END_COM,
                               END_UF,
                               OBS
                          FROM UNIDATENDTO 
                         WHERE ID_UNIDATENDTO = :ID_UNIDATENDTO';
    //*************************************************

    //*************************************************
    //   MÉTODOS - VALIDAÇÕES
    //*************************************************


    //*************************************************

    //*************************************************
    //   MÉTODOS 
    //*************************************************
    public function UnidAtendtoADD($ATIVO,
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
                                   &$erro)
    {
        try 
        {
            $this->DB = new Conn;
            
            if ($this->DB->getBanco() == "ORACLE")
                $sql = $this->sql_insORA;
            else
                $sql = $this->sql_insMYSQL;

            if ($this->DB->PreparaSQL($sql))
            {
                $rec = $this->DB->Exec_SQL( array (
                                                ':ATIVO'     => $ATIVO,
                                                ':FONES'     => $FONES,
                                                ':EMAIL'     => $EMAIL,
                                                ':SITE'      => $SITE,
                                                ':NOME_RESP' => $NOME_RESP,
                                                ':END_LOG'   => $END_LOG,
                                                ':END_NUM'   => $END_NUM,
                                                ':END_BAI'   => $END_BAI,
                                                ':END_CID'   => $END_CID,
                                                ':END_CEP'   => $END_CEP,
                                                ':END_COM'   => $END_COM,
                                                ':END_UF'    => $END_UF,
                                                ':OBS'       => $OBS
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

    public function UnidAtendtoUPD($ID_UNIDATENDTO,
                                   $ATIVO,
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
                                   &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            //************************************************
            // FAZ VALIDAçÔES
            //************************************************
            $this->Nome($NOME);

            if ($this->erro <> "")
            {
              $erro = $this->erro;
              return 0;
            }
            //************************************************

            if ($this->DB->getBanco() == "ORACLE")
                $sql = $this->sql_updORA;
            else
                $sql = $this->sql_updMYSQL;


            if ($this->DB->PreparaSQL($sql))
            {
                $rec = $this->DB->Exec_SQL( array (
                                        ':ID_UNIDATENDTO' => $ID_UNIDATENDTO,
                                        ':ATIVO'          => $ATIVO,
                                        ':FONES'          => $FONES,
                                        ':EMAIL'          => $EMAIL,
                                        ':SITE'           => $SITE,
                                        ':NOME_RESP'      => $NOME_RESP,
                                        ':END_LOG'        => $END_LOG,
                                        ':END_NUM'        => $END_NUM,
                                        ':END_BAI'        => $END_BAI,
                                        ':END_CID'        => $END_CID,
                                        ':END_CEP'        => $END_CEP,
                                        ':END_COM'        => $END_COM,
                                        ':END_UF'         => $END_UF,
                                        ':OBS'            => $OBS
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

    public function UnidAtendtoDEL($ID_UNIDATENDTO, &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            $sql = $this->sql_del;

            if ($this->DB->PreparaSQL($sql))
            {
                $rec = $this->DB->Exec_SQL( array (
                                        ':ID_UNIDATENDTO' => $ID_UNIDATENDTO
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

    public function UnidAtendtoListar(&$erro)
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

    public function UnidAtendtoExiste($ID_UNIDATENDTO, &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            $sql = $this->sql_loc;

            $result = $this->DB->OpenQuery($sql, array (
                                                    ':ID_UNIDATENDTO' => $ID_UNIDATENDTO
                                                    ));
            return $result->fetchAll();
        } catch(PDOException $e) 
        {
            echo 'Erro: ' . $e->getMessage();
        }
        unset($this->DB);
    } 

    public function UnidAtendtoGet($ID_UNIDATENDTO, &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            $sql = $this->sql_get;

            $result = $this->DB->OpenQuery($sql, array (
                                                    ':ID_UNIDATENDTO' => $ID_UNIDATENDTO
                                                    ));
            return $result->fetchAll();
        } catch(PDOException $e) 
        {
            echo 'Erro: ' . $e->getMessage();
        }
        unset($this->DB);
    }     
    //*************************************************
}
?>