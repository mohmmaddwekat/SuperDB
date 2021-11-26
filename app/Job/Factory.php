<?php
namespace App\Job;

use Illuminate\Support\Facades\Schema;

class Factory{
    public function SplitQuery($query){
        $order = array("\r\n", "\r", "", ",", ";");
        $query = str_replace($order, "", $query);
        $order = array("(", ")", "","\n");
        $query = str_replace($order, " ", $query);
        $query = array_slice(explode(' ', $query), 0);
        return $query;
    }

    public function factory($query,$link){
        $splitquery = $this->SplitQuery($query);
        if (in_array('CREATE', $splitquery)) {
            $create = new  Create();
            $message = $create->create($query,$link);
            $create->send($message);
        }
        if (in_array('DROP', $splitquery) and !in_array('ALTER', $splitquery)) {
            $drop = new  Drop();
            $message = $drop->drop($query,$link);
            $drop->send($message);
        }
        if (in_array('ALTER', $splitquery)) {
            $alter = new  Alter();
            $message = $alter->alter($query,$link);
            $alter->send($message);

        }

        if (in_array('INSERT', $splitquery) and Schema::hasTable($splitquery[2])) {
            $insert = new  Insert();
            $message = $insert->insert($query,$link);
            $insert->send($message);

        }
    }


    
}



?>