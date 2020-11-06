<?php

define("PATHCOM","/home/empresa/COM/WebMain/empresa.com/");
define("PATHAR","/home/empresa/AR/WebMain/empresa.ar/");
define("PATHBR","/home/empresa/BR/WebMain/empresa.br/");
define("PATHPT", "/home/empresa/PT/WebMain/empresa.pt/");
define("PATHCL","/home/empresa/CL/WebMain/empresa.cl/");
define("PATHPE","/home/empresa/PE/WebMain/empresa.pe/");
define("PATHEC", "/home/empresa/EC/WebMain/empresa.ec/");
define("PATHCO","/home/empresa/CO/WebMain/empresa.co/");
define("PATHUY","/home/empresa/UR/WebMain/empresa.ur/");
define("PATHES","/home/empresa/ES/WebMain/empresa.es/");
define("PATHPA", "/home/empresa/PA/WebMain/temeplgroup.pa/");
define("PATHMX","/home/empresa/MX/WebMain/empresa.mx/");
define("PATHCOMPT","/home/empresa/SubDomains/pt.empresa.com/");
define("PATHCOMEN","/home/empresa/SubDomains/en.empresa.com/");

define("PATHWEBTO", "/home/empresa/bin/WebToOnline/");

//Definición de constantes para servidores
// empresa.com /empresa.es / empresa.pt / pt.empresa.com / en.empresa.com
define("host_Acens",'');
// empresa.com.ar
define("host_Argentina",'');
// empresa.cl
define("host_Chile", '');
// empresa.mx
define("host_Mexico", '');
// empresa.co / empresa.pa
define("host_Colombia_Panama", '');
// empresa.ec // empresa.pe
define("host_Peru_Ecuador", '');
// empresa.uy
define("host_Brasil_Uruguay",'');

include 'connects_dev.php';
include 'connects.php';

////////////////////////////////////////////////////////////
//Funci�n que devuelve las rutas segun la extension
if(!function_exists("GetPath")):
	function GetPath($extension){
		if($extension == "pt" || $extension == "en")
			return "/home/empresa/COM/WebMain/".$extension."/";
		else
			return "/home/empresa/".strtoupper($extension)."/WebMain/";
	}
endif;
if(!function_exists("GetFullPath")):
	function GetFullPath($extension){
		if($extension == "pt1" || $extension == "en1"){
			
			return "/home/empresa/COM/SubDomains/";
			
		}elseif ($extension == "com"){
			
			return "/home/empresa/COM/WebMain/";
		}
		else{
			return "/home/empresa/".strtoupper($extension)."/WebMain/";
		}
				
	}
endif;
if(!function_exists("GetFullPathBackup")):
	function GetFullPathBackup($extension){
		if($extension == "pt1" || $extension == "en1"){
			return "/home/empresa/COM/Backups/";
		}elseif($extension == "com"){
			return "/home/empresa/COM/Backups/";
		}else{
			
			return "/home/empresa/".strtoupper($extension)."/Backups/";
		}
			

	}
endif;

////////////////////////////////////////////////////////////
//Funci�n que controla el dominio y devuelve la extension
if(!function_exists("GetExtension")):
	function GetExtension($dominio){
		//control de errores
		if($dominio == null)
		{
			echo 'El par�metro de la funci�n esta vaci�'."\n";
			error("20", "Error en le parametro de la funci�n GetExtension");
			die();
		}
		
		//Obtengo la extension del dominio
		if($dominio=="pt.empresa.com"){
			$extension = "pt1";
		}elseif ($dominio=="en.empresa.com"){
			$extension = "en1";
		}elseif($dominio == "empresa.com"){
			$extension = "com";
		}else{
			$extension = substr($dominio, -2);
		}
		
		return $extension;
	}
endif;

/////////////////////////////////////////////////////////
//Función para obtener una linea del archvo especificado
if(!function_exists("getLineFile")):
function getLineFile ($myFile, $findMe){
	
	$lines = file($myFile);
	
	for($pos=0;$pos<count($lines);$pos++){
		
		$result = strpos($lines[$pos], $findMe);
		
		if($result !== false)
			return $lines[$pos];
	}
	
	return '';
}
endif;



///////////////////////////////////////////////////////////////
//Función que devuelve el user Mysql en función de la extensión
if(!function_exists("GetUserMysql")):
function GetUserMysql($dominio){
	
	$extension = GetExtension($dominio);
	
	//Obtengo la extension del dominio
	if($dominio=="pt.empresa.com" || $dominio=="en.empresa.com")
	{
		return "user_com_".substr($extension, 0, -1)."_db";
	}else{
		
		return "user_".$extension."_db";
	}
	
}
endif;

