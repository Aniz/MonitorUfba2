<?php

class Conexao {

 protected
    $conecta='';

    public function __construct(){}

	public static function conn(){

		if(!$conecta)
		{
			$conecta = mysql_connect("localhost", "root", "") or print (mysql_error()); 
			mysql_select_db("Monitoria", $conecta) or print(mysql_error()); 
		}
	return self::$conecta;
	}

}