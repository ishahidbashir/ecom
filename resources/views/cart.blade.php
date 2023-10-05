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
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white px-3">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse px-5" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-item nav-link active" href="#">Home </span></a>
                <a class="nav-item nav-link" href="#">Features</a>
                <a class="nav-item nav-link" href="#">Pricing</a>
                <a class="nav-item nav-link" href="#">Disabled</a>
            </div>
        </div>

        <a href="/logout" class="btn btn-primary  rounded">Logout</a>
        <a href="/welcome" class="btn btn-warning mx-2 py-2 fas fa-arrow-left rounded"></a>
    </nav>
    <a href="/orderNow" class="btn btn-warning mx-2 py-2  rounded" style="right:51px;bottom:54px;position:fixed;">Order
        Now</a>
    <div class="d-flex" style="position: absolute;flex-wrap: wrap;">
        @foreach ($products as $product)
            <div class='proDiv rounded'>
                <div class="card mx-auto col-md-4 ">
                    <div class="imagediv" style="width:255px;overflow:hidden;">
                        @if ($product->image_path)
                            <img class='mx-auto' id='imgP' src="{{ asset('storage/' . $product->image_path) }}"
                                width="255" height="200" />
                        @else
                            No Image
                        @endif
                    </div>
                    <div class="card-body text-center mx-auto">
                        <div class='cvp'>
                            <h6 class="card-title font-weight-bold">{{ $product->name }}</h6>
                            <p class="">Rs {{ $product->price }}</p>
                            <p class="">Quantity {{ $product->quantity }}</p>
                            {{-- <input type="number" value="1" min="1" style="width: 20%"> --}}
                            <a href="/remove-from-cart/{{ $product->cart_id }}" type="submit"
                                class="btn-sm btn-secondary rounded px-auto">Remove From Cart</a>

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</body>

</html>
