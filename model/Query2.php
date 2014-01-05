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

		private function selec()
		{
			/*echo 'iiii';
			echo $conn;
			echo 'ói';
			$sql = "SELECT * FROM aluno"; 
$result = mysql_query($sql, $conn); 
 var_dump($result);
/* Escreve resultados até que não haja mais linhas na tabela */ 
 
//while($consulta = mysql_fetch_array($result)) { 
  // echo $consulta['nome'];
//} 
//mysql_free_result($result); 
//mysql_close($conecta); 
  
//mysql_free_result($result); 
//mysql_close($conecta); */

				return "oioi";

		
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

	

		public function existeProva($nome,$data)
		{
			$s="SELECT * from Competition where nameCompetition='$nome' and dateCompetition = '$data'";
			$selecionar = self::conn()->prepare($s);
			$selecionar->execute();

			if($selecionar->rowCount()>=1)
				return true;
			else
				return false;
		}

		public function existeRelacao($P,$C)
		{
			$s="SELECT * from Competition_Runner where idPerson='$P' and idCompetition = '$C'";
			$selecionar = self::conn()->prepare($s);
			$selecionar->execute();

			if($selecionar->rowCount()>=1)
				return true;
			else
				return false;
		}

		public function existeUsuarioID($id)
		{
			$selecionar = self::conn()->prepare("select * from Competition_Runner where idPerson='$id'");
			$selecionar->execute();

			if($selecionar->rowCount()>=1)
				return true;
			else
				return false;
		}

		public function existeProvaID($id)
		{
			$s="SELECT * from Competition_Runner where idCompetition='$id'";
			$selecionar = self::conn()->prepare($s);
			$selecionar->execute();

			if($selecionar->rowCount()>=1)
				return true;
			else
				return false;
		}

		/*2 formas
		public function cadastraUser($dados=array()){
		$query = "Select * from tabela where id = :id";
		$stmt->bindValue(':id',$_GET['id']);}

		public function cadastraUser($dados=array($_GET[''])){
		$query = "Select * from tabela where id = ?";
		$stmt->execute($dados);}
		*/
		//$nome=strip_tags(filter_input(INPUT_POST,'nome'));

		//ununsed
		public function cadastraUser($dados=array()){
			if($this->existeUsuario($dados[2]))
				return false;
			else
			{
			//$dados[3]=$this->criptografar($dados[3]); //criptografa a senha
			//echo $dados[3];
				
			$values = "(`name`,`lastName`,`cpf`,`password`,`gender`,`birthdate`,`email`,`height`,`weight`,`IMC`)";
			$valores="(?,?,?,?,?,?,?,?,?,?)";
			$sqlInserir=inserir('Person',$values,$valores);

			//$sqlInserir = "INSERT INTO Person (`name`,`lastName`,`cpf`,`password`,`gender`,`birthdate`,`email`,`height`,`weight`,`IMC`) VALUES (?,?,?,?,?,?,?,?,?,?)";
			$stmt=self::conn()->prepare($sqlInserir);
			if($stmt->execute($dados))
				return true;
			else
				return false;
			}
		}

		//atualiza
		public function atualiza($dados=array(),$tabela,$id){
				switch($tabela)
				{
					case 'Person':	
					$alteracao="name ='$dados[0]', lastName ='$dados[1]', password = '$dados[2]', email ='$dados[3]', height ='$dados[4]', weight='$dados[5]', IMC ='$dados[6]'";
					$idS="idPerson='$id'";
					break;
	
					case 'Competition':
					$alteracao="dateCompetition ='$dados[0]', address ='$dados[1]', city = '$dados[2]', state ='$dados[3]', country ='$dados[4]'";
					$idS="idCompetition='$id'";
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