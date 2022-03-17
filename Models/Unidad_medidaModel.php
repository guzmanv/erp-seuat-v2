<?php

class Unidad_medidaModel extends Mysql
{
    public $intIdUnidad_medida;
    public $strNombre_unidad_medida;
    public $intEstatus;
    public $intId_usuario_creacion;
    public $intId_usuario_actualizacion;
    public $strFecha_creacion;
    public $strFecha_actualizacion;
  

	public function __construct()
	{
		parent::__construct();
	}

    public function selectUnidad_medidas()
    {
        //Extraer todas los servicios
        $sql = "SELECT id, nombre_unidad_medida, estatus
                FROM t_unidades_medida
                WHERE estatus !=0
                ORDER BY nombre_unidad_medida ASC ";
        $request = $this->select_all($sql);
        return $request;
    }


    public function insertUnidad_medida(string $nombre_unidad_medida, int $estatus, int $id_usuario_creacion, int $id_usuario_actualizacion, string $fecha_creacion, string $fecha_actualizacion){

        $return = "";
        $this->strNombre_unidad_medida = $nombre_unidad_medida;
        $this->intEstatus = $estatus;
        $this->intId_usuario_creacion = $id_usuario_creacion;
        $this->intId_usuario_actualizacion = $id_usuario_actualizacion;
        $this->strFecha_creacion = $fecha_creacion; // '2022-10-23 00:00:00'; //$fecha_creacion;
        $this->strFecha_actualizacion = $fecha_actualizacion;
        

        $sql = "SELECT * FROM t_unidades_medida WHERE nombre_unidad_medida = '{$this->strNombre_unidad_medida}' ";
        $request = $this->select_all($sql);

        if(empty($request))
        {
            $query_insert = "INSERT INTO t_unidades_medida(nombre_unidad_medida,estatus,id_usuario_creacion,id_usuario_actualizacion,fecha_creacion,fecha_actualizacion) VALUES(?,?,?,?,?,?)";
            $arrData = array($this->strNombre_unidad_medida, $this->intEstatus, $this->intId_usuario_creacion, $this->intId_usuario_actualizacion, $this->strFecha_creacion, $this->strFecha_actualizacion );
            $request_insert = $this->insert($query_insert,$arrData);
            $return = $request_insert;
        }else{
            $return = "exist";
        }
        return $return;
    }	



    public function selectUnidad_medida(int $intIdUnidad_medida)
    {
        //Buscar una unidad de medida
        $this->intIdUnidad_medida = $intIdUnidad_medida;
        $sql = "SELECT * FROM t_unidades_medida WHERE id = $this->intIdUnidad_medida";
        $request = $this->select($sql);
        return $request;
    }



    public function updateUnidad_medida(int $id, string $nombre_unidad_medida, int $estatus, string $fecha_actualizacion, int $id_usuario_actualizacion)
    {

        $this->intIdUnidad_medida = $id;
        $this->strNombre_unidad_medida = $nombre_unidad_medida;
        $this->intEstatus = $estatus;
        $this->strFecha_actualizacion = $fecha_actualizacion;
        $this->intId_usuario_actualizacion = $id_usuario_actualizacion;

        $sql = "SELECT * FROM t_unidades_medida WHERE nombre_unidad_medida = '$this->strNombre_unidad_medida' AND id != $this->intIdUnidad_medida";
        $request = $this->select_all($sql);

        if(empty($request))
        {
            $sql = "UPDATE t_unidades_medida SET nombre_unidad_medida = ?, estatus = ?, fecha_actualizacion = NOW(), id_usuario_actualizacion = ? WHERE id = $this->intIdUnidad_medida ";
            $arrData = array($this->strNombre_unidad_medida, $this->intEstatus, $this->intId_usuario_actualizacion);
            $request = $this->update($sql,$arrData);
        }else{
            $request = "exist";
        }
        return $request;			
    }


    public function deleteUnidad_medida(int $idunidad_medida)
		{
			$this->intIdUnidad_medida = $idunidad_medida;
			$sql = "SELECT * FROM t_servicios WHERE id_unidades_medida = $this->intIdUnidad_medida";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE t_unidades_medida SET estatus = ? WHERE id = $this->intIdUnidad_medida";
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