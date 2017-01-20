@extends('layout.adminindex')
@section('con')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>分类修改</span>
    </div>
    
    <div class="mws-panel-body no-padding">
        <form class="mws-form" action="/admin/cate/update" method="post">
        {{csrf_field()}}
            <input type="hidden" name='id' value='{{$vo['id']}}' />
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">父分类</label>
                    <div class="mws-form-item">
                        <input type="text" class='small' value='{{$funame}}' readonly name='cate' />
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">子分类</label>
                    <div class="mws-form-item">
                        <input type="text" class="small" value='{{$vo['cate']}}' name='cate'>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                <input type="submit" value="修改" class="btn btn-danger">
                <input type="reset" value="重置" class="btn ">
            </div>
        </form>
    </div>      
</div>
@endsection