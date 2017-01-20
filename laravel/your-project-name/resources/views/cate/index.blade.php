@extends('layout.adminindex')
@section('con')
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-table"></i>分类浏览</span>
    </div>
    <div class="mws-panel-body no-padding">
        <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper" role="grid">
            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 156px;">ID</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 208px;">分类名称</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 194px;">PID</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 136px;">PATH</th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 101px;">操作</th>
                    </tr>
                    sdsafasdf
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
                     @foreach ($list as $k => $v)
                        @if($k % 2 == 0)
                            <tr class="odd">
                        @else
                            <tr class="even">
                        @endif
                                <td class=" sorting_1">{{$v['id']}}</td>
                                <td class=" ">{{$v['cate']}}</td>
                                <td class=" ">{{\App\Http\Controllers\CateController::funame($v['pid'])}}</td>
                                <td class=" ">{{$v['path']}}</td>
                                <td class=" ">
                                    <a href="/admin/cate/del/{{$v['id']}}" class='icon-trash' style='font-size:30px;color:blue'></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="/admin/cate/add/{{$v['id']}}" class='icon-plus' style='font-size:25px;color:blue'></a>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="/admin/cate/edit/{{$v['id']}}" class='icon-tools' style='font-size:25px;color:blue'></a>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection