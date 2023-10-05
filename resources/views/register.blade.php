<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<style>
    span{
    font-size: 10px;
    color: red;
    margin: 0px;
    font-weight: bold;
}
</style>

<body>
    <div class="wrapper">
        <div class="logo">
            <img src="{{ asset('logo.jpeg') }}" alt="">

        </div>
        <form method='post' action="{{ url('save-user') }}" class="p-3 mt-3">
            @csrf
            <div class="form-field d-flex align-items-center"  style="margin-bottom:10px;">
                {{-- <span class="far fa-user"></span> --}}
                <input type="text" name="userName" id="userName" placeholder="Enter Your Name">
                
            </div>
            @error('userName')
                    <span class="text-red-300">{{ $message }}</span>
                @enderror
            <div class="form-field d-flex align-items-center" style="margin-bottom:10px;">
                {{-- <span class="far fa-mail"></span> --}}
                <input type="email" name="Email" id="Email" placeholder="Enter Your Email">
                
            </div>
            @error('Email')
                    <span class="text-red-300">{{ $message }}</span>
                @enderror
            <div class="form-field d-flex align-items-center"  style="margin-bottom:10px;">
                {{-- <span class="fas fa-key"></span> --}}
                <input type="password" name="password" id="pwd" placeholder="Password">
            </div>
            @error('password')
                <span class="text-red-300">{{ $message }}</span>
                @enderror
            <button class="btn mt-3">Register</button>
        </form>
        <div class="text-center fs-6">
            {{-- <a href="#">Forget password?</a> or  --}}
            <a href="{{ url('/') }}">Login</a>
        </div>
    </div>
</body>

</html>
