<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration | Bootstrap</title>
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
            /* Padding is no longer necessary as the alert is in the corner */
            /* padding-top: 60px; */ 
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
        .form-switch .form-check-input:checked {
            background-color: #71b7e6;
            border-color: #71b7e6;
        }
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
        
        /* Style for the session alert - MOVED TO TOP-RIGHT */
        .session-alert-container {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem; /* CHANGED to place in the top-right corner */
            width: auto; /* Set to auto width */
            max-width: 350px; /* Added max-width */
            z-index: 1050;
        }

        /* --- STYLES FOR PROGRESS LINE (CLEANER) --- */

        /* Make room for the progress bar */
        #session-success-alert {
            position: relative;
            /* padding-bottom: 20px; */ /* REMOVED extra padding */
            overflow: hidden; /* Good for containing pseudo-elements */
        }

        /* The actual animated line using a pseudo-element */
        #session-success-alert::after { /* CHANGED to pseudo-element */
            content: '';
            position: absolute;
            bottom: 0; /* Position at the very bottom */
            left: 0;
            height: 4px; /* Height of the line */
            width: 100%;
            background-color: #0f5132; /* Darker success green */
            /* This animation shrinks the bar from 100% to 0% over 5s */
            animation: progress-shrink 5s linear forwards;
        }

        /* Keyframes for the animation (re-used) */
        @keyframes progress-shrink {
            from {
                width: 100%;
            }
            to {
                width: 0%;
            }
        }
        /* --- END OF NEW STYLES --- */

    </style>
</head>
<body>

    <!-- Container for the Success Message -->
    <div class="session-alert-container">
        <!-- Check if a 'success' session message exists (from Laravel/backend) -->
        @if (session()->has('success'))
            <!-- Added id="session-success-alert" to target with JS -->
            <div id="session-success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="auth-card">

        <h2 id="form-title">Login</h2>

        <!-- Login Form -->
        <form action="{{ route('loginMatch')}}" method="POST" id="loginForm">
            @csrf
            <div class="mb-3">
                <label for="loginEmail" class="form-label">Email address</label>
                <input type="email" name="email" value="{{old('email')}}"  class="form-control" @error('email')is-invalid @enderror id="loginEmail" placeholder="name@example.com" >
                <span class="text-danger small">
                 @error('email')
                     {{$message}}
                @enderror
               </span>
            </div>
            <div class="mb-4">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="loginPassword" @error('password')is-invalid @enderror placeholder="Minimum 6 characters" >
                <span class="text-danger small">
                 @error('password')
                     {{$message}}
                @enderror
               </span>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Sign In</button>
            </div>
        </form>
        <div class="mt-3 text-center ">
            Don't have an account?
            <a href="{{route('registerform')}}">Register</a>

        </div>
        <!-- Message Box for Alerts (Replaces alert() function) -->
        <div id="messageBox" class="alert mt-4 p-3 text-center" role="alert" style="display:none;">
            
        </div>

    </div>
    
    <!-- Bootstrap JS CDN (Bundle includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" xintegrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom JS for 5-second auto-dismiss -->
    <script>
        // Wait for the document to be fully loaded
        document.addEventListener('DOMContentLoaded', (event) => {
            // Find the success alert by its new ID
            const successAlert = document.getElementById('session-success-alert');
            
            if (successAlert) {
                // Wait 5 seconds (5000 milliseconds)
                setTimeout(() => {
                    // Check if Bootstrap is available before trying to instantiate Alert
                    if (typeof bootstrap !== 'undefined' && bootstrap.Alert) {
                        // Create a Bootstrap Alert instance to use the 'close' method
                        const bsAlert = new bootstrap.Alert(successAlert);
                        bsAlert.close();
                    } else {
                        // Fallback: If Bootstrap JS didn't load, just hide it with CSS
                        successAlert.style.display = 'none';
                    }
                }, 5000);
            }
        });
    </script>
</body>
</html>
