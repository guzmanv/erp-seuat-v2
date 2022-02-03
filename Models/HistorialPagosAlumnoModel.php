<?php
	class HistorialPagosAlumnoModel extends Mysql
	{
		public function __construct()
		{
			parent::__construct();
		}
		//Funcion para consultar lista de Estudiantes
        public function selectEstudiantes(){
            $sql = "SELECT *FROM t_inscripciones";
            $request = $this->select_all($sql);
            return $request;
        }
	}
?>  