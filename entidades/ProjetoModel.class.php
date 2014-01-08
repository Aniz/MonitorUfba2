<?php
require_once '../helper/funcoes.php';

class ProjetoModel extends Conexao {

	public static function seleciona(){

		$sql = selecaoByID('projetoDeMonitoria','id_projeto',$id);	
		$result = mysql_query($sql, self::$conecta); 
	
	if($result){
		while($consulta = mysql_fetch_array($result)) { 
			$professores[] = $consulta;
		}
	}
	return $professores;
	}

}