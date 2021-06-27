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
                                    <th>주소지명/사용여부</th>
                                    <th>주소/전화번호</th>
                                    <th>택배사</th>
                                    <th>등록일</th>
                                    <th>승인상태</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($strMarketCode == "coupang")
                                    @foreach ($returnCenters as $returnCenters)
                                        <tr>    
                                            <td>
                                                <a href="javascript:void(0);" 
                                                    data-code="{{ $returnCenters['returnCenterCode'] }}" 
                                                    data-name="{{ $returnCenters['shippingPlaceName'] }}" 
                                                    data-contact="{{ $returnCenters['placeAddresses'][0]['companyContactNumber'] }}" 
                                                    data-zip="{{ $returnCenters['placeAddresses'][0]['returnZipCode'] }}" 
                                                    data-address="{{ $returnCenters['placeAddresses'][0]['returnAddress'] }}" 
                                                    data-detail="{{ $returnCenters['placeAddresses'][0]['returnAddressDetail'] }}" 
                                                    class="btn btn-primary btn-xs btnSetReturnShippingCenter">
                                                    <span style="font-size:10px;">{{ $returnCenters['shippingPlaceName'] }}</span>
                                                </a>
                                            </td>
                                            <td>[{{ $returnCenters['placeAddresses'][0]['addressType'] }}]
                                                [{{ $returnCenters['placeAddresses'][0]['returnZipCode'] }}]
                                                {{ $returnCenters['placeAddresses'][0]['returnAddress'] }}
                                                <br>
                                                {{ $returnCenters['placeAddresses'][0]['returnAddressDetail'] }}
                                                <br>
                                                {{ $returnCenters['placeAddresses'][0]['companyContactNumber'] }}
                                                <br>
                                                {{ $returnCenters['placeAddresses'][0]['phoneNumber2'] }}
                                            </td>
                                            <td>{{ $returnCenters['deliverName'] }}</td>
                                            <td>{{ date("Y-m-d", $returnCenters['createdAt'] / 1000) }}</td>
                                            <td>{{ $returnCenters['goodsflowStatus'] }}</td>
                                        </tr>
                                    @endforeach
                                @elseif($strMarketCode == "11thhouse")
                                    @foreach ($returnCenters as $returnCenters)
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0);" 
                                                data-code="{{ $returnCenters['memNo'] }}" 
                                                data-name="" 
                                                data-contact="" 
                                                data-zip="" 
                                                data-address="" 
                                                data-detail="" 
                                                class="btn btn-primary btn-xs btnSetReturnShippingCenter">
                                                <span style="font-size:10px;">{{ $returnCenters['addrNm'] }}</span>
                                            </a>
                                        </td>
                                        <td>{{ $returnCenters['addr'] }}
                                            <br>
                                            {{ $returnCenters['gnrlTlphnNo'] }}
                                            <br>
                                            {{ $returnCenters['prtblTlphnNo'] }}
                                            
                                        </td>
                                        <td>{{ $returnCenters['rcvrNm'] }}</td>
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

            $('body').on('click', '.btnSetReturnShippingCenter', function () {
                returnCode = $(this).attr('data-code');
                returnName = $(this).attr('data-name');
                returnContact = $(this).attr('data-contact');
                returnZip = $(this).attr('data-zip');
                returnAddress = $(this).attr('data-address');
                returnDetail = $(this).attr('data-detail');
                if(returnCode == "0"){
                    return false;
                }
                opener.SetReturnShippingCenter(returnCode, returnName, returnContact, returnZip, returnAddress, returnDetail);
                window.close();
                return false;
            });
        });	  
    </script>
@endsection



