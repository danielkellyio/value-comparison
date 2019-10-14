<?php
namespace DanielKellyIO\ValueComparison;
use \PHPUnit\Framework\TestCase;

class ValueComparisonTest extends TestCase
{
	
	public function dataproviderTestIs(){
		return [
			//value is       //comparison        //expected
			[ 'test',          'test',            true],
			[ 'test',          'test ',           true], // test trimming on comparison
			[ 'test ',         'test',            true], // test trimming on value
			[ 'test ',         'test ',           true], // test trimming on both
			[ 'test',          'not test',        false]
		];
	}
	
	/**
	 * @test ValueComparison::is()
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataproviderTestIs
	 */
	public function testIs($value, $comparison, $expected){
		$actual = Compare::value($value)->is($comparison);
		$this->assertSame($expected, $actual, "\"$value\" is: \"$comparison\" failed!");
	}
	
	public function dataProviderTestIsAny(){
		return [
			//value is any of:  //comparison            //expected
			[ 'test',          'test, another, more',   true],
			[ 'test',          'nope, fail, please',    false],
			[ 'test',          'test , another, more',  true], // test trimming on comparison
			[ 'test ',         'test, another, more',   true], // test trimming on value
			[ 'test',          'not test, another',     false], // test item in comparison contains value
		];
	}
	
	/**
	 * @test @test ValueComparison::is($comparison_value, 'any')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestIsAny
	 */
	public function testIsAny($value, $comparison, $expected){
		$actual = Compare::value($value)->is($comparison, 'any');
		$this->assertSame($expected, $actual, "\"$value\" is any of: \"$comparison\" failed!");
	}
	
	public function dataProviderTestIsNot(){
		return [
			//value is not:     //comparison            //expected
			[ 'test',          'nope',                  true],
			[ 'test',          'test',                  false],
			[ 'test',          'test ',                 false], // test trimming on comparison
			[ 'test ',         'test',                  false], // test trimming on value
		];
	}
	
	/**
	 * @test ValueComparison::isNot($comparison_value)
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestIsNot
	 */
	public function testIsNot($value, $comparison, $expected){
		$actual = Compare::value($value)->isNot($comparison);
		$this->assertSame($expected, $actual, "\"$value\" is not: \"$comparison\" failed!");
	}
	
	public function dataProviderTestIsNotAny(){
		return [
			//value is not any: //comparison            //expected
			[ 'test',          'nope, not, here',       true],
			[ 'test',          'test, is, here',        false],
			[ 'test',          'test more, is true',    true], // test item in comparison contains value
		];
	}
	
	/**
	 * @test ValueComparison::isNot($comparison_value, 'any')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestIsNotAny
	 */
	public function testIsNotAny($value, $comparison, $expected){
		$actual = Compare::value($value)->isNot($comparison, 'any');
		$this->assertSame($expected, $actual, "\"$value\" is not any of: \"$comparison\" failed!");
	}
	
	public function dataProviderTestIsNotAll(){
		return [
			//value is not all: //comparison            //expected
			[ 'test',          'nope, not, here',       true],
			[ 'test',          'test, is, here',        true],
			[ 'test',          'test, test, test',      false],
			[ 'test',          'test more, is true',    true], // test item in comparison contains value
		];
	}
	
	/**
	 * @test ValueComparison::isNot($comparison_value, 'all')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestIsNotAll
	 */
	public function testIsNotAll($value, $comparison, $expected){
		$actual = Compare::value($value)->isNot($comparison, 'all');
		$this->assertSame($expected, $actual, "\"$value\" is not all of: \"$comparison\" failed!");
	}
	
	public function dataProviderTestGreaterThan(){
		return [
			//value is >:       //comparison    //expected
			[ 5,                2,              true],
			[ 2,                5,              false],
			[ '5',              '2',            true],
			[ '2',              '5',            false],
		];
	}
	
	/**
	 * @test ValueComparison::greaterThan($comparison_value)
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestGreaterThan
	 */
	public function testGreaterThan($value, $comparison, $expected){
		$actual = Compare::value($value)->greaterThan($comparison);
		$this->assertSame($expected, $actual, "\"$value\" is greater than: \"$comparison\" failed!");
	}
	
	public function dataProviderTestGreaterThanAny(){
		return [
			//value is > any:   //comparison    //expected
			[ 5,                '1, 2, 3',      true],
			[ 5,                '1, 2, 7',      true],
			[ 5,                '5, 6, 7',      false],
			[ '5',              '1, 2, 3',      true],
		];
	}
	
	/**
	 * @test ValueComparison::greaterThan($comparison_value, 'any')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestGreaterThanAny
	 */
	public function testGreaterThanAny($value, $comparison, $expected){
		$actual = Compare::value($value)->greaterThan($comparison, 'any');
		$this->assertSame($expected, $actual, "\"$value\" is greater than any of: \"$comparison\" failed!");
	}
	
	public function dataProviderTestGreaterThanAll(){
		return [
			//value is > any:   //comparison    //expected
			[ 5,                '1, 2, 3',      true],
			[ 5,                '1, 2, 7',      false],
			[ 5,                '5, 6, 7',      false],
			[ '5',              '1, 2, 3',      true],
		];
	}
	
