<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // 用户添加
    public function getAdd(){
        return view('user.add');
    }
    // 执行添加操作
    public function postInsert(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'username' => 'required',
            'repass' => 'same:pass|required',
            'email' => 'required|email',
        ],[
            'name.required' => '姓名必须填写',
            'username.required' => '账号必须填写',
            'repass.same' => '两次密码不一致',
            'repass.required' => '重复密码必须填写',
            'email.required' => '邮箱必须填写',
            'email.email' => '邮箱格式不正确'
        ]);
        $data = $request -> except(['_token','repass']);
        $data['pass'] = Hash::make($data['pass']);//解密Hash::check()
        $data['token'] = str_random(50);
        $data['status'] = 0;

        $res = DB::table('user') -> insert($data);
        if($res){
            return redirect('/admin/user/index')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }
    public function getIndex(Request $request){
        $data = DB::table('user') -> where(function($query) use($request){
            if($request -> input('keyword')!=null){
                $query -> where('name','like','%'.$request -> input('keyword').'%')
                       -> orwhere('email','like','%'.$request -> input('keyword').'%')
                       -> orwhere('status' , $request -> input('keyword'));
            }
            
        }) -> where('state','1') -> paginate($request -> input('num',5));
        return view('user.index',['list' => $data,'request' => $request -> all()]);
    }
    // 删除
    public function getDel($id){
        $res = DB::table('user')->where('id',$id)->update(['state'=>0]);
        // dd($res);
        if($res){
            return redirect('/admin/user/index')->with('success','删除成功');
        }else{
            return back()->with('error','删除失败');
        }
    }

    public function getEdit($id){
        return view('user.edit',[
            'vo' => DB::table('user') -> where('id','=',$id) -> first()
        ]);
    }

    public function postUpdate(Request $request){
        $data = $request -> only(['email','status']);
        // 验证

        // 执行修改
        $res = DB::table('user') -> where('id',$request -> input('id')) -> update($data);
        if($res){
            return redirect('/admin/user/index') -> with('success','修改成功');
        }else{
            return back() -> with('error','修改失败');
        }
    }

}
