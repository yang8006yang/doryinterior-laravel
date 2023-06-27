
@extends('layouts.app')

@section('content')

<hr>
<h1>新增專案</h1>
<hr>
<!-- <form-component></form-component> -->
<div id='app'>
<form method="POST" action="{{route('projects.store')}}" class="w-100 row  mt-3">
    @csrf
    <div class="form-group  w-50 mt-3">   
            <label class="control-label fs-5">專案名稱</label>
            <input class="form-control" id='name' name='name'>
    </div>
    <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">類型</label>
            <select name="type_id" class="form-select ">
          @foreach ($options as $value => $text)
                <option value="{{ $value }}">{{ $text }}</option>
                @endforeach
            </select>
    </div>
    <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">客戶名稱</label>
            <input class="form-control" id='client' name='client' placeholder="private">
    </div>
    <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">專案地點</label>
            <input class="form-control" id='location' name='location' placeholder="private">
    </div>
    <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">金額</label>
            <input class="form-control" id='value' name='value' placeholder="0">
    </div>
    <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">攝影由...</label>
            <input class="form-control" id='photoby' name='photoby' >
    </div>
    <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">是否顯示在前台?</label>
            <select name="show" id="show" class="form-select">
                <option value="1">是</option>
                <option value="0" selected>否</option>
            </select>
    </div>
    <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">是否呈現在首頁?</label>
            <select name="master" id="master" class="form-select">
                <option value="1">是</option>
                <option value="0" selected>否</option>
            </select>
    </div>
    <div class="form-group  w-100 mt-3">
            <label class="control-label fs-5">描述</label>
            <textarea name="description" id="description" cols="30" rows="5" class="form-control"></textarea>
    </div>
    <div class="form-group w-100 mt-3">
        <table class="table">
            <thead class='thead-dark'>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">圖片</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        <input type="file"  accept=".jpg" >
                        <button class="btn btn-danger" type="button">項次刪除</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row"></th>
                    <td colspan="2" class="text-end "><button  @click='addimg()' type="button" class="btn btn-light">新增項次</button></td>
                </tr>
            </tbody>
        </table>
    </div>
    <input type="hidden" name="user_id" value="{{ Auth::id() }}" />
    <!-- Equivalent to... -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <button class="btn btn-info mt-3" type="submit">儲存</button>
</form>
</div>
@endsection
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script> -->
<!-- 
<script>
    
    $(document).ready(function () {
        const app = Vue.createApp({
            data(){
                return {
                    imgs
                }
            },
            methods:{
                addimg(){
                    let list=Object.keys(this.imgs);
                    let numberArray=[];
                    length = list.length;
                    for (var i = 0; i < length; i++){
                        numberArray.push(parseInt(list[i]));
                    }
                    let us=Math.max(...numberArray)+1;
                    this.imgs[us]="";
                }
            }
        })
        app.mount('#app');
    })
</script> -->

