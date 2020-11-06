<?php

// Conexiones con funciones worpdress

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
// Conexiones con BD WP
// Connecto to COM
if(!function_exists("connect_to_COM_dev")):
function connect_to_COM_dev(){
	
	require_once '/home/empresa/COM/empresa/wordpress/wp-config.php';
	require_once '/home/empresa/COM/empresa/wordpress/wp-includes/wp-db.php';
	
	$dbuser		= "user_ms_db";
	$dbpass		= "dbpass";
	$dbname		= "empresa_db_com";
	$dbhost		= "localhost";
	
	try{
		$COM_db		= new wpdb($dbuser,$dbpass,$dbname,$dbhost);
	}catch(Exception $e){
		
		$e->getMessage();
	}
	
	
	return $COM_db;
}
endif;

// Connect to México
if(!function_exists("connect_to_MX_dev")):
	function connect_to_MX_dev(){
		
		require_once '/home/empresa/MX/empresa.mx/worpdress/wp-login.php';
		require_once '/home/empresa/MX/empresa.mx/worpdpress/wp-includes/wp-db.php';
		
		$dbuser		= "user_ms_db";
		$dbpass		= "dbpass";
		$dbname		= "empresa_db_mx";
		$dbhost		= "localhost";
		
		try{
			$MX_db		= new wpdb($dbuser,$dbpass,$dbname,$dbhost);
		}catch(Exception $e){
			
			$e->getMessage();
		}
		
		return $MX_db;
		
	}
endif;

// Connect to Argentina
if(!function_exists("connect_to_AR_dev")):
	function connect_to_AR_dev(){
		
		require '/home/empresa/AR/empresa.ar/wordpress/wp-login.php';
		require '/home/empresa/AR/empresa.ar/wordpress/wp-includes/wp-db.php';
		
		$dbuser		= "user_ms_db";
		$dbpass		= "dbpass";
		$dbname		= "empresa_db_ar";
		$dbhost		= "localhost";
		
		try{
			$AR_db		= new wpdb($dbuser,$dbpass,$dbname,$dbhost);
		}catch(Exception $e){
			
			$e->getMessage();
		}
		
		return $AR_db;
	}
endif;

// Connect to Chile
if(!function_exists("connect_to_CL_dev")):
	function connect_to_CL_dev(){
		require '/home/empresa/CL/empresa.cl/wordpress/wp-config.php';
		require '/home/empresa/CL/empresa.cl/wordpress/wp-includes/wp-db.php';
		
		$dbuser		= "user_ms_db";
		$dbpass		= "dbpass";
		$dbname		= "empresa_db_cl";
		$dbhost		= "localhost";
		
		try{
			$CL_db		= new wpdb($dbuser,$dbpass,$dbname,$dbhost);
		}catch(Exception $e){
			
			$e->getMessage();
		}
		return $CL_db;
	}
endif;

// Connect to Panama
if(!function_exists("connect_to_PA_dev")):
	function connect_to_PA_dev(){
		require '/home/empresa/PA/empresa.pa/wordpress/wp-config.php';
		require '/home/empresa/PA/empresa.pa/wordpress/wp-includes/wp-db.php';
		
		$dbuser		= "user_ms_db";
		$dbpass		= "dbpass";
		$dbname		= "empresa_db_pa";
		$dbhost		= "localhost";
		
		try{
			$PA_db		= new wpdb($dbuser,$dbpass,$dbname,$dbhost);
		}catch(Exception $e){
			
			$e->getMessage();
		}
		return $PA_db;
		
	}
endif;

//Connect to Ecuador
if(!function_exists("connect_to_EC_dev")):
	function connect_to_EC_dev(){
		
		require '/home/empresa/EC/empresa.ec/wordpress/wp-config.php';
		require '/home/empresa/EC/empresa.ec/wordpress/wp-includes/wp-db.php';
		
		$dbuser		= "user_ms_db";
		$dbpass		= "dbpass";
		$dbname		= "empresa_db_ec";
		$dbhost		= "localhost";
		
		try{
			$EC_db		= new wpdb($dbuser,$dbpass,$dbname,$dbhost);
		}catch(Exception $e){
			
			$e->getMessage();
		}
		return $EC_db;
	}
