<?php

namespace App\Http\Controllers;

use App\Job\Factory;
use App\Models\Job;
use App\Rules\CheckAllColunmHasDefultValueRole;
use App\Rules\CheckTableAlreadyExistsRole;
use App\Rules\CheckColumnAlreadyExistsRole;
use App\Rules\CheckColumnNotFoundRole;
use App\Rules\CheckEqualNumberOfElementsRole;
use App\Rules\CheckTableNotFoundRole;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Mockery\Exception\InvalidOrderException;
use PhpParser\Node\Stmt\TryCatch;

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
    public function index()
    {
        return view('jobs.index');
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
    public function store(Request $request)
    {
        $request->validate([
            'query' => [
                'required', 'string', 'max:255',

                new CheckTableAlreadyExistsRole,
                new CheckColumnAlreadyExistsRole,
                new CheckTableNotFoundRole,
                new CheckColumnNotFoundRole,
                new CheckEqualNumberOfElementsRole,
                new CheckAllColunmHasDefultValueRole,
            ],
        ]);
        $query = $request->post('query');
        $factory = new Factory;
        $factory->factory($query);



        return redirect()->route('jobs.index');
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
