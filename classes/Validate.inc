<?php namespace SteveSteele;


class Validate {


    public $status = true;


    /**
     * Validate number
     * @param  mixed   $integer   Integer?
     * @return boolean            True if number; False otherwise
     */
    public function is_integer( $integer ) {

        if ( ! is_int( $integer ) ) {

            $this->status = false;
            return false;

        }

        return true;

    }


    /**
     * Validate array
     * @param  mixed   $array    Array?
     * @return boolean           True if array; False otherwise
     */
    public function is_array( $array ) {

        if ( ! isset( $array ) || empty( $array ) ) {

            $this->status = false;
            return false;

        }

        return true;

    }

}
