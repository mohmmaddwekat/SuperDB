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
            $bool = $create->create($query,$link);
            return $create->send($bool,$link);
        }
        if (in_array('DROP', $splitquery) and !in_array('ALTER', $splitquery)) {
            $drop = new  Drop();
            $bool = $drop->drop($query,$link);
            return $drop->send($bool,$link);
        }
        if (in_array('ALTER', $splitquery)) {
            $alter = new  Alter();
            $bool= $alter->alter($query,$link);
            return $alter->send($bool,$link);
        }
        if (in_array('INSERT', $splitquery)) {
            $insert = new  Insert();
            $bool = $insert->insert($query,$link);
            return $insert->send($bool,$link);
        }
        return ['error','Oops. Something went wrong'];
    }


    
}



?>