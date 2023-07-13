<template>
    <!-- <div id='app'> -->
    <form method="POST" action="" class="w-100 row mt-3">
        <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">專案名稱</label>
            <input class="form-control" id='name' name='name' v-model="formdata.name">
        </div>
        <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">類型</label>
            <select name="type_id" class="form-select" v-model="formdata.type_id">
                <option v-for="(type, index) in typeOptions" 
                :value="index"
                :selected="data[0].type_id === index ? true : false"
                >{{ type }}</option>
                <!-- v-for內 :selected 直接寫?'select':'' 會吃不到 只能用t/f -->
            </select>
        </div>
        <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">客戶名稱</label>
            <input class="form-control" id='client' name='client' v-model="formdata.client" placeholder="private">
        </div>
        <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">專案地點</label>
            <input class="form-control" id='location' name='location' v-model="formdata.location" placeholder="private">
        </div>
        <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">金額</label>
            <input class="form-control" id='value' name='value' v-model="formdata.value" placeholder="private">
        </div>
        <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">攝影由...</label>
            <input class="form-control" id='photoby' name='photoby' v-model="formdata.photoby">
        </div>
        <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">是否顯示在前台?</label>
            <select name="show" id="show" class="form-select" v-model="formdata.show">
                <option value="1" :selected="data[0].show === 1 ? 'selected' : ''">是</option>
                <option value="0" :selected="data[0].show === 0 ? 'selected' : ''">否</option>
            </select>
        </div>
        <div class="form-group  w-50 mt-3">
            <label class="control-label fs-5">是否呈現在首頁?</label>
            <select name="master" id="master" class="form-select" v-model="formdata.master">
                <option value="1" :selected="data[0].master === 1 ? 'selected' : ''">是</option>
                <option value="0" :selected="data[0].master === 0 ? 'selected' : ''">否</option>
            </select>
        </div>
        <div class="form-group  w-100 mt-3">
            <label class="control-label fs-5">描述</label>
            <textarea name="description" id="description" cols="30" rows="5" v-model="formdata.description"
                class="form-control">{{ data[0].description }}</textarea>
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
                    <tr v-for="(img, index) in imgdata">
                        <td v-if="img !== undefined">{{ countIndex(index, this.imgdata) }}</td>
                        <td v-if="img !== undefined"><img :src="img.img_path" height="250" :alt="index" v-if="img.img_path != ''" />
                        </td>
                        <td v-if="img !== undefined">
                            <input type="file" :id="fileId(index)" :name="fileName(index)" accept=".jpg"
                                @change="uploadImg($event, index)">
                            <div class="mt-3 mb-2 form-check">
                                <input class="form-check-input" type="radio" name="masterimg" :id="'masterimg' + img.id"
                                    :checked="img.master == 1" @click="setmaster(img.id)">
                                <label class="form-check-label" :for="'masterimg' + img.id">專案封面</label>
                            </div>
                            <div class="form-group  mt-2 mb-3">
                                <label class="control-label">呈現方式</label>
                                <select :name="'typeimg['+index+']'" :id="'typeimg'+index" class="form-select form-select-sm" v-model="img.type" @change="setImgType(index)">
                                    <option value="0" :selected="img.type === 0 ? 'selected' : ''">一般</option>
                                    <option value="1" :selected="img.type === 1 ? 'selected' : ''">燈箱圖</option>
                                    <option value="2" :selected="img.type === 2 ? 'selected' : ''">頁面底圖</option>
                                    <option value="3" :selected="img.type === 3 ? 'selected' : ''">Panzoom</option>
                                </select>
                            </div>

                            <button class="btn btn-danger" type="button" @click="delimg(index, img.id)"
                                v-if="img != ''">項次刪除</button>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"></th>
                        <td colspan="2" class="text-end "><button @click='addImgItem()' type="button"
                                class="btn btn-light">新增項次</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="w-100 justify-content-md-center d-grid  d-md-flex mb-3 mt-2">
            <button type="button" class="btn btn-warning btn-lg" @click="save()">儲存</button>
            <div class="m-1"></div>
            <button type="button" class="btn btn-info btn-lg" @click="back()">返回</button>
        </div>
    </form>
    <!-- </div> -->
