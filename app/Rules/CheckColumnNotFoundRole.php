<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class CheckColumnNotFoundRole implements Rule
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
        $order = array("\r\n", "\n", "\r","",",",";");
        $query =str_replace($order, "", $query);
        $order = array("(",")","");
        $query =str_replace($order, " ", $query);
        $query =array_slice(explode(' ', $query), 0);

        if (in_array('ALTER', $query) and $hasDrop = array_intersect($query, ['DROP'])) {

            foreach ($hasDrop as $key => $result) {
                $key += 2;
                if (!Schema::hasColumn($query[2], $query[$key])) {
                    return false;
                }

                $element_search = $query[$key];
                unset($query[$key]);
                if (array_search($element_search, $query)) {
                    return false;
                }
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
        
        return 'The Column Not Found.';
    }
}
