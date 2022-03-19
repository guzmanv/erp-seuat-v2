<?php

class Categoria_serviciosModel extends Mysql
{
    public $intIdCategoria_servicios;
	public $strNombre_categoria;
	public $intEstatus;
	public $strFecha_creacion;
    public $strFecha_actualizacion;
    public $intId_usuario_creacion;
    public $intId_usuario_actualizacion;

	public function __construct()
	{
		parent::__construct();
	}

    public function selectCategoria_servicios()
    {
        //Extraer las categorias de servicios
        $sql = "SELECT * FROM t_categoria_servicios WHERE estatus !=0";
        $request = $this->select_all($sql);
        return $request;
    }
    

    public function selectCategoria_servicio(int $intIdCategoria_servicios)
    {
        //Buscar Categoria
        $this->intIdCategoria_servicios = $intIdCategoria_servicios;
        $sql = "SELECT * FROM t_categoria_servicios WHERE id = $this->intIdCategoria_servicios";
        $request = $this->select($sql);
        return $request;
    }


    public function insertCategoria_servicios(string $strClave_categoria,string $strNombre_categoria,int $intAplica_colegiatura,int $intEstatus,int $id_user){
        $return = "";
        $this->strNombre_categoria = $nombre_categoria;
        $this->intEstatus = $estatus;
        $this->strFecha_creacion = $fecha_creacion;
        $this->strFecha_actualizacion = $fecha_actualizacion;
        $this->intId_usuario_creacion = $id_usuario_creacion;
        $this->intId_usuario_actualizacion = $id_usuario_actualizacion;

        $sql = "SELECT * FROM t_categoria_servicios WHERE nombre_categoria = '{$this->strNombre_categoria}' ";
        $request = $this->select_all($sql);

        if(empty($request))
        {
            $query_insert = "INSERT INTO t_categoria_servicios(nombre_categoria,estatus,fecha_creacion,fecha_actualizacion,id_usuario_creacion,id_usuario_actualizacion) VALUES(?,?,?,?,?,?)";
            $arrData = array($this->strNombre_categoria, $this->intEstatus, $this->strFecha_creacion, $this->strFecha_actualizacion, $this->intId_usuario_creacion, $this->intId_usuario_actualizacion );
            $request_insert = $this->insert($query_insert,$arrData);
            $return = $this->intId_usuario_actualizacion;
        }else{
            $return = "exist";
        } */
        return $id_user;
    }	


    public function updateCategoria_servicios(int $id, string $nombre_categoria, int $estatus, string $fecha_actualizacion, int $id_usuario_actualizacion){

        $this->intIdCategoria_servicios = $id;
        $this->strNombre_categoria = $nombre_categoria;
        $this->intEstatus = $estatus;
        //$this->strFecha_actualizacion = $fecha_actualizacion;
        $this->intId_usuario_actualizacion = $id_usuario_actualizacion;

        $sql = "SELECT * FROM t_categoria_servicios WHERE nombre_categoria = '$this->strNombre_categoria' AND id != $this->intIdCategoria_servicios";
        $request = $this->select_all($sql);

        if(empty($request))
        {
            $sql = "UPDATE t_categoria_servicios SET nombre_categoria = ?, estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ? WHERE id = $this->intIdCategoria_servicios ";
            $arrData = array($this->strNombre_categoria, $this->intEstatus, $this->intId_usuario_actualizacion);
            $request = $this->update($sql,$arrData);
        }else{
            $request = "exist";
        }
        return $request;			
    }


    public function deleteCategoria_servicios(int $idcategoria_servicios)
		{
			$this->intIdCategoria_servicios = $idcategoria_servicios;
			$sql = "SELECT * FROM t_servicios WHERE id_categoria_servicio = $this->intIdCategoria_servicios";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE t_categoria_servicios SET estatus = ? WHERE id = $this->intIdCategoria_servicios";
				$arrData = array(0);
				$request = $this->update($sql,$arrData);
				if($request)
				{
					$request = 'ok';	
				}else{
					$request = 'error';
				}
			}else{
				$request = 'exist';
			}
			return $request;
		}


}
?>