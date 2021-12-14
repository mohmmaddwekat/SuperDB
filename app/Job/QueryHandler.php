<?php
namespace App\Job;


class QueryHandler{
    public function SplitQuery($query){
        $order = array("\r\n", "\r", "", ",", ";");
        $query = str_replace($order, "", $query);
        $order = array("(", ")", "","\n");
        $query = str_replace($order, " ", $query);
        $query = array_slice(explode(' ', $query), 0);
        return $query;
    }

    public function handleQueries($query,$mysqlConnection){
        $splitquery = $this->SplitQuery($query);
        if (in_array('CREATE', $splitquery)) {
            $create = new  Create();
            $isSucceeded = $create->create($query,$mysqlConnection);
            return $create->send($isSucceeded,$mysqlConnection);
        }
        if (in_array('DROP', $splitquery) and !in_array('ALTER', $splitquery)) {
            $drop = new  Drop();
            $isSucceeded = $drop->drop($query,$mysqlConnection);
            return $drop->send($isSucceeded,$mysqlConnection);
        }
        if (in_array('ALTER', $splitquery)) {
            $alter = new  Alter();
            $isSucceeded= $alter->alter($query,$mysqlConnection);
            return $alter->send($isSucceeded,$mysqlConnection);
        }
        if (in_array('INSERT', $splitquery)) {
            $insert = new  Insert();
            $isSucceeded = $insert->insert($query,$mysqlConnection);
            return $insert->send($isSucceeded,$mysqlConnection);
        }
        return ['error','Oops. Something went wrong'];
    }


    
}



?>