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

        @if (session('otp'))
        <div class="alert alert-danger">
            <b>Opps!</b> {{ session('otp') }}
        </div>
        @endif

        <form action="{{ route('lupapassword2.post') }}" method="POST">
            @csrf

            <p style="text-align:center; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">
                Kami telah mengirimkan kode OTP ke email Anda. Masukkan 4 digit kode OTP yang telah dikirim.
            </p>

            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="text" id="otpInput" name="otp" class="form-control" placeholder="Kode OTP Anda" required autofocus oninvalid="this.setCustomValidity('Masukkan kode OTP yang telah dikirim ke alamat email Anda')" oninput="this.setCustomValidity('')">
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group button-container">
                        <button type="submit" class="btn btn-danger"><i style="font-size: 15px;" class="bi bi-arrow-right-square"></i></button>
                    </div>
                </div>
            </div>

            <hr style="margin-top:0;margin-bottom:0">

            <div class="text-center logopmi">
                <img src="../assets/img/logopmi.png" alt="">
            </div>
        </form>
    </div>
</body>

</html>

<script>
document.getElementById("otpInput").addEventListener("input", function() {
  let inputValue = this.value;
  
  // Hapus karakter yang bukan angka
  inputValue = inputValue.replace(/\D/g, "");

  // Batasi input menjadi 4 karakter
  if (inputValue.length > 4) {
    inputValue = inputValue.slice(0, 4);
  }

  // Update nilai input
  this.value = inputValue;
});
</script>