///////////////////////////////////////////////////////////////
//Función para obtener el password de MySQL según dominio
if(!function_exists("GetPassMysql")):
	function GetPassMysql($dominio){
		
		//Obtenemos la extensión para obtener del directorio bueno el archivo wp-config.php
		$extension 	= GetExtension($dominio);
		
		//Obtenemos la ruta hacia el fichero wp-config.php
		$fullPath 	= GetFullPath($extension);
		
		//Definimos la palabra de la línea que queremos coger y guardar.
		$findMeMysql = 'DB_PASSWORD';
		
		//Variable donde devolveremos la contraseña
		$password = '';
				
		if ($extension == 'pt1' || $extension == 'en1'){
			
			$fichero = $fullPath."".substr($extension, 0,1)."empresa.com/wp-config.php";
			$lineaPassword = getLineFile($fichero, $findMeMysql);
			
			$password = substr($lineaPassword, 23, 8);
			
			return $password;
			
			
						
		}elseif ($extension == 'com'){
			
			$fichero = $fullPath."empresa.".$extension."/wp-config.php";
			$lineaPassword 	= getLineFile($fichero, $findMeMysql);
			
			$password 	= substr($lineaPassword,23,9);
			
			return $password;
			
		}else{
			
			$fichero = $fullPath."empresa.".$extension."/wp-config.php";
			$lineaPassword 	= getLineFile($fichero, $findMeMysql);
			
			$password 	= substr($lineaPassword,23,8);
			
			return $password;
			
		}
		
		
		
		if ($password != '' && $fichero != ''){
			
			echo '[Info] Fichero guardado y contraseña obtenida';
			
			
		}else{
			
			echo '[Error] Al obtener el password Mysql';	
		}
		
		
		
		
		
		
		
	}
endif;

//////////////////////////////////////////////////////////////////////
//Función para obtener la base de datos correspondiente al dominio
if(!function_exists("GetDBName")):
	function GetDBName($dominio){
		
		$extension = GetExtension($dominio);
		$dbname = '';
		
		if ($dominio == 'pt.empresa.com' || $dominio == 'en.empresa.com'){
			
			$dbname = "empresa_db_com_".$extension;
			
		}else{
			
			$dbname = "empresa_db_".$extension;
			
		}
		
		return $dbname;
	}
endif;

///////////////////////////////////////////////////////////////
//Función para registrar los errores
if(!function_exists('error')):
	function error($num,$texto_error){
		
		$fichero_errores = fopen("error.log",'a');
		fwrite($fichero_errores, "[".date("r")."] Error ".$num.": ".$texto_error."\r\n");
		fclose($fichero_errores);
	}
	set_error_handler('error');
endif;

//////////////////////////////////////////////////////////////////////
//Función que devuelve un array con todos los dominios empresa.com
if(!function_exists('GetDomains')):
	function GetAllDomains(){
		
		$array_domains = array();
		
		$array_domains = 	[	'empresa.com','empresa.com.ar','empresa.com.br','empresa.pt',
								'empresa.mx','empresa.pe','empresa.ec',
								'empresa.com.pa','empresa.uy','empresa.cl',
								'empresa.co','empresa.es','pt.empresa.com',
								'en.empresa.com'
		];
		
		return $array_domains;	
}
endif;

///////////////////////////////////////////////////////////////////////
//Función que muestra el texto de presentación
if(!function_exists('PresentacionWebToOnline')):
function PresentacionWebToOnline(){
	
	echo shell_exec("figlet WebToOnline");
	echo shell_exec("figlet Tempel Group");
	
}
endif;

//////////////////////////////////////////////////////////////////////////////////////////////////////
//Función para seleccionar el dominio donde queremos replicar, este lo introduce el usuario por teclado
if(!function_exists('ElegirDominio')):
function ElegirDominio(){
	
	echo 'Elige un domino de esta lista para poner Online dicho dominio: '."\n";
	
	$dominios 	= 	GetAllDomains();
	
	$length_dominios = count($dominios);
	
	for ($x=0;$x<$length_dominios;$x++){
		echo 'Dominio: '.$dominios[$x] . "\n";
	}
	
	echo 'Introduce uno de los dominios de la lista: '."\n";
	// Cogemos línea
	try{
		
		$entrada_dominios = trim(fgets(STDIN));
		
	}catch(Exception $e){
		
		error("1", $e->getMessage());
	};
	
	$select_domain = '';

	$WebToOnline = false;
	for($x=0;$x<count($dominios);$x++){

		if ($entrada_dominios == $dominios[$x]) {
			$WebToOnline = true;
			echo 'Dominio seleccionado: '. $entrada_dominios . "\n";
			$select_domain = $entrada_dominios;
			echo shell_exec("figlet ".$entrada_dominios);
		}
	}

	if($WebToOnline)
		return $select_domain;
	else{
		echo shell_exec('clear');
		echo 'Opción incorrecta. Intentelo de nuevo.'."\n";
		return ElegirDominio();
	}



	return $select_domain;
};
endif;

