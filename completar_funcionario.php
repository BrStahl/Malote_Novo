<?
include("../SCA/includes/conect_sqlserver.php");



$q=strtolower ($_GET["q"]);

$query = "SELECT nome
          FROM usuario with (nolock) 
          WHERE nome like '$q%'
		  and status = 'a'
		  ORDER BY NOME";

$result = odbc_exec($conSQL, $query) ;


while(odbc_fetch_row($result))
{
    //if (srtpos(strtolower($reg['nom_lista']),$q !== false){
	// echo $result["nome"]."|".$reg["nome"]."\n";
	print odbc_result($result,1)."|".odbc_result($result,1)."\n";
}

?>
