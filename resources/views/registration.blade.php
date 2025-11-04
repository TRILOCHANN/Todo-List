<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration & Login | Bootstrap</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom Styles for Centering and Aesthetics -->
    <style>
        body {
            background: linear-gradient(135deg, #71b7e6, #9b59b6);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
        }
        .auth-card {
            max-width: 450px;
            width: 90%;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            background: white;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(155, 89, 182, 0.25);
            border-color: #9b59b6;
        }
        .btn-primary {
            background-color: #9b59b6;
            border-color: #9b59b6;
            font-weight: bold;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #8e44ad;
            border-color: #8e44ad;
        }
        .form-switch .form-check-input {
            width: 3.5em;
            height: 1.5em;
            background-color: #ccc;
            border-color: #ccc;
        }
        /* START: Changes to default for Registration view */
        .form-switch .form-check-input:not(:checked) {
            /* Switch color when Register is active (i.e., checkbox is unchecked initially) */
            background-color: #71b7e6;
            border-color: #71b7e6;
        }
        .form-switch .form-check-input:checked {
            /* Switch color when Login is active (i.e., checkbox is checked) */
            background-color: #ccc;
            border-color: #ccc;
        }
        /* END: Changes to default for Registration view */
        .form-check-label {
            font-weight: 500;
        }
        /* Style for the active title */
        #form-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #9b59b6;
            margin-bottom: 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="auth-card">
        
        <!-- Initial title is Register -->
        <h2 id="form-title">Register</h2>
        <!-- Registration Form (Starts visible) -->
        <form method="POST" action="{{route('reg.store')}}" id="registrationForm">
            @csrf
            <div class="mb-3">
                <label for="regName" class="form-label">Name</label>
                <input type="text" class="form-control" value="{{old('name')}}" @error('name')is-invalide @enderror name="name" id="regName" placeholder="Your full name" >
               <span class="text-danger small">
                 @error('name')
                    {{$message}}
                @enderror
               </span>
            </div>
            <div class="mb-3">
                <label for="regEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" value="{{old('email')}}" @error('email')is-invalide @enderror name="email" id="regEmail" placeholder="name@example.com" >
                <span class="text-danger small">
                 @error('email')
                    {{$message}}
                @enderror
               </span>
            </div>
            <div class="mb-3">
                <label for="regPassword" class="form-label">Password</label>
                <input type="password" class="form-control" value="{{old('password')}}"   name="password" @error('password')is-invalide @enderror id="regPassword" placeholder="Minimum 6 characters">
                <span class="text-danger small">
                 @error('password')
                    {{$message}}
                @enderror
               </span>
            </div>
            <div class="mb-4">
                <label for="regConfirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" value="{{old('password')}}" name="password_confirmation" @error('password') is-invalide @enderror id="regConfirmPassword" placeholder="Re-enter password" >
                <span class="text-danger small">
                 @error('password')
                    {{$message}}
                @enderror
               </span>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Create Account</button>
            </div>
        </form>
        <div class="mt-3 text-center ">
            Have already an account?
            <a href="{{route('loginform')}}"  >Login here</a>
        </div>
        <!-- Message Box for Alerts (Replaces alert() function) -->
        <div id="messageBox" class="alert mt-4 p-3 text-center" role="alert" style="display:none;"></div>

    </div>

    <!-- Bootstrap JS CDN (Bundle includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