///////////////////////////////////////////////////////////////////////////
//Función para comprobar si los fichero para la subida de la web existen
if(!function_exists('comprobarFicheros')):
	function comprobarFicheros($dominio){
		
		//Iniciamos la comprobación de la existencia de los directorios y ficheros necesarios para la
		//subida del dominio to Online.
		echo '[INFO] Iniciando la comprobación de ficheros para del dominio: '.$dominio."\n";

		$arrayDominios 	= 	GetAllDomains();
		$extension 		=	GetExtension($dominio);
		$fullPath 		= 	GetFullPath($extension); 
		$fullPathBackup = 	GetFullPathBackup($extension);
		
		for ($x=0;$x<count($arrayDominios);$x++){
			
			if ($dominio == $arrayDominios[$x]) {
				//Dominios pt1 y en1
				if ($extension == "pt1" || $extension == "en1"){
					
					$file_sql = $fullPathBackup."empresa_db_com_".$extension.".sql";
					$file_tar = $fullPathBackup."empresa_com_".$extension.".tar";
					
					$cmd_rm_sql = "rm -rf ".$file_sql;
					$cmd_rm_tar = "rm -rf ".$file_tar;
					
					if(file_exists($file_sql)){
						
						echo '[Info] El fichero SQL del dominio: '.$dominio.'si que existe'."\n";
						echo '[Info] Procedemos a borrarlo y a generar uno actual'."\n";
						
						// Eliminamos el fichero existente SQL de pt1 o en1
						try{
							
							shell_exec($cmd_rm_sql);
							
						}catch(Exception $e){
							
							if($e){
								echo '[Error] Error borrando el archivo: '.$file_sql."\n";
							}
							
						}finally{
							
							if(!$e){
								//pt1 en1
								//Archivo SQL borrado
								echo '[Info] Archivo sql borrado correctamente'."\n";
								echo '[Info] Procedemos a la creación del backup SQL del dominio: '.$dominio."\n";
								$cmd_mysqldump = "mysqldump -u user_ms_db -ppassword_db! empresa_db_com_".substr($extension, 0, -1)." > ".$fullPathBackup."empresa_db_com_".substr($extension, 0, -1).".sql";
								
								//Creación de la copia de seguridad SQL
								try{
									shell_exec($cmd_mysqldump);
									
								}catch(Exception $e){
									if($e){
										echo 'Error creando la copia sql del dominio'.$dominio."\n";
										echo $e->getMessage();
									}
								}
							}	
						}
					
					}else{
						
						//pt1 en1
						//Archivo SQL borrado
						echo '[Info] El fichero SQL no existe'."\n";
						echo '[Info] Procedemos a la creación del backup SQL del dominio: '.$dominio."\n";
						$cmd_mysqldump = "mysqldump -u user_ms_db -ppassword_db! empresa_db_com_".substr($extension, 0, -1)." > ".$fullPathBackup."empresa_db_com_".substr($extension, 0, -1).".sql";
						
						//Creación de la copia de seguridad SQL
						try{
							shell_exec($cmd_mysqldump);
							
						}catch(Exception $e){
							if($e){
								echo '[Error] creando la copia sql del dominio'.$dominio."\n";
								echo $e->getMessage();
							}
						}	
					
					}
					//Fichero Tar de pt1 o en1
					if (file_exists($file_tar)){
					
						echo '[Info] El fichero TAR del dominio: '.$dominio.'si que existe'."\n";
						echo '[Info] Procedemos a borrarlo y a generar uno actual'."\n";
						
						//Eliminamos el fichero existente TAR
						try{
							shell_exec($cmd_rm_tar);
							
						}catch(Exception $e){
							
							if($e){
								
								echo '[Error] borrando el archivo: '.$file_tar."\n";
							}		
						}finally{
							if(!$e){
								//Archivo TAR
								echo '[Info] Procedemos a la creación del backup TAR del dominio: '.$dominio."\n";
								$cmd_tar = "tar -cvf ".$fullPathBackup."empresa_com_".substr($extension, 0, -1).".tar ".substr($extension, 0, -1).".empresa.com/";
								
								//Creación del la copia de seguridad TAR
								try{
									chdir($fullPath);
									shell_exec($cmd_tar);
									
								}catch (Exception $e){
									if($e){
										echo '[Error] al comprimir el directorio del dominio: '.$dominio;
										$e->getMessage();
									}
								}
							}
								
						}
						
					}else{
						echo '[Info] El fichero TAR no existe'."\n";
						//Archivo TAR
						echo '[Info] Procedemos a la creación del backup TAR del dominio: '.$dominio."\n";
						$cmd_tar = "tar -cvf ".$fullPathBackup."empresa_com_".substr($extension, 0, -1).".tar ".substr($extension, 0, -1).".empresa.com/";
						
						//Creación del la copia de seguridad TAR
						try{
							chdir($fullPath);
							shell_exec($cmd_tar);
							
						}catch (Exception $e){
							if($e){
								echo '[Error]  al comprimir el directorio del dominio: '.$dominio;
								$e->getMessage();
							}	
						}
						
					}
				
			//Fin casos pt1 o en1
			
			//Los demás tipos de dominios	
			}else{
				
				$file_sql = $fullPathBackup."empresa_db_".$extension.".sql";
				$file_tar = $fullPathBackup."empresa_".$extension.".tar";
				
				$cmd_rm_sql = "rm -rf ".$file_sql;
				$cmd_rm_tar = "rm -rf ".$file_tar;
				
				
				if (file_exists($file_sql)){
					
					echo '[Info] El fichero '.$file_sql.' del dominio: '.$dominio.' si que existe'."\n";
					echo '[Info] Procedemos al borrado del fichero'."\n";
					
					try{
						
						shell_exec($cmd_rm_sql);
						
					}catch (Exception $e){
						if($e){
							
							echo '[Error] Fallo al borrar el fichero SQL'."\n";
							echo $e->getMessage();
						}
							
					}finally {
						
						if(!$e){
							echo '[Info] El fichero fue borrado sin problemas'."\n";
							//Archivo SQL borrado
							echo '[Info] Procedemos a la creación del backup SQL del dominio: '.$dominio."\n";
							$cmd_mysqldump = "mysqldump -u user_ms_db -ppassword_db! empresa_db_".$extension." > ".$fullPathBackup."empresa_db_".$extension.".sql";
							
							//Creación de la copia de seguridad SQL
							try{
								
								shell_exec($cmd_mysqldump);
								
							}catch(Exception $e){
								if($e){
									echo '[Error] creando la copia sql del dominio'.$dominio."\n";
									echo $e->getMessage();
								}
							}finally {
									echo '[Info] Archivo SQL creado'."\n";
							}
						}
					}
												
				}else{
					
					echo '[Info] El fichero '.$file_sql.' no existe'."\n";
					//Archivo SQL borrado
					echo '[Info] Procedemos a la creación del backup SQL del dominio: '.$dominio."\n";
					$cmd_mysqldump = "mysqldump -u user_ms_db -ppassword_db! empresa_db_".$extension." > ".$fullPathBackup."empresa_db_".$extension.".sql";
					
					//Creación de la copia de seguridad SQL
					try{
						shell_exec($cmd_mysqldump);
						
					}catch(Exception $e){
						if($e){
							echo '[Error] creando la copia sql del dominio'.$dominio."\n";
							echo $e->getMessage();
						}
					}finally{
						
							echo '[Info] Archivo SQL creado'."\n";
					}
				}
				
				if (file_exists($file_tar)){
					
					echo '[Info] El fichero '.$file_tar.' del dominio: '.$dominio.'si que existe'."\n";
					echo '[Info] Procedemos a borrarlo y a generar uno actual'."\n";
					
					//Eliminamos el fichero existente TAR
					try{
						echo '[Info] Borrando el fichero antiguo TAR'."\n";
						shell_exec($cmd_rm_tar);
						
					}catch(Exception $e){
						
						if($e){
							
							echo '[Error] Error borrando el archivo: '.$file_tar."\n";
							echo $e->getMessage();
						}
							
					}finally{
							
							//Archivo TAR
							echo '[Info] Procedemos a la creación del backup TAR del dominio: '.$dominio."\n";
							$cmd_tar = "tar -cvf ".$fullPathBackup."empresa_".$extension.".tar empresa.".$extension."/";
							
							//Creación del la copia de seguridad TAR
							try{
								chdir($fullPath);
								shell_exec($cmd_tar);
								
							}catch (Exception $e){
								if($e){
									
									echo '[Error]  Al comprimir el directorio del dominio: '.$dominio;
								}	$e->getMessage();
							}
							
					}
			
				}else{
					echo '[Info] El fichero '.$file_tar.' no existe'."\n";
					//Archivo TAR
					echo '[Info] Procedemos a la creación del backup TAR del dominio: '.$dominio."\n";
					$cmd_tar = "tar -cvf ".$fullPathBackup."empresa_".$extension.".tar empresa.".$extension."/";
					
					//Creación del la copia de seguridad TAR
					try{
						chdir($fullPath);
						shell_exec($cmd_tar);
						
					}catch (Exception $e){
						if($e){
							echo '[Error] Al comprimir el directorio del dominio: '.$dominio;
						}	$e->getMessage();	
					}
					
				}
			}	
		}
	}
}
endif;

