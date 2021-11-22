<?php
namespace App\Job;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
class Insert implements Job{

        public function insert($query,$newquery){
        
                preg_match('#\((.*?)\)#', $newquery, $querycalumn);
                $newquery = str_replace($querycalumn[0], '', $newquery);
                preg_match('#\((.*?)\)#', $newquery, $queryValue);
    
                $newqueryValue = str_replace(array("(", "(,","'",")"), '', $queryValue[0]);
                $newqueryValue = explode(',', $newqueryValue);
                $newquerycalumn = str_replace(array("(",")"," "), '', $querycalumn[0]);
                $newquerycalumn = explode(',', $newquerycalumn);
                $this->name_column =$newquerycalumn;
                $this->data_row = $newqueryValue;
    
                DB::table($query[2])->insert(array_combine($this->name_column,$this->data_row));
    
            
        }
        public function send() {
                return redirect()->route('jobs.index')->with('success','INSERTed data!');
        }
}
