<?php
/**
* Nemesis Class
* @author Nick Rameau (Crakken)
* @name Nemesis
* @version 1.0
*
*/
class Nemesis
{

	private static $_host	= "localhost";
	private static $_user	= "root";
	private static $_pass	= "root";
	private static $_db		= "books";
	public static $version 	=  1.0;

	protected static $_connection = NULL;
	public static  $nemesis_functions = array('get_connection', 'query', 'create_database', 'select_database', 'create_and_select_database', 'drop_database',
												'insert', 'alter', 'select', 'update', 'count_all_rows', 'count_distinct_rows', 'delete_from_table', 'test_query',
												'create_and_test_database', 'which_database', 'drop_and_test_database', 'show_tables_in_database', 'create_and_test_table',
												'show_rows_in_table'
												 );

	private function __construct() {} // Left Blank by purpose...

	/****************************************************
						CONNECTION
	*****************************************************/

	public static function get_connection()
	{
		if (!self::$_connection) {
			self::$_connection = @new mysqli(self::$_host, self::$_user, self::$_pass, self::$_db);
			if (self::$_connection->connect_error) {
				die('Connect Error: '.self::$_connection->connect_error);
			}
		}
		return self::$_connection;
	}

	/****************************************************
						MASTER QUERY
	*****************************************************/

	public static function query($query, $debug = NULL)
	{
		if (is_null($debug)) {
			if (is_array($query)) {
				for ($i=0; $i < count($query); $i++) { 
					$qr = self::$_connection->query($query[$i]);
				}
			} else {
					$qr = self::$_connection->query($query);
			}
		} else {
			if (is_array($query)) {
				for ($i=0; $i < count($query); $i++) { 
					if (!$qr = self::$_connection->query($query[$i])) {
						echo "A MySQL error has occured. Error: (".self::$_connection->errno.") ".self::$_connection->error."<br />";
					} else {
						$qr = self::$_connection->query($query[$i]);
					}
				}
			} else {
				if (!$qr = self::$_connection->query($query)) {
					echo "A MySQL error has occured. Error: (".self::$_connection->errno.") ".self::$_connection->error."<br />";
				} else {
					$qr = self::$_connection->query($query);
				}
			}
		}
		return $qr;
	}

	/****************************************************
						DATABASE
	*****************************************************/

	public static function create_database($database_name)
	{
		if (is_array($database_name)) {
			for ($i=0; $i < count($database_name); $i++) { 
				$query = self::$_connection->query("CREATE DATABASE `".$database_name[$i]."`");
			}
		} else{
			$query = self::$_connection->query("CREATE DATABASE `".$database_name."`");
		}
		return $query;
	}

	public static function select_database($database_name)
	{
		return self::$_connection->select_db($database_name);
	}

	public static function create_and_select_database($database_name)
	{
		$create = self::create_database($database_name);
		$select = self::select_database($database_name);

		return $create;
		return $select;
	}

	public static function drop_database($database_name)
	{
		if (is_array($database_name)) {
			for ($i=0; $i < count($database_name); $i++) { 
				$query = self::$_connection->query("DROP DATABASE `".$database_name[$i]."`");
			}
		} else {
			$query = self::$_connection->query("DROP DATABASE `".$database_name."`");
		}
		return $query;
	}

	/****************************************************
						TABLE
	*****************************************************/

