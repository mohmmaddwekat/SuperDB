<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Exceptions\ErrorHandlerMsg;

class CheckEqualNumberOfElementsRole implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        ErrorHandlerMsg::setLog('debug',"Role validation passes entered");
        $query = $value;
        $order = array("\r\n", "\n", "\r","",",",";");
        $query =str_replace($order, "", $query);
        $order = array("(",")","");
        $query =str_replace($order, " ", $query);
        $query =array_slice(explode(' ', $query), 0);
        if(in_array('INSERT',$query)){
            preg_match('#\((.*?)\)#', $value, $querycalumn);
            $newquery = str_replace($querycalumn[0], '', $value);
            preg_match('#\((.*?)\)#', $newquery, $queryValue);
            
            $newqueryValue = str_replace(array("(", "(,","'",")"), '', $queryValue[0]);
            $newqueryValue = explode(',', $newqueryValue);
            $newquerycalumn = str_replace(array("(",")"," "), '', $querycalumn[0]);
            $newquerycalumn = explode(',', $newquerycalumn);
            if (count($newquerycalumn) != count($newqueryValue)){
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Both parameters should have an equal number of elements.';
    }
}
