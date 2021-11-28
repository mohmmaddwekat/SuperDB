<?php

namespace App\Http\Controllers;

use App\Job\Factory;
use App\Models\Job;
use App\Rules\CheckNotConnectRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class JobController extends Controller
{
    protected $TYPE = ['int', 'varchar'];

    protected $test;
    protected $name_column;
    protected $data_row;
    protected $fillable;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);

        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);


        $result = mysqli_query($link ,"show tables");
        $tables = array();
        while($table = mysqli_fetch_array($result)) {
            array_push($tables,$table[0]);
        }
        mysqli_close($link);

        return view('jobs.index',[
        'connection'=> $DBconnection,
        'tables' => $tables
        ]);
    }

    public function viewColumn($name,$id)
    {
        $DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);

        $sqlcolunms = mysqli_query($link,"SHOW COLUMNS FROM ".$name);
        $sqlrow = mysqli_query($link,"SELECT * FROM ".$name);
        $rows = array();
        while ($row = mysqli_fetch_assoc($sqlrow)) {
            array_push($rows,$row);
        }

        $colunms = array();
        while($row = mysqli_fetch_array($sqlcolunms)){
          array_push($colunms,$row);
        }
        mysqli_close($link);
        return view('jobs.viewcolumn',[
        'connection'=> $DBconnection,
        'colunms' => $colunms,
        'rows' => $rows,
        ]);
    }
    
    public function sql($id)
    {
        $DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
        return view('jobs.sql',[
        'connection'=> $DBconnection,
        ]);
    }

    public function insert($id)
    {
        $connection = DB::table('connection')->where('id','=',$id)->first(['name','id']);

        return view('jobs.insert',[
            'connection'=> $connection
            ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
        $request->validate([
            'query' => [
                'required', 'string', 'max:255',
                new CheckNotConnectRole($DBconnection->name),
            ],
        ]);

        $link = mysqli_connect("localhost", "root", "", $DBconnection->name);

        $query = $request->post('query');
        $factory = new Factory;
        $factory->factory($query,$link,$DBconnection);
        mysqli_close($link);

        return redirect()->route('jobs.sql',$DBconnection->id);
    }



    protected  $type ;
    protected  $colunm ;
    public function storeInsert(Request $request,$id)
    {
        $DBconnection = DB::table('connection')->where('id','=',$id)->first(['name','id']);
        dd($id);

        $request->validate([
            'nametable' => [
                'required', 'string', 'max:255',

            ],
            'colunm' => [
                'required', 'max:255',
            ],
            'type' => [
                'required'
            ],
        ]);
        $nametable = $request->post('nametable');
        $this->colunm = $request->post('colunm');
        $this->type = $request->post('type');



        Schema::create($nametable, function($table)
        {
            
            $table->increments('id');
            foreach ($this->type as $key => $result) {

                if($result == 'varchar'){
                    preg_match('#\((.*?)\)#', $this->colunm[$key], $querycalumn);
                    if(empty($querycalumn[1])){
                        $value =250;
                        $valCol = $this->colunm[$key];
                    }
                    if(!empty($querycalumn[1])){
                        $value =$querycalumn[1];
                        $valCol = str_replace(' '.$querycalumn[0], '', $this->colunm[$key]);
                    }
                    $table->string($valCol, $value);
                }
                if($result == 'int'){
                    $table->integer($this->colunm[$key]);
                }
            }
        });


        return redirect()->route('jobs.insert');
    }



    public function import(){
        return view('jobs.import');
    }
    public function storeImport(Request $request){

        dd($request->all());
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
