@extends('layouts.app')
@section('content')
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="">상하단 이미지관리</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">HOME</a></li>
                <li class="breadcrumb-item"><a href="#">운영관리</a></li>
                <li class="breadcrumb-item active">상하단이미지관리</li>
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
                            <li class="pull-right float-right pr-2 pt-2" style="">
                                <a href="javascript:void(0)" class="btn btn-success btn-sm btnAdd" >등록</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <form id="divProductForm">
                            <div class="card-body p-0" >
                                <table id="imageTable" class="table table-dark table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width:50px !important">No</th>
                                            <th>구분</th>
                                            <th>이미지</th>
                                            <th>이름</th>
                                            <th style="width:70px !important">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- //==Modal==// -->
    <div class="modal fade"  id="modal-id_image">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-sm" style="font-weight: 700">오픈마켓 아이디등록관리</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form id="manageImage" method="post" action="{{ route('operation.TopDownImageManageStore') }}"> 
                <div class="modal-body">
                    <div id="divForm">
                        <input type="hidden" name="hidImageId" id="hidImageId" value="0">
                        <div class="form-group row">
                            <label for="txtAccountPwd" class="col-sm-2 col-form-label lb-sm" style="font-size:12px;">구분</label>
                            <div class="input-group col-sm-10">
                                <select class="custom-select form-control-border custom-select-sm" name="selImageType" id="selImageType">
                                    <option value="">=선택=</option>
                                    <option value="TOP">상단</option>
                                    <option value="DOWN">하단</option>
                                    <option value="OTHER">기타</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" >
                            <label for="txtAccountPwd" class="col-sm-2 col-form-label lb-sm" style="font-size:12px;">제목</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="txtImageName" id="txtImageName" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row" id="divVendorId">
                            <label for="divPrevImage" class="col-sm-2 col-form-label lb-sm" style="font-size:12px;">이미지</label>
                            <div class="col-sm-10">
                                <div class="bg-gray border border-danger" style="height: 500px;" name="divPrevImage" id="divPrevImage">
                                    <img name="imgPreview" id="imgPreview" src="https://via.placeholder.com/300/FFFFFF?text=%20" style="width:100%; height:100%;" alt="">
                                    
                                </div>
                                <input type="file" name="fileImage" id="fileImage" style="opacity: 0;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer justify-content-between">
                    <button type="sumbit" class="btn btn-primary btn-sm float-left btnSaveImage">보관</button>
                    <button type="button" class="btn btn-default btn-sm float-right" data-dismiss="modal">취소</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    @section('script')
    <script>
        var table = null;
        tableTran  = $('#imageTable');
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            //Date range picker
            $('#txtDateRange').daterangepicker({
                locale: {
                    format: 'YYYY-MM-DD',
                    separator: " ~ "
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            });
            //Date range as a button
            $('#daterange-btn').daterangepicker(
                {
                    locale: {
                        format: 'YYYY-MM-DD',
                        separator: " ~ "
                    },
                    ranges   : {
                    'Today'       : [moment(), moment()],
                    'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                    'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    startDate: moment().subtract(29, 'days'),
                    endDate  : moment()
                },
                function (start, end) {
                    $('#txtDateRange').daterangepicker({
                        locale: {
                            format: 'YYYY-MM-DD',
                            separator: " ~ "
                        }, 
                        startDate: start.format('YYYY-MM-DD'), 
                        endDate: end.format('YYYY-MM-DD') 
                    });
                }
            );

            table = tableTran.DataTable({
                processing: true,
                serverSide: true,
                searching: false,
                scrollY: "400px",
                ajax: {
                    url: "{{ route('operation.TopDownImageManage') }}"
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex' , orderable: false},
                    {data: 'strImageType', name: 'strImageType'},
                    {data: 'image', name: 'image'},
                    {data: 'strImageName', name: 'strImageName'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ],
                responsive: true, lengthChange: true,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#imageTable_wrapper .col-md-6:eq(0)');
            
            // Handle click on "Select all" control
            $('#select_all').on('click', function(){
                var table = $('#imageTable').DataTable(); 
                // Get all rows with search applied
                var rows = table.rows({ 'search': 'applied' }).nodes();
                // Check/uncheck checkboxes for all rows in the table
                $('input[type="checkbox"]', rows).prop('checked', this.checked);
            });
            
            $('#divPrevImage').on('click', function (e) {
                $('#fileImage').trigger('click'); 
            });
            
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imgPreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#fileImage").change(function() {
                readURL(this);
            });

            $('body').on('click', '.btnAdd', function (e) {
                $('#hidImageId').val("0");
                $('#selImageType').val("");
                $('#txtImageName').val("");
                $('#fileImage').val(null);
                $('#imgPreview').attr('src', "https://via.placeholder.com/300/FFFFFF?text=%20");
                $('#modal-id_image').modal('show');
                
            });

            $('#manageImage').submit(function(e) {
                e.preventDefault();
                var imageId = $('#hidImageId').val();
                let formData = new FormData(this);
                if($('#selImageType option:selected').val() == ""){
                    alert('이미지타입을 선택해주세요');
                    return false;
                }
                if($('#txtImageName').val() == ""){
                    alert('이름을 입력해주세요');
                    return false;
                }
                
                if(imageId == 0){//추가
                    if ($('#fileImage').get(0).files.length === 0) {
                       alert('파일을 입력해주세요');
                        return false;
                    }
                    var action = '/operationTopDownImageManage';
                    $.ajax({
                        url: action,
                        data: formData,
                        type: "POST",
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function ({status, data}) {
                            $('#modal-id_image').modal('hide');
                            var table = $('#imageTable').DataTable(); 
                            table.draw();
                        },
                        error: function (data) {
                        }
                    });
                }else{
                    var action = '/operationTopDownImageManage/update';
                    $.ajax({
                        url: action,
                        data: formData,
                        type: "POST",
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function ({status, data}) {
                            $('#modal-id_image').modal('hide');
                            var table = $('#imageTable').DataTable(); 
                            table.draw();
                        },
                        error: function (data) {
                        }
                    });
                }
            });

            $('body').on('click', '.btnEdit', function (e) {
                var image_id = $(this).attr('data-id');
                $('#hidImageId').val(image_id);
                $.get('operationTopDownImageManage/' + image_id +'/edit', function ({status, data}) {
                    $('#selImageType').val(data.strImageType);
                    $('#txtImageName').val(data.strImageName);
                    $('#fileImage').val(null);
                    $('#imgPreview').attr('src', data.strImageURL);
                    $('#modal-id_image').modal('show');
                    
                })
            });

            $('body').on('click', '.btnDelete', function (e) {
                if(!confirm("정말 삭제하시겠습니까?")){
                    return false;
                }

                var image_id = $(this).attr('data-id');

                $('#hidImageId').val(image_id);

                $.ajax({
                    url: 'operationTopDownImageManage/' + image_id,
                    type: "DELETE",
                    dataType: 'JSON',
                    success: function ({status, data}) {
                        var table = $('#imageTable').DataTable(); 
                        table.draw();
                    },
                    error: function (data) {
                    }
                });
            });
        });	  
    </script>
    @endsection
@endsection