</template>
<script>
export default {
    mounted() {
        console.log('Component mounted.')
        this.imgs.map(img => {
            if (img.img_path !== '') {
                this.imgdata[img.seq] = img;
            }
        });
    },
    data() {
        return {
            imgdata: [],
            upimg: {
                'imgs': []
            },
            formdata: this.data[0],
            delimgid: [],
            masterimg: '',
            imgtype: [],

        }

    },
    props: ['data', 'createRoute', 'editRoute', 'up', 'typeOptions', 'imgs'],
    methods: {
        doinit() {
            this.imgdata = this.imgs.map(img => {
                this.imgdata[img.seq] = img.img_path;
            })
        },
        fileId(index) {
            return "prj-file-" + index;
        },
        fileName(index) {
            return "prj[file][" + index + "]";
        },
        addImgItem() {
            if (this.checkUpload(this.imgdata) === false && this.imgdata.length != 0) {
                alert("請先上傳所有圖片。")
            } else {
                let list = Object.keys(this.imgdata);
                let numberArray = [];
                length = list.length;
                for (var i = 0; i < length; i++) {
                    numberArray.push(parseInt(list[i]));
                }
                let us = Math.max(...numberArray) + 1;
                if (us == -Infinity) {
                    us = 1;
                }
                this.imgdata.splice(us, 0, {'type':0,'img_path':''});
            }
        },
        checkUpload(data) {
            //    新增圖片項次前檢查是否有上傳圖片
            let emptyInputs = []
            for (let key in data) {
                let inputFile = document.getElementById(this.fileId(key))
                let uploadImg = inputFile.parentElement.parentElement.children[1].firstChild
                // 4是v-if
                if (inputFile.files.length == 0 && (uploadImg.length == 0 || uploadImg.length <= 4)) {
                    emptyInputs.push(key)
                }
            }
            if (emptyInputs.length <= 0) {
                return true;
            } else {
                return false;
            }
        },
        // 圖片表格編號以計數呈現，不依資料庫中順序欄位
        countIndex(index, datafile) {
            const keys = Object.keys(datafile);
            const counter = keys.indexOf(index.toString());
            return counter !== -1 ? counter + 1 : keys.length;
        },
        delimg(index, id) {
            this.imgdata.splice(index, 1);
            this.delimgid.push(id);
            console.log(this.delimgid);
        },
        back() {
            window.history.back()
        },
        uploadImg(e, index) {
            // console.log(e.target.files.item(0));
            let img = e.target.files.item(0);
            this.upimg['imgs'][index] = img;
        },
        setmaster(id) {
            this.masterimg = id;
        },
        setImgType(seq) {
            this.imgtype[seq] = $(`#typeimg${seq}`).val();
            console.log(this.imgtype);
        },

        save() {
            if (this.up === true) {
                // this.formdata['imgs'] = this.upimg['imgs'];
                window.axios.put(`/projects/${this.formdata.id}`, this.formdata).then((res) => {
                    // 上傳圖片要FormData
                    let formData = new FormData();
                    // 多圖片放入formData
                    Object.keys(this.upimg['imgs']).forEach(key => {
                        formData.append(`img[${key}]`, this.upimg['imgs'][key])
                    })
                    formData.append('prj_id', this.formdata.id)
                    formData.append('type', '0')
                    formData.append('del[]', this.delimgid)
                    formData.append('masterimg', this.masterimg)
                    Object.keys(this.imgtype).forEach(key => {
                        formData.append(`imgtype[${key}]`, this.imgtype[key])
                    })

                    window.axios.post(`/imgs`, formData).then((res) => {
                        var currentUrl = window.location.href;
                        var newUrl = currentUrl.replace('/edit', '');
                        // location.replace(newUrl);
                        console.log(res);
                    })
                })
            } else {
                console.log('create');
            }
        }
    },
    watch: {
        masterimg: {
            handler() {
                // $("[name='masterimg']").prop("checked", false);
                // $(`#masterimg${this.masterimg}`).prop("checked", true);
            }
        }
    }
}
</script>
