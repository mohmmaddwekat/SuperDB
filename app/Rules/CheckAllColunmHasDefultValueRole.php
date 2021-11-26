<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class CheckAllColunmHasDefultValueRole implements Rule
{
    protected $link;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($link)
    {
        $this->link = $link;
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
        $query = $value;
        $order = array("\r\n", "\n", "\r", "", ",", ";");
        $query = str_replace($order, "", $query);
        $order = array("(", ")", "");
        $query = str_replace($order, " ", $query);
        $query = array_slice(explode(' ', $query), 0);

        if (in_array('INSERT', $query)) {

            preg_match('#\((.*?)\)#', $value, $querycalumn);
            $newquery = str_replace($querycalumn[0], '', $value);
            preg_match('#\((.*?)\)#', $newquery, $queryValue);
            $newqueryValue = str_replace(array("(", "(,", "'", ")"), '', $queryValue[0]);
            $newqueryValue = explode(',', $newqueryValue);
            $newquerycalumn = str_replace(array("(", ")", " "), '', $querycalumn[0]);
            $newquerycalumn = explode(',', $newquerycalumn);

            $result = mysqli_query($this->link,"SELECT * FROM customers");
            // $tables = array();
            // while($table = mysqli_fetch_array($result)) {
            //     array_push($tables,$table[0]);
            // }
            // dd(mysqli_fetch_lengths($result),$result);
            // if (count($newquerycalumn) != count($tables)) {
            //     return false;
            // }

            dd();
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
        return "Same colunm doesn't have a default value";
    }
}
