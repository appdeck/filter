<?php

namespace FilterTest;

use Filter\Filter;

class FilterTest extends \PHPUnit_Framework_TestCase {

	private $tests = array(
		true,
		'true',
		't',
		1,
		42,
		0x0A,
		'yes',
		'1,1',
		false,
		'false',
		'f',
		0,
		'This text is false',
		'',
		null,
		array(),
		"str\ting",
		"\0",
		'no',
		'<script>alert();</script>',
		"email@testing\n.co",
		'email@testing.co',
		"http://testing\0.co",
		'http://testing.co',
		'01/01/1970',
		'31/12/1970',
		'12/31/1970',
		'10/10/70',
		'127.0.0.1',
		'255.255.255.255',
		'2001:0db8:0000:0000:0000:ff00:0042:8329'
	);

	public function testBool() {
		$expect = array(
			false,
			true,
			true,
			true,
			false,
			true,
			true,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false,
			false
		);
		foreach ($this->tests as $index => $value)
			$this->assertSame($expect[$index], Filter::bool($value), "Test index: {$index}");
		$this->assertSame($expect, call_user_func_array('\\Filter\\Filter::bool', $this->tests));
	}

	public function testInt() {
		$expect = array(
			1,
			0,
			0,
			1,
			42,
			10,
			0,
			11,
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			1011970,
			31121970,
			12311970,
			101070,
			127001,
			255255255255,
			PHP_INT_MAX
		);
		foreach ($this->tests as $index => $value)
			$this->assertSame($expect[$index], Filter::int($value), "Test index: {$index}");
		$this->assertSame($expect, call_user_func_array('\\Filter\\Filter::int', $this->tests));
	}

	public function testFloat() {
		$expect  = array(
			1.0,
			0.0,
			0.0,
			1.0,
			42.0,
			10.0,
			0.0,
			1.0,
			0.0,
			0.0,
			0.0,
			0.0,
			0.0,
			0.0,
			0.0,
			0.0,
			0.0,
			0.0,
			0.0,
			0.0,
			0.0,
			0.0,
			0.0,
			0.0,
			1011970.0,
			31121970.0,
			12311970.0,
			101070.0,
			127.0,
			255.255,
			2.00108E+27
		);
		foreach ($this->tests as $index => $value)
			$this->assertSame($expect[$index], Filter::float($value), "Test index: {$index}");
		$this->assertSame($expect, call_user_func_array('\\Filter\\Filter::float', $this->tests));
	}

	public function testString() {
		$expect = array(
			'1',
			'true',
			't',
			'1',
			'42',
			'10',
			'yes',
			'1,1',
			'',
			'false',
			'f',
			'0',
			'This text is false',
			'',
			'',
			'',
			'string',
			'',
			'no',
			'<script>alert();</script>',
			'email@testing.co',
			'email@testing.co',
			'http://testing.co',
			'http://testing.co',
			'01/01/1970',
			'31/12/1970',
			'12/31/1970',
			'10/10/70',
			'127.0.0.1',
			'255.255.255.255',
			'2001:0db8:0000:0000:0000:ff00:0042:8329'
		);
		foreach ($this->tests as $index => $value)
			$this->assertSame($expect[$index], Filter::string($value), "Test index: {$index}");
		$this->assertSame($expect, call_user_func_array('\\Filter\\Filter::string', $this->tests));
	}

	public function testNoTags() {
		$expect = array(
			'1',
			'true',
			't',
			'1',
			'42',
			'10',
			'yes',
			'1,1',
			'',
			'false',
			'f',
			'0',
			'This text is false',
			'',
			'',
			'',
			'string',
			'',
			'no',
			'alert();',
			'email@testing.co',
			'email@testing.co',
			'http://testing.co',
			'http://testing.co',
			'01/01/1970',
			'31/12/1970',
			'12/31/1970',
			'10/10/70',
			'127.0.0.1',
			'255.255.255.255',
			'2001:0db8:0000:0000:0000:ff00:0042:8329'
		);
		foreach ($this->tests as $index => $value)
			$this->assertSame($expect[$index], Filter::noTags($value), "Test index: {$index}");
		$this->assertSame($expect, call_user_func_array('\\Filter\\Filter::noTags', $this->tests));
	}

	public function testEmail() {
		$expect = array(
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			'email@testing.co',
			'email@testing.co',
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null
		);
		foreach ($this->tests as $index => $value)
			$this->assertSame($expect[$index], Filter::email($value), "Test index: {$index}");
		$this->assertSame($expect, call_user_func_array('\\Filter\\Filter::email', $this->tests));
	}

	public function testUrl() {
		$expect = array(
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			'http://testing.co',
			'http://testing.co',
			null,
			null,
			null,
			null,
			null,
			null,
			null
		);
		foreach ($this->tests as $index => $value)
			$this->assertSame($expect[$index], Filter::url($value), "Test index: {$index}");
		$this->assertSame($expect, call_user_func_array('\\Filter\\Filter::url', $this->tests));
	}

	public function testDate() {
		$expect = array(
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			'1970/01/01',
			'1970/12/31',
			'1970/12/31',
			null,
			null,
			null,
			null
		);
		foreach ($this->tests as $index => $value)
			$this->assertSame($expect[$index], Filter::date($value), "Test index: {$index}");
		$this->assertSame($expect, call_user_func_array('\\Filter\\Filter::date', $this->tests));
	}

	public function testIpv4() {
		$expect = array(
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			'127.0.0.1',
			'255.255.255.255',
			null
		);
		foreach ($this->tests as $index => $value)
			$this->assertSame($expect[$index], Filter::ipv4($value), "Test index: {$index}");
		$this->assertSame($expect, call_user_func_array('\\Filter\\Filter::ipv4', $this->tests));
	}

	public function testIpv6() {
		$expect = array(
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			null,
			'2001:0db8:0000:0000:0000:ff00:0042:8329'
		);
		foreach ($this->tests as $index => $value)
			$this->assertSame($expect[$index], Filter::ipv6($value), "Test index: {$index}");
		$this->assertSame($expect, call_user_func_array('\\Filter\\Filter::ipv6', $this->tests));
	}

}
