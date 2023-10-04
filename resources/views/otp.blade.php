<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit OTP</title>
</head>
<body>
    <h1>Submit OTP</h1>
    <p>Silakan masukkan kode OTP yang telah kami kirimkan ke email Anda.</p>
    
    <form method="POST" action="{{ route('password.reset.otp') }}">
        @csrf
        <div class="form-group">
            <label for="otp">Kode OTP:</label>
            <input type="text" id="otp" name="otp" required>
        </div>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
