
@extends('layouts.app')

@section('content')

<hr>
<h1>新增專案</h1>
<hr>
<form-component :up='false' 
                :data="" 
                :type-options="{{ json_encode($options) }}" 
                :imgs=""
                :user-id="{{ Auth::id() }}" />

@endsection