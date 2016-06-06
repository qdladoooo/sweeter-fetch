<?php 
namespace SweeterFetch;

class SweeterFetch {
    protected static $pdo_ar = [];
    protected static $pdo;

    function __construct($host, $user_name, $password) {
        return $this->GetInstance($host, $user_name, $password);
    }

    //instance
    function GetInstance($host, $user_name, $password) {
    	$hash = md5($host . $user_name . $password);
        if ( !isset(self::$pdo_ar[$hash]) ) {
            self::$pdo = new \PDO("mysql:host={$host};", $user_name, $password);;
            self::$pdo->exec('SET NAMES UTF8');
            self::$pdo_ar[$hash] = $self::$pdo;
        } else {
        	self::$pdo = self::$pdo_ar[$hash];
        }

        return self::$pdo;
    }

    //excute query
    function Eq($sql) {
        $res = self::$pdo->query ( $sql );
        $this->IsError ();
        $res->setFetchMode ( \PDO::FETCH_ASSOC );
        return $res->fetchAll ();
    }

    //excute one row
    function Eor($sql) {
        $res = self::$pdo->query ( $sql );
        $this->IsError ();
        $res->setFetchMode ( \PDO::FETCH_ASSOC );
        $data = $res->fetch ();
        return $data;
    }

    //excute col
    function Ec($sql) {
        $res = self::$pdo->query ( $sql );
        $this->IsError ();
        $res->setFetchMode ( \PDO::FETCH_ASSOC );
        $data = $res->fetchAll ( \PDO::FETCH_COLUMN, 0 );
        return $data;
    }

    //excute scalar
    function Es($sql) {
        $res = self::$pdo->query ( $sql );
        $this->IsError ();
        $res->setFetchMode ( \PDO::FETCH_NUM );
        $data = $res->fetch ( \PDO::FETCH_COLUMN );
        return $data;
    }

    //last insert id
    function lastInsertId() {
        return $this->Es('select last_insert_id();');
    }

    //for dump
    function IsError() {
        if( env('APP_DEBUG', false) ) {
            $errorCode = self::$pdo->errorCode ();
            if ($errorCode != '00000') {
                var_dump ( self::$pdo->errorInfo () );
                exit ();
            }
        }
    }

    function quote($var) {
        return self::$pdo->quote ( $var );
    }
}
