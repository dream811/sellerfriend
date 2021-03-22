@extends('layouts.window')
@section('content')
<form id="userForm" method="post" action="{{ route('admin.user.UserManage.Save') }}" enctype="multipart/form-data"> 
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="font-size:16px; font-weight:700;">유저 {{ $title }}</h1>
            </div><!-- /.col -->
            
                <div style="position: fixed; z-index: 99; padding: 4px; right: 20px; background-color: lightgray; border-radius: 0.5rem;">
                    <button type="submit" class="btn btn-primary btn-xs btnSave">설정저장</button>
                    <button type="button" class="btn bg-indigo btn-xs btnClose">닫기</button>
                </div>
            </div><!-- /.col -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title text-sm">계정정보</h3>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="userId" id="userId" value="{{$userId}}">
                            <div class="form-group row mb-0" id="divVendorId">
                                <label for="divPrevImage" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label" style="font-size:12px;">이미지</label>
                                <div class="col-sm-10">
                                    <div class="bg-gray border border-danger" style="height: 100px;width: 100px;" name="divPrevImage" id="divPrevImage">
                                        <img name="imgPreview" id="imgPreview" @if($user->image != "") src="{{asset('storage/'.$user->image)}}" @else src="https://via.placeholder.com/300/FFFFFF?text=%20" @endif style="width:100%; height:100%;" alt="">
                                        <input type="hidden" name="beforeImage" id="beforeImage" value="{{$user->image}}">
                                    </div>
                                    <input type="file" name="fileImage" id="fileImage" style="opacity: 0;">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtName" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">이름<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtName" name="txtName" value="{{ $user->name }}" placeholder="이름을 입력하세요">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtID" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">아이디<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtID" name="txtID" value="{{ $user->strID }}" placeholder="아이디는 8~12자리를 입력하세요">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtPWD1" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">비번<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="password" class="form-control form-control-sm" id="txtPWD1" name="txtPWD1" value="" placeholder="특수문자를 포함하여 16자리이상 입력하세요">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtPWD2" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">비번확인<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="password" class="form-control form-control-sm" id="txtPWD2" name="txtPWD2" value="" placeholder="비번을 확인하세요">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtEmail" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">메일<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="email" class="form-control form-control-sm" id="txtEmail" name="txtEmail" value="{{ $user->email }}" placeholder="메일을 입력하세요">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtPhone" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">휴대폰<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="tel" class="form-control form-control-sm" id="txtPhone" name="txtPhone" value="{{ $user->phone_number }}" placeholder="휴대폰번호를 입력하세요">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtMoney" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">예치금<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="number" class="form-control form-control-sm" id="txtMoney" name="txtMoney" value="{{ $user->money }}" placeholder="예치금액을 입력하세요">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="selRole" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">역할<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                    <select class="custom-select form-control-border custom-select-sm" name="selRole" id="selRole">
                                        <option value="">= 선택 =</option>
                                        <option value="ADMIN" @if ( "ADMIN" == $user->role) selected @endif>관리팀</option>
                                        <option value="SELLER" @if ( "SELLER" == $user->role) selected @endif>판매팀</option>
                                        <option value="BUYER" @if ( "BUYER" == $user->role) selected @endif>구매팀</option>
                                        <option value="SHIPPER" @if ( "USER" == $user->role) selected @endif>배송팀</option>
                                        <option value="USER" @if ( "USER" == $user->role) selected @endif>사용자</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">사용상태<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6 mt-1">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" id="rdoIsUsed1" name="rdoIsUsed" value="1" @if( $user->bIsUsed ) checked @endif>
                                        <label for="rdoIsUsed1" class="custom-control-label pt-1" style="font-size:12px;" >사용함</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="custom-control-input" type="radio" id="rdoIsUsed2" name="rdoIsUsed" value="0" @if( !$user->bIsUsed ) checked @endif>
                                        <label for="rdoIsUsed2" class="custom-control-label pt-1" style="font-size:12px;">사용안함</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row mb-0">
                                <label for="txtBusinessName" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">업체명<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtBusinessName" name="txtBusinessName" value="{{ $user->business_name }}" placeholder="업체명을 입력하세요">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtBusinessNumber" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">사업자등록번호<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtBusinessNumber" name="txtBusinessNumber" value="{{ $user->business_number }}" placeholder="예)123-12-12312">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtBusinessPhone" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">업체전화번호<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtBusinessPhone" name="txtBusinessPhone" value="{{ $user->business_phone }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtBusinessType" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">업태<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtBusinessType" name="txtBusinessType" value="{{ $user->business_type }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtBusinessKind" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">업종<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtBusinessKind" name="txtBusinessKind" value="{{ $user->business_kind }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtBusinessZip" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">우편번호<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtBusinessZip" name="txtBusinessZip" value="{{ $user->business_zip }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtBusinessAddress1" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label">업체주소<code style="color:red !important;">[필수]</code></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtBusinessAddress1" name="txtBusinessAddress1" value="{{ $user->business_address1 }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <label for="txtBusinessAddress2" class="text-left text-sm-right col-sm-3 col-md-2 col-form-label"></label>
                                <div class="col-sm-9 col-md-6">
                                <input type="text" class="form-control form-control-sm" id="txtBusinessAddress2" name="txtBusinessAddress2" value="{{ $user->business_address2 }}" placeholder="">
                                </div>
                            </div>
                        </div>    
                    
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('script')    
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#divPrevImage').on('click', function (e) {
                $('#fileImage').trigger('click'); 
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imgPreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]); // convert to base64 string
                }
            }

            $("#fileImage").change(function() {
                readURL(this);
            });
            
            //설정 보관
            // $('body').on('click', '.btnSave', function () {
            $('#userForm').submit(function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                var txtName = $("#txtName").val();
                if(txtName == ""){
                    alert('이름을 입력해주세요!');
                    return false;
                }
                var txtID = $("#txtID").val();
                if(txtID == ""){
                    alert('아이디를 입력해주세요!');
                    return false;
                }
                var txtEmail = $("#txtEmail").val();
                if(txtEmail == ""){
                    alert('메일주소를 입력해주세요!');
                    return false;
                }
                
                
                var txtPWD1 = $("#txtPWD1").val();
                if(txtPWD1 == ""){
                    alert('비번을 입력해주세요!');
                    return false;
                }
                if(txtPWD1.length < 8){
                    alert('수자, 문자, 특수문자를 포함해서 8자이상이여야 합니다!');
                    return false;
                }
                var txtPWD2 = $("#txtPWD1").val();
                if(txtPWD1 != txtPWD2){
                    alert('비번이 일치하지 않습니다!');
                    return false;
                }

                var txtPhone = $("#txtPhone").val();
                if(txtPhone == ""){
                    alert('휴대폰번호를 입력해주세요!');
                    return false;
                }
                var txtMoney = $("#txtMoney").val();
                if(txtMoney == ""){
                    alert('예치금을 입력해주세요!');
                    return false;
                }
                var selRole = $("#selRole option:selected").val();
                if(selRole == ""){
                    alert('역할을 선택해주세요!');
                    return false;
                }

                var rdoIsUsed = $("input[name='rdoIsUsed']:checked").val();
                if(rdoIsUsed == undefined){
                    alert('사용상태를 선택해주세요!');
                    return false;
                }
                var txtBusinessName = $("#txtBusinessName").val();
                if(txtBusinessName == ""){
                    alert('업체명을 입력해주세요!');
                    return false;
                }

                var txtBusinessNumber = $("#txtBusinessNumber").val();
                if(txtBusinessNumber == ""){
                    alert('사업자등록번호를 입력해주세요!');
                    return false;
                }
                var txtBusinessPhone = $("#txtBusinessPhone").val();
                if(txtBusinessPhone == ""){
                    alert('업체전화번호를 입력해주세요!');
                    return false;
                }

                var txtBusinessType = $("#txtBusinessType").val();
                if(txtBusinessType == ""){
                    alert('업태를 입력해주세요!');
                    return false;
                }
                var txtBusinessKind = $("#txtBusinessKind").val();
                if(txtBusinessKind == ""){
                    alert('업종을 입력해주세요!');
                    return false;
                }
                var txtBusinessZip = $("#txtBusinessZip").val();
                if(txtBusinessZip == ""){
                    alert('우편번호를 입력해주세요!');
                    return false;
                }

                var txtBusinessAddress1 = $("#txtBusinessAddress1").val();
                if(txtBusinessAddress1 == ""){
                    alert('업체주소를 입력해주세요!');
                    return false;
                }
                var userId = $("#userId").val();
                var action ="/admin/user/userManage/checkIDEmail";
                $.ajax({
                    url: action,
                    data: {userId, txtID, txtEmail},
                    type: "GET",
                    dataType: "json",
                    success: function({status, data}){
                        console.log(data);
                        if(status == "success"){
                            if(data.id == 0){
                                alert("이미 등록된 아이디입니다.");
                                return false;
                            }
                            if(data.email == 0){
                                alert("이미 등록된 메일주소입니다.");
                                return false;
                            }
                            if(data.id == 1 && data.email == 1){
                                
                                action = "/admin/user/userManage";
                                //formData.submit();
                                $.ajax({
                                    url: action,
                                    data: formData,
                                    type: "POST",
                                    dataType: 'JSON',
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success: function ({status, data}) {
                                        if(status="success"){
                                            alert("성공적으로 등록되였습니다");
                                            $('#beforeImage').val(data.image);
                                            //window.close();
                                        }
                                    },
                                    error: function (data) {
                                    }
                                });
                            }
                        }
                    }
                });
                
            });
            
            $('.btnClose').on('click', function (e) {
                window.close();
            });
        });	  
    </script>
@endsection

