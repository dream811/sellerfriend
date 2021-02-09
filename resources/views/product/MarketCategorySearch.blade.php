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
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">카테고리</h1>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    <form id="manageMarketAccount" method="post" action="{{ route('product.MarketAccountSelect', ['marketCode'=>'coupang', 'categoryCode'=> 0]) }}"> 
                        @csrf
                        <input type="hidden" name="txtMarketCode" id="txtMarketCode" value="{{ $marketCode }}" />
                        <input type="hidden" name="txtCategoryCode" id="txtCategoryCode" value="0" />
                        <div class="card-header border-bottom-0">
                            <div class="row col-12 pull-right float-right">
                                <a href="javascript:void(0)" class="btn btn-success btn-xs btnSubmitCategory" style="font-size:12px !important;">선택</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="window.opener=null; window.close(); return false;" class="btn btn-warning btn-xs" style="font-size:12px !important;">닫기</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-2" style="height:500px;">
                            <div class="row col">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <select class="clsCategoryName custom-select form-control-border" cate-id="1" name="selCategoryName1" id="selCategoryName1">
                                                <option value="0">카테고리 1</option>
                                                @foreach ($categories_1 as $category_1)
                                                <option value="{{$category_1->displayItemCategoryCode}}" >{{$category_1->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <select class="clsCategoryName custom-select form-control-border" cate-id="2" name="selCategoryName2" id="selCategoryName2">
                                                <option value="0">카테고리 2</option>
                                                {{-- @foreach ($categories_2 as $category_2)
                                                <option value="{{$category_2->nIdx}}" >{{$category_2->strCategoryName}}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <select class="clsCategoryName custom-select form-control-border" cate-id="3" name="selCategoryName3" id="selCategoryName3">
                                                <option value="0">카테고리 3</option>
                                                {{-- @foreach ($categories_3 as $category_3)
                                                <option value="{{$category_3->nIdx}}" >{{$category_3->strCategoryName}}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <select class="clsCategoryName custom-select form-control-border" cate-id="4" name="selCategoryName4" id="selCategoryName4">
                                                <option value="0">카테고리 4</option>
                                                {{-- @foreach ($categories_4 as $category_4)
                                                <option value="{{$category_4->nIdx}}" >{{$category_4->strCategoryName}}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <select class="clsCategoryName custom-select form-control-border" cate-id="5" name="selCategoryName5" id="selCategoryName5">
                                                <option value="0">카테고리 5</option>
                                                {{-- @foreach ($categories_4 as $category_4)
                                                <option value="{{$category_4->nIdx}}" >{{$category_4->strCategoryName}}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <div class="input-group input-group-sm">
                                            <select class="custom-select form-control-border" cate-id="6" name="selCategoryName6" id="selCategoryName6">
                                                <option value="0">카테고리 6</option>
                                                {{-- @foreach ($categories_4 as $category_4)
                                                <option value="{{$category_4->nIdx}}" >{{$category_4->strCategoryName}}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#select_all').on('click', function(){
                // Get all rows with search applied
                // Check/uncheck checkboxes for all rows in the table
                $('input[type="checkbox"]').prop('checked', this.checked);
            });

            $('body').on('click', '.btnSubmitCategory', function () {
                
                market_code = $('#txtMarketCode').val();
                category_code = $('#txtCategoryCode').val();
                if(category_code == "0"){
                    return false;
                }
                var category_tree = "";
                for(var i = 1; i <= 6; i++){
                    //$('#selCategoryName' + i.toString()).html('<option value="0">카테고리 ' + i + '</option>');
                    if($('#selCategoryName' + i.toString() + ' > option:selected').val() != "0"){
                        if(i == 1){
                            category_tree += $.trim($( '#selCategoryName' + i.toString() + ' > option:selected' ).text().replace(/\n/g,''));
                        }else{
                            category_tree += " > " + $.trim($( '#selCategoryName' + i.toString() + ' > option:selected' ).text().replace(/\n/g,''));
                        }
                    }
                    
                }

                opener.SetCategoryInfo(market_code, category_code, category_tree);
                window.close();
                return false;
            });
            //카테고리 선택
            $('.clsCategoryName').change(function(){ 
                var market_code = $('#txtMarketCode').val();
                var category_code = $(this).val();
                $('#txtCategoryCode').val(category_code);
                var idx = parseInt($(this).attr('cate-id'));
                var nxtIdx = idx + 1;
                //카테고리 바뀌였으면 아래 카테고리 모두 빈 카테고리로 만든다
                for(var i = nxtIdx; i <= 6; i++){
                    $('#selCategoryName' + i.toString()).html('<option value="0">카테고리 ' + i + '</option>');
                }
                //루트를 빈카테고리 선택했다면 하위 카테고리 모두 빈카테고리로 
                if(category_code == 0) {
                    return;
                }
                var action = '/productSearchMarketCategory/' + market_code + '/category/' + category_code;
                $.ajax({
                    url: action,
                    data: market_code,
                    type: "GET",
                    dataType: 'json',
                    success: function ({status, data}) {
                        if(status == "success"){
                            $('#selCategoryName' + nxtIdx.toString()).html('<option value="0">카테고리 ' + nxtIdx.toString() + '</option>');
                            data.forEach( (element, index) => {
                                $('#selCategoryName' + nxtIdx.toString()).append(`<option value="${element.displayItemCategoryCode}"> 
                                        ${element.name} 
                                    </option>`); 
                            });
                        }
                    },
                    error: function (data) {

                    }
                });
            });
            
        });	  
    </script>
</body>
</html>

