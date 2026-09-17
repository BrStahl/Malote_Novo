<?php
session_name("covre_ti");
session_start();

include("../../SCA/includes/conect_sqlserver.php");


$po = $_POST["po"];


$query = "select  DISTINCT pfunc.chapa PESSOA_ID , usuario.nome nome

FROM usuario WITH (NOLOCK)
LEFT JOIN CORPORE..PFUNC 
    ON usuario.REGISTRO = PFUNC.CHAPA
LEFT JOIN CORPORE..PSECAO 
    ON PSECAO.CODIGO = PFUNC.CODSECAO
	LEFT JOIN CORPORE..PFUNCAO 
    ON PFUNCAO.CODIGO = PFUNC.CODFUNCAO AND PFUNCAO.CODCOLIGADA=1
LEFT JOIN ponto_operacao po
    ON UPPER(PSECAO.DESCRICAO COLLATE SQL_Latin1_General_CP1_CI_AI)
    LIKE '%' + UPPER(po.nome_fantasia COLLATE SQL_Latin1_General_CP1_CI_AI)    + '%'
		
LEFT JOIN CORPORE..PFHSTAFT PFHSTAFT WITH (NOLOCK) 
    ON PFHSTAFT.CHAPA COLLATE SQL_Latin1_General_CP1_CI_AS = pfunc.chapa
    AND ISNULL(PFHSTAFT.DTFINAL, GETDATE() + 1) >= GETDATE() 
    AND PFHSTAFT.CODCOLIGADA = 1


where status = 'a'
			AND PFHSTAFT.CHAPA IS NULL
		   and PO.PONTO_OPERACAO_ID = $po
			AND PFUNC.CODSITUACAO in ('A','F')
			AND PFUNCAO.NOME NOT LIKE 'MOTORIS%'
			AND NOT EXISTS (
    SELECT 1
    FROM CORPORE..PFUFERIASPER FER
    WHERE PFUNC.CHAPA = FER.CHAPA
	AND FER.CODCOLIGADA = 1
    AND (
        -- Férias em andamento
        (FER.DATAINICIO <= GETDATE() AND FER.DATAFIM >= GETDATE())
        -- Ou férias agendadas
       --- OR (FER.DATAINICIO > GETDATE())
    )
)
			ORDER BY NOME	
";

$result = odbc_exec($conSQL, $query) ;

print "<option value=''></option>";
while(odbc_fetch_row($result))
{
	print "<option value='".odbc_result($result,1)."'>".odbc_result($result,2)."</option>";
}


?>

