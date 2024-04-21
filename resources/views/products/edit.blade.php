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
          <a href="{{ route('products.index') }}" class="btn btn-dark">Back</a>
        </div>
      </div>

      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card border-0 shadow-lg my-4">
            <div class="card-header bg-dark">
              <h3 class="text-white">Edit Product</h3>
            </div> 
            <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
              @method('put')
              @csrf
              <div class="card-body">
  
                <div class="mb-3">
                  <label for="name" class="form-label h5">Name</label>
                  <input type="text" value="{{ old('name', $product->name) }}" name="name" id="name" class="@error('name') is-invalid @enderror form-control form-control-lg" placeholder="Name">
                  @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>
  
                <div class="mb-3">
                  <label for="sku" class="form-label h5">Sku</label>
                  <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" class="@error('sku') is-invalid @enderror form-control form-control-lg" placeholder="Sku">
                  @error('sku')
                    <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>
  
                <div class="mb-3">
                  <label for="price" class="form-label h5">Price</label>
                  <input type="text" value="{{ old('price', $product->price) }}" name="price" id="price" class="@error('price') is-invalid @enderror form-control form-control-lg" placeholder="Price">
                  @error('price')
                    <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>
  
                <div class="mb-3">
                  <label for="description" class="form-label h5">Description</label>
                  <textarea name="description" class="form-control" id="description" placeholder="Description" cols="30" rows="5">{{ old('description', $product->description) }}</textarea>
                </div>
  
                <div class="mb-3">
                  <label for="image" class="form-label h5">Image</label>
                  <input type="file" name="image" id="image" class="form-control form-control-lg" placeholder="Image">
                  @if ($product->image != '')
                    <img src="{{ asset('uploads/products/'.$product->image) }}" height="30" width="30">
                  @endif
                </div>
  
                <div class="d-grid">
                  <button class="btn btn-lg btn-primary">Update</button>
                </div>
  
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
