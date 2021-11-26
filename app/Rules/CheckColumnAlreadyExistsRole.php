<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class CheckColumnAlreadyExistsRole implements Rule
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
        $order = array("\r\n", "\n", "\r","",",",";");
        $query =str_replace($order, "", $query);
        $order = array("(",")","");
        $query =str_replace($order, " ", $query);
        $query =array_slice(explode(' ', $query), 0);


        $result = mysqli_query($this->link ,"SHOW COLUMNS FROM customers");
        dd($result);
        // if($index_same_value = array_intersect($query, ['int'])){
            
        //     foreach ($index_same_value as $key => $result){
                
        //         $key -=1;
        //         if (Schema::hasColumn($query[2], $query[$key])) {
        //             return false; 
        //         }
        //         $element_search = $query[$key];
        //         unset($query[$key]);
        //         if(array_search($element_search, $query)){
        //             return false; 
        //         }
        //     }           
        // }
        // if($index_same_value = array_intersect($query, ['varchar'])){

        //     foreach ($index_same_value as $key => $result){
        //         $key -=1;
        //         if (Schema::hasColumn($query[2], $query[$key])) {
        //             return false; 
        //         }
        //         $element_search = $query[$key];
        //         unset($query[$key]);
        //         if(array_search($element_search, $query)){
        //             return false; 
        //         }
        //     }           
        // }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Column already exists.';
    }
}
