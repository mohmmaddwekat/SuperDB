<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class CheckTableAlreadyExistsRole implements Rule
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
        $query = $value;
        $order = array("\r\n", "\r","",",",";");
        $query =str_replace($order, "", $query);

        $order = array("(",")","", "\n");
        $query =str_replace($order, " ", $query);

        $query =array_slice(explode(' ', $query), 0);

        if (Schema::hasTable($query[2]) and in_array('DROP',$query)) {
            return true; 
        }
        if (Schema::hasTable($query[2]) and !in_array('ALTER',$query) and !in_array('INSERT',$query)) {
            return false; 
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
        
        return 'The Table already exists';
    }
}
