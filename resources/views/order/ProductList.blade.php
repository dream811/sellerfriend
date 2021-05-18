@extends('layouts.window')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">쇼핑몰 아이디 선택</h1>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    <form id="manageMarketAccount" method="post" action="{{ route('order.MarketOrderCollection.GetMarketOrderList') }}"> 
                        @csrf
                        <input type="hidden" name="orderItemId" id="orderItemId" value="{{$orderItemId}}">
                        <div class="card-header border-bottom-0">
                            <div class="row col-12 pull-right float-right">
                                <a href="javascript:void(0)" class="btn btn-success btn-xs btnSubmitAccount" style="font-size:12px !important;">주문수집</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="window.opener=null; window.close(); return false;" class="btn btn-warning btn-xs" style="font-size:12px !important;">닫기</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" style="height:500px;">
                            <table id="marketAccountTable" class="table table-striped projects" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>이미지</th>
                                        <th>상품명</th>
                                        <th>상품코드</th>
                                        <th>선택</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr id="{{ $product->nIdx }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <li class="list-inline-item" >
                                                    <a href="{{$product->productMainImage->strURL}}" target="_blank">
                                                        <span data="{{$product->productMainImage->strURL}}" class="preview">
                                                            <img alt="gallery thumbnail" style="width: 5rem;" src="{{$product->productMainImage->strURL}}">
                                                        </span>
                                                    </a>
                                                </li>
                                            </td>
                                            <td>{{ $product->market->strMarketName }}</td>
                                            <td>{{ $product->strAccountId }}</td>
                                            <td>{{ $product->strAccountId }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
            $('.chkMarcketAccount').on('change', function(){
                if(!this.checked){
                    $('#select_all').prop('checked', false);
                }
                
            });
            
            $('body').on('click', '.btnSubmitAccount', function () {
                var account = "";
                // $.each($("input[name='chkAccount[]']:checked"), function(){
                //     acount += $(this).val() + "|";
                // });
                // products = products.slice(0,-1);
                if($("input[name='chkAccount[]']:checked").length <= 0)
                {
                    alert("계정을 하나이상 선택해주세요!");
                    return false;
                }
                // //console.log(account);
                // var action = '/orderMarketOrderCollection/GetMarketOrderList';
                // var data = $('#divProductForm').serialize();
                // $.ajax({
                //     url: action,
                //     data: data,
                //     type: "POST",
                //     dataType: 'json',
                //     success: function ({status, data}) {
                //         if(status == "success"){
                //             window.opener.drawTable();
                //             window.close();
                //         }
                //     },
                //     error: function (data) {
                //     }
                // });
                $( "#manageMarketAccount" ).submit();
            });
        });	  
    </script>
@endsection

