<?php
/**
 * auth/joomla.class.php
 *
 * @author    Nicolas Ruflin <spam@ruflin.com>
 */

class auth_joomla extends auth_basic {
	
	function auth_joomla() {
	    global $conf;
	    $conf['superuser'] = "admin";

	    include_once("../configuration.php");
	
		$configuration = new JConfig;

		$mosConfig_host = $configuration->host;
		$mosConfig_user = $configuration->user;
		$mosConfig_password = $configuration->password;
		$mosConfig_db = $configuration->db;
	    
	    $conn = mysql_connect($mosConfig_host,$mosConfig_user,$mosConfig_password);
	    mysql_select_db($mosConfig_db, $conn);
	}
	
	
	function checkPass($user,$pass){
	  	$sql = "SELECT password FROM jos_users WHERE username = '$user'";
	  		
	  	$res = mysql_fetch_array(mysql_query($sql));
	    	
	    return $this->checkJoomlaPassword($pass,$res['password']);
	}
  
  
	/**
	 * checks the password with salt
	 */
	function checkJoomlaPassword($pass,$dbpass) {
		
		//Splittet den String auf
		list($hash, $salt) = explode(':', $dbpass);
		
		//setzt salt-wert mit dem eingegebenen Passwort zusammen und gibt den md5 Wert zurück
		$cryptpass = md5($pass.$salt);
		
		//überprüft ob Doppelpunkt vorhanden und vergleich hash-Wert mit den cryptpass
		if( (strpos($dbpass,':') == true) && $hash == $cryptpass) { 
			return true; 
		}
	
		return false;
	}
  


  /**
   * Returns info about the given user needs to contain
   * at least these fields:
   *
   * name string  full name of the user
   * mail string  email addres of the user
   * grps array   list of groups the user is in
   *
   * @return  array containing user data or false
   */
	function getUserData($user) {
		global $conf;
		
		if(isset($user) && $user == $conf['superuser']) {
			$groups = array("admin","user");
		}
		else {
			$groups = array("user");
		}
		
		$sql = "SELECT name, email FROM jos_users WHERE username = '$user' ;";
		$u = mysql_fetch_array(mysql_query($sql));
		
		if($u != null) {
			$email = $u['email'];
			$name = $u['name'];
		}
		else {
			$name = $user;
			$email = "";
		}
		
		$user = array('name' => $name, 'mail' => $email ,'grps' => $groups );
		
		return $user;	
  	}
}