///////////////////////////////////////////////////////////////////////////////
//Función para subir los ficheros de backup según el dominio que introduzcamos
if(!function_exists("UploadFiles")):
	function UploadFiles($dominio){
		
		$arrayDominios 	= 	GetAllDomains();
		$extension 		=	GetExtension($dominio);
		$fullPath 		= GetFullPath($extension);
		$fullPathBackup 		= GetFullPathBackup($extension);
		
		// Conexión SSH
		$connectionssh 	= ssh2_connect(host_Acens, 22);
		
		try{
			
			ssh2_auth_password($connectionssh, "root", "pass_ssh");
			
		}catch (Exception $e){
			
			if ($e){
				echo 'Error en la conexión SSH'."\n";
				$e->getMessage();
			}
		}
		
				
		for($x=0;$x<count($arrayDominios); $x++){
			
			if ($dominio == $arrayDominios[$x]){
				
				if ($extension == "pt1" or $extension == "en1"){
					
					$localfileSQL = $fullPathBackup."empresa_db_com_".substr($extension, 0, -1).".sql";  
					$localfileTAR = $fullPathBackup."empresa_com_".substr($extension, 0, -1).".tar";
					
					$remotefileSQL = $fullPathBackup."empresa_db_com_".substr($extension, 0, -1).".sql";
					$remotefileTAR = $fullPathBackup."empresa_com_".substr($extension, 0, -1).".tar";
					
					echo '[Info] Comenzamos con el envió del fichero SQL hacia el dominio: '.$dominio."\n";
					try{
						ssh2_scp_send($connectionssh, $localfileSQL, $remotefileSQL);
						
					}catch (Exception $e){
						if($e){
							echo '[Error] Fallo al enviar el fichero SQL'."\n";
							echo $e->getMessage();
							
						}else{
							echo '[Info] Fichero SQL enviado correctamente'."\n";
						}
					}
					
					echo '[Info] Comenzamos con el envió del fichero .tar hacia el dominio: '.$dominio."\n";
					try{
						
						ssh2_scp_send($connectionssh, $localfileTAR, $remotefileTAR);
						
					}catch(Exception $e){
						if($e){
							echo '[Error] Fallo al enviar el fichero TAR'."\n";
							echo $e->getMessage();
							
						}else{
							echo '[Info] Fichero TAr enviado correctamente'."\n";
						}
					}
					
					
					
				}else{
					
					$localfileSQL = $fullPathBackup."empresa_db_".$extension.".sql";
					$localfileTAR = $fullPathBackup."empresa_".$extension.".tar";
					
					$remotefileSQL = $fullPathBackup."empresa_db_".$extension.".sql";
					$remotefileTAR = $fullPathBackup."empresa_".$extension.".tar";
					
					echo '[Info] Comenzamos con el envió del fichero SQL hacia el dominio: '.$dominio."\n";
					try{
						ssh2_scp_send($connectionssh, $localfileSQL, $remotefileSQL);
						
					}catch (Exception $e){
						if($e){
							echo '[Error] Fallo al enviar el fichero SQL'."\n";
							echo $e->getMessage();
							
						}
					}finally {
						
						echo '[Info] Fichero SQL enviado correctamente'."\n";
					}
					
					echo '[Info] Comenzamos con el envió del fichero .tar hacia el dominio: '.$dominio."\n";
					try{
						
						ssh2_scp_send($connectionssh, $localfileTAR, $remotefileTAR);
						
					}catch(Exception $e){
						if($e){
							echo '[Error] Fallo al enviar el fichero TAR'."\n";
							echo $e->getMessage();	
						}
					}finally{
						
						echo '[Info] Fichero TAr enviado correctamente'."\n";
					}		
				}
			}
			
			//Cerramos conexión SSH
			ssh2_exec($connectionssh, 'exit');
			unset($connectionssh);
		}
	}
