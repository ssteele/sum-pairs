<?php namespace SteveSteele;


class FormatPairs implements Format {


    private $_pairs = [];
    private $_formatted = '';


    /**
     * Set pairs
     * @param SumPairs $sum    SumPairs object
     */
    public function set_pairs( SumPairs $sum ) {

        $this->_pairs = $sum->pairs;

    }


    /**
     * Build individual pair for output
     * @param  array $pair    Individual pair result
     */
    private function _package( $pair ) {

        if ( is_array( $pair ) && ! empty( $pair ) ) {
            $this->_formatted .= '(' . $pair[0] . ',' . $pair[1] . ')';
        }

    }


    /**
     * Build all pairs output
     */
    private function _stringify() {

        if ( is_array( $this->_pairs ) ) {

            foreach ( $this->_pairs as $pair ) {
                $this->_package( $pair );
            }

        } else {
            $this->_formatted = $this->_pairs;
        }

    }


    /**
     * Format output
     * @return string    Formatted pair output
     */
    public function pairs() {

        $this->_stringify();
        return $this->_formatted;

    }

}
