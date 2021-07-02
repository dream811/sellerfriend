@extends('layouts.window')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">상품등록 결과</h1>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container">
      <div class="card card-primary card-outline">
        <div class="row m-2">
          @foreach ( $uploadResults as $result)
            <div class="col-md-4 col-sm-6 col-12">
              <div class="info-box @if($result['allProduct'] == $result['successProduct']) bg-gradient-success @elseif( $result['successProduct'] > 0 ) bg-gradient-warning @else bg-gradient-danger @endif ">
                <span class="info-box-icon"><i class=" @if($result['allProduct'] == $result['successProduct'])far fa-thumbs-up @elseif( $result['successProduct'] > 0 ) icon fas fa-exclamation-triangle @else far fa-thumbs-down @endif"></i></span>

                <div class="info-box-content">
                  <span class="info-box-number text-sm">마 켓 : {{$result['marketName']}}</span>
                  <span class="info-box-text text-sm">아이디: {{$result['marketAccount']}}</span>

                  <div class="progress">
                    <div class="progress-bar" style="width: {{ number_format($result['successProduct']/$result['allProduct']*100) }}%"></div>
                  </div>
                  <span class="progress-description">
                    {{$result['allProduct']}} 개중 {{$result['successProduct']}} 개 등록 성공 {{$result['failedProduct']}} 개 실패
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          @endforeach
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
                // Get all rows with search applied
                // Check/uncheck checkboxes for all rows in the table
                //$('input[type="checkbox"]').prop('checked', this.checked);
            });
            // $('#marketAccountTable tbody').on('change', 'input[type="checkbox"]', function(){
            //     if(!this.checked){
            //         var el = $('#select_all');
            //         // If Select all" control is checked and has 'indeterminate' property
            //         if(el && el.checked){
            //             //el.checked = false;
            //         }
            //     }
            // });
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
                $( "#manageMarketAccount" ).submit();
            });
        });	  
    </script>
@endsection

