<?php
namespace Packfire\Command;

/**
 * Test class for OptionSet.
 * Generated by PHPUnit on 2012-10-19 at 04:26:09.
 */
class OptionSetTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var OptionSet
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new OptionSet;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Packfire\Command\OptionSet::parse=
     */
    public function testParse() {
        $username = null;
        $counter = 0;
        $this->object->add('name=', 'username',
                function($value) use(&$username){
            $username = $value;
        });
        $this->object->add('c|counter', 'adds to counter',
                function()use(&$counter){
            ++$counter;
        });
        $this->object->add('f|file', 'adds to counter',
                function()use(&$counter){
            ++$counter;
        });
        
        $this->object->parse(array('-c', '--counter', '--name', 'Sam'));
        $this->assertEquals('Sam', $username);
        $this->assertEquals(2, $counter);
    }

    /**
     * @covers Packfire\Command\OptionSet::parse
     */
    public function testParse2() {
        $command = null;
        $quiet = false;
        $force = false;
        $linker = false;
        $file = '';
        $this->object->addIndex(0, 'The command of the compiler',
                function($value) use(&$command){
            $command = $value;
        });
        $this->object->add('q', 'Forces compiler not to output anything',
                function()use(&$quiet){
            $quiet = true;
        });
        $this->object->add('l', 'Use linker',
                function()use(&$linker){
            $linker = true;
        });
        $this->object->add('f', 'performs a force on the light saber',
                function()use(&$force){
            $force = true;
        });
        $this->object->add('file=', 'The last file',
                function($value)use(&$file){
            $file = $value;
        });
        
        $this->object->parse(array('update', '-qf', '/file=test.log'));
        $this->assertEquals('update', $command);
        $this->assertTrue($quiet);
        $this->assertTrue($force);
        $this->assertFalse($linker);
        $this->assertEquals('test.log', $file);
    }
}
