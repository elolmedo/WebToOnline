<?php 

	/*
	 * @autor: Ra�l Olmedo Murillo
	 * @description: This script send web replicate to Server Online
	 * 
	 *  
	 * /////////////////////////////////////////////////////////////////////////////////
	 * TIPOS DE ERRORES
	 * 10 - ERROR EN LA CREACI�N DE LOS BACKUP DE LA BASE DE DATOS
	 * 20 - ERROR EN LA CREACI�N DEL BACKUP DEL DIRECTORIO
	 * 30 - ERROR EN LA SELECCI�N DEL DOMINIO
	 * 40 - ERROR EN LA SUBIDA DE FICHEROS MEDIANTE SCP
	 * 50 - ERROR CAMBIANDO EL DIRECTORIO DE NOMBRE
	 * 60 - ERROR EN LA DESCOMPRESI�N DEL DIRECTORIO DE BACKUP
	 * 70 - ERROR CAMBIO DE PROPIETARIO EN LOS DIRECTORIOS
	 * 80 - ERROR CAMBIO DE PERMISOS EN LOS DIRECTORIOS
	 * 90 - ERROR MOVIENDO CARPETAS EXTERNAS DE WORDPRESS
	 * 
	 * 701- ERROR EN EL BORRADO DE BD
	 * 702- ERROR EN LA CREACI�N DE LA BD
	 * 703- ERROR EN LA ACTUALIZACI�N DE LA BD
	 * /////////////////////////////////////////////////////////////////////////////////
	 */
	
	
	include 'functions.php';

	PresentacionWebToOnline();

	$dominio_seleccionado = ElegirDominio();

	/*comprobarFicheros($dominio_seleccionado);

	UploadFiles($dominio_seleccionado);
	
	prepararDirectorios($dominio_seleccionado);
	
	/*deCompress($dominio_seleccionado);*/
	
	prepararBD($dominio_seleccionado);
	
	/*restorePermissions($dominio_seleccionado);*/
	
	
	
	
	
	
?>
