<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel 11 CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="bg-dark py-3">
      <h3 class="text-white text-center">Simple Laravel 11 CRUD</h1>
    </div>

    <div class="container">

      <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
          <a href="{{ route('products.create') }}" class="btn btn-dark">Create</a>
        </div>
      </div>

      <div class="row d-flex justify-content-center">

        @if (Session::has('success'))
        
          <div class="col-md-10 mt-4">
            <div class="alert alert-success">
              {{ Session::get('success') }}
            </div>
          </div>

        @endif
        
        <div class="col-md-10">
          <div class="card border-0 shadow-lg my-4">
            <div class="card-header bg-dark">
              <h3 class="text-white">Products List</h3>
            </div> 
           
            <div class="card-body">
              <table class="table">
                <tr>
                  <th>ID</th>
                  <th></th>
                  <th>Name</th>
                  <th>Sku</th>
                  <th>Price</th>
                  <th>Created at</th>
                  <th>Action</th>
                </tr>
                @if ($products->isNotEmpty())
                  @foreach ($products as $product)
                    <tr>
                      <td>{{ $product->id }}</td>
                      <td>
                        @if ($product->image != '')
                            <img src="{{ asset('uploads/products/'.$product->image) }}" height="30" width="30">
                        @endif
                      </td>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->sku }}</td>
                      <td>{{ $product->price }}</td>
                      <td>{{ \Carbon\Carbon::parse($product->created_at)->format('d M,Y') }}</td>
                      <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark">Edit</a>
                        <a href="#" class="btn btn-dark" onClick="deleteProduct({{$product->id}})">Delete</a>
                        <form id="delete-product-form-{{$product->id}}" action="{{ route('products.destroy', $product->id) }}" method="post">
                          @csrf
                          @method('delete')
                        </form>
                      </td>
                    </tr>
                  @endforeach
                @endif
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
      function deleteProduct(id) {
        if(confirm('Are you sure you want to delete this product?')) {
          document.getElementById('delete-product-form-' + id).submit()
        }
      }
    </script>
  </body>
</html>

