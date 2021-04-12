<?php 

//primeiro arqivo que será chamado, caso não especifica, na pasta
//verificará se o arquivo já foi incluído, e em caso afirmativo, não o incluirá (exigirá) novamenteo
//nesse caso é do config.pgp
require_once("config.php");

//cria uma variavel do tipo Sql(), para encontrar na pasta
//$sql = new Sql();

//manda executar um comando dentro do banco de dados 
//qualquer select que for fazer a partit de agora, será feito aqui nesse arquivo
//$usuarios = $sql->select("SELECT * FROM tb_usuarios");

//exibe todos os dados de acordo com a consulta sql
//json_encode: Retorna a string contendo a representação JSON de um value.
//echo json_encode($usuarios);


//usar a classe usuario

//cria um novo usuario, mas para apenas um

/*
$root = new Usuario();

$root->loadById(5);

//exibir o root na tela
echo $root;
*/

//Carrega uma lista de usuarios
//a forma de chamar  direto sem precisar instanciar o objeto é relatico ao método static 
/*$lista = Usuario::getList();

//exibir a lista encontradas no banco de dados 
//echo json_encode($lista);
*/

//Carrega uma lista de usuarios buscado pelo login
/*$search = Usuario::search("lu");

echo json_encode($search);
*/

//carrega um usuario usando o login e a senha
$user = new Usuario();

//usar o método login();
$user->login("luilquer","12345678");

//exibe o resultado da consulta no banco de dados 
echo $user;


 ?>