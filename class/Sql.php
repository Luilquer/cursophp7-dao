<?php 
//dao
//criando uma classe, herda da classe padrão PDO, logo faz tudo que a classe PDO pode fzr
//aos atributos e métodos public e protected
class Sql extends PDO 
{
	//atributo de conexão com o banco
	private $conn;

	//método mágico construtor para conectar com o banco de dados
	public function __construct()
	{	
		//faz a conexão com o banco de dados, especificando a inerface do banco(mysql), localhost, nome do banco(dbphp7), user(root), senha("")
		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
	}

	//método mais global para mudança, recebe o stmt e os dados
	//parâmetros é um array por padrâo
	private function setParams($statement, $parametrs = array())
	{
		//associar os parametros a esse comando, acima
		//verifica os parâmetros pegando a chave e o valor
		foreach ($parametrs as $key => $value) 
		{
			//chamando o método criado setParam()
			$this->setParam($statement, $key, $value);
		}
	}

	//metodo para apenas um parâmetro, recebendo a chave e o valor
	private function setParam($statement, $key, $value)
	{
		//passando a chave e o valor
		$statement->bindParam($key, $value);
	}



	//executar os comandos
	// variavel rawQuery: comando sql que será tratados posteriormente
	//params: parâmetros array, dados recebidos
	public function query($rawQuery, $params = array())
	{
		//criar um váriavel local passando o rawQuerry só funciona aqui dentro
		// 
		$stmt = $this->conn->prepare($rawQuery);

		//chamndo o setParams, sabe como o set de cada parâmetro
		$this->setParams($stmt, $params);

		//executa o comando no banco de dados
		$stmt->execute();

		//faz o retorna da variavel $stmt
		return $stmt;	
	}

	//método para inserir no banco de dados, coloca um array na frente para especifica o tipo de retorno 
	public function select($rawQuery, $params = array()):array
	{
		//chamndo o método passando o query e os parametros, e atribui o retorna para variavel $stmt
		$stmt = $this->query($rawQuery, $params);


		//passando o PDO, para fazer o FETCH_ASSOC(retorna apenas os dados associativos, sem os indeces)
		//em seguida faz o retorno do resultado 
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}


}




 ?>