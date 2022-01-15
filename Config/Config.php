<?php

	//define("BASE_URL", "http://localhost/erp-seuat-v1/");
	const BASE_URL = "http://localhost:8888/erp-seuat-v2";

	//Zona horaria
	date_default_timezone_set('America/Mexico_City');

	//const LIBS = "Libraries/";
	//const VIEWS = "Views/";
	const DB_HOST = "localhost:8889";
	const DB_NAME = "erpseuat";
	const DB_USER = "root";
	const DB_PASSWORD = "root";
	const DB_CHARSET = "utf8";

	//Delimitadores decimal y millar Ej. 27,1985.00
	const SPD = "."; //Separador de decimales
	const SPM = ","; //Separador de millares

	//Simbolo de moneda
	const SMONEDA = "$";

?>