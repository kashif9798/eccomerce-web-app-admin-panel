@extends('layouts.admin')

@push('styles')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endpush

@section('content')
    @if (session('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @elseif(session('product-create-message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('product-create-message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @elseif(session('product-update-message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('product-update-message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @elseif(session('product-delete-message'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{session('product-delete-message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif
    
    <div class="card shadow mb-4">
        
      <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">All Products</h6>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createProductModel">
            Create Product
          </button>
        </div>

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Price</th>
                  <th>Categories</th>
                  <th>Image 1</th>
                  <th>Image 2</th>
                  <th>Image 3</th>
                  <th>Delete</th>
                  <th>Edit</th>
                  <th>Purchase</th>
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
                        <td> 
                            <a class="btn btn-outline-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteProduct">
                                <span>Delete</span>
                            </a>
                            <!-- Logout Modal-->
                            <div class="modal fade" id="deleteProduct" tabindex="-1" role="dialog" aria-labelledby="deleteProduct" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete the {{ $product->name }} product?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <form action="{{route('admin.products.destroy',$product)}}" method="post">
                                          @csrf
                                          @method('DELETE')
                                          <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div> 
                            
                        </td>
                        <td>
                            <a href="{{route('admin.products.edit', $product->id)}}" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                        <td>
                          <a href="{{route('admin.pay.details',$product)}}" class="btn btn-sm btn-outline-success">Buy</a>
                      </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>

    {{-- Create Model Component --}}
    <x-create-products :categories="$categories"/>
    @isset($editProduct)
      {{-- Edit Model Component --}}
      <x-edit-product :categories="$categories" :editProduct="$editProduct"/>
    @endisset
@endsection

@push('scripts')
    <!-- Page level plugins -->
    <script src="http://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
      jQuery( document ).ready(function( $ ) {
        $('#dataTable').DataTable();
        
        @isset($editProduct)
          $('#editProductModel').modal('show');
        @endisset
      });
    </script>
@endpush