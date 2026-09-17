<?php
session_name("covre_ti");
session_start();

include("../../SCA/includes/conect_sqlserver.php");


$nome = $_POST["nome"];


$query = "select PESSOA_ID
			from CARGOSOL..PESSOA (NOLOCK)
			WHERE PESSOA.nome_fantasia = '$nome'";

print $query;
$result = odbc_exec($conSQL, $query) ;

$registro = odbc_result($result, 1);

if ($registro != '')
	print "1|".$registro;
else
	print "2|invalido";





?>

