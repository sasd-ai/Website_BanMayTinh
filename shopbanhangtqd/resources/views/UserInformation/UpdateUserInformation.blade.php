<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin khách hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .row {
            margin-top: 20px;
        }

        #formUpdate {
            width: 600px;
            padding: 20px;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .text-center {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container" id="formUpdate">
    <form method="POST" action="{{ route('user.updateInformation') }}">
        @csrf

        <h4 class="text-center">Cập nhật thông tin khách hàng</h4>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="TenKH">Tên khách hàng</label>
                  
                    <input id="TenKH" type="text" class="form-control" name="TenKH" placeholder="Tên khách hàng" value="{{ old('TenKH', $user->TenKH) }}">
                    @if ($errors->has('TenKH'))
                        <span class="text-danger">{{ $errors->first('TenKH') }}</span>
                    @endif
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="SDT">Số điện thoại</label>
                    <input id="SDT" type="text" class="form-control" name="SDT" placeholder="Số điện thoại" value="{{ old('SDT', $user->SDT) }}">
                    @if ($errors->has('SDT'))
                        <span class="text-danger">{{ $errors->first('SDT') }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-success" style="margin-top: 30px;">Cập nhật</button>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>