endif;

// Connect to Brasil
if(!function_exists("connect_to_BR_dev")):
	function connect_to_BR_dev(){
		
		require '/home/empresa/BR/empresa.br/worpdress/wp-config.php';
		require '/home/empresa/BR/empresa.br/wordpress/wp-includes/wp-db.php';
		
		$dbuser		= "user_ms_db";
		$dbpass		= "dbpass";
		$dbname		= "empresa_db_br";
		$dbhost		= "localhost";
		
		try{
			$BR_db		= new wpdb($dbuser,$dbpass,$dbname,$dbhost);
		}catch(Exception $e){
			
			$e->getMessage();
		}
		return $BR_db;
	}
endif;

// Connect to Uruguay
if (!function_exists("connect_to_UR_dev")):
	function connect_to_UR_dev(){
		
		require '/home/empresa/UR/empresa.ur/wordpress/wp-config.php';
		require '/home/empresa/UR/empresa.ur/wordpress/wp-includes/wp-dp.php';
		
		$dbuser		= "user_ms_db";
		$dbpass		= "dbpass";
		$dbname		= "empresa_db_ur";
		$dbhost		= "localhost";
		
		try{
			$UR_db		= new wpdb($dbuser,$dbpass,$dbname,$dbhost);
		}catch(Exception $e){
			
			$e->getMessage();
		}
		return $UR_db;
	}
endif;

// Connect to Peru
if (!function_exists("connect_to_PE_dev")):
	function connect_to_PE_dev(){
		
		require '/home/empresa/PE/empresa.pe/worpdress/wp-config.php';
		require '/home/empresa/PE/empresa.pe/wordpress/wp-includes/wp-db.php';
		
		$dbuser		= "user_ms_db";
		$dbpass		= "dbpass";
		$dbname		= "empresa_db_pe";
		$dbhost		= "localhost";
		
		try{
			$PE_db		= new wpdb($dbuser,$dbpass,$dbname,$dbhost);
		}catch(Exception $e){
			
			$e->getMessage();
		}
		return $PE_db;
	}
endif;

// Connect to Portugal
if (!function_exists("connect_to_PT_dev")):
	function connect_to_PT_dev(){
		
		require '/home/empresa/PT/empresa.pt/wordpress/wp-config.php';
		require '/home/empresa/PT/empresa.pt/wordpress/wp-includes/wp-db.php';
		
		$dbuser		= "user_ms_db";
		$dbpass		= "dbpass";
		$dbname		= "empresa_db_pt";
		$dbhost		= "localhost";
		
		try{
			$PT_db		= new wpdb($dbuser,$dbpass,$dbname,$dbhost);
		}catch(Exception $e){
			
			$e->getMessage();
		}
		return $PT_db;
	}
endif;

// Connect To España
if (!function_exists("connect_to_ES_dev")):
	function connect_to_ES_dev(){
		
		require '/home/empresa/ES/empresa.es/wordpress/wp-config.php';
		require '/home/empresa/ES/empresa.es/wordpress/wp-includes/wp-db.php';
		
		$dbuser		= "user_ms_db";
		$dbpass		= "dbpass";
		$dbname		= "empresa_db_es";
		$dbhost		= "localhost";
		
		try{
			$ES_db		= new wpdb($dbuser,$dbpass,$dbname,$dbhost);
		}catch(Exception $e){
			
			$e->getMessage();
		}
		return $ES_db;
	}
endif;

