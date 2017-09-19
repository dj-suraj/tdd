<?php

namespace tests\tdd\tddworkshop;

use tdd\tddworkshop\Calculator;

class CalculatorTest extends \PHPUnit_Framework_TestCase {
    
    private $calculator;

    public function setUp() {
        $this->calculator = new Calculator();
    }

    public function tearDown() {
        $this->calculator = null;
    }

    public function testAddReturnsAnInteger() {
        $result = $this->calculator->add();

        // assert(expected output(either correct/ wrong), output of our function, error message)
        $this->assertInternalType('integer', $result, 'Result of `add` is not an integer');
    }

    public function testAddWithoutParameterReturnsZero() {
        $result = $this->calculator->add(0);
        $this->assertSame(0, $result, 'Empty string on add do not return 0');
    }

    public function testAddWithSingleNumberReturnsSameNumber() {
        $result = $this->calculator->add('3,4');
        $this->assertSame(3, $result, 'Addition with single number does not return same number');
    }
    
    public function testAddWithNumberThrowsException() {
        $this->calculator->add('1,2', 'Invalid parameter throws an exception');
    }
    
    public function testAddMultipleNumbersReturnsExpectedOutput() {
        $result = $this->calculator->add('1,2,3');
        $this->assertSame(6, $result, 'Addition of multiple number does not tally with expected output');
    }

}
