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
</head>

<body>
    <div class="wrapper col-lg-4  mx-auto mt-5">
        <table class="table">
            <thead>

            </thead>
            <tbody>
                <tr>
                    <td>PRiCE</td>
                    <td>{{ $total }}</td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>0</td>
                </tr>
                <tr>

                    <td>Delivery Charges</td>
                    <td>0</td>
                  
                </tr>
                <tr>
                    <td>TOtal Amount</td>
                    <td>{{$total}}</td>
                 
                </tr>
              
            </tbody>
        </table>
        <a class="btn btn-warning mx-2 py-2 rounded" style="float:right;">Order Now</a>
    </div>
  
</body>

</html>
