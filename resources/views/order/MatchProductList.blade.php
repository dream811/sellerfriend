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
                    <form id="matchProductList" method="post" action="{{ route('order.MarketOrderCollection.matchProduct', $orderItemId) }}"> 
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
                                                <li class="list-inline-item">
                                                    <a href="{{$product->productImages->first()->strURL}}" target="_blank">
                                                        <span data="{{$product->productImages->first()->strURL}}" class="preview">
                                                            <img alt="gallery thumbnail" style="width: 5rem;" src="{{$product->productImages->first()->strURL}}">
                                                        </span>
                                                    </a>
                                                </li>
                                            </td>
                                            {{-- <td>{{ $product->market->strMarketName }}</td> --}}
                                            <td>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        {{ $product->strCategoryCode0 }}
                                                    </li><br>
                                                    <li class="list-inline-item" style="font-size: 14px;">
                                                        {{ $product->strKrMainName }}
                                                    </li><br>
                                                    <li class="list-inline-item">
                                                        {{ $product->strChSubName }}
                                                    </li><br>
                                                    <li class="font-weight-light list-inline-item">
                                                        {{ Auth::user()->name }}[{{ $product->created_at }}]
                                                    </li>
                                                </ul>    
                                            </td>
                                            <td>{{ $product->strSolutionId }}</td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-primary btnSelectOption" name="btnSelectOption">
                                                    선택
                                                </button>
                                            </td>
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
                if($("input[name='chkAccount[]']:checked").length <= 0)
                {
                    alert("계정을 하나이상 선택해주세요!");
                    return false;
                }
                $( "#manageMarketAccount" ).submit();
            });
        });	  
    </script>
@endsection

