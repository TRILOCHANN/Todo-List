<!DOCTYPE html>
<html>
<head>
    <title>Verify Email</title>
</head>
<body>
    <h2>Verify Your Email Address</h2>

    @if (session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    <p>Before proceeding, please check your email for a verification link.</p>

    <form method="POST" action="{{ route('verification.send')}}">
        @csrf
        <button type="submit">Resend Verification Email</button>
    </form>
</body>
</html>
