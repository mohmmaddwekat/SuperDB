<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckNotConnectRole implements Rule
{
    protected $connection;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($connection)
    {
        $this->connection =$connection;
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
        try {
            $link = mysqli_connect("localhost", "root", "", $this->connection);
            return true;
        } catch (\Throwable $th) {
            ErrorHandlerMsg::setLog('debug',"Error while creating connection");
            return false;
        }        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Could not connect to database.';
    }
}
