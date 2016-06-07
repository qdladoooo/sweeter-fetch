<?php
use SweeterFetch\SweeterFetch;

class SweeterFetchTest extends PHPUnit_Framework_TestCase
{

    public function test()
    {
        $sf = new SweeterFetch('localhost', 'travis', '');
        $sql = 'use candy_shop;';
        $sf->Enq($sql);

        //execute query
        $sql = 'select * from candy limit 5';
        $candy_list = $sf->Eq($sql);
        $this->assertEquals( 3, count($candy_list) );

        //execute one row
        $sql = 'select * from candy where id = 1';
        $first_candy = $sf->Eor($sql);
        $this->assertEquals( 5, count($first_candy) );

        //execute column
        $sql = 'select name from candy limit 5';
        $candy_cate = $sf->Ec($sql);
        $this->assertEquals( 3, count($candy_cate) );

        //execute scalar
        $sql = 'select sum(sale_num) from candy limit 5';
        $candy_cate_num = $sf->Es($sql);
        $this->assertEquals( 15, $candy_cate_num );
    }

}
