<?php

class Conn
{
    //*************************************************
    //   setagem do banco em utilização
    //*************************************************
    //private $BANCO = "ORACLE";
    private $BANCO = "MYSQL";

    //para produção deixar como FALSE
    private $DEBUG = /*TRUE;/*/FALSE;
    //*************************************************

    //*************************************************
    //   credenciais para cada banco
    //*************************************************
    //MySQL
    private $servername = '127.0.0.1'; //enderço servidor
    private $username   = 'FATECPROJ2';      //usuario de banco
    private $password   = 'FATEC2SEM';     //senha do banco
    private $dbname     = 'DESASTRE';//nome do banco
    
    //Oracle
    private $db_username = "FATECPROJ2";         //usuario de banco
    private $db_password = "FATEC2SEM";          //senha do banco
    private $db = "oci:dbname=server:1521/orcl"; //enderço servidor + porta + SID

    //sintaxe => [//]host_name[:port][/service_name][:server_type][/instance_name]
    //*************************************************
    
    private $conn; //guarda a conexão
    private $stmt; //para o PDO
    private $_SQL; //Guarda o sql
    private $erro; //Guarda o erro
    
    //*************************************************
    //   metodos - auto executaveis/gerenciados
    //*************************************************
    public function __construct()
    {
        try 
        {
            $this->erro = "";

            if ($this->BANCO == "ORACLE")
                $this->conn = new PDO($this->db, $this->db_username, $this->db_password);
            else
                $this->conn = new PDO("mysql:host=" . $this->servername . "; dbname=" . $this->dbname, $this->username, $this->password);

            if (!$this->conn)
            {
                $this->erro = "Erro de conexão";
                die($this->erro);
            }
        } catch(PDOException $e) 
        {
            $this->erro = "Erro de conexão" . $e->getMessage();
            die($this->erro);
        }
    }

    public function __destruct()
    {
        $this->conn = null;
    }
    //*************************************************

    //*************************************************
    //   metodos
    //*************************************************
    public function DriversAtivos_PDO()
    {
        echo "Drivers PDO habilitados<br/>";
        print_r(PDO::getAvailableDrivers());
        echo "<br/>";
    }

    public function getBanco()
    {
        return $this->BANCO;
    }
    public function getDebug()
    {
        return $this->DEBUG;
    }
    public function getErro()
    {
        return $this->erro;
    }

    public function PreparaSQL($txt)
    {
        $this->erro = "";
        $this->_SQL = $txt;

        try 
        {
            $this->stmt = $this->conn-> prepare($txt);
            return TRUE;
        } catch(PDOException $e) 
        {
            $this->erro = "Erro ao preparar SQL" . $e->getMessage();
            return FALSE;
        }
    }

    public function Exec_SQL($CMPS)
    {
        try 
        {
            $this->erro = "";

            if ($CMPS <> null)
            {
                $this->stmt->execute( $CMPS );
            }
            else
            {
                $this->stmt->execute();
            }

            return $this->stmt->rowCount();
        } catch(PDOException $e) 
        {
            $txt = "Erro ao executar SQL: <br/>";
            if ($this->DEBUG)
                $txt = $txt . "Comando: " . $this->_SQL . "<br/>";
            
            $txt = $txt . "Erro: " .$e->getMessage();
            
            $this->erro = $txt;
            
            if ($this->DEBUG)
              die($this->erro);

            return 0;
        }
    }

    public function OpenQuery($txt, $CMPS)
    {
        $this->_SQL = $txt;
        $this->erro = "";

        try 
        {
            if ($CMPS == null)
                $result = $this->conn->query($this->_SQL);
            else
            {
                if ($this->PreparaSQL($txt))
                {
                    $this->stmt->execute( $CMPS );
                    
                    $result = $this->stmt;//para usar o mesmo retorno
                }
            }
            
            return $result;
        } catch(PDOException $e) 
        {
            $txt = "Erro ao executar SQL: <br/>";
            if ($this->DEBUG)
                $txt = $txt . "Comando: " . $this->_SQL . "<br/>";
            
            $txt = $txt . "Erro: " .$e->getMessage();
            
            $this->erro = $txt;
            
            if ($this->DEBUG)
                die($this->erro);
        }
    }
    //*************************************************
}

?>