endif;

///////////////////////////////////////////////////////////////////////////////////
//Función para preparar el directorio web donde hemos subido los archivos Backup
if(!function_exists("prepararDirectorios")):
	function prepararDirectorios($dominio){
		
		$extension 		= GetExtension($dominio);
		$fullPath 		= GetFullPath($extension);
		$fullPathBackup = GetFullPathBackup($extension);
		
		$array_dominios = GetAllDomains();
		
		$connection = ssh2_connect(host_Acens,22);
		try{
			
			ssh2_auth_password($connection, "root", "pass_ssh");
			
		}catch (Exception $e){
			if($e){
				echo '[Error] en la conexión SSH';
				echo $e->getMessage();
			}
			
		}finally {
			if(!$e){
				echo '[Info] Conexión realizada con éxito'."\n";
				ssh2_exec($connection, 'ls -al /home/empresa');
			}
			
		}
		
	
		
		if ($extension == 'pt1' || $extension == 'en1'){
			
			echo '[Info] Iniciamos la preparación de los directorios'."\n";
			$cmd_mv = "mv ".$fullPath."".$extension.".empresa.com ".$fullPath."".substr($extension, 0, -1)."empresa.com_".date('d-m-y');
			
			//echo 'dentro del bucle y pt1 || en1'."\n";
			//var_dump('comando mv pt1 y en1. '.$cmd_mv);
			
			try{
				
				//Cambio de nombre de la carpeta de la web
				ssh2_exec($connection, $cmd_mv);
				
			}catch (Exception $e){
				if ($e){
					
					echo '[Error] Fallo al cambiar de nombre del directorio del dominio: '.$dominio."\n";
					echo $e->getMessage();
				}
			}finally {
				if(!$e){
					
					echo '[Info] Cambio de nombre del directorio es Correcto!'."\n";
					
				}
			}
			
		}else{
			
			echo '[Info] Iniciamos la preparación de los directorios'."\n";
			$cmd_mv = "mv ".$fullPath."empresa.".$extension." ".$fullPath."empresa.".$extension."_".date('d-m-y');
			
			//echo 'dentro del bucle y dominios'."\n";
			//var_dump('comando mv otros dominios'.$cmd_mv);
			
			try{
				
				//Cambio de nombre de la carpeta de la web
				ssh2_exec($connection, $cmd_mv);
				
			}catch (Exception $e){
				if ($e){
					echo '[Error] Fallo al cambiar de nombre del directorio del dominio: '.$dominio."\n";
					echo $e->getMessage();
				}
			}finally {
				if(!$e){
					
					echo '[Info] Cambio de nombre del directorio es Correcto!'."\n";
				}
			}
		}
		//Apagamos conexión SSH
		ssh2_exec($connection, 'exit');
		unset($connection);
	}
endif;

