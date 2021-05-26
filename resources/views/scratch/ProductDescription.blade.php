<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{asset('js/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('js/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('js/summernote/summernote-bs4.min.css')}}">

    <!-- DataTables  & Plugins -->
    <script src="{{asset('js/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('js/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('js/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    <!-- <script src="{{asset('js/jszip/jszip.min.js')}}"></script>
    <script src="{{asset('js/pdfmake/pdfmake.min.js')}}"></script>
    <script src="{{asset('js/pdfmake/vfs_fonts.js')}}"></script> -->
    <script src="{{asset('js/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('js/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('js/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
    <!-- Summernote -->
    <script src="{{asset('js/summernote/summernote-bs4.min.js')}}"></script>
    @yield('third_party_stylesheets')

    @stack('page_css')
</head>
<body class="hold-transition sidebar-mini layout-fixed dark-mode text-sm">
    <div class="content-header " >
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:20px; font-weight:700;">상품수정</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 float-right text-right" >
                <div style="position: fixed; z-index: 99; padding: 4px; right: 20px; background-color: lightgray; border-radius: 0.5rem;">
                    <button type="submit" class="btn btn-primary btn-xs btnUpdateProduct">상품수정</button>
                    <button type="button" class="btn bg-indigo btn-xs btnClose">닫기</button>
                </div>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <form method="POST" id="frmScrap" action="{{route('scratch.SellPrepareCheck.updateDescription', $product->nIdx)}}">
            @csrf
            <div class="col-12">
                <fieldset >
                       
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="mt-3">
                                    <textarea name="summernote" id="summernote">
                                    </textarea>
                                </div>
                            </div>
                            
                        </div>
                </fieldset>
                <input type="text" id="hdDescription" class="form-control" hidden="">
                <input type="hidden" id="txtDesc" class="form-control" value="{{$product->productDetail->blobNote}}">
            </div>
            </form>
        </div>
    </div>
    <!-- //==Modal==// -->
    <div class="modal fade"  id="modal-id_image">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title text-sm" style="font-weight: 700">판매중지내용 작성</h4>
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
    <script>
           $(document).on({
        ajaxStart: function(){
            $("body").addClass("loading"); 
        },
        ajaxStop: function(){ 
            $("body").removeClass("loading"); 
        }    
    });
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        
        $('#summernote').summernote({
            height: '400px'
        });
        $('#summernote').summernote('code', $('#txtDesc').val());
        //delete account
        $('body').on('click', '.btnDelItem', function () {
            var rowId = $(this).attr('data-id');

            $(".subItemsTable tbody").find("#row_" + rowId).remove();
        });
        
        $('body').on('click', '.btnUpdateProduct', function () {
            
            if(confirm("수집정보를 저장하시겠습니까")){
                $('#optionFieldset').prop( "disabled", false );
                $('#frmScrap').submit();
            }
        });	
        $('body').on('click', '.btnClose', function () {
            window.close();
        });
    })
    </script>
</body>
</html>

