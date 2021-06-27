@extends('layouts.window')
@section('content')
<div class="content-header " >
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0" style="font-size:20px; font-weight:700;">반품지</h1>
        </div><!-- /.col -->
        <div class="col-sm-6 float-right text-right" >
            {{-- <div style="position: fixed; z-index: 99; padding: 4px; right: 20px; background-color: lightgray; border-radius: 0.5rem;">
                <button type="submit" class="btn btn-primary btn-xs btnSaveSetting">저장</button>
                <button type="button" class="btn bg-indigo btn-xs btnClose">닫기</button>
            </div> --}}
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card card-primary card-outline card-tabs">
                <form id="manageMarketAccount" method="post" action="{{ 1 }}"> 
                    @csrf
                    <div class="card-body table-responsive p-0" style="height:500px;">
                        <table id="outboundShippingPlaceTable" class="table table-striped table-bordered projects text-xs" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>템플릿번호</th>
                                    <th>템플릿명</th>
                                    <th>발송방법</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($strMarketCode == "11thhouse")
                                    @foreach ($sendCloseTpls as $sendCloseTpl)
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0);" 
                                                data-code="{{ $sendCloseTpl['prdInfoTmpltNo'] }}" 
                                                data-name="" 
                                                data-contact="" 
                                                data-zip="" 
                                                data-address="" 
                                                data-detail="" 
                                                class="btn btn-primary btn-xs btnSetSendCloseTpl">
                                                <span style="font-size:10px;">{{ $sendCloseTpl['prdInfoTmpltNo'] }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            {{ $sendCloseTpl['prdInfoTmpltNm'] }}
                                        </td>
                                        <td>@if($sendCloseTpl['sendCmplTerm'] > 2)
                                            재고확인 후 순차발송(소량재고/주문제작)
                                            @else
                                            일반발송
                                            @endif 
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
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

            $('body').on('click', '.btnSetSendCloseTpl', function () {
                var sendCloseTplCode = $(this).attr('data-code');
                
                if(sendCloseTplCode == "0"){
                    return false;
                }
                opener.SetSendCloseTpl(sendCloseTplCode);
                window.close();
                return false;
            });
        });	  
    </script>
@endsection



