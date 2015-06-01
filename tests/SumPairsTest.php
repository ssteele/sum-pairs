<?php

use SteveSteele\Validate;
use SteveSteele\FormatPairs;
use SteveSteele\SumPairs;


class SumPairsTest extends \PHPUnit_Framework_TestCase {


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_set_sum() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_sum( 1 );
        $this->assertEquals( 1, $sum_pairs->get_sum() );

        $sum_pairs->set_sum( '1' );
        $this->assertEquals( 1, $sum_pairs->get_sum() );

    }


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_set_sum_exception() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_sum();
        $this->assertEquals( [], $sum_pairs->calculate() );

        $sum_pairs->set_sum( 1.1 );
        $this->assertEquals( [], $sum_pairs->calculate() );

        $sum_pairs->set_sum( '1' );
        $this->assertEquals( [], $sum_pairs->calculate() );

        $sum_pairs->set_sum( 'NaN' );
        $this->assertEquals( [], $sum_pairs->calculate() );

    }


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_set_range() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_range( [-50, 50] );
        $this->assertEquals( [-50, 50], $sum_pairs->get_range() );

    }


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_set_range_exception() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_range();
        $this->assertEquals( [], $sum_pairs->calculate() );

        $sum_pairs->set_range( -50 );
        $this->assertEquals( [], $sum_pairs->calculate() );

        $sum_pairs->set_range( [-50] );
        $this->assertEquals( [], $sum_pairs->calculate() );

        $sum_pairs->set_range( [50, -50] );
        $this->assertEquals( [], $sum_pairs->calculate() );

        $sum_pairs->set_range( [-50, 0, 50] );
        $this->assertEquals( [], $sum_pairs->calculate() );

        $sum_pairs->set_range( [-50.5, 50.5] );
        $this->assertEquals( [], $sum_pairs->calculate() );

    }


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_100() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_sum( 100 );
        $sum_pairs->set_range( [-50, 50] );
        $this->assertEquals( [], $sum_pairs->calculate() );

    }


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_99() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_sum( 99 );
        $sum_pairs->set_range( [-50, 50] );
        $this->assertEquals( '(49,50)', $sum_pairs->calculate() );

    }


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_98() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_sum( 98 );
        $sum_pairs->set_range( [-50, 50] );
        $this->assertEquals( '(48,50)', $sum_pairs->calculate() );

    }


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_97() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_sum( 97 );
        $sum_pairs->set_range( [-50, 50] );
        $this->assertEquals( '(47,50)(48,49)', $sum_pairs->calculate() );

    }


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_neg_100() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_sum( 100 );
        $sum_pairs->set_range( [-50, 50] );
        $this->assertEquals( [], $sum_pairs->calculate() );

    }


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_neg_99() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_sum( -99 );
        $sum_pairs->set_range( [-50, 50] );
        $this->assertEquals( '(-50,-49)', $sum_pairs->calculate() );

    }


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_neg_98() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_sum( -98 );
        $sum_pairs->set_range( [-50, 50] );
        $this->assertEquals( '(-50,-48)', $sum_pairs->calculate() );

    }


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_neg_97() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_sum( -97 );
        $sum_pairs->set_range( [-50, 50] );
        $this->assertEquals( '(-50,-47)(-49,-48)', $sum_pairs->calculate() );

    }


    /**
     * @covers \SteveSteele\SumPairs
     * @uses   \SteveSteele\SumPairs
     */
    public function test_0() {

        $validate = new Validate();
        $format = new FormatPairs();
        $sum_pairs = new SumPairs( $validate, $format );

        $sum_pairs->set_sum( 0 );
        $sum_pairs->set_range( [-50, 50] );
        $this->assertEquals( '(-50,50)(-49,49)(-48,48)(-47,47)(-46,46)(-45,45)(-44,44)(-43,43)(-42,42)(-41,41)(-40,40)(-39,39)(-38,38)(-37,37)(-36,36)(-35,35)(-34,34)(-33,33)(-32,32)(-31,31)(-30,30)(-29,29)(-28,28)(-27,27)(-26,26)(-25,25)(-24,24)(-23,23)(-22,22)(-21,21)(-20,20)(-19,19)(-18,18)(-17,17)(-16,16)(-15,15)(-14,14)(-13,13)(-12,12)(-11,11)(-10,10)(-9,9)(-8,8)(-7,7)(-6,6)(-5,5)(-4,4)(-3,3)(-2,2)(-1,1)', $sum_pairs->calculate() );

    }

}