	/**
	 * @test ValueComparison::greaterThan($comparison_value, 'all')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestGreaterThanAll
	 */
	public function testGreaterThanAll($value, $comparison, $expected){
		$actual = Compare::value($value)->greaterThan($comparison, 'all');
		$this->assertSame($expected, $actual, "\"$value\" is greater than all of: \"$comparison\" failed!");
	}
	
	public function dataProviderTestLessThan(){
		return [
			//value is <:       //comparison    //expected
			[ 5,                2,              false],
			[ 2,                5,              true],
			[ '5',              '2',            false],
			[ '2',              '5',            true],
		];
	}
	
	/**
	 * @test ValueComparison::lessThan($comparison_value)
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestLessThan
	 */
	public function testLessThan($value, $comparison, $expected){
		$actual = Compare::value($value)->lessThan($comparison);
		$this->assertSame($expected, $actual, "\"$value\" is less than: \"$comparison\" failed!");
	}
	
	public function dataProviderTestLessThanAny(){
		return [
			//value is < any:   //comparison    //expected
			[ 5,                '1, 2, 3',      false],
			[ 5,                '1, 2, 7',      true],
			[ 5,                '5, 6, 7',      true],
			[ '5',              '1, 2, 3',      false],
			[ '5',              '6, 7, 8',      true],
		];
	}
	
	/**
	 * @test ValueComparison::lessThan($comparison_value, 'any')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestLessThanAny
	 */
	public function testLessThanAny($value, $comparison, $expected){
		$actual = Compare::value($value)->lessThan($comparison, 'any');
		$this->assertSame($expected, $actual, "\"$value\" is less than any of: \"$comparison\" failed!");
	}
	
	public function dataProviderTestLessThanAll(){
		return [
			//value is < any:   //comparison    //expected
			[ 5,                '1, 2, 3',      false],
			[ 5,                '1, 2, 7',      false],
			[ 5,                '8, 6, 7',      true],
			[ '5',              '1, 2, 3',      false],
			[ '5',              '8, 6, 7',      true],
		];
	}
	
	/**
	 * @test ValueComparison::lessThan($comparison_value, 'all')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestLessThanAll
	 */
	public function testLessThanAll($value, $comparison, $expected){
		$actual = Compare::value($value)->lessThan($comparison, 'all');
		$this->assertSame($expected, $actual, "\"$value\" is less than all of: \"$comparison\" failed!");
	}
	
	public function dataProviderTestContains(){
		return [
			//value contains:   //comparison    //expected
			[ 'testing here',   'ing',          true],
			[ 'testing here',   'ing here',     true],
			[ 'testing here',   'testing here', true],
			[ 'testing here',   'not',          false],
			[ 'we\'re #1',      1,              true],
		];
	}
	
	/**
	 * @test ValueComparison::contains($comparison_value)
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestContains
	 */
	public function testContains($value, $comparison, $expected){
		$actual = Compare::value($value)->contains($comparison);
		$this->assertSame($expected, $actual, "\"$value\"contains: \"$comparison\" failed!");
	}
	
	public function dataProviderTestContainsAny(){
		return [
			//value contains any:comparison                //expected
			[ 'testing here',   'ing, not, wrong',          true],
			[ 'testing here',   'ing here, not, wrong',     true],
			[ 'testing here',   'not, wrong',               false],
		];
	}
	
	/**
	 * @test ValueComparison::contains($comparison_value, 'any')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestContainsAny
	 */
	public function testContainsAny($value, $comparison, $expected){
		$actual = Compare::value($value)->contains($comparison, 'any');
		$this->assertSame($expected, $actual, "\"$value\"contains any of: \"$comparison\" failed!");
	}
	
	public function dataProviderTestContainsAll(){
		return [
			//value contains all:comparison                //expected
			[ 'testing here',   'ing, not, wrong',          false],
			[ 'testing here',   'ing here, testing',        true],
		];
	}
	
	/**
	 * @test ValueComparison::contains($comparison_value, 'all')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestContainsAll
	 */
	public function testContainsAll($value, $comparison, $expected){
		$actual = Compare::value($value)->contains($comparison, 'all');
		$this->assertSame($expected, $actual, "\"$value\"contains any of: \"$comparison\" failed!");
	}
	
	public function dataProviderTestExcludes(){
		return [
			//value excludes:   //comparison        //expected
			[ 'testing here',   'excluded',         true],
			[ 'testing here',   'inghere',          true],
			[ 'testing here',   '1testing here',    true],
			[ 'testing here',   'here',             false],
			[ 'we\'re #1',      1,                  false],
		];
	}
	
	/**
	 * @test ValueComparison::excludes($comparison_value)
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestExcludes
	 */
	public function testExcludes($value, $comparison, $expected){
		$actual = Compare::value($value)->excludes($comparison);
		$this->assertSame($expected, $actual, "\"$value\" excludes: \"$comparison\" failed!");
	}
	
	public function dataProviderTestExcludesAny(){
		return [
			//value excludes any:comparison            //expected
			[ 'testing here',   'excluded, test',       true],
			[ 'testing here',   'nope, nopers, wrong',  true],
			[ 'testing here',   'test, here',           false],
		];
	}
	
