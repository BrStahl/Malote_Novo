<?php
session_name("covre_ti");
session_start();

include("../../SCA/includes/conect_sqlserver.php");

$logado = $_SESSION["usuario_logado"];

$id			 	= $_POST["id"];
$data_entrega	= $_POST["data_entrega"];


if($logado != "")
{
	$query = "select id
			  From usuario with (nolock)
			  Where usuario = '$logado'";
	//print $query;
	$result = odbc_exec($conSQL, $query) ;
	$usuario_id = odbc_result($result, 1);


	$nova_data_entrega = 
	implode(preg_match("~\/~", $data_entrega) == 0 ? "/" : "-", 
	array_reverse(explode(preg_match("~\/~", $data_entrega) == 0 ? "-" : "/", $data_entrega)));

	$query = "update rastreabilidade_malote
			  set data_recebimento = '$nova_data_entrega', recebedor_destino_id = $usuario_id, status_id = 'f'
			  where id = $id";
	//print $query;
	odbc_exec($conSQL, $query) or die("Erro ao atualizar a confirmacao do malote");

}
?>

