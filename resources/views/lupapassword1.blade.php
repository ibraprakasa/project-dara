<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DARA</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-icons-1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="dara-touch-icon" sizes="120x120" href="../assets/img/daraicon.png">
    <link rel="icon" type="image/png" href="../assets/img/daraicon.png">
</head>

<body>
    <div class="global-container"><br>
        <div class="card login-form"">
        <div class=" icon-text">
            <img src="../assets/img/daraicon.png" class="iconjudul" alt="">
            <div class="titledesc">
                <h2 class="title">
                    DARA (DARAH RELAWAN)
                </h2>
                <p class="slogan">
                    Setetes Darah Akan Sangat Berarti
                </p>
            </div>
        </div>
        <div style="clear: both;"></div>
        <hr class="line">

        @if (session('error'))
        <div class="alert alert-danger">
            <b>Opps!</b> {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('lupapassword1.post') }}" method="POST">
            @csrf

            <p class="lupapassword-title">
                Kode OTP akan segera dikirimkan ke alamat email yang terdaftar di akun Anda. Silakan cek kotak masuk email Anda dalam beberapa saat.
            </p>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required autofocus oninvalid="this.setCustomValidity('Masukkan email Anda.')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group button-container">
                        <button type="submit" class="btn btn-danger"><i style="font-size: 15px;" class="bi bi-arrow-right-square"></i></button>
                    </div>
                </div>
            </div>

            <hr>

            <div class="text-center logopmi">
                <img src="../assets/img/logopmi.png" alt="">
            </div>
        </form>
    </div>
</body>

</html>