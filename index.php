<?php 

//primeiro arqivo que será chamado, caso não especifica, na pasta
//verificará se o arquivo já foi incluído, e em caso afirmativo, não o incluirá (exigirá) novamenteo
//nesse caso é do config.pgp
require_once("config.php");

//cria uma variavel do tipo Sql(), para encontrar na pasta
$sql = new Sql();

//manda executar um comando dentro do banco de dados 
//qualquer select que for fazer a partit de agora, será feito aqui nesse arquivo
$usuarios = $sql->select("SELECT * FROM tb_usuarios");

//exibe todos os dados de acordo com a consulta sql
//json_encode: Retorna a string contendo a representação JSON de um value.
echo json_encode($usuarios);


 ?>