////////////////////////////////////////////////////////////////////////////////////
//Función para descomprimir el *.tar según el dominio elegido
if(!function_exists("deCompress")):
	function deCompress($dominio){
		
		$extension 		= GetExtension($dominio);
		$fullPath 		= GetFullPath($extension);
		$fullPathBackup = GetFullPathBackup($extension);
		
		$array_dominios = GetAllDomains();
		
		$connection = ssh2_connect(host_Acens,22);
		
		//Conexión con control de errores
		try{
			ssh2_auth_password($connection, "root", "pass_ssh");
		}catch (Exception $e){
			if($e){
				echo '[Error] Error de conexión ssh'."\n";
				echo $e->getMessage();
			}
		}finally {
			if(!$e){
				echo '[Info] Conexión SSH realizada con éxito'."\n";
			}
			
		}
					
		if ($extension == "pt1" || $extension == "en1"){
			
			echo '[Info] Empezamos con las descompresión del fichero tar del dominio: '.$dominio."\n";
			//Comando de descompresión
			$cmd_tar = "tar -xf /home/tempelgorup/COM/Backups/".substr($extension, 0, -1).".empresa_com.tar -C /home/empresa/COM/Subdomains/";
			
			try{
				ssh2_exec($connection, $cmd_tar);
			}catch (Exception $e){
				if ($e){
					echo '[Error] Fallo al descomprimir el fichero del dominio: '.$dominio."\n";
					echo $e->getMessage();
				}
			}finally {
				if(!$e){
					echo '[Info] Archivo descomprimido con éxito'."\n";
				}
			}
			
		}elseif($extension == 'com'){
			
			echo '[Info] Empezamos con las descompresión del fichero tar del dominio: '.$dominio."\n";
			//Comando de descompresión
			$cmd_tar = "tar -xf /home/tempelgorup/COM/Backups/empresa_com.tar -C /home/empresa/COM/WebMain/";
					
			try{
				ssh2_exec($connection, $cmd_tar);
			}catch (Exception $e){
				if ($e){
					echo '[Error] Fallo al descomprimir el fichero del dominio: '.$dominio."\n";
					echo $e->getMessage();
				}
			}finally {
				if(!$e){
					echo '[Info] Archivo descomprimido con éxito'."\n";
				}
			}
			
			echo '[Info] Iniciamos la recuperación de las carpetas de imágenes, firmas y correos [mailing - uploads - catalogos]'."\n";
			
			$cmd_mv_mailing = "cp -r /home/empresa/COM/Webmain/empresa.com_".date("d-m-y")."/mailing /home/empresa/COM/WebMain/empresa.com/";
			$cmd_mv_uploads = "cp -r /home/empresa/COM/Webmain/empresa.com_".date("d-m-y")."/uploads /home/empresa/COM/WebMain/empresa.com/";
			$cmd_mv_catalogos = "cp -r /home/empresa/COM/Webmain/empresa.com_".date("d-m-y")."/catalogos /home/empresa/COM/WebMain/empresa.com/";
			
			//Carpeta Mailing
			try{
				ssh2_exec($connection, $cmd_mv_mailing);
				
			}catch (Exception $e){
				if($e){
					echo '[Error] Fallo al copiar la carpeta mailing'."\n";
					echo $e->getMessage();
				}
			}finally {
				if(!$e){
					echo '[Info] Copia de la carpeta mailing realizada con éxito'."\n";
				}
			}
			
			//Carpeta Uploads
			try{
				ssh2_exec($connection, $cmd_mv_uploads);
				
			}catch (Exception $e){
				if($e){
					echo '[Error] Fallo al copiar la carpeta uploads'."\n";
					echo $e->getMessage();
				}
			}finally {
				if(!$e){
					echo '[Info] Copia de la carpeta uploads realizada con éxito'."\n";
				}
			}
			
			//Carpeta Catalogos
			try{
				ssh2_exec($connection, $cmd_mv_catalogos);
				
			}catch (Exception $e){
				if($e){
					echo '[Error] Fallo al copiar la carpeta catalogos'."\n";
					echo $e->getMessage();
				}
			}finally {
				if(!$e){
					echo '[Info] Copia de la carpeta catalogos realizada con éxito'."\n";
				}
			}
			
			
		}else{
			echo '[Info] Empezamos con las descompresión del fichero tar del dominio: '.$dominio."\n";
			//Comando de descompresión
			$cmd_tar = "tar -xf /home/tempelgorup/".strtoupper($extension)."/Backups/.empresa_".$extension.".tar -C /home/empresa/".strtoupper($extension)."/WebMain/";
			
			try{
				ssh2_exec($connection, $cmd_tar);
			}catch (Exception $e){
				if ($e){
					echo '[Error] Fallo al descomprimir el fichero del dominio: '.$dominio."\n";
					echo $e->getMessage();
				}
			}finally {
				if(!$e){
					echo '[Info] Archivo descomprimido con éxito'."\n";
				}
			}
		}
		//Apagamos conexión SSH
		ssh2_exec($connection, 'exit');
		unset($connection);
		
	}
endif;

////////////////////////////////////////////
////////////////////////////////////////////
//////// VOY POR AQUÍ //////////////////////
/////////////////////////////////////////// PENSANDO EN CAMBIAR EL MÉTODO DE CONEXIÓN.


