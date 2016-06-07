<?php
use SweeterFetch\SweeterFetch;

class SweeterFetchTest extends PHPUnit_Framework_TestCase
{

    public function test()
    {
        $sf = new SweeterFetch('localhost', 'travis', '');
        $this->assertEquals(1, 1);
    }

}
