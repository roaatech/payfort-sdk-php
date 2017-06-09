<?php
/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/9/17
 * Time: 2:06 PM
 */

use ItvisionSy\PayFort\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
    }

    public function testInvoke()
    {
        $config = Config::make([]);
        $this->assertTrue(is_array($config()));
    }

    protected function setUp()
    {
        parent::setUp();
        foreach (Config::defaults() as $key => $value) {
            try {
                Config::setDefault($key, null);
            } catch (Exception $e) {

            }
        }
    }

    public function testUnderscore()
    {
        $this->assertEquals("testing_this_one", Config::underscore("TestingThisOne"));
        $this->assertEquals("testing_this_one", Config::underscore("testingThisOne"));
        $this->assertEquals("testing_this_one", Config::underscore("testing    This  One"));
        $this->assertEquals("testing_this_one", Config::underscore("testing-This-One"));
    }

    public function testValidateValid()
    {
        $config = Config::make([]);
        foreach (Config::defaults() as $key => $value) {
            try {
                $config->$key = "something";
            } catch (Exception $e) {

            }
        }
        $this->assertTrue($config->validate());
    }

    public function testValidateInvalid()
    {
        $this->expectException(\ItvisionSy\PayFort\Exceptions\InvalidConfigException::class);
        $config = new Config();
        $config->validate();
    }

    public function testValidateValidDefaults()
    {
        foreach (Config::defaults() as $key => $value) {
            try {
                Config::$key("something");
            } catch (Exception $e) {

            }
        }
        $this->assertTrue(Config::validateDefaults());
    }

    public function testValidateInvalidDefaults()
    {
        $this->expectException(\ItvisionSy\PayFort\Exceptions\InvalidConfigException::class);
        Config::validateDefaults();
    }

    public function testSettersAndGetters()
    {
        Config::defaults(['language' => Config::LANG_AR]);
        $this->assertEquals(Config::LANG_AR, Config::language());
        $config = Config::make(['sha_type' => Config::SHA_TYPE_SHA512]);
        $this->assertEquals(Config::LANG_AR, $config->get('language'));
        $this->assertEquals(Config::SHA_TYPE_SHA512, $config->get('sha type'));
        $config->shaType(Config::SHA_TYPE_SHA128);
        $this->assertEquals(Config::SHA_TYPE_SHA128, $config->shaType());
        $config->shaType = Config::SHA_TYPE_SHA256;
        $this->assertEquals(Config::SHA_TYPE_SHA256, $config->shaType);
        $config->set('sha type', Config::SHA_TYPE_SHA512);
        $config->makeDefault();
        $this->assertEquals(Config::SHA_TYPE_SHA512, Config::shaType());
        $this->assertNull($config->nothingLikeThat);
        Config::nothingLikeThat(123);
        $this->assertNull(Config::nothingLikeThat());
    }


}
