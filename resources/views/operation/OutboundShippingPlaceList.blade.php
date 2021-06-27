@extends('layouts.window')
@section('content')
<div class="content-header " >
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0" style="font-size:20px; font-weight:700;">출고지</h1>
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
                <form id="manageMarketAccount" method="post" action="{{ route('product.MarketAccountList') }}"> 
                    @csrf
                    <div class="card-body table-responsive p-0" style="height:500px;">
                        <table id="outboundShippingPlaceTable" class="table table-striped projects text-xs" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>주소지명/사용여부</th>
                                    <th>주소/전화번호</th>
                                    <th>택배사</th>
                                    <th>등록일</th>
                                    <th>승인상태</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if( $strMarketCode == "coupang" )
                                    @foreach ($outbouds as $outboud)
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0);" data-code="{{ $outboud['outboundShippingPlaceCode'] }}" class="btn btn-primary btn-xs btnSetOutboundShippingPlace">
                                                    <span style="font-size:10px;">{{ $outboud['shippingPlaceName'] }}</span>
                                                </a>
                                            </td>
                                            <td>[{{ $outboud['placeAddresses'][0]['addressType'] }}]
                                                [{{ $outboud['placeAddresses'][0]['returnZipCode'] }}]
                                                {{ $outboud['placeAddresses'][0]['returnAddress'] }}
                                                <br>
                                                {{ $outboud['placeAddresses'][0]['returnAddressDetail'] }}
                                                <br>
                                                {{ $outboud['placeAddresses'][0]['companyContactNumber'] }}
                                                <br>
                                                {{ $outboud['placeAddresses'][0]['phoneNumber2'] }}
                                            </td>
                                            <td></td>
                                            <td>{{ $outboud['createDate'] }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                @elseif( $strMarketCode == "11thhouse" )
                                    @foreach ($outbouds as $outboud)
                                        <tr>
                                            <td>
                                                <a href="javascript:void(0);" data-code="{{ $outboud['memNo'] }}" class="btn btn-primary btn-xs btnSetOutboundShippingPlace">
                                                    <span style="font-size:10px;">{{ $outboud['addrNm'] }}</span>
                                                </a>
                                            </td>
                                            <td>{{ $outboud['addr'] }}
                                                <br>
                                                {{ $outboud['gnrlTlphnNo']}}
                                                <br>
                                                {{ $outboud['memNo'] }}
                                                <br>
                                                {{ $outboud['prtblTlphnNo']}}
                                            </td>
                                            <td>{{ $outboud['rcvrNm'] }}</td>
                                            <td></td>
                                            <td></td>
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

            $('body').on('click', '.btnSetOutboundShippingPlace', function () {
                    
                    outboundCode = $(this).attr('data-code');
                    if(outboundCode == "0"){
                        return false;
                    }
                    
                    opener.SetOutboundShippingPlace(outboundCode);
                    window.close();
                    return false;
                });
        });	  
    </script>
@endsection



