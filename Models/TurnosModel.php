<?php
class TurnosModel extends Mysql
{
    public $intIdTurno;
    public $strNombreTurno;
    public $strAbreviatura;
    public $tmHoraEnt;
    public $tmHoraSal;
    public $intLu;
    public $intMa;
    public $intMi;
    public $intJu;
    public $intVi;
    public $intSa;
    public $intDo;
    public $estatus;

    public function __construct()
    {
        parent::__construct();
    }

    public function selectTurnos()
    {
        $sql = "SELECT id, nombre_turno, abreviatura, hora_entrada, hora_salida, estatus 
        FROM t_turnos WHERE estatus <> 0";
        $request = $this->select_all($sql);
        return $request;
    }
    
    public function insertTurno(string $nombreTurno, string $abreviatura, string $horaEnt, string $horaSal, int $lun, int $mar, int $mie, int $jue, int $vie, int $sab, int $dom)
    {
        $return = "";
        $this->strNombreTurno = $nombreTurno;
        $this->strAbreviatura = $abreviatura;
        $this->tmHoraEnt = $horaEnt;
        $this->tmHoraSal = $horaSal;
        $this->intLu = $lun;
        $this->intMa = $mar;
        $this->intMi = $mie;
        $this->intJu = $jue;
        $this->intVi = $vie;
        $this->intSa = $sab;
        $this->intDo = $dom;

        $sql = "SELECT * FROM t_turnos where nombre_turno = '{$this->strNombreTurno}'";
        $request = $this->select($sql);
        if(empty($request))
        {
            $query_insert = "INSERT INTO t_turnos(nombre_turno, abreviatura, hora_entrada, hora_salida, lu, ma, mi, ju, vi, sa, do, estatus) VALUES (?,?,?,?,?,?,?,?,?,?,?,1)";
            $arrData = array($this->strNombreTurno, $this->strAbreviatura, $this->tmHoraEnt, $this->tmHoraSal, $this->intLu,$this->intMa,$this->intMi, $this->intJu, $this->intVi, $this->intSa, $this->intDo);
            $request_insert = $this->insert($query_insert,$arrData);
        }
        else
        {
            $return = "exist";
        }
        return $return;
    }

}