<?php
class Database {
    private static $db = null;
    private function __construct() {}

    public static function getConnection() {
        if (self::$db == null) {
            self::$db = new SQLite3('database.db');
        }
        return self::$db;
    }
}
?>
