<?php
session_name("covre_ti");
session_start();

include("../../SCA/includes/conect_sqlserver.php");

$logado = $_SESSION["usuario_logado"];

if($logado != ""){
	
	$valor 	 	= $_POST["valor"];
	$id		 	= $_POST["id"];
	$numero		= $_POST["numero"];
	
	if($numero == 1)
	{
		$query = "update rastreabilidade_malote
				  set lacre_retirada = case when '$valor' = '' then null else '$valor' end
				  where id = $id";
		odbc_exec($conSQL, $query) or die("Erro ao atualizar o lacre de retirada");
	}
	else
		if ($numero == 2)
		{
			$data_retirada = 
			implode(preg_match("~\/~", $valor) == 0 ? "/" : "-", 
			array_reverse(explode(preg_match("~\/~", $valor) == 0 ? "-" : "/", $valor)));
		
			$query = "update rastreabilidade_malote
					  set data_retirada = case when '$data_retirada' = '' then null else '$data_retirada' end
					  where id = $id";
			odbc_exec($conSQL, $query) or die("Erro ao atualizar a data de retirada");
		}
		else
		{
			$query = "update rastreabilidade_malote
					  set responsavel_retirada = case when '$valor' = '' then null else '$valor' end
					  where id = $id";
			odbc_exec($conSQL, $query) or die("Erro ao atualizar o responsavel da retirada");
		}	
}
?>

