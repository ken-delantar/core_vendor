@extends('layouts.app')

@section('content')
    <h1>Manage Your Products</h1>

    <div class="d-flex align-items-center justify-content-between">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Add New Product</button>
        @if (session()->has('success'))
            <div id="success-message" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div id="error-message" class="alert alert-danger">
                Operation failed, check your input!
            </div>
        @endif
    </div>

    <div class="card">
        <div class="card-header">Product Catalog</div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>
                                @foreach (\Stripe\Price::all(['product' => $product->id]) as $price)
                                    <p class="m-0">{{ number_format($price->unit_amount / 100, 2) }} {{ strtoupper($price->currency) }}</p>
                                @endforeach    
                            </td>
                            <td>{{ $product->metadata['stock'] }}</td>
                            <td>{{ $product->active == 1 ? 'Active' : 'Inactive' }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateProductModal{{ $product->id }}">Edit</button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between">
                    <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProduct" action="" method="POST">
                        @csrf
                        @method('POST')

                        <div class="mb-3">
                            <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter product name">
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price (₱)</label>
                            <input type="number" class="form-control" name="price" placeholder="Enter product price" step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control" name="stock" placeholder="Enter stock quantity">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" name="desc" placeholder="Enter product description">
                        </div>

                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal" aria-label="Close">Back</button>
                    <button type="submit" class="btn btn-primary m-1" form="addProduct">Add Product</button>
                </div>
            </div>
        </div>
    </div>

    @foreach ($products as $product)
        <div class="modal fade" id="updateProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="updateProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateProductModalLabel">Update Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="updateProduct" action="{{ route('product_update', $product->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="update_product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Enter product name">
                            </div>

                            <div class="mb-3">
                                <label for="update_stock" class="form-label">Stock</label>
                                <input type="number" class="form-control" name="stock" value="{{ $product->metadata['stock'] }}" placeholder="Enter stock quantity">
                            </div> 
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" name="desc" value="{{ $product->description }}" placeholder="Enter product description">
                            </div>

                            @if ($product->active)
                                <div class="form-group">
                                    <label class="col-form-label">Status</label>
                                    <select class="form-control" name="active">
                                        <option value="true">Active</option>
                                        <option value="false">Inactive</option>
                                    </select>
                                </div>
                            @endif
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" form="updateProduct">Update Product</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($products as $product)
        <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <strong>{{ $product->name }}</strong>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger" id="confirm_delete">Yes, delete it</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            var errorMessage = document.getElementById('error-message');
    
            if (successMessage) {
                successMessage.style.display = 'none';
            }
            
            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 5000);
    </script>

@endsection
