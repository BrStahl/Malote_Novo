<?php
session_name("covre_ti");
session_start();

include("../../SCA/includes/conect_sqlserver.php");

$logado    = $_SESSION["usuario_logado"];

$auxiliar 			= $_POST["auxiliar"];


	switch ( $auxiliar ){
	  case 1:
		$order_by = 'order by codigo_malote';
		break;
	  case 2:
		$order_by = 'order by tipo_malote';
		break;
	  case 3:
		$order_by = 'order by dt_postagem_ordem';
		break;
	  case 4:
		$order_by = 'order by recebedor';
		break;
	  case 5:
		$order_by = 'order by num_lacre';
		break;
	  case 6:
		$order_by = 'order by nome_expedidor';
		break;
	  case 7:
		$order_by = 'order by filial';
		break;
	  case 8:
		$order_by = 'order by destinatario';
		break;
	  case 9:
		$order_by = 'order by observacao';
		break;
	  case 10:
		$order_by = 'order by lacre_retirada';
		break;
	  case 11:
		$order_by = 'order by dt_retirada_ordem';
		break;
	  case 12:
		$order_by = 'order by responsavel_retirada';
		break;																				
	  case 13:
		$order_by = 'order by data_recebimento_ordem';
		break;
	  case 14:
		$order_by = 'order by nom_recebedor_entrega';
		break;		

	}

	print $order_by;


?>

