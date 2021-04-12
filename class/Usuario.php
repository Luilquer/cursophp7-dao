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
			//caso relamente exita no banco
			//pega o resultado na primeira ou única linha que foi encontrado 
			$row = $results[0];

			//pega os dados e manda para os setters 
			$this->setIDusuario($row['idusuario']);
			$this->setDeslogin($row['deslogin']);
			$this->setDessenha($row['dessenha']);
			//colocar no formato pt_BR(hotas, data)
			$this->setDtcadastro(new DateTime($row['dtcadastro']));

		}
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