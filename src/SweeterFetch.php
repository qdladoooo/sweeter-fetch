<?php 
namespace SweeterFetch;

class SweeterFetch {
    //store pdo instance
    protected static $pdo_ar = [];
    protected static $pdo;
    //switch of dump info
    protected static $need_dump_info = false;

    //init
    function __construct($host, $user_name, $password) {
        return $this->GetInstance($host, $user_name, $password);
    }

    //instance
    private function GetInstance($host, $user_name, $password) {
    	$hash = md5($host . $user_name . $password);
        if ( !isset(self::$pdo_ar[$hash]) ) {
            self::$pdo = new \PDO("mysql:host={$host};", $user_name, $password);;
            self::$pdo->exec('SET NAMES UTF8');
            self::$pdo_ar[$hash] = self::$pdo;
        } else {
        	self::$pdo = self::$pdo_ar[$hash];
        }

        return self::$pdo;
    }

    //for dump
    private function IsError() {
        if( self::$need_dump_info ) {
            $errorCode = self::$pdo->errorCode ();
            if ($errorCode != '00000') {
                var_dump ( self::$pdo->errorInfo () );
                exit ();
            }
        }
    }

    //need dump info
    function NeedDumpInfo( $flag = true ) {
        self::$need_dump_info = (bool)$flag;
    }

    //execute query
    function Eq($sql) {
        $res = self::$pdo->query ( $sql );
        $this->IsError ();
        $res->setFetchMode ( \PDO::FETCH_ASSOC );
        return $res->fetchAll ();
    }

    //execute one row
    function Eor($sql) {
        $res = self::$pdo->query ( $sql );
        $this->IsError ();
        $res->setFetchMode ( \PDO::FETCH_ASSOC );
        $data = $res->fetch ();
        return $data;
    }

    //execute col
    function Ec($sql) {
        $res = self::$pdo->query ( $sql );
        $this->IsError ();
        $res->setFetchMode ( \PDO::FETCH_ASSOC );
        $data = $res->fetchAll ( \PDO::FETCH_COLUMN, 0 );
        return $data;
    }

    //execute scalar
    function Es($sql) {
        $res = self::$pdo->query ( $sql );
        $this->IsError ();
        $res->setFetchMode ( \PDO::FETCH_NUM );
        $data = $res->fetch ( \PDO::FETCH_COLUMN );
        return $data;
    }

    //execute none query
    function Enq($sql) {
        $res = self::$pdo->exec($sql);
        $this->IsError();

        return $res;
    }

    function quote($var) {
        return self::$pdo->quote ( $var );
    }
}