//////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////
// Conexiones con PDO hacia el servidor de Desarrollo
// Conexión con empresa.com
if (!function_exists("pdo_connect_to_COM_dev")):
	function pdo_connect_to_COM_dev(){
		
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_com";
		
		try{
			
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		}catch (Exception $e){
			$e->getMessage();
		}
		
		return $dbconnect;
		
	}
endif;

// Conexión  con empresa.com.ar
if(!function_exists("pdo_connect_to_AR_dev")):
	function pdo_connect_to_AR_dev(){
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_ar";
		try {
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		} catch (Exception $e) {
			$e->getMessage();
		}
		
		
		return $dbconnect;
	}
endif;

//Conexión con empresa.com.br
if(!function_exists("pdo_connect_to_BR_dev")):
	function pdo_connect_to_BR_dev(){
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_br";
		
		try {
			
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
			
		} catch (Exception $e) {
			
			$e->getMessage();
		}
		
		
		return $dbconnect;
	}
endif;

//Conexióin con empresa.pt
if(!function_exists("pdo_connect_to_PT_dev")):
	function pdo_connect_to_PT_dev(){
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_pt";
		
		try {
			
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		} catch (Exception $e) {
			
			$e->getMessage();
		}
		
		
		return $dbconnect;
	}
endif;

//Conexión con empresa.mx
if(!function_exists("pdo_connect_to_MX_dev")):
	function pdo_connect_to_MX_dev(){
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_mx";
		
		try {
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		} catch (Exception $e) {
			
			$e->getMessage();
		}
		
		
		return $dbconnect;
	}
endif;

//Conexión con empresa.pe
if(!function_exists("pdo_connect_to_PE_dev")):
	function pdo_connect_to_PE_dev(){
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_pe";
		
		try {
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		} catch (Exception $e) {
			
			$e->getMessage();
		}

		return $dbconnect;
	}
endif;

//Conexión con empresa.ec
if(!function_exists("pdo_connect_to_EC_dev")):
	function pdo_connect_to_EC_dev(){
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_ec";
		
		try{
		
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		}catch(Exception $e){
			
			$e->getMessage();
			
		}
		
		
		
		return $dbconnect;
	}
endif;

//Conexión con empresa.pa
if(!function_exists("pdo_connect_to_PA_dev")):
	function pdo_connect_to_PA_dev(){
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_pa";
		
		
		try {
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		} catch (Exception $e) {
			
			$e->getMessage();
		}
		
		
		return $dbconnect;
	}
endif;

//Conexión con empresa.uy
if(!function_exists("pdo_connect_to_UR_dev")):
	function pdo_connect_to_UR_dev(){
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_uy";
		
		
		try {
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		} catch (Exception $e) {
			
			$e->getMessage();
		}
		
		
		return $dbconnect;
	}
endif;

//Conexión con empresa.es
if(!function_exists("pdo_connect_to_ES_dev")):
	function pdo_connect_to_ES_dev(){
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_es";
		
		
		try {
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		} catch (Exception $e) {
			
			$e->getMessage();
		}
		
		
		return $dbconnect;
	}
endif;

//Conexión con empresa.cl
if(!function_exists("pdo_connect_to_CL_dev")):
	function pdo_connect_to_CL_dev(){
		
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_cl";
		
		
		try {
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		} catch (Exception $e) {
			
			$e->getMessage();
		}
		
		
		return $dbconnect;
	}
endif;

//Conexion con empresa.co
if(!function_exists("pdo_connect_to_CO_dev")):
	function pdo_connect_to_CO_dev(){
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_co";
		
		
		try {
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		} catch (Exception $e) {
			
			$e->getMessage();
		}
		
		
		return $dbconnect;
	}
endif;

//Conexión con pt.empresa.com
if(!function_exists("pdo_connect_to_COM_PT_dev")):
	function pdo_connect_to_COM_PT_dev(){
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_com_pt";
		
		
		try {
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		} catch (Exception $e) {
			
			$e->getMessage();
		}
		
		
		return $dbconnect;
	}
endif;

