<?php 
//classe para usuario
class Usuario
{
	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	//Gettter
	public function getIdusuario()
	{
		return $this->idusuario;
	}

	//Setter
	public function setIdusuario($value)
	{
		$this->idusuario = $value;
	}

	//Gettter
	public function getDeslogin()
	{
		return $this->deslogin;
	}

	//Setter
	public function setDeslogin($value)
	{
		$this->deslogin = $value;
	}

	//Gettter
	public function getDessenha()
	{
		return $this->dessenha;
	}

	//Setter
	public function setDessenha($value)
	{
		$this->dessenha = $value;
	}

	//Gettter
	public function getDtcadastro()
	{
		return $this->dtcadastro;
	}

	//Setter
	public function setDtcadastro($value)
	{
		$this->dtcadastro = $value;
	}


	//métodos para fazer a leitura do id usuario
	public function loadById($id)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id,
		));

		//verificar se o resultado do banco de dados existe 
		//em seguida faz 
		//if(isset($results[0]): 1 opcão
		//ou assim 
		if(count($results) > 0)
		{
			//chama o metodo para retorna os dados setdata()
			//passando o resultado no indice 0
			$this->setData($results[0]);

			

		}
	}


	//método para exibir todos os usuarios da tabela
	// a vantagem do método ser static é não precisar instanciar objetos, ou seja,
	// pode chamar direto sem precisar utilizar a sintaxe do sistema 
	public static function getList()
	{
		//cria um novo sql
		$sql = new Sql();

		//retorna a consulta feita no banco de dados 
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}

	//Lista através  do Login
	public static function search($Login)
	{
		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDEr BY deslogin", array(
			':SEARCH'=>"%".$Login."%"
		));
	}

	//obter os dados do usuario autenticado
	public function login($login, $password)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :PASSWORD", array(
			":LOGIN"=>$login,
			":PASSWORD"=>$password
		));

		//verificar se o resultado do banco de dados existe 
		//em seguida faz 
		//if(isset($results[0]): 1 opcão
		//ou assim 
		if(count($results) > 0)
		{
			//caso relamente exita no banco
			//pega o resultado na primeira ou única linha que foi encontrado 
			//$row = $results[0];. Porém foi susbstituido pelo método abaixo:

			//chama o metodo para retorna os dados setdata()
			//passando o resultado no indice 0
			$this->setData($results[0]);
			
		}
		//caso não tenha nehum resultado
		else
		{
			//lança uma exeção dentro da classe
			throw new Exception("Error: Login e/ou senha inválidos.");
			
		}
	}

	//método para retorna os dados do banco de dados  
	public function setData($data)
	{
			//pega os dados e manda para os setters 
			$this->setIDusuario($data['idusuario']);
			$this->setDeslogin($data['deslogin']);
			$this->setDessenha($data['dessenha']);
			//colocar no formato pt_BR(hotas, data)
			$this->setDtcadastro(new DateTime($data['dtcadastro']));

	}


	//método para inserir 
	public function insert()
	{
		//novo instancia da classe Sql()
		$sql = new Sql();

		//armazena em results o resultado da CALL, dentro do mysql passando a login e a senha (prosedure)
		//como é no mysql: a prosedure usa-se com CALL e usa-se parenteses, para o sqlserver é execute
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha()
		));

		//verifica se é maior que zero
		if(count($results) > 0)
		{
			$this->setData($results[0]);
		}
	}

	//meetod para atualizar no banco de dados 
	public function update($login, $password)
	{
		//definindo dentro do objeto
		$this->setDeslogin($login);
		$this->setDessenha($password);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			//especificando os parametros
			':LOGIN'=>$this->getDeslogin(),
			':PASSWORD'=>$this->getDessenha(),
			':ID'=>$this->getIdusuario()
		));
	}


	//metodo construtor
	public function __construct($login = "", $password = "")
	{
		$this->setDeslogin($login);
		$this->setDessenha($password);
	}


	//mostrar na tela
	public function __toString()
	{
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			//colocando no fromato DateTime()
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}





}



 ?>