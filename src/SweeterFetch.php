<?php namespace App\Libs;

use DB;
class SweeterFetch {
    protected static $pdo;
    function __construct() {
        if (self::$pdo == null) {
            self::$pdo = DB::getPdo();
            self::$pdo->exec ( 'SET NAMES UTF8' );
        }
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

    //todo: 这个lib不该有insert，update方法，事急从权，后续处理
    //excute none query
    function Enq($sql) {
        $res = self::$pdo->exec( $sql );
        $this->IsError();

        return $res;
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