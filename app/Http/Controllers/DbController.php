<?php

namespace App\Http\Controllers;

use App\RestoreDB\ExportDB\ExportAsCSV;
use App\RestoreDB\ExportDB\ExportAsSQL;
use App\RestoreDB\ExportDB\MangeDataBase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysqli;

class DbController extends Controller
{
    public function export($connection_id, $export, $tables = '*')
    {
       
            $roles_Abilitiles = Auth::user()->role->abilities()->pluck('code')->toArray();
            if (!in_array('super-db.jobs.index', $roles_Abilitiles)) {
                abort(403);
            }
            $DBconnection = DB::table('connection')->where('id', '=', $connection_id)->first(['name', 'id']);
            $db = new mysqli('localhost', 'root', '', $DBconnection->name);
            $comparisonoperators = new MangeDataBase;
            list($NameDB, $tables) = $comparisonoperators->ComparisonOperators($tables, $DBconnection, $db);
            if ($export == "csv") {
               
                $handle = fopen('../storage/app/db/' . $NameDB . '_' . time() . '.csv', 'w+');
                $csv = new ExportAsCSV;
                $csv->export($tables, $db, $handle);
            }
            if ($export == "sql") {
                $handle = fopen('../storage/app/db/' . $NameDB . '_' . time() . '.sql', 'w+');
                $sql = new ExportAsSQL;
                $sql->export($tables, $db, $handle);
            }
            fclose($handle);
            return redirect()->route('super-db.jobs.index', $DBconnection->id)->with("success", "Database Export Successfully!");
       
    }
}
