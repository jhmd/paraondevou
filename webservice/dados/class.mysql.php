<?php
$mysqlIncluded = true;

class connection {
   var $application = "mprof";
   var $host =  "localhost";
   var $login = "";
   var $senha = "";
   var $db = "";
   var $admMail = "mprof <mprof@hardoom.com>";
   var $conID = NULL;
   


   # Cria a instancia do objeto de log ##########################################################
   function connection() {
	  $this->connect();
   }
   ##############################################################################################

   # Conectar com o servidor MySQL e selecionar uma base de dados ###############################
   function connect() {
      $err = "<font size='2' face='Verdana,Arial'><b> $this->application <br><br> <font color='#FF0000'>- Erro ao tentar conectar-se com o servidor de banco de dados.</font></b><br><br>Favor <a href='mailto:$this->admMail'>entrar em contato</a> com o administrador do site.";

      $connection = @mysql_connect($this->host,$this->login,$this->senha);
      if (!$connection) {
         print($err);
         exit;
      }

      $err = "<font size='2' face='Verdana,Arial'><b> $this->application <br><br> - Conectado ao servidor de banco de dados. <br> <font color='#FF0000'>- Erro ao tentar selecionar a base de dados.</font></b><br><br>Favor <a href='mailto:$this->admMail'>entrar em contato</a> com o administrador do site.";
      $database = @mysql_select_db($this->db);

      if (!$database) {
         $this->close($connection);
		 print($err);
         exit;
      }

      $this->conID = $connection;
   }
   ##############################################################################################

   # Fechar a conexão MySQL #####################################################################
   function close() {
      mysql_close($this->conID);
   }
   ##############################################################################################

} # Final da Classe connection
  ##############################################################################################



class recordSet extends connection {

   var $numFields;

   # Validar caracteres maliciosos na sentenca SQL ##############################################
   function checkSql($sql, $mode) {

      $valid = true;
      $sql = strtolower($sql);

      if ($mode == "execute")
         $dic = array ("alter table", "create table", "drop table", "alter database", "create database", "drop database", "rename table", "drop index");
      else
         $dic = array ("alter table", "create table", "drop table", "alter database", "create database", "drop database", "rename table", "drop index", "delete");

      while(list($id, $word) = each($dic))
         if (strpos($sql, $word) !== false) $valid = false;

	  return $valid;
   }
   ##############################################################################################


   # executa uma consulta a base de dados MySQL #################################################
   function select($sql) {
	  if ($this->checkSql($sql, "select")) {
         $err = "<font size='2' face='Verdana,Arial'><b> $this->application <br><br> - Conectado ao servidor de banco de dados. <br> - Base de dados selecionada. <font color='#FF0000'><br>- Erro ao consultar na base de dados.</font></b><br><br>Favor <a href='mailto:$this->admMail'>entrar em contato</a> com o administrador do site.";
		$result = @mysql_query($sql, $this->conID);

         if (!$result) {
            $this->close();
            //print($sql."<p>".$err);
            exit;
         }
         else {
            $this->numFields = @mysql_num_fields($result);
			return $result;
         }
      }
      else {
          $this->close();
          print($err);
          exit;
      }
   }
   ##############################################################################################


   # Retorna uma linha da consulta MySQL ########################################################
   function setRow($result) {
      $row = @mysql_fetch_array($result);
	  if (!$row) {
	  	mysql_free_result($result);
		//$this->close;
		}
     return $row;
   }
   ##############################################################################################

   # Retorna o ultimo Id gerado por um campo auto incremento ####################################
   function getLastID() {

     return @mysql_insert_id($this->conID);
   }
   ##############################################################################################


   # Retorna um array com os campos #############################################################
   function getFields($tableName) {

     return @mysql_list_fields($this->db, $tableName, $this->conID);
   }
   ##############################################################################################


   # Retorna o nome do campo ####################################################################
   function getFieldName($result, $index) {

     return @mysql_field_name($result, $index);
   }
   ##############################################################################################


   # Retorna o nome do campo ####################################################################
   function fieldsCount($result) {

     return @mysql_num_fields($result);
   }
   ##############################################################################################


   # Retorna o tamanho do campo #################################################################
   function fieldLen($result, $fieldIndex) {

     return @mysql_field_len($result, $fieldIndex);
   }
   ##############################################################################################


   # Retorna o número de registros de uma consulta MySQL ########################################
   function recordCount($result) {

     return @mysql_num_rows($result);
   }
   ##############################################################################################


   # Executa uma sentenca SQL ###################################################################
   function exec($sql) {
      if ($this->checkSql($sql, "execute")) {
		  $err = "<font size='2' face='Verdana,Arial'><b> $this->application <br><br> - Conectado ao servidor de banco de dados. <br> - Base de dados selecionada. <font color='#FF0000'><br>- Erro ao executar a sentença SQL na base de dados.</font></b><br><br>Favor <a href='mailto:$this->admMail'>entrar em contato</a> com o administrador do site.";

          if (!mysql_query($sql, $this->conID)) {
             $this->close();
             print($err);
             exit;
          }
      }
      else {
         $this->close();
         print($err);
         exit;
      }
   }
   ##############################################################################################


   # Deleta um registro #########################################################################
   function erase($id, $idFieldName, $table) {

     $sql = "Delete From $table Where $idFieldName = $id";
     $this->exec($sql);
   }
   ##############################################################################################


   # Deleta registros com ID dentro do array ####################################################
    // function erases($array, $idFieldName, $table) {
	// 
	//       sort(&$array);
	//       $array_ids = join(",",$array);
	//       $sql = "Delete From $table Where $idFieldName In ($array_ids)";
	//       $this->exec($sql);
	//    }
   ##############################################################################################

   # Deleta registros com ID dentro do array ####################################################
	function eraseString($string,$idFieldName,$table) {
	  $sql = "Delete From $table Where $idFieldName In ($string)";
      $this->exec($sql);
	}
   ##############################################################################################

   # Escreve os items de um <input select> de acordo com o SQL ##################################
   function comboBox($sql, $selected){

      $result = $this->select($sql);

      while($table = $this->SetRow($result)) {
         if($selected == $table[0])
            print("<option value='".$table[0]."' selected>".$table[1]."</option>");
         else
            print("<option value='".$table[0]."'>".$table[1]."</option>");
      }
   }
   ##############################################################################################


   # Retorna um array ###########################################################################
   function inputSelect($sql, $selected){
	  $string = "";
      $result = $this->select($sql);

      $i = 0;
	  $arr = array();

	  while($list = $this->SetRow($result)) {
	  	$arr[$i][0] = $list[0];
	  	$arr[$i][1] = $list[1];
		$i++;
      }

	  return $arr;
   }
   ##############################################################################################
} 

?>