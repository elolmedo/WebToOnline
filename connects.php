<?php

//Global vars
$GLOBALS['dbhost']	= "";

$GLOBALS['dbuser']	= "";
$GLOBALS['dbpass']	= "";
/*$GLOBALS['dbuser']	= "";
$GLOBALS['dbpass']	= ""


// Conexiones con funciones worpdress

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
// Conexiones con BD WP
// Connecto to COM --> option = 0 / 1 to connect to other extensions / 2 to mysql db
if(!function_exists("connect_to_Mysql")):
	function connect_to_Mysql($extension, $option, $dominio){
		
		switch ($option) {
			case 0:
					$dbname = "empresa_db_com";
					break;
			case 1:
					if ($dominio == 'pt.empresa.com' || $dominio == 'en.empresa.com')
					{
						$dbname	= "empresa_db_com_".substr($extension, 0, -1);				
					}else{
						$dbname	= "empresa_db_".$extension;
					}
					break;
			case 2:
					$dbname = "mysql";
					break;
			default:
					die('Parámetro mal introducido');
					break;
		}
		
		try{
		
			$con_db= new PDO("mysql:host=".$GLOBALS['dbhost'].";dbname=".$dbname, $GLOBALS['dbuser'], $GLOBALS['dbpass']);
			//$con_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(Exception $e){
			if($e)
			{
				echo 'No se puede conectar con la BD: '.$dbname;
				$e->getMessage();
			}
		}
		
		return $con_db;
	}
endif;

?>
