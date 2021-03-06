@extends('backend.pages.master')

@section('header')
@parent
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
 

    body {
        font-family: 'Muli', sans-serif;
    }

    .white-box label {
        font-weight: bold;
    }

    ul.theLoai {
        border-left: 0.5px solid black;
    }
</style>
@endsection
{{-- {{$html}} --}}

@section('noi-dung')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row bg-title">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h4 class="page-title">Nhan Vien</h4>
            </div>
        </div>

        <div class="white-box">
            <form id="nhanvienForm" action="{{route('nhanvien.store')}}" method="post">
                @csrf
                {{-- Nhap ten Nhan Vien --}}
                <div>
                    <label for="hoTen">Họ và tên</label>
                    <input type="text" class="form-control" required name="hoTen" id="hoTen"
                        placeholder="Tối đa 50 kí tự">
                </div>
                
                <div style="display: flex;">

                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="namSinh">Chức vụ</label>
                    <input type="text" class="form-control"  name="chucVu" id="chucVu"
                    placeholder="Tối đa 30 kí tự">
                </div>
                


                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="namSinh">Năm sinh</label>
                    <input type="text" class="form-control"  name="namSinh" id="namSinh"
                    placeholder="Năm sinh">
                </div>

                
            
                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="namMat">CMND</label>
                    <input type="text" class="form-control"  name="cmnd" id="cmnd"
                    placeholder="Tối đa 30 kí tự">
                </div>

                

                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="quocTich">Địa chỉ</label>
                    <input type="text" class="form-control"  name="diaChi" id="diaChi"
                    placeholder="Tối đa 50 kí tự">
                </div>


                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="quocTich">Số điện thoại</label>
                    <input type="text" class="form-control"  name="sdt" id="sdt"
                    placeholder="Tối đa 30 kí tự">
                </div>


                <div style="margin-top:2rem ;margin-right:1rem ;">
                    <label for="quocTich">Email</label>
                    <input type="text" class="form-control"  name="email" id="email"
                    placeholder="Tối đa 0 kí tự">
                </div>
            </div>

            <div class="text-center" style="margin-top: 5rem;">
                <!-- <input type="button" class="btn btn-primary" value="Lưu"> -->
                <button type="button" id="check" class="btn btn-primary">Lưu</button>
                <a href="{{route('nhanvien.index')}}"> <button type="button" class="btn btn-danger">Hủy</button></a>
            </div>


            </form>
        </div>
    </div>
</div>
@endsection

@section('footer')
@parent
<script>

    const urlPost='/admin/danhmuc/nhanvien';
    $("#check").click(function () {
        var hl = $("#nhanvienForm").valid();
        if (hl) {
            thucHienAjax($("#nhanvienForm"));
        }
    });

    $("#nhanvienForm").validate({
        onfocusout: function (element) {
            if ($(element).val() == "") return;
            var hl = $(element).valid();
            if (hl) {

                if ($(element).hasClass('is-invalid'))
                    $(element).removeClass("form-control is-invalid");
                $(element).addClass('form-control is-valid');
            }
        }, onkeyup: false,
        rules: {
            hoTen: {
                required: true,
                minlength: 7,
                maxlength: 50,
                
            },
            chucVu: {
                required: true,
                minlength: 3,
                maxlength: 30,
                
            },
            namSinh:{
                min:'1950',
                max: '2020',
                required:true
            },
            cmnd: {
                required: true,
                minlength: 6,
                maxlength: 30
            },
            diaChi: {
                required: true,
                minlength: 1,
                maxlength: 50
            },
            sdt: {
                required: true,
                minlength: 7,
                maxlength: 11
            },
           email:{
            required: true,
                minlength: 1,
                maxlength: 50
           },
        },
        messages: {
            hoTen: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 50 kí tự'
            },
            chucvu: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 3 kí tự',
                maxlength: 'Tối đa 30 kí tự'
            },
            namSinh:{
                min:'Năm sinh quá lâu, chém gió à',
                max: 'Năm sinh lớn hơn hiện tại, chém gió à',
                required:'Không được bỏ trống'
            },
            cmnd: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 6 kí tự',
                maxlength: 'Tối đa 30 kí tự'
            },
            diaChi:{
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 1 kí tự',
                maxlength: 'Tối đa 50 kí tự'
           },
            sdt: {
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 7 kí tự',
                maxlength: 'Tối đa 11 kí tự'
            },
            email:{
                required: 'Không được bỏ trống',
                minlength: 'Ít nhát 1 kí tự',
                maxlength: 'Tối đa 40 kí tự'
           },
        }, errorPlacement: function (err, elemet) {
        
        err.insertAfter(elemet);    
        err.addClass('invalid-feedback d-inline text-danger');
        elemet.addClass('form-control is-invalid');
        $('.focus-input100-1,.focus-input100-2').addClass('hidden');
    }
}
);
    function thucHienAjax(form) {
        var obj = {
            'hoTen': $("#hoTen").val(),
            'chucVu': $("#chucVu").val(),
            'namSinh': $("#namSinh").val(),
            'cmnd': $("#cmnd").val(),
            'diaChi': $("#diaChi").val(),
            'sdt': $("#sdt").val(),
            'email': $("#email").val(),
            'ID_Admin': 1,
            // 'theLoai': $('input[name=theLoai]:checked').val(),
        
        };
        // var obj = $("#nhanvienForm").serialize();
        console.log(obj);
        
        $.ajax({
            type: "post",
            url: urlPost,
            data: obj,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {

                if (response.yes === true) {

                   var now = new Date();
                    $("#hoTen").val("");
                    $("#chuVu").val("");
                    $("#namSinh").val("2020");
                    $("#cmnd").val("");
                    $("#diaChi").val("");
                    $("#sdt").val("");
                    $("#email").val("");
                    $("#ID_Admin").val("1");

                    alertify.success('Thêm nhân viên thành công');
                }
            }
        });
    }



</script>
@endsection