<?php
namespace App\Job;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Create implements Job{


    public function create($query){
        

            Schema::create($query[2], function (Blueprint $table) {
                $table->increments('id');
            });

            $this->test = $query;
            Schema::table($query[2], function (Blueprint $table) {

                if ($results = array_intersect($this->test, ['int'])) {

                    foreach ($results as $key => $result) {
                        unset($this->test[$key]);
                        $key -= 1;
                        $table->integer($this->test[$key]);
                        unset($this->test[$key]);
                    }
                }

                if ($results = array_intersect($this->test, ['varchar'])) {

                    foreach ($results as $key => $result) {
                        unset($this->test[$key]);
                        $value = $key + 1;
                        unset($this->test[$value]);
                        $key -= 1;
                        $table->string($this->test[$key], $value);
                        unset($this->test[$key]);
                    }
                }
            });
        }
        public function send() {
            return redirect()->route('jobs.index')->with('success','Table Created!');
        }
    
}



?>