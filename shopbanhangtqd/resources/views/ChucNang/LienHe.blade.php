<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width=device-width" />
    <link rel="icon" href="{{ asset('Image/Icon/logo.jpg') }}" type="image/x-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/e21d90a16d.js" crossorigin="anonymous"></script>
    <script src="~/Scripts//jquery-3.7.1.js"></script>
    <script src="~/Scripts/jquery.validate.js"></script>
    <script src="~/Scripts/jquery.validate.unobtrusive.js"></script>

</head>
<style>
    #Form_LienHe {
        width: 600px;
        margin: 0 auto;
    }

        #Form_LienHe h4 {
            text-align: center !important;
        }

        #Form_LienHe form {
            padding: 35px;
            /*box-shadow: rgba(47, 165, 255, 0.6) 0px 10px 20px, rgba(47, 165, 255, 0.7) 0px 6px 6px;*/
        }

    input.label {
        width: 530px;
    }

    .title {
        text-align: center !important;
        padding-left: 10px;
    }

    form h4 {
        color: red;
    }

    button[type="submit"] {
        display: block;
        margin: 0 auto;
        width: 180px !important;
        text-align: center !important;
    }
</style>


    <!-- Headerd -->
    @include('Shared/Header')
    

    <div id="Form_LienHe">

<div>
        <h4>CONTACT</h4>
        <div class="mb-3 ">
            <label for="Name" class="form-label">Họ Và Tên<strong style="color:red">*</strong></label>
            <input name="Name" type="text" class="form-control label" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 ">
            <label for="SDT" class="form-label">Điện Thoại<strong style="color:red">*</strong></label>
            <input name="SDT" type="text" class="form-control lable" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3 ">
            <label for="Email" class="form-label">Email address<strong style="color:red">*</strong></label>
            <input name="Email" type="email" class="form-control lable" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="NoiDung" class="form-label">Nhập nội dung<strong style="color:red">*</strong></label>
            <textarea name="NoiDung" style="width:530px;height:120px;" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

</div>
<div class="title " style="margin-top: 0px;">
    <p>
        Chúng tôi mong muốn lắng nghe ý kiến của quý khách.Vui lòng gửi mọi yêu cầu,
        thắc mắc theo thông tin bên dưới, chúng tôi sẽ liên lạc với bạn sớm nhất có thể.
    </p>
</div>
</div>
    @include('Shared/Footer')

