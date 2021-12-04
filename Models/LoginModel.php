<?php

class LoginModel extends Mysql
{
	private $intIdUsuario;
	private $strUsuario;
	private $strPassword;
	private $strToken;

	public function __construct()
	{
		parent::__construct();
	}

	public function loginUSer(string $usuario, string $password)
	{
		$this->strUsuario = $usuario;
		$this->strPassword = $password;
		$sql = "SELECT id,estatus FROM t_usuarios WHERE 
		nickname = '$this->strUsuario' and 
		password = '$this->strPassword' and 
		estatus != 0 ";
		$request = $this->select($sql);
		return $request;
	}
}
?>