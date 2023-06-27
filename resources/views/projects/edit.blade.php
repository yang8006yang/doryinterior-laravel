@extends('layouts.app')

@section('content')

<?php
// dd($project->first()->id);
?>
<form-component :up='true' 
                :data="{{ json_encode($project) }}" 
                :type-options="{{ json_encode($options) }}" 
                :edit-route="'{{route('projects.edit',['project'=>$project->first()->id])}}'" />


@endsection