<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CateController extends Controller
{
    //分类添加
    public function getAdd($id=''){
        $cate = self::getCates();
        return view('cate.add',['list' => $cate,'id' => $id]);
    }
    public static function getCates(){
       $cate = DB::table('cate') -> select('*',DB::raw('concat(path,id) as paths')) -> orderBy('paths') -> get();
       foreach ($cate as $k => $v) {
           $num = count(explode(',',$v['path']))-2;
           $cate[$k]['cate'] = str_repeat('|---',$num).$v['cate'];
       }
       return $cate;
    }
    public function postInsert(Request $request){
        if($request -> input('id') == 0){
            $data['cate'] = $request -> input('cate');
            $data['pid'] = 0;
            $data['path'] = '0,';
        }else{
            $data['cate'] = $request -> input('cate');
            $data['pid'] = $request -> input('id');
            $path = DB::table('cate') -> where('id',$request -> input('id')) -> first()['path'];
            $data['path'] = $path.$request -> input('id');
        }
        $res = DB::table('cate') -> insert($data);
        if ($res) {
            return readirect('/admin/cate/index') -> with('success','添加分类成功');
        }else{
            return back() -> with('error','添加失败');
        }
    }

    public function getIndex(){
        return view('cate.index',['list' => self::getCates()]);
    }
    public static function funame($pid){
        $funame = DB::table('cate') -> where('id',$pid) -> first()['cate'];
        echo empty($funame) ? '顶级分类' : $funame;
    }

    public function getDel(){
        $data = DB::table('cate') -> where('pid',$id) -> get();
        if(count($data) > 0){
            return back() -> with('error','该类下面有子类不能直接删除');
        }else{
            $res = DB::table('cate') -> where('id',$id) -> delete();
            if($res){
                return redirect('/admin/cate/index') -> with('success','删除成功');
            }else{
                return back() -> with('error','删除失败');
            }
        }
    }

    public function getEdit($id){
        $data = DB::table('cate as c1')
                    ->join('cate as c2','c1.pid','=','c2.id')
                    ->select('c2.cate as funame')
                    ->where('c1.id',$id)
                    ->first()['funame'];
        $funame = empty($funame) ? '顶级类' : $funame;
        return view('cate.edit',[
            'vo' => DB::table('cate') -> where('id',$id) -> first(),
            'funame' => $funame
        ]);
    }

    public function postUpdate(Request $request){
        if(DB::table('cate') -> where('id',$request->input('id'))->update($request->only('cate'))){
            return redirect('/admin/cate/index')->with('success','修改成功');
        }else{
            return back()->with('error','修改失败');
        }
    }
}
