<?php

require_once '../vendor/autoload.php';
require_once '../helper/twig.php';
require_once '../entidades/Professor.class.php';
require_once('../helper/funcoes.php');

//banco
$conecta = conectar();

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';


session_start(); 	
$tipo = $_SESSION['tipo'];

$twig = twig('../view/');


$baseTemplate="professor/";

if(!$tipo = $_SESSION['tipo'])
	header('location:../login.php'); 

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
            'tipo' => $tipo,
        ));
}
	//echo $twig->render($baseTemplate. 'new.twig', array('name' => 'Professor'));


}else if ($acao == 'edit') {

$id = $_GET["idProfessor"];
	
$sql = selecaoByID('professor','id_professor',$id);	

$departamentos = array();

$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{

	while($consulta = mysql_fetch_array($result)) { 
		$professores[] = $consulta;
	}

$sql = selecao("departamento"); 

$result = mysql_query($sql, $conecta); 

while($consulta = mysql_fetch_array($result)) { 
		$departamentos[] = $consulta;
}

//	var_dump($alunos);
echo $twig->render($baseTemplate.'edit.twig',
	array(
            'entities' => $professores,
            'departamentos' => $departamentos,
            'tipo' => $tipo,
        ));
}
 
} else if ($acao == 'delete') {
		$idx=$_GET['idProfessor'];
		
		$idS = "id_professor =".$idx;	
		
$sqlDeletar = deletar('professor',$idS);

$result = mysql_query($sqlDeletar, $conecta); 

		if(!mysql_error())
		{
			echo "<script>alert(\"Removido!\");</script>";    

			unset($_GET['acao']);
			unset($_GET['idProfessor']);
		}	
		else   	
			echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
		
		//echo $twig->render('index.php');
		echo ("<script>window.location.href = \"../controller/professor.php?acao=consult\";</script>");	
		
	//	}
	//	else
	//		echo "<script>alert(\"Não foi possível remover!\");</script>";       
	//
} else if ($acao == 'create') {
		//$senha2=$_POST['senha2'];
		$professor = new Professor($_POST);   	

		//var_dump($_POST);

	  	/*$val = $aluno->ValidaUsuario($senha2);//valida
		
		if(!empty($val))
		{
			foreach ($val as $erro) 
				echo $twig->render($baseTemplate.'erro.twig', array('Erros' => $erro));
    	}*/
	//	else 
	//			{			
		
			$dados=array($professor->getNome(),$professor->getCpf(),$professor->getEmail(),$professor->getRg(),$professor->getOrgaoEmissor(),
				$professor->getSenha(),$professor->getEndereco(),$professor->getTelefone(),$professor->getMatricula(), 
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

if(!$professor->getMatricula())
	$matricula = "";
else
	$matricula = $professor->getMatricula();

if(!$professor->getDepartamento())
	$departamento = "";
else
	$departamento = $professor->getDepartamento();


$pquer = mysql_query("Select email from professor");
$aquer = mysql_query("Select email from aluno");

if((mysql_num_rows($pquer) > 0)||(mysql_num_rows($aquer) > 0)) { 
	echo $twig->render($baseTemplate.'new.twig', array('Erros' => 'Erro! Esse email já está cadastrado! ',array('tipo' => $tipo,'entity'=>$entity)));
}
/*
echo "INSERT INTO 
professor VALUES('".
	$professor->getCpf()."','".
	$nome."','".
	$professor->getEmail()."','".
	$professor->getSenha()."','".
	$professor->getRg()."','".
	$professor->getOrgaoEmissor()."','".
	$professor->getEndereco()."','".
	$professor->getTelefone()."','".	
	$professor->getMatricula()."','".
	$professor->getDepartamento().
")";*/

$quer = mysql_query("INSERT INTO professor VALUES(null,'".
	$cpf."','".
	$nome."','".
	$email."','".
	$senha."','".
	$rg."','".
	$oe."','".
	$endereco."','".
	$telefone."','".	
	$matricula."','". 
	$departamento."')");

//echo $cpf;
if(!mysql_error())
{					
	echo "<script>alert(\"Inserido! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!',array('tipo' => $tipo)));
	
} else if ($acao == 'update') {		
		$professoralt = new Professor($_POST);   	
		
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
		$sqlUpdate = "UPDATE PROFESSOR SET ";

if($professoralt->getNome())
	$sqlUpdate .= "nome ='".$professoralt->getNome()."', " ;

if($professoralt->getCpf())
	$sqlUpdate .= "cpf ='".$professoralt->getCpf()."', " ;

if($professoralt->getEmail())
	$sqlUpdate .= "email ='".$professoralt->getEmail()."', " ;

if($professoralt->getRg())
	$sqlUpdate .= "rg ='".$professoralt->getRg()."', " ;


if($professoralt->getOrgaoEmissor())
	$sqlUpdate .= "orgao_emissor ='".$professoralt->getOrgaoEmissor()."', " ;


if($professoralt->getSenha())
	$sqlUpdate .= "senha ='".$professoralt->getSenha()."', " ;


if($professoralt->getEndereco())
	$sqlUpdate .= "endereco ='".$professoralt->getEndereco()."', " ;


if($professoralt->getTelefone())
	$sqlUpdate .= "telefone ='".$professoralt->getTelefone()."', " ;

if($professoralt->getMatricula())
	$sqlUpdate .= "matricula ='".$professoralt->getMatricula()."', " ;

if($professoralt->getDepartamento())
	$sqlUpdate .= "id_departamento ='".$professoralt->getDepartamento()."' " ;

$id = $_POST['id'];

$sqlUpdate .= "where id_professor='".$id."'";
$quer = mysql_query($sqlUpdate);

if(!mysql_error())
{					
	echo "<script>alert(\"Editado! $mensagem\");</script>";       
	echo ("<script>window.location.href = \"../index.php\";</script>");	
}
else
	echo $twig->render($baseTemplate.'erro.twig', array('Erros' => 'Erro! Nao foi possivel inserir!','tipo' => $tipo));

} else if ($acao == 'consult') {
	$sql = selecao("Professor"); 
	$result = mysql_query($sql, $conecta); 
 
if(!$result)
	    echo "<script>alert(\"Nenhum registro encontrado. Para criar um novo selecione `Novo Cadastro`\");</script>";       
else{
	

	while($consulta = mysql_fetch_array($result)) { 
		$professores[] = $consulta;
		
	}

	// Transformando id de departamento no nome do departamento
	$i=0;
	foreach ($professores as $key) {
		$sql2 = selecaoByID("departamento","id_departamento",$key['id_departamento']);
		$result2 = mysql_query($sql2, $conecta); 
		while($consulta2 = mysql_fetch_array($result2)) { 
			$departamentos_nomes[$i] = $consulta2;
			$professores[$i]['id_departamento'] = $consulta2['nome'];
		}
		$i++;
	}
	
	
echo $twig->render($baseTemplate.'consult.twig',
	array(
            'entities' => $professores,    
            'tipo' => $tipo,        
        ));
}
//mysql_free_result($result); 
//mysql_close($conecta); 
}else {
	echo $twig->render('404.twig');
}

