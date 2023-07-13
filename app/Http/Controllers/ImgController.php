<?php

namespace App\Http\Controllers;

use App\Models\Img;
use Hamcrest\Arrays\IsArray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
        $input = $request->all();
        $prjId = $input['prj_id'];
        $imgs = $request->file('img')??[];
        $del = $input['del'];
        $del =explode(',',$del[0]);
        $masterimg = $input['masterimg']??'';
        $imgtype = $input['imgtype']??'';
        
        foreach ($imgs as $key => $img) {
            $subFileName = $img->getClientOriginalExtension();
            $fileName = "prj_{$prjId}_{$key}.".$subFileName;
            $storagePath = Storage::putFileAs('/public/imgs', $img, $fileName);
            $imageUrl = Storage::url($storagePath);
            
            // 以亂數名稱存圖檔到指定位置
            // $storagePath = Storage::put('/public/imgs',  $img);
            // $fileName = basename($storagePath);

            $query = Img::where([['prj_id','=',$prjId],['seq','=',$key]])->first();
            if(empty($query)){
                //新增
                $data=new Img;
                $data->prj_id = $prjId;
                $data->pic_name = $fileName;
                $data->img_path = $imageUrl;
                $data->seq= $key ;
                $data->type= $imgtype[$key] ?? 0 ;
                unset($imgtype[$key]);
                $data->save();
            }else{
                //更新
                $query->pic_name = $fileName;
                $query->img_path = $imageUrl;
                if (isset($imgtype[$key])) {
                    $query->type= $imgtype[$key];
                    unset($imgtype[$key]);
                }
                $query->save();
            }
        }
    // 刪除圖片
        if(!empty($del)){
            Img::destroy($del);
        }

    //設定封面圖片
    if ($masterimg !=='') {
        Img::where([['prj_id','=',$prjId]])->update(['master'=> 0]);
        Img::find($masterimg)->update(['master'=> 1]);
    }

    if (!empty($imgtype)) {
        foreach ($imgtype as $seq => $type) {
            $query = Img::where([['prj_id','=',$prjId],['seq','=',$seq]])->first();
            $query->type= $type;
            $query->save();
        }
    }
        
    } catch (\Exception $e) {
        return $e;
    }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Img  $img
     * @return \Illuminate\Http\Response
     */
    public function show(Img $img)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Img  $img
     * @return \Illuminate\Http\Response
     */
    public function edit(Img $img)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Img  $img
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Img $img)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Img  $img
     * @return \Illuminate\Http\Response
     */
    public function destroy(Img $img)
    {
        //
    }
}
