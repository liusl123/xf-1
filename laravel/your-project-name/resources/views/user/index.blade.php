@extends('layout.adminindex')
@section('con')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-table"></i>用户浏览</span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
        
            <form action="/admin/user/index" method='get'>
                <div id="DataTables_Table_1_length" class="dataTables_length">
                    <label>Show 
                        <select size="1" name="num" aria-controls="DataTables_Table_1">
                            <option value="5"
                                @if(!empty($request['num']) && $request['num'] == '5')
                                    selected
                                @endif
                            >5</option>
                            <option value="10"
                                @if(!empty($request['num']) && $request['num'] == '10')
                                    selected
                                @endif
                            >10</option>
                            <option value="25"
                                @if(!empty($request['num']) && $request['num'] == '25')
                                    selected
                                @endif
                            >25</option>
                            <option value="50"
                                @if(!empty($request['num']) && $request['num'] == '50')
                                    selected
                                @endif
                            >50</option>
                            <option value="100"
                                @if(!empty($request['num']) && $request['num'] == '100')
                                    selected
                                @endif
                            >100</option>
                        </select> entries
                    </label>
                </div>
                <div class="dataTables_filter" id="DataTables_Table_1_filter">
                    <label>Search: 
                        <input type="text" value='@if(!empty($request['keyword'])){{$request['keyword']}}@endif' name='keyword' aria-controls="DataTables_Table_1">
                    </label>
                    <input type="submit" class='btn btn-primary' value='搜索' />
                </div>

            </form>
            
            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 156px;">ID</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">用户名</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 194px;">邮箱</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 136px;">电话</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">状态</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">操作</th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                     @foreach ($list as $k => $v)
                        @if($k % 2 == 0)
                            <tr class="odd">
                        @else
                            <tr class="even">
                        @endif
                                <td class=" sorting_1">{{$v['id']}}</td>
                                <td class=" ">{{$v['name']}}</td>
                                <td class=" ">{{$v['email']}}</td>
                                <td class=" ">{{$v['phone']}}</td>
                                <td class=" ">
                                    @if($v['status'] == 0)
                                        禁用
                                    @else
                                        启用
                                    @endif
                                </td>
                                <td class=" ">
                                    <a href="/admin/user/del/{{$v['id']}}" class='icon-trash' style='font-size:30px;color:blue'></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="/admin/user/edit/{{$v['id']}}" class='icon-tools' style='font-size:25px;color:blue'></a>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- 分页开始 -->
            <div class="dataTables_paginate paging_full_numbers" id="page">
                {!!$list->appends($request)->render()!!}
            </div>
            <!-- 分页结束 -->
        </div>
    </div>
</div>
@endsection