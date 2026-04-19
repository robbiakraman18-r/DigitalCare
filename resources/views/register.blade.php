<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/style_lolly.css') }}">
    <script src="{{ asset('js/script_lolly.js') }}"></script>
    <title>Register</title>
    <style>
    body {
        background-image: url("{{ asset('images/polibatam.jpg') }}");
        background-size: cover;
        background-position: center;
        height: 100vh;
    }
</style>
</head>
<body>

<div class="register-box">
     <img src="{{ asset('images/logo.jpg') }}" class="logo">
    <h2>DigitalCare Polibatam</h2>
    <form>
        <input type="text" placeholder="Nama" required><br><br>
        <input type="email" placeholder="Email" required><br><br>
        <input type="password" placeholder="Password" required><br><br>
<div class="password-box">
    <input type="password" id="password" placeholder="Password" required>
    <span class="toggle-password" onclick="togglePassword()">👁️</span>
</div>
<div class="button-group">
    <button type="submit" class="submit-box">Submit</button>
    <button type="button" class="cancel-box" onclick="window.location.href='{{ url('/') }}'">Cancel</button>
</div>
    </form>
</div>

</body>
</html>