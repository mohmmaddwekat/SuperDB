<?php
namespace App\Job;


class QueryHandler{

    /*
    *Split query by qoutations, handle the spaces, then store it in an array
    */
    public function SplitQuery($query){
        $order = array("\r\n", "\r", "", ",", ";");
        $query = str_replace($order, "", $query);
        $order = array("(", ")", "","\n");
        $query = str_replace($order, " ", $query);
        $query = array_slice(explode(' ', $query), 0);
        return $query;
    }

    /*
    *handle queries.
    *Update table/column according to SQL query (DROP,ALTER,INSERT,CREATE).
    */

    public function handleQueries($query,$mysqlConnection){

        $splitquery = $this->SplitQuery($query);
        if (in_array('CREATE', $splitquery)) {
            $create = new  Create();
            $bool = $create->create($query,$mysqlConnection);
            return $create->send($bool,$mysqlConnection);
        }

        if (in_array('DROP', $splitquery) and !in_array('ALTER', $splitquery)) {
            $drop = new  Drop();
            $bool = $drop->drop($query,$mysqlConnection);
            return $drop->send($bool,$mysqlConnection);
        }

        if (in_array('ALTER', $splitquery)) {
            $alter = new  Alter();
            $bool= $alter->alter($query,$mysqlConnection);
            return $alter->send($bool,$mysqlConnection);
        }

        if (in_array('INSERT', $splitquery)) {
            $insert = new  Insert();
            $bool = $insert->insert($query,$mysqlConnection);
            return $insert->send($bool,$mysqlConnection);
        }

        return ['error','Oops. Something went wrong'];
    }


    
}



?>