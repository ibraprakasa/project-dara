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
    <link rel="icon" type="image/x-icon" href="../assets/img/daraiconico.ico">
</head>

<body>
    <div class="global-container">
        <br>
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
        @elseif(session('success'))
        <div class="alert-container1 success">
            <div class="alert-icon">&#10004;</div> <!-- Ikon ceklis untuk sukses -->
            <div>
                {{ session('success') }}
                <i class="bi bi-emoji-smile"></i>
            </div>
        </div>
        @endif

        <form action="{{ route('loginaksi') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required="">
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required="">
            </div>
            
            <p style="margin-top:-15px" class="text-right">
                <a href="{{ route('lupapassword1') }}" style="color:red">
                    Lupa Password?
                </a>
            </p>
            <button type="submit" class="btn btn-block btn-danger">Masuk</button>

            <div class="text-center logopmi">
                <img src="../assets/img/logopmi.png" alt="">
            </div>
            
        </form>
    </div>
</body>

</html>