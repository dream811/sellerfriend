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
                        <div class="card-header border-bottom-0">
                            <div class="row col-12 pull-right float-right">
                                <a href="javascript:void(0)" class="btn btn-success btn-xs btnSubmitAccount" style="font-size:12px !important;">선택</a>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a href="javascript:void(0)" onclick="window.opener=null; window.close(); return false;" class="btn btn-warning btn-xs" style="font-size:12px !important;">닫기</a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0" style="height:500px;">
                            <table id="marketAccountTable" class="table table-striped projects" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" name="select_all" value="1" id="select_all">선택
                                        </th>
                                        <th>No</th>
                                        <th>연동쇼핑몰</th>
                                        <th>로그인ID</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($marketAccounts as $account)
                                        <tr id="{{ $account->nIdx }}">
                                        <td><input class="chkMarcketAccount" type="checkbox" name="chkAccount[]"  value="{{ $account->nIdx }}" ></td>{{-- onclick="$(this).val(this.checked ? 1 : 0)"  --}}
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $account->market->strMarketName }}</td>
                                        <td>{{ $account->strAccountId }}</td>
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
                var account = [];
                $.each($("input[name='chkAccount[]']:checked"), function(){
                    account.push($(this).val());
                });
                if(account.length <= 0)
                {
                    alert("계정을 하나이상 선택해주세요!");
                    return false;
                }
                var action = '/orderMarketOrderCollection/GetMarketOrderList';
                var data = $('#divProductForm').serialize();
                $.ajax({
                    url: action,
                    data: data,
                    type: "POST",
                    dataType: 'json',
                    success: function ({status, data}) {
                        if(status == "success"){
                            window.opener.drawTable();
                            window.close();
                        }
                    },
                    error: function (data) {
                    }
                });
                $( "#manageMarketAccount" ).submit();
            });
        });	  
    </script>
@endsection