	public static function insert($table_name, $specs = NULL, $what, $on_duplicate = NULL)
	{
		if (is_array($what)) {
			for ($i=0; $i < count($what); $i++) { 
				if (is_null($on_duplicate) && is_null($specs)) {
					$query = self::$_connection->query("INSERT INTO `".$table_name."` VALUES (".$what[$i].")");
				} elseif (is_null($on_duplicate)) {
					$query = self::$_connection->query("INSERT INTO `".$table_name."` (".$specs.") VALUES (".$what[$i].")");
				} elseif (is_null($specs)) {
					$query = self::$_connection->query("INSERT INTO `".$table_name."` VALUES ".$what[$i]." ON DUPLICATE KEY UPDATE ".$on_duplicate);
				} else {
					$query = self::$_connection->query("INSERT INTO `".$table_name."` (".$specs.") VALUES (".$what[$i].") ON DUPLICATE KEY UPDATE ".$on_duplicate);
				}
			}
		} else {
				if (is_null($on_duplicate) && is_null($specs)) {
					$query = self::$_connection->query("INSERT INTO `".$table_name."` VALUES (".$what.")");
				} elseif (is_null($on_duplicate)) {
					$query = self::$_connection->query("INSERT INTO `".$table_name."` (".$specs.") VALUES (".$what.")");
				} elseif (is_null($specs)) {
					$query = self::$_connection->query("INSERT INTO `".$table_name."` VALUES (".$what.") ON DUPLICATE KEY UPDATE ".$on_duplicate);
				} else {
					$query = self::$_connection->query("INSERT INTO `".$table_name."` (".$specs.") VALUES (".$what.") ON DUPLICATE KEY UPDATE ".$on_duplicate);
				}
			}
		return $query;
	}

	public static function alter($table_name, $action, $what, $position = NULL)
	{
		if (is_array($what)) {
			for ($i=0; $i < count($what); $i++) { 
				if ($position == "first" || $position == "FIRST") {
					$query = self::$_connection->query("ALTER TABLE ".$table_name." ".strtoupper($action)." ".$what[$i]." FIRST");
				} elseif ($position == NULL) {
					$query = self::$_connection->query("ALTER TABLE ".$table_name." ".strtoupper($action)." ".$what[$i]);
				} else {
					$query = self::$_connection->query("ALTER TABLE ".$table_name." ".strtoupper($action)." ".$what[$i]." AFTER ".$position);
				}
			}
		} else {
			if ($position == "first" || $position == "FIRST") {
				$query = self::$_connection->query("ALTER TABLE ".$table_name." ".strtoupper($action)." ".$what." FIRST");
			} elseif ($position == NULL) {
				$query = self::$_connection->query("ALTER TABLE ".$table_name." ".strtoupper($action)." ".$what);
			} else {
				$query = self::$_connection->query("ALTER TABLE ".$table_name." ".strtoupper($action)." ".$what." AFTER ".$position);
			}
			return $query;
		}
	}

	public static function select($what, $table_name, $where = NULL, $order_by = NULL)
	{
		if (is_null($where) && is_null($order_by)) {
			$query = self::$_connection->query("SELECT ".$what." FROM ".$table_name);
		} elseif (is_null($order_by)) {
			$query = self::$_connection->query("SELECT ".$what." FROM ".$table_name." WHERE ".$where);
		} elseif (is_null($where)) {
			$query = self::$_connection->query("SELECT ".$what." FROM ".$table_name." ORDER BY ".$order_by);
		} else {
			$query = self::$_connection->query("SELECT ".$what." FROM ".$table_name." WHERE ".$where." ORDER BY ".$order_by);
		}
		return $query;
	}

	public static function update($table_name, $what, $where = NULL) 
	{
		if (is_null($where)) {
			$query = self::$_connection->query("UPDATE ".$table_name." SET ".$what);
		} else {
			$query = self::$_connection->query("UPDATE ".$table_name." SET ".$what." WHERE ".$where);
		}
		return $query;
	}

	public static function count_all_rows($table_name)
	{
		$query = self::select("*", NULL, $table_name);
		$count = $query->num_rows;
		echo $count;
	}

	public static function count_distinct_rows($what, $table_name, $where = NULL)
	{
		if (!is_null($where)) {
			$query = self::select("DISTINCT ".$what, NULL, $table_name, $where);
		} else {
			$query = self::select("DISTINCT ".$what, NULL, $table_name);
		}
		$count = $query->num_rows;
		echo $count;
	}
	
	

	public static function delete_from_table($table_name, $where = NULL)
	{
		if (is_null($where)) {
			$query = self::$_connection->query("DELETE FROM `".$table_name."`");
		} else {
			$query = self::$_connection->query("DELETE FROM `".$table_name."` WHERE ".$where);
		}
	}
	
