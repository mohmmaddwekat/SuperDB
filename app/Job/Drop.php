<?php
namespace App\Job;

use Illuminate\Support\Facades\Schema;

class Drop implements Job{

    public function drop($query){

        Schema::drop($query[2]);
    }
    public function send() {
        return redirect()->route('jobs.index')->with('success','Table Droped!');
    }
}



?>