///////////////////////////////////////////////////////////////////////////////////////
//Función para guardar backup, borrar, crear y actualizar bases de datos
if(!function_exists("prepararBD")):
	function prepararBD($dominio){
		
		$extension 		= GetExtension($dominio);
		$fullPath 		= GetFullPath($extension);
		$fullPathBackup = GetFullPathBackup($extension);
		
		$array_dominios = GetAllDomains();
		
		$connection = ssh2_connect(host_Acens,22);
		
		//Conexión con control de errores
		try{
			ssh2_auth_password($connection, "root", "pass_ssh");
		}catch (Exception $e){
			if($e){
				echo '[Error] Error de conexión ssh'."\n";
				echo $e->getMessage();
			}
		}finally {
			if(!$e){
				echo '[Info] Conexión SSH realizada con éxito'."\n";
			}
			
		}
		
		//Obtenemos usuario, contraseña y bases de datos según dominio
		$userMysql 	= GetUserMysql($dominio);
		$password 	= GetPassMysql($dominio);
		$dbname 	= GetDBName($dominio);
		
		$userAdmin 	 = GetUserMysql('empresa.com');
		$passAdmin	 = GetPassMysql('empresa.com');
		$dbnameMysql = "mysql";
		
		// Host disponibles.
			// localhost. Servidor donde ejecutemos el Script. Normalmente en 172.16.1.47
			// Servidor de producción. Normalmente en remote ip
		
		$dbhostLocal = 'localhost';
		$dbhostRemote = 'remote ip';
		
			
		
				
		if ($extension == 'pt1' || $extension == 'en1'){
			
			//Proceso1. Borrado de la BD antigua.
			echo '[Info] Conexión con el SGBD Mysql del Servidor de producción.'."\n";
			
			$db_connection 	= connect_to_Mysql($extension, 1, $dominio);
			$sql_del		= "DROP DATABASE empresa_db_com_".substr($extension, 0, -1).";";
			
			try{
				echo '[Info] Prodecemos a borrar la BD del dominio: '.$dominio;
				$db_connection->query($sql_del);
				
			}catch (Exception $e){
				
				echo '[Error] Fallo al borrar la base de datos del dominio: '.$dominio.'.'."\n";
				echo $e->getMessage();
				
			}finally {
				
				echo '[Info] Base de datos Borrada con éxito'."\n";
			}
			
			//Proceso2. Creación de la nueva BD.
			echo '[Info] Procedemos a la creación de la BD del dominio: '.$dominio;
			$dbar->query("CREATE DATABASE empresa_db_com_ar");
			
			//Proceso3. Creación del usuario pertinente según dominio
			$sql_permission = "GRANT ALL PRIVILEGES ON ".$dbname.".* TO '".$usuario."'@'localhost' identified by '".$psswd."';";
			
			//Proceso4. Conexión con el nuevo usuario ya creado.
			
			//Proceso5. Update de la nueva BD con el nuevo usuario.
			echo '[Info] Procedemos a la actualización de la DB del dominio: '.$dominio;
			
		}else{
			
		}
	}
endif;
		
		
		

