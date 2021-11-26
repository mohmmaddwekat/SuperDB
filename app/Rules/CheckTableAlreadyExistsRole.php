<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class CheckTableAlreadyExistsRole implements Rule
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
        $order = array("\r\n", "\r","",",",";");
        $query =str_replace($order, "", $query);
        $order = array("(",")","", "\n");
        $query =str_replace($order, " ", $query);
        $query =array_slice(explode(' ', $query), 0);

        $result = mysqli_query($this->link ,"show tables");
        $tables = array();
        while($table = mysqli_fetch_array($result)) {
            array_push($tables,$table[0]);
        }

        if (in_array(strtolower($query[2]),$tables) and in_array('CREATE',$query)) {
            return false;
        }
        
        if (in_array(strtolower($query[2]),$tables) and in_array('DROP',$query)) {
            return true; 
        }
        if (in_array(strtolower($query[2]),$tables) and !in_array('ALTER',$query) and !in_array('INSERT',$query)) {
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
