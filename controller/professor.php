<?php

require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once '../entidades/Professor.class.php';
//r//equire_once('../model/query.php');
require_once('../helper/funcoes.php');
/*
require_once '../config/config.php';
require_once '../helper/database.php';
require_once '../model/pessoa.php';
require_once '../helper/Pessoa.class.php';*/
//require_once('../model/BD.class.php');
//require('../model/Query.php');	
//require('../model/conexao.php');	
//require('../model/execute.php');	
//	BD::conn();
//	$usuario = new Query();
//require_once '../helper/Validacao.class.php';
// incluir twig
// incluir model pessoa
// incluir classe de validacao

//banco
$conecta = mysql_connect("localhost", "root", "") or print (mysql_error()); 
mysql_select_db("Monitoria", $conecta) or print(mysql_error()); 			

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

$twig = twig('../view/');

$baseTemplate="professor/";

if ($acao == 'new') {

	$departamentos = array();

	$sql = selecao("departamento"); 
	$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Não existem departamentos cadastrados. Para criar um novo selecione departamento->Novo\");</script>";       
else{
	while($consulta = mysql_fetch_array($result)) { 
		$departamentos[] = $consulta;
	}
	echo $twig->render($baseTemplate.'new.twig',
	array(
            'departamentos' => $departamentos,
        ));
}
	//echo $twig->render($baseTemplate. 'new.twig', array('name' => 'Professor'));


}else if ($acao == 'edit') {

$id = $_GET["idProfessor"];
	
$sql = selecaoByID('Professor',$id);	

//echo $sql;

$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{

	while($consulta = mysql_fetch_array($result)) { 
	$professores[] = $consulta;
}

//	var_dump($alunos);
echo $twig->render($baseTemplate.'edit.twig',
	array(
            'entities' => $professores,
        ));
}
 
} else if ($acao == 'delete') {
		$idx=$_GET['idAluno'];
		
		$idS = "id_aluno =".$idx;	
		
$sqlDeletar = deletar('aluno',$idS);

echo $sqlDeletar;

$result = mysql_query($sqlDeletar, $conecta); 

		if(!mysql_error())
		{
			echo "<script>alert(\"Removido!\");</script>";    

			unset($_GET['acao']);
			unset($_GET['idAluno']);
		}	
		else   	
			echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
		
		//echo $twig->render('index.php');
		echo ("<script>window.location.href = \"../controller/aluno.php?acao=consult\";</script>");	
		
	//	}
	//	else
	//		echo "<script>alert(\"Não foi possível remover!\");</script>";       
	//
} else if ($acao == 'create') {
		//$senha2=$_POST['senha2'];
		$professor = new Professor($_POST);   	

	  	/*$val = $aluno->ValidaUsuario($senha2);//valida
		
		if(!empty($val))
		{
			foreach ($val as $erro) 
				echo $twig->render($baseTemplate.'erro.twig', array('Erros' => $erro));
    	}*/
	//	else 
	//			{			
		echo $professor->getNome();

			$dados=array($professor->getNome(),$professor->getCpf(),$professor->getEmail(),$professor->getRg(),$professor->getOrgaoEmissor(),
				$professor->getSenha(),$professor->getEndereco(),$professor->getTelefone(),$professor->getTipo(),$professor->getMatricula(), 
				$professor->getDepartamento());

if(!$professor->getNome())
	$nome = "";
else
	$nome = $professor->getNome();

if(!$professor->getCpf())
	$cpf = "";
else
	$cpf = $professor->getCpf();

if(!$professor->getEmail())
	$email = "";
else
	$email = $professor->getEmail();

if(!$professor->getRg())
	$rg = "";
else
	$rg = $professor->getRg();

if(!$professor->getOrgaoEmissor())
	$oe = "";
else
	$oe = $professor->getOrgaoEmissor();

if(!$professor->getSenha())
	$senha = "";
else
	$senha = $professor->getSenha();

if(!$professor->getEndereco())
	$endereco = "";
else
	$endereco = $professor->getEndereco();

if(!$professor->getTelefone())
	$telefone = "";
else
	$telefone = $professor->getTelefone();

if(!$professor->getTipo())
	$tipo = "";
else
	$tipo = $professor->getTipo();

if(!$professor->getMatricula())
	$matricula = "";
else
	$matricula = $professor->getMatricula();

if(!$professor->getDepartamento())
	$departamento = "";
else
	$departamento = $professor->getDepartamento();



/*echo "INSERT INTO 
professor VALUES('".
	$professor->getCpf()."','".
	$nome."','".
	$professor->getEmail()."','".
	$professor->getSenha()."','".
	$professor->getRg()."','".
	$professor->getOrgaoEmissor()."','".
	$professor->getEndereco()."','".
	$professor->getTelefone()."','".
	$professor->getTipo()."','".
	$professor->getMatricula()."','".
	$professor->getDepartamento().
")";
*/
$quer = mysql_query("INSERT INTO professor VALUES(null,'".
	$cpf."','".
	$nome."','".
	$email."','".
	$senha."','".
	$rg."','".
	$oe."','".
	$endereco."','".
	$telefone."','".
	$tipo."','".
	$matricula."','". 
	$departamento."')");

echo $cpf;
if(!mysql_error())
{					
	echo "<script>alert(\"Inserido! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!'));
	
} else if ($acao == 'update') {		
		//$senha2=$_POST['senha2'];

	if ($_POST) {
	  foreach ($_POST as $key => $value) {
	    echo $key . ' = ' . $value . '<br />';
	  }
	}
		$alunoalt = new Aluno($_POST);   	
		
	//	$id = $alunoalt->getId();   
	 //  	var_dump($id);
	   	
	   	//$val = $alunoalt->ValidaUsuarioAlterado($senha2);//valida
		
		//if(!empty($val))
		//{
		//	foreach ($val as $erro) 
		//		echo $twig->render($baseTemplate.'erro.twig', array('Erros' => $erro));
    	//}
		//else 
		//		{				
		$sqlUpdate = "UPDATE ALUNO SET ";

if($alunoalt->getNome())
	$sqlUpdate .= "nome ='".$alunoalt->getNome()."', " ;

if($alunoalt->getCpf())
	$sqlUpdate .= "cpf ='".$alunoalt->getCpf()."', " ;

if($alunoalt->getEmail())
	$sqlUpdate .= "email ='".$alunoalt->getEmail()."', " ;

if($alunoalt->getRg())
	$sqlUpdate .= "rg ='".$alunoalt->getRg()."', " ;


if($alunoalt->getOrgaoEmissor())
	$sqlUpdate .= "orgaoEmissor ='".$alunoalt->getOrgaoEmissor()."', " ;


if($alunoalt->getSenha())
	$sqlUpdate .= "senha ='".$alunoalt->getSenha()."', " ;


if($alunoalt->getEndereco())
	$sqlUpdate .= "endereco ='".$alunoalt->getEndereco()."', " ;


if($alunoalt->getTelefone())
	$sqlUpdate .= "telefone ='".$alunoalt->getTelefone()."', " ;


if($alunoalt->getTipo())
	$sqlUpdate .= "tipo ='".$alunoalt->getTipo()."', " ;


if($alunoalt->getMatricula())
	$sqlUpdate .= "matricula ='".$alunoalt->getMatricula()."', " ;

if($alunoalt->getCurso())
	$sqlUpdate .= "curso ='".$alunoalt->getCurso()."', " ;

if($alunoalt->getAnoIngresso())
	$sqlUpdate .= "anoIngresso ='".$alunoalt->getAnoIngresso()."', " ;

if($alunoalt->getBanco())
	$sqlUpdate .= "banco ='".$alunoalt->getBanco()."', " ;

if($alunoalt->getAgencia())
	$sqlUpdate .= "agencia ='".$alunoalt->getAgencia()."', " ;

if($alunoalt->getCc())
	$sqlUpdate .= "cc ='".$alunoalt->getCc()."', " ;

if($alunoalt->getHistorico())
	$sqlUpdate .= "historico ='".$alunoalt->getHistorico()."' " ;

$id = $_POST['id'];



echo $sqlUpdate .= "where id_aluno='".$id."'";
$quer = mysql_query($sqlUpdate);

if(!mysql_error())
{					
	echo "<script>alert(\"Editado! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!'));

} else if ($acao == 'consult') {
	$sql = selecao("Professor"); 
	$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{

	while($consulta = mysql_fetch_array($result)) { 
	$professores[] = $consulta;
}
echo $twig->render($baseTemplate.'consult.twig',
	array(
            'entities' => $professores,
        ));
}
//mysql_free_result($result); 
//mysql_close($conecta); 
}else {
	echo $twig->render('404.twig');
}

