<?php
namespace Packfire\Yaml;

/**
 * Test class for YamlInline.
 * Generated by PHPUnit on 2012-07-13 at 06:26:32.
 */
class YamlInlineTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers \Packfire\Yaml\YamlInline::parseValue
     */
    public function testParseValue()
    {
        $this->assertEquals('test two', YamlInline::load('test two')->parseValue());
        $pos = 0;
        $this->assertEquals('test', YamlInline::load('test two')->parseValue($pos, array(' ')));
        $this->assertEquals(5, $pos);
        $this->assertEquals('two', YamlInline::load('test two')->parseValue($pos));
        $pos = 0;
        $this->assertEquals('test two', YamlInline::load('"test two"')->parseValue($pos, array(' ')));
    }

    /**
     * @covers \Packfire\Yaml\YamlInline::parseKeyValue
     */
    public function testParseKeyValue()
    {
        $data = YamlInline::load('test: alpha')->parseKeyValue();
        $this->assertEquals(array('test' => 'alpha'), $data);
        $data = YamlInline::load('test: "alpha: is happy"')->parseKeyValue();
        $this->assertEquals(array('test' => 'alpha: is happy'), $data);
    }

    /**
     * @covers \Packfire\Yaml\YamlInline::parseSequence
     */
    public function testParseSequence()
    {
        $data = YamlInline::load('[test, 1, 2, "{maybe, cool]", three]')->parseSequence();
        $this->assertEquals(array('test', 1, 2, '{maybe, cool]', 'three'), $data);
    }

    /**
     * @covers \Packfire\Yaml\YamlInline::parseMap
     */
    public function testParseMap()
    {
        $data = YamlInline::load('{alpha: test, mike: bravo, good: "bad}, equals", hungry: "yes[iam"}')->parseMap();
        $this->assertEquals(
            array(
                'alpha' => 'test',
                'mike' => 'bravo',
                'good' => 'bad}, equals',
                'hungry' => 'yes[iam'
            ),
            $data
        );
    }
}
