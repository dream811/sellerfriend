@extends('layouts.app')
@section('content')
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="">계정관리</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">관리자</a></li>
                <li class="breadcrumb-item"><a href="#">유저관리</a></li>
                <li class="breadcrumb-item active">유저관리</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        
                        <ul class="nav float-right">
                            <li class="pull-right float-right pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-success btn-sm btnAdd">새로 등록</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body" >
                        <form id="divUserForm">
                            <table id="userTable" class="table table-dark table-hover table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                            </table>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    @section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });	
        var table = $('#userTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            scrollY: "400px",
            ajax: {
                url: "{{ route('admin.user.UserManage') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, 'searchable' : false, 'exportable' : false, 'printable'  : true},
                {title: "이름", data: 'name', name: 'name'},
                {title: "메일", data: 'email', name: 'email'},
                {title: "전화번호", data: 'phone_number', name: 'phone_number'},
                {title: "예치금", data: 'money', name: 'money'},
                {title: "역할", data: 'role', name: 'role', className: "text-center"},
                {title: "사용상태", data: 'bIsUsed', name: 'bIsUsed', className: "text-right"},
                {title: "조작", data: 'action', name: 'action', orderable:false, searchable: false, className: "text-center"},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#productTable_wrapper .col-md-6:eq(0)');
        $('body').on('click', '.btnEdit', function () {
            var userId = $(this).attr('data-id');
            window.open('/admin/user/userManage/edit/' + userId, '정보 수정', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        $('body').on('click', '.btnAdd', function () {
            window.open('/admin/user/userManage/edit/0', '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
    </script>
    @endsection
@endsection