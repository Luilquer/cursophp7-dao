<?php 
//arquivo de configuração que faz o autoload das classes

spl_autoload_register(function($class_name)
{	
	//variavel que recebe o arquivo.php
	$filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";

	//verifica se o arquivo existe 
	if(file_exists(($filename)))
	{
		//verificará se o arquivo já foi incluído, e em caso afirmativo, não o incluirá (exigirá) novamenteo
		require_once($filename);
	}
});




 ?>