@extends('layouts.window')
@section('content')
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
                        <input type="hidden" name="txtSetId" id="txtSetId" value="{{ $setId }}" />
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
@endsection
@section('script')
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
                set_id = $('#txtSetId').val();
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

                opener.SetCategoryInfo(market_code, category_code, category_tree, set_id);
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
                var action = '/productSearchMarketCategory/' + market_code + '/category/' + category_code + '/setting/0';
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
@endsection

