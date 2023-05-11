<?php
# Name: Database.class.php
# File Description: MySQL Class to allow easy and clean access to common mysql commands
# Create: maksudkhan



//require("config.inc.php");
//$db = new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);


###################################################################################################
###################################################################################################
###################################################################################################
class Database {


	var $server   = ""; //database server
	var $user     = ""; //database login name
	var $pass     = ""; //database login password
	var $database = ""; //database name
	var $pre      = ""; //table prefix


	#######################
	//internal info
	var $error = "";
	var $errno = '';

	//number of rows affected by SQL query
	var $affected_rows = '';

	var $link_id = '';
	var $query_id = '';


	#-#############################################
	# desc: constructor
	function __construct($server, $user, $pass, $database, $pre=''){
		$this->server=$server;
		$this->user=$user;
		$this->pass=$pass;
		$this->database=$database;
		$this->pre=$pre;
		
	}#-#constructor()


	#-#############################################
	# desc: connect and select database using vars above
	# Param: $new_link can force connect() to open a new link, even if mysql_connect() was called before with the same parameters
	function connectmaksud($new_link=false) {
	    $this->link_id=mysqli_connect($this->server,$this->user,$this->pass,$this->database);
		if (!$this->link_id) {//open failed
			$this->oops("Could not connect to server: <b>$this->server</b>.");
		}
		// if(!@mysqli_select_db($this->link_id,$this->database)) {//no database
		// 	$this->oops("Could not open database: <b>$this->database</b>.");
		// }

		// unset the data so it can't be dumped
		$this->server='';
		$this->user='';
		$this->pass='';
		$this->database='';
	}#-#connect()

	#-#############################################
	# desc: close the connection
	function nums() {
	    return mysqli_num_rows($this->query_id);;
		
	}#-#close()


	#-#############################################

	#-#############################################
	# desc: close the connection
	function close() {
		if(!@mysqli_close($this->link_id)){
			$this->oops("Connection close failed.");
		}
	}#-#close()


	#-#############################################
	# Desc: escapes characters to be mysql ready
	# Param: string
	# returns: string
	function escape($string) {
		if(get_magic_quotes_runtime()) $string = stripslashes($string);
		return @mysqli_real_escape_string($this->link_id,$string);
	}#-#escape()


	#-#############################################
	# Desc: executes SQL query to an open connection
	# Param: (MySQL query) to execute
	# returns: (query_id) for fetching results etc
	function query($sql) {
		// do query
		$this->query_id = @mysqli_query($this->link_id,$sql);
		$this->affected_rows = @mysqli_affected_rows($this->link_id);
		return $this->query_id;
	}#-#query()


	#-#############################################
	# desc: fetches and returns results one line at a time
	# param: query_id for mysql run. if none specified, last used
	# return: (array) fetched record(s)
	public function fetch_array($query_id) {
		
		// retrieve row
		if ($query_id!='') {
			$this->query_id=$query_id;
		}
		if (isset($this->query_id)) {
			$record = @mysqli_fetch_assoc($this->query_id);
		}else{
			$this->oops("Invalid query_id: <b>$this->query_id</b>. Records could not be fetched.");
		}
		return $record;
	}#-#fetch_array()


	#-#############################################
	# desc: returns all the results (not one row)
	# param: (MySQL query) the query to run on server
	# returns: assoc array of ALL fetched results
	function selectAll($sql) {

		$query_id = $this->query($sql);
		$out = array();
		while ($row = $this->fetch_array($query_id)){
			$out[] = $row;
		}
		$this->free_result($query_id);
		return $out;
	}
	function fetch_all_array($sql) {
		$query_id = $this->query($sql);
		$out = array();

		while ($row = $this->fetch_array($query_id)){
			$out[] = $row;
		}

		$this->free_result($query_id);
		return $out;
	}

	#-#fetch_all_array()


	#-#############################################
	# desc: frees the resultset
	# param: query_id for mysql run. if none specified, last used
	function free_result($query_id) {
		$this->query_id=$query_id;
		if(@mysqli_free_result($this->query_id)) {
			$this->oops("Result ID: <b>$this->query_id</b> could not be freed.");
		}
	}#-#free_result()


