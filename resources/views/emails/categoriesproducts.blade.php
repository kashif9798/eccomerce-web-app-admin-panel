<!doctype html>
<html lang="en">
<head>
  	<title>Table 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-5">
                <h2 >List of Products</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-primary">
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Categories</th>
                        <th>Image 1</th>
                        <th>Image 2</th>
                        <th>Image 3</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td>${{$product->price}}</td>
                            <td>
                            <ul>
                                @foreach ($product->categories as $category)
                                <li>{{ $category->name }}</li>
                                @endforeach
                            </ul>
                            </td>
                            <td>
                            <img height="40px" src="{{ url("img/{$product->img_1}") }}" alt="">
                            </td>
                            <td>
                            <img height="40px" src="{{ url("img/{$product->img_2}") }}" alt="">
                            </td>
                            <td>
                            <img height="40px" src="{{ url("img/{$product->img_3}") }}" alt="">
                            </td>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center mb-5">
                <h2 >List of Categories</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-primary">
                    <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Products</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{Str::limit($category->description,'500','...')}}</td>
                                <td>
                                <ul>
                                    @foreach ($category->products as $product)
                                    <li>{{ $product->name }}</li>
                                    @endforeach
                                </ul>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>