	/**
	 * @test ValueComparison::excludes($comparison_value, 'any')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestExcludesAny
	 */
	public function testExcludesAny($value, $comparison, $expected){
		$actual = Compare::value($value)->excludes($comparison, 'any');
		$this->assertSame($expected, $actual, "\"$value\" excludes any of: \"$comparison\" failed!");
	}
	
	public function dataProviderTestExcludesAll(){
		return [
			//value excludes any:comparison            //expected
			[ 'testing here',   'excluded, test',       false],
			[ 'testing here',   'nope, nopers, wrong',  true],
			[ 'testing here',   'test, here',           false],
		];
	}
	
	/**
	 * @test ValueComparison::excludes($comparison_value, 'all')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderTestExcludesAll
	 */
	public function testExcludesAll($value, $comparison, $expected){
		$actual = Compare::value($value)->excludes($comparison, 'all');
		$this->assertSame($expected, $actual, "\"$value\" excludes all of: \"$comparison\" failed!");
	}
	
	public function dataProviderStartsWith(){
		return [
			//value starts with //comparison        //expected
			[ 'testing here',   'test',             true],
			[ 'testing here',   'ing',              false],
			[ 'testing here',   'here',             false],
			[ 'testing here',   'tester',           false],
			[ '123',            1,                  true],
		];
	}
	/**
	 * @test ValueComparison::startsWith($comparison_value)
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderStartsWith
	 */
	public function testStartsWith($value, $comparison, $expected){
		$actual = Compare::value($value)->startsWith($comparison);
		$this->assertSame($expected, $actual, "\"$value\" starts with: \"$comparison\" failed!");
	}
	
	public function dataProviderStartsWithAny(){
		return [
			//value starts with any     //comparison        //expected
			[ 'testing here',           'test, no, nope',   true],
			[ 'testing here',           'ing, test, no',    true],
			[ 'testing here',           'here, testy, no',  false],
		];
	}
	/**
	 * @test ValueComparison::startsWith($comparison_value, 'any')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderStartsWithAny
	 */
	public function testStartsWithAny($value, $comparison, $expected){
		$actual = Compare::value($value)->startsWith($comparison, 'any');
		$this->assertSame($expected, $actual, "\"$value\" starts with any of: \"$comparison\" failed!");
	}
	
	public function dataProviderStartsWithAll(){
		return [
			//value starts with all     //comparison        //expected
			[ 'testing here',           'test, t, tes',     true],
			[ 'testing here',           'test, ty, tes',    false],
			[ 'testing here',           'nope, test, no',  false],
		];
	}
	/**
	 * @test ValueComparison::startsWith($comparison_value, 'all')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderStartsWithAll
	 */
	public function testStartsWithAll($value, $comparison, $expected){
		$actual = Compare::value($value)->startsWith($comparison, 'all');
		$this->assertSame($expected, $actual, "\"$value\" starts with all of: \"$comparison\" failed!");
	}
	
	public function dataProviderEndsWith(){
		return [
			//value ends with   //comparison    //expected
			[ 'testing here',   'here',         true],
			[ 'testing here',   ' here',        true],
			[ 'testing here',   'testing here', true],
			[ 'testing here',   'testing',      false],
			[ 'testing here',   'nope',         false],
			[ 'testing here1',   1,             true],
		];
	}
	/**
	 * @test ValueComparison::endsWith($comparison_value)
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderEndsWith
	 */
	public function testEndsWith($value, $comparison, $expected){
		$actual = Compare::value($value)->endsWith($comparison);
		$this->assertSame($expected, $actual, "\"$value\" ends with: \"$comparison\" failed!");
	}
	
	public function dataProviderEndsWithAny(){
		return [
			//value ends with any of    //comparison                //expected
			[ 'testing here',           'here, not, nope',          true],
			[ 'testing here',           'testing, nope',            false],
			[ 'testing here',           're, here, testing here',   true],
		];
	}
	/**
	 * @test ValueComparison::endsWith($comparison_value, 'any')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderEndsWithAny
	 */
	public function testEndsWithAny($value, $comparison, $expected){
		$actual = Compare::value($value)->endsWith($comparison, 'any');
		$this->assertSame($expected, $actual, "\"$value\" ends with any of: \"$comparison\" failed!");
	}
	
	public function dataProviderEndsWithAll(){
		return [
			//value ends with all of    //comparison                //expected
			[ 'testing here',           'here, not, nope',          false],
			[ 'testing here',           'testing, nope',            false],
			[ 'testing here',           're, here, testing here',   true],
		];
	}
	/**
	 * @test ValueComparison::endsWith($comparison_value, 'all')
	 * @param $value
	 * @param $comparison
	 * @param $expected
	 * @dataProvider dataProviderEndsWithAll
	 */
	public function testEndsWithAll($value, $comparison, $expected){
		$actual = Compare::value($value)->endsWith($comparison, 'all');
		$this->assertSame($expected, $actual, "\"$value\" ends with any of: \"$comparison\" failed!");
	}
}
