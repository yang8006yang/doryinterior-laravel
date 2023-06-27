<!-- 套用 ./layouts/app.blade.php 這個版面 -->
@extends('layouts.front')

<!-- content 段落會塞回 app.blade.php 中的 @yield('content') -->
@section('content')

    <!-- 在頁面上置入 ExampleComponent.vue 這個元件 -->
    <example-component></example-component>
    
@endsection