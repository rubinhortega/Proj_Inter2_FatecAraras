<?php

include_once 'conn.php';

class Pessoa
{
    private $erro = ""; //Guarda o erro
    private $DB   = "";

    //*************************************************
    //   SELECTS
    //*************************************************
    private $sql_insORA = 'INSERT INTO PESSOA(ID_PESSOA,
                                              CPF,
                                              NOME,
                                              FONE,
                                              EHWHATS,
                                              SENHA,
                                              EMAIL,
                                              ATIVO,
                                              EHOFICIAL,
                                              LIB_CADDESASTRE,
                                              REGISTRO_OFICIAL,
                                              CONTATOS,
                                              END_LOG,
                                              END_NUM,
                                              END_BAI,
                                              END_CID,
                                              END_CEP,
                                              END_COM,
                                              END_UF) 
                                       VALUES(PESSOA_SEQ.NEXTVAL,
                                              :CPF,
                                              :NOME,
                                              :FONE,
                                              :EHWHATS,
                                              :SENHA,
                                              :EMAIL,
                                              :ATIVO,
                                              :EHOFICIAL,
                                              :LIB_CADDESASTRE,
                                              :REGISTRO_OFICIAL,
                                              TO_BLOB(UTL_RAW.CAST_TO_RAW(:CONTATOS)),
                                              :END_LOG,
                                              :END_NUM,
                                              :END_BAI,
                                              :END_CID,
                                              :END_CEP,
                                              :END_COM,
                                              :END_UF)';

    private $sql_insMYSQL = 'INSERT INTO PESSOA(ID_PESSOA,
                                                CPF,
                                                NOME,
                                                FONE,
                                                EHWHATS,
                                                SENHA,
                                                EMAIL,
                                                ATIVO,
                                                EHOFICIAL,
                                                LIB_CADDESASTRE,
                                                REGISTRO_OFICIAL,
                                                CONTATOS,
                                                END_LOG,
                                                END_NUM,
                                                END_BAI,
                                                END_CID,
                                                END_CEP,
                                                END_COM,
                                                END_UF) 
                                        VALUES(NEXT VALUE FOR PESSOA_SEQ,
                                                :CPF,
                                                :NOME,
                                                :FONE,
                                                :EHWHATS,
                                                :SENHA,
                                                :EMAIL,
                                                :ATIVO,
                                                :EHOFICIAL,
                                                :LIB_CADDESASTRE,
                                                :REGISTRO_OFICIAL,
                                                :CONTATOS,
                                                :END_LOG,
                                                :END_NUM,
                                                :END_BAI,
                                                :END_CID,
                                                :END_CEP,
                                                :END_COM,
                                                :END_UF)';

    private $sql_updORA = 'UPDATE  PESSOA 
                              SET  NOME             = :NOME,
                                   FONE             = :FONE,
                                   EHWHATS          = :EHWHATS,
                                   EMAIL            = :EMAIL,
                                   ATIVO            = :ATIVO,
                                   EHOFICIAL        = :EHOFICIAL,
                                   LIB_CADDESASTRE  = :LIB_CADDESASTRE,
                                   REGISTRO_OFICIAL = :REGISTRO_OFICIAL,
                                   CONTATOS         = TO_BLOB(UTL_RAW.CAST_TO_RAW(:CONTATOS)),
                                   END_LOG          = :END_LOG,
                                   END_NUM          = :END_NUM,
                                   END_BAI          = :END_BAI,
                                   END_CID          = :END_CID,
                                   END_CEP          = :END_CEP,
                                   END_COM          = :END_COM,
                                   END_UF           = :END_UF
                             WHERE ID_PESSOA = :ID_PESSOA';

    private $sql_updMYSQL = 'UPDATE  PESSOA 
                                SET  NOME             = :NOME,
                                     FONE             = :FONE,
                                     EHWHATS          = :EHWHATS,
                                     EMAIL            = :EMAIL,
                                     ATIVO            = :ATIVO,
                                     EHOFICIAL        = :EHOFICIAL,
                                     LIB_CADDESASTRE  = :LIB_CADDESASTRE,
                                     REGISTRO_OFICIAL = :REGISTRO_OFICIAL,
                                     CONTATOS         = :CONTATOS,
                                     END_LOG          = :END_LOG,
                                     END_NUM          = :END_NUM,
                                     END_BAI          = :END_BAI,
                                     END_CID          = :END_CID,
                                     END_CEP          = :END_CEP,
                                     END_COM          = :END_COM,
                                     END_UF           = :END_UF
                               WHERE ID_PESSOA = :ID_PESSOA';

    private $sql_delete = 'DELETE 
                             FROM PESSOA 
                            WHERE ID_PESSOA = :ID_PESSOA';
    //*************************************************

    //*************************************************
    //   MÉTODOS - VALIDAÇÕES
    //*************************************************
    private function CPF($CPF)
    {
        if ($CPF == null)
        {
            $this->erro = $this->erro . "CPF deve ser informado.<br/>";
            return FALSE;
        }
        else
            return TRUE;
    }
    private function CPFUnico($CPF, $ID)
    {
        $sql = 'SELECT COUNT(*) REGS FROM PESSOA WHERE CPF = '.$CPF;
        if ($ID != null)
            $sql = $sql . ' AND $ID <> '.$ID;
        
        if ($CPF != null)
            //if ($this->DB->PreparaSQL($sql))
            {
                $dados = $this->DB->OpenQuery($sql);
                
                $linhas = $dados->fetchAll();

                foreach($linhas as $lin) 
                {
                    if ($lin['REGS'] > 0)
                    {
                        $this->erro = $this->erro . "CPF já cadastrado.<br/>";
                        return FALSE;
                    }
                    else
                        return TRUE;
                }
            }
    }
    private function Nome($Nome)
    {
        if ($Nome == null)
        {
            $this->erro = $this->erro . "Nome deve ser informado.<br/>";
            return FALSE;
        }
        else
            return TRUE;
    }
    //*************************************************

    //*************************************************
    //   MÉTODOS 
    //*************************************************
    public function PessoaADD($CPF,
                              $NOME,
                              $FONE,
                              $EHWHATS,
                              $SENHA,
                              $EMAIL,
                              $ATIVO,
                              $EHOFICIAL,
                              $LIB_CADDESASTRE,
                              $REGISTRO_OFICIAL,
                              $CONTATOS,
                              $END_LOG,
                              $END_NUM,
                              $END_BAI,
                              $END_CID,
                              $END_CEP,
                              $END_COM,
                              $END_UF,
                              &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            //************************************************
            // FAZ VALIDAçÔES
            //************************************************
            $this->CPF($CPF);
            $this->CPFUnico($CPF, null);
            $this->Nome($NOME);

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
                                                ':CPF'              => $CPF,
                                                ':NOME'             => $NOME,
                                                ':FONE'             => $FONE,
                                                ':EHWHATS'          => $EHWHATS,
                                                ':SENHA'            => $SENHA,
                                                ':EMAIL'            => $EMAIL,
                                                ':ATIVO'            => $ATIVO,
                                                ':EHOFICIAL'        => $EHOFICIAL,
                                                ':LIB_CADDESASTRE'  => $LIB_CADDESASTRE,
                                                ':REGISTRO_OFICIAL' => $REGISTRO_OFICIAL,
                                                ':CONTATOS'         => $CONTATOS,
                                                ':END_LOG'          => $END_LOG,
                                                ':END_NUM'          => $END_NUM,
                                                ':END_BAI'          => $END_BAI,
                                                ':END_CID'          => $END_CID,
                                                ':END_CEP'          => $END_CEP,
                                                ':END_COM'          => $END_COM,
                                                ':END_UF'           => $END_UF
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

    public function PessoaUPD($ID_PESSOA,
                              $NOME,
                              $FONE,
                              $EHWHATS,
                              $EMAIL,
                              $ATIVO,
                              $EHOFICIAL,
                              $LIB_CADDESASTRE,
                              $REGISTRO_OFICIAL,
                              $CONTATOS,
                              $END_LOG,
                              $END_NUM,
                              $END_BAI,
                              $END_CID,
                              $END_CEP,
                              $END_COM,
                              $END_UF,
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
                                        ':ID_PESSOA'        => $ID_PESSOA,
                                        ':NOME'             => $NOME,
                                        ':FONE'             => $FONE,
                                        ':EHWHATS'          => $EHWHATS,
                                        ':EMAIL'            => $EMAIL,
                                        ':ATIVO'            => $ATIVO,
                                        ':EHOFICIAL'        => $EHOFICIAL,
                                        ':LIB_CADDESASTRE'  => $LIB_CADDESASTRE,
                                        ':REGISTRO_OFICIAL' => $REGISTRO_OFICIAL,
                                        ':CONTATOS'         => $CONTATOS,
                                        ':END_LOG'          => $END_LOG,
                                        ':END_NUM'          => $END_NUM,
                                        ':END_BAI'          => $END_BAI,
                                        ':END_CID'          => $END_CID,
                                        ':END_CEP'          => $END_CEP,
                                        ':END_COM'          => $END_COM,
                                        ':END_UF'           => $END_UF
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

    public function PessoaDEL($ID_PESSOA, &$erro)
    {
        try 
        {
            $this->DB = new Conn;

            $sql = $this->sql_delete;

            if ($this->DB->PreparaSQL($sql))
            {
                $rec = $this->DB->Exec_SQL( array (
                                        ':ID_PESSOA' => $ID_PESSOA
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
    //*************************************************
}
/*$nome = $_POST['nome'];
$endereco = $_POST['endereco'];
$cpf = $_POST['cpf'];
$idade = $_POST['idade'];
$sexo = $_POST['sexo'];*/

/*$DB = new Conn;

$DB->adicionar_cliente($nome, $endereco, $idade, $cpf, $sexo);

unset($DB);*/

$P = new Pessoa;

//INSERT 
/*
if ($P->PessoaADD(11167662,
              'Rubens barichello',
              '(19)99988-5555',
              'S',
              'semnenha',
              'eu@uol.com.br',
              'S',
              'S',
              'S',
              'CTZ2-Marinha 289545-ALPHA',
              'telefone da visinha 19-65899-9999 Joana Dark',
              'Rua Godofredo Bartolomeu',
              600,
              'Bairro Boa Vista',
              'Cidade de Deus',
              13488760,
              'bloco 20 apto 88',
              'SP',
              $erro
    ) > 0)
    echo 'Inserido com sucesso !';
  else
  echo 'Falhou ! <br/> Motivo:<br/>'.$erro;
*/

//UPDATE
/*if ($P->PessoaUPD(30, //chave q está alterando
              'Rubens barichello alterado',
              '(19)99988-5555',
              'S',
              'eu@uol.com.br',
              'S',
              'S',
              'S',
              'CTZ2-Marinha 289545-ALPHA',
              'telefone da visinha 19-65899-9999 Joana Dark',
              'Rua Godofredo Bartolomeu',
              600,
              'Bairro Boa Vista',
              'Cidade de Deus',
              13488760,
              'bloco 20 apto 88',
              'SP',
              $erro
    ) > 0)
    echo 'Alterado com sucesso !';
  else
  echo 'Falhou ! <br/> Motivo:<br/>'.$erro;*/

//DELETE
if ($P->PessoaDEL(30, //chave q está alterando
              $erro
    ) > 0)
    echo 'Excluído com sucesso !';
  else
  {
      if ($erro != "")
        echo 'Falhou ! <br/> Motivo:<br/>'.$erro;
      else
        echo 'Registro não encontrado.<br/>';
  }

unset($P);  

?>