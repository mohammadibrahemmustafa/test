<?php

use App\VersionComparison;

class VersionComparisonTest extends \PHPUnit\Framework\TestCase
{

    public function testOldVersion(){
        $version = new VersionComparison();
        $this->assertEquals(
            'Europe/Berlin',
            $version->compare('1.0.15+83')
        );
    }

    public function testNewVersion(){
        $version = new VersionComparison();
        $this->assertEquals(
            'UTC',
            $version->compare('1.0.17+65')
        );
    }

}