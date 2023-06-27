<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Type;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        //compact:將projects的值傳到前端
        return view('projects.index', compact('projects'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $options = Type::getOptions();
        $options = Type::pluck('text', 'id');
        return view('projects.create', ['options'=>$options]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data= new Project;
        
        $data->name=$request->name;
        $data->type_id=$request->type_id;
        $data->client=$request->client;
        $data->location=$request->location;
        $data->value=$request->value;
        $data->photoby=$request->photoby;
        $data->description=$request->description;
        $data->show=$request->show;
        $data->master=$request->master;
        $data->user_id=$request->user_id;
        
        $data->save();

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $project= Project::where('id', $id)
               ->get();
        if(!$project){
            return redirect()->route('projects.index');
        }
        return view('projects.show', ['project'=>$project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project= Project::where('id', $id)
        ->get();
        $options = Type::pluck('text', 'id');
        return view('projects.edit', ['project'=>$project,'options'=>$options]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::destroy($id);
        return redirect()->route('projects.index');
    }
}
