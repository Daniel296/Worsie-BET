<?php
class DbConnection {
    private static $instance;
    private $dbConn;
	
    private static $DB_HOST = "fenrir.info.uaic.ro";
	private static $DB_USER = "WorsieBET";
	private static $DB_PASS = "ykoFsp2TCB";
	private static $DB_DB = "WorsieBET";

	//private static $DB_HOST = "localhost";
    // private static $DB_USER = "root";
    // private static $DB_PASS = "";
    // private static $DB_DB = "worsiebet";

    private function __construct() {}

    private static function getInstance(){
        if (self::$instance == null){
            $className = __CLASS__;
            self::$instance = new $className;
        }
        return self::$instance;
    }

    private static function initConnection(){
        $db = self::getInstance();
		$db->DbConnection =  new mysqli(self::$DB_HOST, self::$DB_USER, self::$DB_PASS, self::$DB_DB);
		$db->DbConnection->set_charset('utf8');
		return $db;
    }

    public static function getDbConnection() {
        try {
            $db = self::initConnection();
            //echo "Connected";
            return $db->DbConnection;
        } catch (Exception $ex) {
            echo "I was unable to open a connection to the database. " . $ex->getMessage();
            return null;
        }
    }
	
	public static function closeDbConnection() {
		$db = self::getInstance();
		mysql_close($db);
	}
}
?>