	#-#############################################
	# desc: does a query, fetches the first row only, frees resultset
	# param: (MySQL query) the query to run on server
	# returns: array of fetched results
	function query_first($query_string) {
		$query_id = $this->query($query_string);
		$out = $this->fetch_array($query_id);
		$this->free_result($query_id);
		return $out;
	}
	function selectOne($query_string) {
		$query_id = $this->query($query_string);
		$out = $this->fetch_array($query_id);        
		$this->free_result($query_id);
		return $out;
	}
	function deleteOne($query_string) {
		$query_id = $this->query($query_string);
	}
	#-#query_first()


	#-#############################################
	# desc: does an update query with an array
	# param: table (no prefix), assoc array with data (doesn't need escaped), where condition
	# returns: (query_id) for fetching results etc
	function query_update($table, $data, $where='1') {
		$q="UPDATE `".$this->pre.$table."` SET ";
	        foreach($data as $key=>$val) {
			if(strtolower($val)=='null') $q.= "`$key` = NULL, ";
			elseif(strtolower($val)=='now()') $q.= "`$key` = NOW(), ";
	        elseif(preg_match("/^increment\((\-?\d+)\)$/i",$val,$m)) $q.= "`$key` = `$key` + $m[1], "; 
			else $q.= "`$key`='".$this->escape($val)."', ";
		}

		$q = rtrim($q, ', ') . ' WHERE '.$where.';';

	    //echo $q; exit;

		return $this->query($q);
	}#-#query_update()


	#-#############################################
	# desc: does an insert query with an array
	# param: table (no prefix), assoc array with data
	# returns: id of inserted record, false if error
	function query_insert($table, $data) {
		$q="INSERT INTO `".$this->pre.$table."` ";
		$v=''; $n='';
		foreach($data as $key=>$val) {
			$n.="`$key`, ";
			if(strtolower($val)=='null') $v.="NULL, ";
			elseif(strtolower($val)=='now()') $v.="NOW(), ";
			else $v.= "'".$this->escape($val)."', ";
		}
		$q .= "(". rtrim($n, ', ') .") VALUES (". rtrim($v, ', ') .");";
		if($this->query($q)){
			//$this->free_result();
			return mysqli_insert_id($this->link_id);
		}
		else return false;

	}#-#query_insert()


	#-#############################################
	# desc: throw an error message
	# param: [optional] any custom error to display
	function oops($msg='') {
		if($this->link_id>0){
			$this->error=mysqli_error($this->link_id);
			$this->errno=mysqli_errno($this->link_id);
		}
		else{
			$this->error=mysqli_error();
			$this->errno=mysqli_errno();
		}
		?>
			<table align="center" border="1" cellspacing="0" style="background:white;color:black;width:80%;">
			<tr><th colspan=2>Database Error</th></tr>
			<tr><td align="right" valign="top">Message:</td><td><?php echo $msg; ?></td></tr>
			<?php if(!empty($this->error)) echo '<tr><td align="right" valign="top" nowrap>MySQL Error:</td><td>'.$this->error.'</td></tr>'; ?>
			<tr><td align="right">Date:</td><td><?php echo date("l, F j, Y \a\\t g:i:s A"); ?></td></tr>
			<?php if(!empty($_SERVER['REQUEST_URI'])) echo '<tr><td align="right">Script:</td><td><a href="'.$_SERVER['REQUEST_URI'].'">'.$_SERVER['REQUEST_URI'].'</a></td></tr>'; ?>
			<?php if(!empty($_SERVER['HTTP_REFERER'])) echo '<tr><td align="right">Referer:</td><td><a href="'.$_SERVER['HTTP_REFERER'].'">'.$_SERVER['HTTP_REFERER'].'</a></td></tr>'; ?>
			</table>
		<?php
	}#-#oops()
	function numRows($string="",$qid=""){
			if($string != ""){
				$this->query($string);
				$this->total = mysqli_num_rows($this->query_id);
			}elseif($qid != ""){
				$this->total = mysqli_num_rows($qid);
			}elseif(empty($sting) && empty($qid)){
				$this->total = mysqli_num_rows($this->query_id);
			}
			
			return $this->total;
		}

}//CLASS Database
###################################################################################################

?>