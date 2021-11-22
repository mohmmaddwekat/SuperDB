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

    public function factory($query){
        $splitquery = $this->SplitQuery($query);
        if (in_array('CREATE', $splitquery)) {
            $create = new  Create();
            $create->create($splitquery);
            $create->send();
        }
        if (in_array('DROP', $splitquery) and !in_array('ALTER', $splitquery)) {
            $drop = new  Drop();
            $drop->drop($splitquery);
            $drop->send();
        }
        if (in_array('ALTER', $splitquery)) {
            $alter = new  Alter();
            $alter->alter($splitquery);
            $alter->send();

        }

        if (in_array('INSERT', $splitquery) and Schema::hasTable($splitquery[2])) {
            $insert = new  Insert();
            $insert->insert($splitquery,$query);
            $insert->send();

        }
    }


    
}



?>