//Conexión con en.empresa.com
if(!function_exists("pdo_connect_to_COM_EN_dev")):
	function pdo_connect_to_COM_EN_dev(){
		
		$dbuser = "user_ms_db";
		$dbpass	= "dbpass";
		$dbhost	= "localhost";
		$dbname	= "empresa_db_com_en";
		
		
		try {
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		} catch (Exception $e) {
			
			$e->getMessage();
		}
		
		
		return $dbconnect;
	}
endif;

////////////////////////////////////////////////////////////////////////////////////////
// Conexiones PDO hacia el servidor de producción

// empresa.com
if(!function_exists("COM_pdo_produccion")):
	function COM_pdo_produccion(){
		
		$dbuser = "user_ms_db";
		$dbpass = "dbpass";
		$dbhost	= "ip_host";
		$dbname = "empresa_db_com";
		
		try{
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		}catch (Exception $e){
			
			$e->getMessage();
			
		}
		
		return $dbconnect;
		
	}
endif;

// empresa.pt
if(!function_exists("PT_pdo_produccion")):
	function PT_pdo_produccion(){
		
		$dbuser = "user_ms_db";
		$dbpass = "dbpass";
		$dbhost	= "ip_host";
		$dbname = "empresa_db_pt";
		
		try{
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		}catch (Exception $e){
			
			$e->getMessage();
			
		}
		
		return $dbconnect;
	}
endif;

// pt.empresa.com
if(!function_exists("COM_PT_pdo_produccion")):
 function COM_PT_pdo_produccion(){
 	
 	$dbuser = "user_ms_db";
 	$dbpass = "dbpass";
 	$dbhost	= "ip_host";
 	$dbname = "empresa_db_com_pt";
 	
 	try{
 		$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
 		
 	}catch (Exception $e){
 		
 		$e->getMessage();
 		
 	}
 	
 	return $dbconnect;
 }
endif;

// en.empresa.com
if (!function_exists("COM_EN_pdo_produccion")):
	function COM_EN_pdo_produccion(){
		
		$dbuser = "user_ms_db";
		$dbpass = "dbpass";
		$dbhost	= "ip_host";
		$dbname = "empresa_db_com_en";
		
		try{
			$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
			
		}catch (Exception $e){
			
			$e->getMessage();
			
		}
		
		return $dbconnect;
	}
endif;

// empresa.es
if(!function_exists("ES_pdo_produccion")):
 function ES_pdo_produccion(){
 	
 	$dbuser = "user_ms_db";
 	$dbpass = "dbpass";
 	$dbhost	= "ip_host";
 	$dbname = "empresa_db_es";
 	
 	try{
 		$dbconnect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser,$dbpass);
 		
 	}catch (Exception $e){
 		
 		$e->getMessage();
 		
 	}
 	
 	return $dbconnect;
 }
endif;

// empresa.co
if(!function_exists("CO_pdo_produccion")):
	function CO_pdo_produccion(){
		
	}
endif;

// empresa.pa
if(!function_exists("PA_pdo_produccion")):
	function PA_pdo_produccion(){
		
	}
endif;

// empresa.ec
if(!function_exists("EC_pdo_produccion")):
	function EC_pdo_produccion(){
		
	}
endif;

// empresa.pe
if(!function_exists("PE_pdo_produccion")):
	function PE_pdo_produccion(){
		
	}
endif;

// empresa.mx
if(!function_exists("MX_pdo_produccion")):
	function MX_pdo_produccion(){
		
	}
endif;

// empresa.uy
if(!function_exists("UY_pdo_produccion")):
	function UY_pdo_produccion(){
		
	}
endif;

// empresa.com.ar
if(!function_exists("AR_pdo_produccion")):
	function AR_pdo_produccion(){
		
	}
endif;

// empresa.com.br
if(!function_exists("BR_pdo_produccion")):
	function BR_pdo_produccion(){
		
	}
endif;







?>
