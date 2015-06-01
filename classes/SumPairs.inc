<?php namespace SteveSteele;

use Exception;


class SumPairs {


    public $pairs = [];
    private $_sum;
    private $_range = [];
    private $_validate;
    private $_format;


    /**
     * Constructor
     * @param Validate $validate    Validation class
     * @param Format   $format      Format interface
     */
    public function __construct( Validate $validate, Format $format ) {

        $this->_validate = $validate;
        $this->_format = $format;

    }


    /**
     * Internal sum setter w/ basic validation
     * @param mixed $sum    User input sum
     */
    private function _set_sum( $sum ) {

        if ( ! $this->_validate->is_integer( $sum ) ) {

            throw new Exception( '$sum should be an integer' );
            return false;

        }

        $this->_sum = $sum;

    }


    /**
     * Set the passed-in sum
     * @param integer $sum    User input sum
     */
    public function set_sum( $sum = null ) {

        try {
            $this->_set_sum( $sum );
        } catch ( Exception $e ) {
            echo $e->getMessage() . '<br />';
        }

    }


    /**
     * Get sum
     * @return integer    User input sum
     */
    public function get_sum() {

        return $this->_sum;

    }


    /**
     * Internal range setter w/ basic validation
     * @param mixed $range    User input range
     */
    private function _set_range( $range ) {

        if (
            ! $this->_validate->is_array( $range ) ||
            ! $this->_validate->is_integer( $range[0] ) ||
            ! $this->_validate->is_integer( $range[1] ) ||
            2 !== count( $range )
         ) {

            throw new Exception( '$range should be an array with 2 integer elements [min, max]' );
            return false;

        }

        $this->_range = $range;

    }


    /**
     * Set range
     * @param array $range    User input range
     */
    public function set_range( $range = null ) {

        try {
            $this->_set_range( $range );
        } catch ( Exception $e ) {
            echo $e->getMessage() . '<br />';
        }

    }


    /**
     * Get range
     * @return array    User input range
     */
    public function get_range() {

        return $this->_range;

    }


    /**
     * Verify the sum is within the range provided
     * @return boolean    True if w/in range; False otherwise
     */
    private function _is_sum_in_range() {

        $min = $this->_range[0] * 2;
        $max = $this->_range[1] * 2;

        if ( $this->_sum > $min && $this->_sum < $max ) {
            return true;
        }

        return false;

    }


    /**
     * Save a pair that totals to user sum
     * @param  integer $i    Pair element 1
     * @param  integer $j    Pair element 2
     */
    private function _save_successful_pair( $i, $j ) {

        $this->pairs[] = [$i, $j];

    }


    /**
     * Second loop: second range element
     * @param  integer $i    First range element index
     */
    private function _loop_range_inner( $i ) {

        for ( $j=$i+1 ; $j<=$this->_range[1] ; $j++ ) {

            $sum = $i + $j;
            if ( $this->_sum === $sum ) {
                $this->_save_successful_pair( $i, $j );
            }

        }

    }


    /**
     * First loop: first range element
     */
    private function _loop_range() {

        for ( $i=$this->_range[0] ; $i<=$this->_range[1] ; $i++ ) {
            $this->_loop_range_inner( $i );
        }

    }


    /**
     * Prepare output for rendering
     * @return string    Formatted pair output
     */
    private function _output() {

        $this->_format->set_pairs( $this );
        return $this->_format->pairs();

    }


    /**
     * Calculate pairs driver
     * @return string    A set of pairs that individually total to user input sum
     */
    public function calculate() {

        if ( ! $this->_validate->status || ! $this->_is_sum_in_range() ) {
            return $this->pairs;
        }

        $this->_loop_range();

        return $this->_output();

    }

}