///////////////////////////////////////////////////////////////////////////////////////
//Función para restaurar los permisos de los directorios recién subidos
if(!function_exists("restorePermissions")):
	function restorePermissions($dominio){
		
				
		if ($dominio == "empresa.com"){
			
			$connection = ssh2_connect(host_Acens,22);
			ssh2_auth_password($connection, "root", "pass_ssh");
			
			$cmd_chown = "chown -R apache:apache ".PATHCOM;
			$cmd_chmod = "chmod -R 775 ".PAHTCOM;
			
			
			try{
				echo '[INFO] Cambiando propietarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] Propietarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
			}
			
			try{
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
			}
		
		}elseif ($dominio == "empresa.com.ar"){
			
			$connection = ssh2_connect(host_Argentina,22);
			ssh2_auth_password($connection, "", "");
			
			$cmd_chown = "chown -R apache.apache ".PATHAR;
			$cmd_chmod = "chmod -R 775 ".PATHAR;
			
			try{
				echo '[INFO] Cambiando propetarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] propetarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
				
			}
			
			try{
				
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
				
			}
			
		}elseif ($dominio == "empresa.com.br"){
			
			$connection = ssh2_connect(host_Brasil_Uruguay,22);
			//ssh2_auth_password($connection, $username, $password);
			
			$cmd_chown = "chown -R apache.apache ".PATHBR;
			$cmd_chmod = "chmod -R 775 ".PATHBR;
			
			try{
				echo '[INFO] Cambiando propetarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] propetarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
				
			}
			
			try{
				
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
				
			}
			
			
		}elseif ($dominio == "empresa.pt"){
			
			$connection = ssh2_connect(host_Acens,22);
			ssh2_auth_password($connection, "root", "pass_ssh");
			
			$cmd_chown = "chown -R apache:apache ".PATHPTº;
			$cmd_chmod = "chmod -R 775 ".PAHTPT;
			
			
			try{
				echo '[INFO] Cambiando propietarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] Propietarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
			}	
			
			try{
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
			}
			
		}elseif ($dominio == "empresa.mx"){
			
			$connection = ssh2_connect(host_Mexico,22);
			ssh2_auth_password($connection, $username, $password);
			
			$cmd_chown = "chown -R apache.apache ".PATHMX;
			$cmd_chmod = "chmod -R 775 ".PATHMX;
			
			try{
				echo '[INFO] Cambiando propetarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] propetarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
				
			}
			
			try{
				
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
				
			}
			
		}elseif ($dominio == "empresa.pe"){
			
			$connection = ssh2_connect(host_Peru_Ecuador,22);
			//ssh2_auth_password($connection, $username, $password);
			
			$cmd_chown = "chown -R apache.apache ".PATHPE;
			$cmd_chmod = "chmod -R 775 ".PATHAPE;
			
			try{
				echo '[INFO] Cambiando propetarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] propetarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
				
			}
			
			try{
				
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
				
			}
			
		}elseif ($dominio == "empresa.ec"){
			
			$connection = ssh2_connect(host_Peru_Ecuador,22);
			//ssh2_auth_password($connection, $username, $password);
			
			$cmd_chown = "chown -R apache.apache ".PATHEC;
			$cmd_chmod = "chmod -R 775 ".PATHEC;
			
			try{
				echo '[INFO] Cambiando propetarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] propetarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
				
			}
			
			try{
				
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
				
			}
			
			
		}elseif ($dominio == "empresa.pa"){
			
			$connection = ssh2_connect(host_Colombia_Panama,22);
			ssh2_auth_password($connection, $username, $password);
			
			$cmd_chown = "chown -R apache.apache ".PATHPA;
			$cmd_chmod = "chmod -R 775 ".PATHPA;
			
			try{
				echo '[INFO] Cambiando propetarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] propetarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
				
			}
			
			try{
				
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
				
			}

			
		}elseif ($dominio == "empresa.uy"){
			
			$connection = ssh2_connect(host_Brasil_Uruguay,22);
			//ssh2_auth_password($connection, $username, $password);
			
			$cmd_chown = "chown -R apache.apache ".PATHUY;
			$cmd_chmod = "chmod -R 775 ".PATHUY;
			
			try{
				echo '[INFO] Cambiando propetarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] propetarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
				
			}
			
			try{
				
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
				
			}
			
		}elseif ($dominio == "empresa.cl"){
			
			$connection = ssh2_connect(host_Chile,22);
			//ssh2_auth_password($connection, $username, $password);
			
			$cmd_chown = "chown -R apache.apache ".PATHCL;
			$cmd_chmod = "chmod -R 775 ".PATHCL;
			
			try{
				echo '[INFO] Cambiando propetarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] propetarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
				
			}
			
			try{
				
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
				
			}
			
		}elseif ($dominio == "empresa.co"){
			
			$connection = ssh2_connect(host_Colombia_Panama,22);
			//ssh2_auth_password($connection, $username, $password);
			
			$cmd_chown = "chown -R apache.apache ".PATHCO;
			$cmd_chmod = "chmod -R 775 ".PATHCO;
			
			try{
				echo '[INFO] Cambiando propetarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] propetarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
				
			}
			
			try{
				
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
				
			}
			
		}elseif ($dominio == "empresa.es"){
			
			$connection = ssh2_connect(host_Acens,22);
			ssh2_auth_password($connection, "root", "pass_ssh");
			
			$cmd_chown = "chown -R apache:apache ".PATHES;
			$cmd_chmod = "chmod -R 775 ".PAHTES;
			
			
			try{
				ssh2_exec($connection, $cmd_chown);
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
			}
			
			try{
				ssh2_exec($connection, $cmd_chmod);
				
			}catch (Exception $e){
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
			}
			
		}elseif ($dominio == "pt.empresa.com"){
			
			$connection = ssh2_connect(host_Acens,22);
			ssh2_auth_password($connection, "root", "pass_ssh");
			
			$cmd_chown = "chown -R apache.apache ".PATHCOMPT;
			$cmd_chmod = "chmod -R 775 ".PATHCOMPT;
			
			try{
				echo '[INFO] Cambiando propetarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] propetarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
				
			}
			
			try{
				
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
				
			}
			
			
			
		}elseif ($dominio == "en.empresa.com"){
			
			$connection = ssh2_connect(host_Acens,22);
			ssh2_auth_password($connection, "root", "pass_ssh");
			
			$cmd_chown = "chown -R apache.apache ".PATHCOMEN;
			$cmd_chmod = "chmod -R 775 ".PATHCOMEN;
			
			try{
				echo '[INFO] Cambiando propetarios de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chown);
				echo '[INFO] propetarios del dominio '.$dominio.' CAMBIADOS!'."\n";
				
			}catch (Exception $e){
				
				error("70", "[ERR] Fallo al cambiar de propietario, chown");
				error("70", $e->getMessage());
				
			}
			
			try{
				
				echo '[INFO] Cambiando los permisos de '.$dominio."\n";
				ssh2_exec($connection, $cmd_chmod);
				echo '[INFO] Permisos cambiados'."\n";
				
			}catch (Exception $e){
				
				error("80", "[ERR] Fallo al cambiar los permisos del directorio");
				
			}
			
		}elseif ($dominio == null){
			
			error("30", "Error en la selección del dominio");
			die('No se ha elegido ningún dominio correctamente, deCompress();');
			
		}	
	}
endif;
