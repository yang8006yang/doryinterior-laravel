<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Type;
use App\Models\Img;


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
        try{
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
            return response($data->id, Response::HTTP_OK);
        }catch(\Exception $e){
            return response($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        

        // return redirect()->route('projects.index');
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
        $imgs=Img::where('prj_id', $id)->get();
        $options = Type::pluck('text', 'id');
        return view('projects.edit', ['project'=>$project,'options'=>$options,'imgs'=>$imgs]);
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
        try {
        $input=$request->except(['_token','_method']);
        $data=Project::findOrFail($id);
        
        $data->name = $input['name'];
        $data->client = $input['client'];
        $data->description = $input['description'];
        $data->location = $input['location'];
        $data->photoby = $input['photoby'];
        $data->master = $input['master'];
        $data->show = $input['show'];
        $data->type_id = $input['type_id'];
        $data->value = $input['value'];
        $data->modby = Auth::id();

        $data->save();

        return response(null, Response::HTTP_OK);
        } catch (\Exception $e) {
                
        }
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