	// VERIFICAR EXISTENCIA DE UN REGISTRO //   BY MAIKO //
	// DEVUELVE "TRUE" SI LO ENCONTRO 
	public static function verificar_existencia($what, $table_name, $where = NULL)
	{
		if (!is_null($where)) {
			$query = self::$_connection->query("SELECT ".$what." FROM ".$table_name." WHERE ".$where);
		}
		$count = $query->num_rows;
		if($count >= 1) {
			$aux = true;
		} else {
			$aux = false;
		}
		return $aux;
	}
	


	/****************************************************
						DEBUGGING
	*****************************************************/

	public static function create_and_test_database($database_name)
	{
		if ($result = self::$_connection->query("CREATE DATABASE `".$database_name."`")) {
			$msg = $database_name." database was created successfully.<br />";
		} else {
			$msg = $database_name." database could not be created. Please, 
								check if the user is allowed to create databases or 
								if the database already exists.<br />";
		}
		echo $msg;
	}

	public static function which_database()
	{
		if ($result = self::$_connection->query("SELECT DATABASE()")) {
			$row = $result->fetch_array(MYSQLI_NUM);
			echo "Currently using the ".$row[0]." database.<br />";
		}
	}

	public static function drop_and_test_database($database_name)
	{
		if ($result = self::$_connection->query("DROP DATABASE `".$database_name."`")) {
			$msg = $database_name." database was dropped/deleted successfully.<br />";
		} else {
			$msg = $database_name." database could not be dropped/deleted. Please, 
								check if the user is allowed to drop/delete databases or 
								if the database exists.<br />";
		}
		echo $msg;
	}

	public static function show_tables_in_database($database_name)
	{
		self::select_database($database_name);
		if ($result = self::$_connection->query("SHOW TABLES")) {
			echo "<h4>Tables in '".$database_name."' database:</h4>";
			while ($row = $result->fetch_array()) {
				echo $row[0]."<br />";
			}
		}
	}

	public static function create_and_test_table($query)
	{
		if (!$result = self::$_connection->query($query)) {
			$msg = "Unable to create table.<br />";
		} else {
			$msg = "Table created successfully.<br />";
		}
		echo $msg;
	}

	public static function show_rows_in_table($table_name)
	{
		if ($result = self::$_connection->query("SELECT * FROM ".$table_name)) {
			echo "<h4>Rows in Table: ".$table_name."</h4>";
			echo "<table border='1'>";
			while($row = $result->fetch_row()) {
    			echo "<tr>";
    			foreach($row as $cell) {
        			echo "<td>".$cell."</td>";
        		}
			echo "</tr>";
			}
			echo "</table>";
		}
	}

	public static function show_columns_in_table($table_name)
	{
		if ($result = self::$_connection->query("SHOW COLUMNS FROM ".self::$_db.".".$table_name)) {
			echo "<h4>Columns in Table: ".$table_name."</h4>";
			echo "<table border='1'>";
			while($row = $result->fetch_row()) {
    			echo "<tr>";
    			foreach($row as $cell) {
        			echo "<td>".$cell."</td>";
        		}
			echo "</tr>";
			}
			echo "</table>";
		}
	}
	
	/****************************************************
						THE HELPERS
	*****************************************************/

	public static function info($nemesis_function = NULL)
	{  // We should check if $nemesis_function is one of our functions eith an array full of them codecademy for loop
		if (is_null($nemesis_function)) {
			$msg = "Please, add the name of the Nemesis function as a parameter to get more information about it. (Note: Parameter is case sensitive, "
					."so, please, keep it all lowercase)<br />";
		} else {
			if (!in_array($nemesis_function, self::$nemesis_functions)) {
				$msg = $nemesis_function."() doesn't match any of the Nemesis functions (Currently ".self::count_nemesis_functions()." functions) For a complete"
						." list of available functions, please, check the <a href='http://crakken.com/docs/nemesis/index.html#functions_reference' target='_blank'>documentation file</a>.<br />";
			} else {
				$msg = "For more information about ".$nemesis_function."(), please,"
						." <a href='http://crakken.com/docs/nemesis/#".$nemesis_function."' target='_blank'>Click Here</a>.<br />";
			}
		}
		echo $msg;
	}

	public static function nemesisinfo()
	{
		$count = count(self::$nemesis_functions);
		echo "Nemesis version:".self::$version."<br />";
		echo "Number of functions: ".$count."<br />";
	}
	
}
?>