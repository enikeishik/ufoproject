<?php
require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use \Ufo\Core\Config;
 
class ConfigTest extends \Codeception\Test\Unit
{
    public function testProjectConfig()
    {
        $config = new Config();
        $config->loadFromIni(dirname(__DIR__) . '/../.config');
        
        $this->assertTrue(property_exists($config, 'debug'));
        $this->assertEquals($config->debug, true);
        $this->assertTrue($config->debug === true);
        
        $this->assertTrue(property_exists($config, 'dbServer'));
        $this->assertEquals($config->dbServer, 'localhost');
        
        $this->assertTrue(property_exists($config, 'dbReadonly'));
        $this->assertEquals($config->dbReadonly, false);
        $this->assertTrue($config->dbReadonly === false);
        
        $this->assertTrue(property_exists($config, 'dbTablePrefix'));
        $this->assertEquals($config->dbTablePrefix, '');
        $this->assertTrue($config->dbTablePrefix === '');
    }
}
