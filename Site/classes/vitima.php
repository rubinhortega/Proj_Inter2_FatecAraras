<?php

include_once 'conn.php';

class Vitima
{
    private $erro = ""; //Guarda o erro
    private $DB   = "";

    //*************************************************
    //   SELECTS
    //*************************************************
    private $sql_insORA = 'INSERT INTO LISTA(ID_LISTA,
                                             ID_DESASTRE,
                                             ID_UNIDATENDTO,
                                             INSERIDOPOR,
                                             NOME,
                                             CPF,
                                             IDADE,
                                             OBTO,
                                             ENCERRADO,
                                             DATA_HORA,
                                             CARACTERISTICAS)
                                      VALUES(LISTA_SEQ.NEXTVAL,
                                             :ID_DESASTRE,
                                             :ID_UNIDATENDTO,
                                             :INSERIDOPOR,
                                             :NOME,
                                             :CPF,
                                             :IDADE,
                                             :OBTO,
                                             :ENCERRADO,
                                             :DATA_HORA,
                                             TO_BLOB(UTL_RAW.CAST_TO_RAW(:CARACTERISTICAS)))';

    private $sql_insMYSQL = 'INSERT INTO LISTA(ID_LISTA,
                                               ID_DESASTRE,
                                               ID_UNIDATENDTO,
                                               INSERIDOPOR,
                                               NOME,
                                               CPF,
                                               IDADE,
                                               OBTO,
                                               ENCERRADO,
                                               DATA_HORA,
                                               CARACTERISTICAS)
                                        VALUES(NEXT VALUE FOR LISTA_SEQ,
                                               :ID_DESASTRE,
                                               :ID_UNIDATENDTO,
                                               :INSERIDOPOR,
                                               :NOME,
                                               :CPF,
                                               :IDADE,
                                               :OBTO,
                                               :ENCERRADO,
                                               :DATA_HORA,
                                               :CARACTERISTICAS)';

    private $sql_updORA = 'UPDATE LISTA
                              SET ID_UNIDATENDTO  = :ID_UNIDATENDTO,
                                  NOME            = :NOME,
                                  CPF             = :CPF,
                                  IDADE           = :IDADE,
                                  OBTO            = :OBTO,
                                  ENCERRADO       = :ENCERRADO,
                                  CARACTERISTICAS = :CARACTERISTICAS
                            WHERE ID_LISTA = :ID_LISTA';

    private $sql_updMySQL = 'UPDATE LISTA
                                SET ID_UNIDATENDTO  = :ID_UNIDATENDTO,
                                    NOME            = :NOME,
                                    CPF             = :CPF,
                                    IDADE           = :IDADE,
                                    OBTO            = :OBTO,
                                    ENCERRADO       = :ENCERRADO,
                                    CARACTERISTICAS = :CARACTERISTICAS
                              WHERE ID_LISTA = :ID_LISTA';

    private $sql_del = 'DELETE 
                          FROM LISTA 
                         WHERE ID_LISTA = :ID_LISTA';
    
    private $sql_loc = 'SELECT COUNT(*) REGS FROM LISTA WHERE ID_LISTA = :ID_LISTA';

    private $sql_get = 'SELECT ID_LISTA,
                               ID_DESASTRE,
                               ID_UNIDATENDTO,
                               INSERIDOPOR,
                               NOME,
                               CPF,
                               IDADE,
                               OBTO,
                               ENCERRADO,
                               DATA_HORA,
                               CARACTERISTICAS
                          FROM LISTA 
                         WHERE ID_LISTA = :ID_LISTA';
    //*************************************************

    //*************************************************
    //   MÉTODOS - VALIDAÇÕES
    //*************************************************


    //*************************************************

    //*************************************************
    //   MÉTODOS 
    //*************************************************
    public function VitimaADD($ID_DESASTRE,
                              $ID_UNIDATENDTO,
                              $INSERIDOPOR,
                              $NOME,
                              $CPF,
                              $IDADE,
                              $OBTO,
                              $ENCERRADO,
                              $DATA_HORA,
                              $CARACTERISTICAS,
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
                                                ':ID_DESASTRE'     => $ID_DESASTRE,
                                                ':ID_UNIDATENDTO'  => $ID_UNIDATENDTO,
                                                ':INSERIDOPOR'     => $INSERIDOPOR,
                                                ':NOME'            => $NOME,
                                                ':CPF'             => $CPF,
                                                ':IDADE'           => $IDADE,
                                                ':OBTO'            => $OBTO,
                                                ':ENCERRADO'       => $ENCERRADO,
                                                ':DATA_HORA'       => $DATA_HORA,
                                                ':CARACTERISTICAS' => $CARACTERISTICAS
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

    public function VitimaUPD($ID_LISTA,
                              $ID_UNIDATENDTO,
                              $NOME,
                              $CPF,
                              $IDADE,
                              $OBTO,
                              $ENCERRADO,
                              $CARACTERISTICAS,
                              &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            if ($this->DB->getBanco() == "ORACLE")
                $sql = $this->sql_updORA;
            else
                $sql = $this->sql_updMySQL;

            if ($this->DB->PreparaSQL($sql))
            {
                $rec = $this->DB->Exec_SQL( array (
                                        ':ID_LISTA'        => $ID_LISTA,
                                        ':ID_UNIDATENDTO'  => $ID_UNIDATENDTO,
                                        ':NOME'            => $NOME,
                                        ':CPF'             => $CPF,
                                        ':IDADE'           => $IDADE,
                                        ':OBTO'            => $OBTO,
                                        ':ENCERRADO'       => $ENCERRADO,
                                        ':CARACTERISTICAS' => $CARACTERISTICAS
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

    public function VitimaDEL($ID_LISTA, &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            $sql = $this->sql_del;

            if ($this->DB->PreparaSQL($sql))
            {
                $rec = $this->DB->Exec_SQL( array (
                                        ':ID_LISTA' => $ID_LISTA
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

    public function VitimaListar(&$erro)
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

    public function VitimaExiste($ID_LISTA, &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            $sql = $this->sql_loc;

            $result = $this->DB->OpenQuery($sql, array (
                                                    ':ID_LISTA' => $ID_LISTA
                                                    ));
            $result->fetchAll();
        } catch(PDOException $e) 
        {
            echo 'Erro: ' . $e->getMessage();
        }
        unset($this->DB);
    } 

    public function VitimaGet($ID_LISTA, &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            $sql = $this->sql_get;

            $result = $this->DB->OpenQuery($sql, array (
                                                    ':ID_LISTA' => $ID_LISTA
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