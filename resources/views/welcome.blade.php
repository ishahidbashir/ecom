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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-dT6P0F20f5OAG9f3+brfNpf7z00q4z5l5W5ugRs5ljz0S3csPvhW6p7Y2E8Cc3Qr8Oev5kN4tj5rj2I6SIs6Gw=="
        crossorigin="anonymous" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        @if (session('user_role') == 1)
            <a class=" mx-1 rounded" style="width:11%;" id="productForm">Add Product</a>
            <a href="/logout" class="btn btn-primary mx-1 rounded">Logout</a>
        @else
            <a href="/cartView" class="btn btn-warning py-2  fas fa-shopping-cart rounded">Cart[{{ $count }}]</a>
            <a href="/logout" class="btn btn-primary mx-1 rounded">Logout</a>
        @endif


    </nav>
    {{-- ******************    NAVBAR ENDS HERE      *********************** --}}

    {{-- ******************    NAVBAR ENDS HERE  AND PRODUCTS DIV BEGINS  *********************** --}}
    <div class="d-flex " style="position: absolute;flex-wrap: wrap;">
        @foreach ($products as $product)
            <div class='proDiv'>
                <div class="card mx-auto col-md-4 " style="padding-bottom: 0px;">
                    <div class="imagediv mx-auto" style="width:257px;overflow:hidden;">
                        @if ($product->image_path)
                            <img class='mx-auto ' id="imgP" src="{{ asset('storage/' . $product->image_path) }}"
                                width="257" height="200" />
                        @else
                            No Image
                        @endif
                    </div>
                    <div class="card-body text-center mx-auto">
                        <div class='cvp'>
                            <h6 class="card-title font-weight-bold">{{ $product->name }}</h6>
                            <p class="card-text">Rs {{ $product->price }}</p>
                            <form action="/add-to-cart" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">

                                {{-- <input type="number" value="1" min="1" style="width: 20%"> --}}
                                @if (session('user_role') == 1)
                                    <a href="/remove-product/{{ $product->id }}" type="submit"
                                        class="btn btn-secondary rounded px-auto">Remove Product</a>
                                @else
                                    <input type="number" value="1" min="1" class="" style="width: 20%" name="qty">
                                    <button type="submit" class="btn-sm btn-secondary rounded px-auto">Add To
                                        Cart</button>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- ******************ADD PRODUCTS FORM********************************************************************** --}}
    <div class="formCont" id="addproductForm">
        <div class="container mt-5 col-lg-10">
            <div>
                <div>
                    <a class="btn btn-primary mx-4 my-3" style="float:right;" href="/welcome" id="formCancel">Back</a>
                    <div id="response-message" class="alert-success mt-3"></div>
                </div>
                <form id="product-form" enctype="multipart/form-data">
                    @csrf <!-- CSRF Token -->
                    <div>
                        <input type="text" class="form-control py-3 mb-2" id="name" name="name"
                            placeholder="Name Of the Product">
                    </div>
                    <div>
                        <input type="number" id="price" class="form-control py-3 mb-2" name="price"
                            placeholder="Price Of the Product" required>
                    </div>
                    <div>
                        <input type="file" id="image" class="form-control py-3 mb-2" name="image"
                            accept="image/*" required>
                    </div>
                    <button type="button" id="add-product-btn" class="form-control py-3 mb-2 btn btn-success">Add
                        Product</button>
                </form>
            </div>

        </div>
    </div>
    {{-- **************************************************************************************** --}}



</body>
<script>
    $(document).ready(function() {
        $('#productForm').click(
            function() {
                $('#addproductForm').show();
            });
        $('#formCancel').click(
            function() {
                $('#addproductForm').hide();
            });

        $('#add-product-btn').click(function() {
            var name = $('#name').val();
            var price = $('#price').val();
            var image = $('#image')[0].files[0]; // Get the selected image file

            // Create a FormData object and append data to it
            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('name', name);
            formData.append('price', price);
            formData.append('image', image);

            // Make the AJAX request
            $.ajax({
                type: 'POST',
                url: '/add-product',
                data: formData, // Use the FormData object
                contentType: false, // Set to false for FormData
                processData: false, // Set to false for FormData
                success: function(response) {
                    // Handle the success response
                    $('#response-message').html('<p>' + response.message + '</p>');
                    // Optionally, clear input fields or update the UI
                    $('#name').val('');
                    $('#price').val('');
                    $('#image').val(''); // Clear the file input
                },
                error: function(error) {
                    // Handle any errors
                    $('#response-message').html('<p>Error: ' + error.statusText + '</p>');
                    console.error(error);
                }
            });
        });
        window.reload();
    });
</script>

</html>
