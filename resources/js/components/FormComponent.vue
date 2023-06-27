<template>
    <div id='app'>
        <form method="POST" action="" class="w-100 row  mt-3">
            <div class="form-group  w-50 mt-3">
                <label class="control-label fs-5">專案名稱</label>
                <input class="form-control" id='name' name='name' :value="data[0].name">
            </div>
            <div class="form-group  w-50 mt-3">
                <label class="control-label fs-5">類型</label>
                <select name="type_id" class="form-select " v-model="data[0].type_id">
                    
                    <option v-for="(type,index) in typeOptions" 
                        :value="index">{{ type }}</option>

                </select>
            </div>
            <div class="form-group  w-50 mt-3">
                <label class="control-label fs-5">客戶名稱</label>
                <input class="form-control" id='client' name='client' :value="data[0].client === null ?'private':''">
            </div>
            <div class="form-group  w-50 mt-3">
                <label class="control-label fs-5">專案地點</label>
                <input class="form-control" id='location' name='location' :value="data[0].location === null ?'private':''">
            </div>
            <div class="form-group  w-50 mt-3">
                <label class="control-label fs-5">金額</label>
                <input class="form-control" id='value' name='value' :value="data[0].value === null ?'private':''">
            </div>
            <div class="form-group  w-50 mt-3">
                <label class="control-label fs-5">攝影由...</label>
                <input class="form-control" id='photoby' name='photoby' :value="data[0].photoby">
            </div>
            <div class="form-group  w-50 mt-3">
                <label class="control-label fs-5">是否顯示在前台?</label>
                <select name="show" id="show" class="form-select">
                    <option value="1" :selected="data[0].show === 1 ?'selected':''">是</option>
                    <option value="0" :selected="data[0].show === 0 ?'selected':''">否</option>
                </select>
            </div>
            <div class="form-group  w-50 mt-3">
                <label class="control-label fs-5">是否呈現在首頁?</label>
                <select name="master" id="master" class="form-select">
                    <option value="1" :selected="data[0].show === 1 ?'selected':''">是</option>
                    <option value="0" :selected="data[0].show === 0 ?'selected':''">否</option>
                </select>
            </div>
            <div class="form-group  w-100 mt-3">
                <label class="control-label fs-5">描述</label>
                <textarea name="description" id="description" cols="30" rows="5" class="form-control" >{{ data[0].description }}</textarea>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    },
    props: ['data', 'createRoute','editRoute','up','typeOptions'],
    methods: {

    }
}
</script>
