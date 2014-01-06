<?php
require_once('../helper/funcoes.php');
//require_once('../Entity/Aluno.php');

class Query {

	private static $conn;

		public function conexao(){
			$conecta = mysql_connect("localhost", "root", "") or print (mysql_error()); 
			mysql_select_db("Monitoria", $conecta) or print(mysql_error()); 
			/*$banco = 'Monitoria';
			$usuario = 'root';
			$senha = '';
			$host = 'localhost';
			$conn = mysql_connect($host,$usuario,$senha) or die ('Conection error');//conect
			mysql_select_db($banco) or die ('Database error');*/

			////permite acentuacao
			mysql_query("SET NAMES 'UTF8'");
			mysql_query("SET character_set_connection=utf8");
			mysql_query("SET character_set_client=utf8");
			mysql_query("SET character_set_results=utf8");
			
			$conn = $conecta;
			return $conn;
		}

		private function criptografar($senha)
		{
			return md5($senha);
		}

		public function existeUsuario($cpf)
		{
			$selecionar = self::conn()->prepare("SELECT id from Aluno where cpf='$cpf'");
			$selecionar->execute();

			if($selecionar->rowCount()>=1)
				return true;
			else
				return false;
		}

		//atualiza
		public function atualiza($dados=array(),$tabela,$id){
				switch($tabela)
				{
					case 'Aluno':	
					$alteracao="nome ='$dados[0]', cpf ='$dados[1]', rg = '$dados[2]', email ='$dados[3]', senha ='$dados[4]', endereco='$dados[5]', telefone ='$dados[6]'";
					$idS="id_aluno='$id'";
					break;
				}
				//$sqlInserir = "INSERT INTO Person (`name`,`lastName`,`cpf`,`password`,`gender`,`birthdate`,`email`,`height`,`weight`,`IMC`) VALUES (?,?,?,?,?,?,?,?,?,?)";		
				$sqlInserir=alterar($tabela,$alteracao,$idS);
				//echo($sqlInserir);
				$stmt=self::conn()->prepare($sqlInserir);
				if($stmt->execute($dados))
					return true;
				else
					return false;
			}

		//remove
		public function del($tabela,$id){
				$sql=deletar($tabela,$id);
				$stmt=self::conn()->prepare($sql);
				if($stmt->execute($dados))
					return true;
				else
					return false;
			}

		//cadastro
		public function cadastra($dados=array(),$tabela){
			echo 'selectohihu';
			switch($tabela)
			{
				case 'Aluno':
				$values = "(`name`,`cpf`,`email`,`rg`,`orgaoEmissor`,`senha`,
					`endereco`,`telefone`,`tipo`,`matricula`,`curso`,`anoIngresso`,
					`banco`,`agencia`,`cc`,`historico`)";
				$valores = "(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
				break;

			}
			//$sqlInserir = "INSERT INTO Person (`name`,`lastName`,`cpf`,`password`,`gender`,`birthdate`,`email`,`height`,`weight`,`IMC`) VALUES (?,?,?,?,?,?,?,?,?,?)";		
			$sqlInserir=inserir($tabela,$values,$valores);
			//echo($sqlInserir);
			$stmt=self::conn()->prepare($sqlInserir);
			if($stmt->execute($dados))
				return self::conn()->lastInsertId();
			else
				return false;
		}


		public function Selecao($tabela)
		{

			switch($tabela)
			{	
				case 'Aluno':
					$seleciona = "SELECT distance FROM $tabela";
				break;
			}

			$rs = self::conn()->query($seleciona)->fetchAll(PDO::FETCH_ASSOC);
		   	return $rs;
		}
		
	public function SELA($tabela, $id)
	{
		switch($tabela)
				{	
					case 'Aluno':
						$seleciona = "SELECT * from Aluno where id_aluno =".$id;
					break;
				}

				$rs = self::conn()->query($seleciona)->fetchAll();
			   	return $rs;
	}
}