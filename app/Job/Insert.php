<?php

namespace App\Job;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Insert implements Job
{

        public function insert($query, $link)
        {
                if (mysqli_query($link, $query)) {
                        return ['success', 'INSERTed data!'];
                }
                if (!mysqli_query($link, $query)) {
                        return ['error', mysqli_error($link)];
                }
        }
        public function send($message,$connection)
        {
                return redirect()->route('jobs.index',$connection->id)->with($message[0], $message[1]);
        }
}
