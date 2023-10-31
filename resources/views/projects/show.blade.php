@extends ('layouts.app')

@section('content')
<h1>{{ $project[0]->name }}</h1>

<table class="table table-hover table-bordered">
    <thead class="table-dark">
        <tr>
            <th>項目</th>
            <th colspan="3">內容</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td>專案名稱</td>
            <td colspan="3">{{ $project[0]->name }}</td>
        </tr>
        <tr>
            <td>專案類型</td>
            <td colspan="3">{{ $options[$project[0]->type_id] }}</td>
        </tr>
        <tr>
            <td>客戶名稱</td>
            <td colspan="3"><?= $client= $project[0]->client ??"<span style='color: gray'>private</span>"?></td>
        </tr>
        <tr>
            <td>專案地點</td>
            <td colspan="3"><?= $client= $project[0]->location ??"<span style='color: gray'>private</span>"?></td>
        </tr>
        <tr>
            <td>金額</td>
            <td colspan="3"><?= $client= $project[0]->value ??"<span style='color: gray'>private</span>"?></td>
        </tr>
        <tr>
            <td>攝影由...</td>
            <td colspan="3">{{ $project[0]->photoby }}</td>
        </tr>
        <tr>
            <td>描述</td>
            <td colspan="3">{{ $project[0]->description }}</td>
        </tr>
        <tr>
            <td>是否呈現在首頁?</td>
            <td colspan="3">{{ $project[0]->master }}</td>
        </tr>
    </tbody>
    <tfoot class="table-light">

        <tr>
            <td >創建由...</td>
            <td>{{ $project[0]->user_id }}</td>
            <td>創建時間</td>
            <td>{{ $project[0]->created_at }}</td>
        </tr>
        <tr>
            <td>修改由...</td>
            <td>{{ $project[0]->modby }}</td>
            <td>修改時間</td>
            <td>{{ $project[0]->updated_at }}</td>
        </tr>
</tfoot>
</table>
@endsection

