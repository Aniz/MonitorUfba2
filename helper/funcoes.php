<?php
//operacoes no banco	
	function inserir($tabela,$values,$valores){
		$sql_inserir = "INSERT INTO $tabela $values VALUES $valores";
		return $sql_inserir;
	}
	
	function deletar($tabela,$id){
		$sql_apagar = "DELETE FROM $tabela WHERE $id";
			return $sql_apagar;
	}
	
	function alterar($tabela,$alteracao,$tipoid){
		$sql_alterar="UPDATE $tabela SET $alteracao WHERE $tipoid";
			return $sql_alterar;
	}	

    function selecao($tabela)
    {

        $seleciona = "SELECT * FROM $tabela";
            
        return $seleciona;
    }

    function selecaoById($tabela,$id)
    {

        switch($tabela)
        {   
            case 'Aluno':
                $seleciona = "SELECT * FROM $tabela WHERE id_aluno=$id";
            break;
        }

        return $seleciona;
    }

function msgbox($msg, $type)
    {
    if ($type == "alert")
        {
        // Simple alert window
        ?> <script language="JavaScript"> alert("<? echo $msg; ?>"); </script> <?
        }
    elseif ($type == "confirm")
        {
        // Enter Confirm Code Here and assign the $result variable for use
        // Should include "OK" and "Cancel" buttons.
        ?>
           <script language="JavaScript">
           if (confirm("<? echo $msg; ?>"))
                {
                <?php $result == "ok"; ?>
                }
           else
                {
                <?php $result == "cancel"; ?>
                }
           </script>
        <?php
        }
    }
?>