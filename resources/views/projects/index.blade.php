@extends('layouts.app')

@section('content')



<div class='w-100 justify-content-md-end d-grid  d-md-flex mb-3 mt-2'>
    <a class="btn btn-primary" href="{{ route('projects.create') }}">我有新專案！</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">action</th>
        </tr>
    </thead>
    <tbody>
        @if (count($projects) === 0)
        <tr>
            <th scope="row" colspan="4" class='text-center'>尚無資料</th>
        </tr>
        @else
        @foreach ($projects as $key => $prj)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td> <a href="{{ route('projects.show',['project'=> $prj['id'] ]) }}"> {{ $prj->name }}</a></td>
            <td>{{ $prj->type_id }}</td>
            <td class="d-flex">
                <a class="btn btn-info" href="{{ route('projects.edit', ['project' => $prj->id]) }}">編輯</a>
                <form action="{{ route('projects.destroy', ['project' => $prj->id] )}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('是否要刪除?')">刪除</button>
                </form>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>



@endsection