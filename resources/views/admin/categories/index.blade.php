@extends('layouts.admin')

@push('styles')
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endpush

@section('content')
    {{-- @if (Session::has('message')) --}}
    @if (session('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{-- {{Session::get('message')}} --}}
        {{session('message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @elseif(session('category-create-message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{-- {{Session::get('message')}} --}}
        {{session('category-create-message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @elseif(session('category-update-message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{-- {{Session::get('message')}} --}}
        {{session('category-update-message')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @elseif(session('category-delete-message'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{-- {{Session::get('message')}} --}}
          {{session('category-delete-message')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
          <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
          <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#createCategoryModel">Create Category</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Description</th>
                  <th>Products</th>
                  <th>Delete</th>
                  <th>Edit</th>
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
                        <td>
                            <a class="btn btn-outline-danger btn-sm" href="#" data-toggle="modal" data-target="#deleteCategory">
                              <span>Delete</span>
                          </a>
                          <!-- Logout Modal-->
                          <div class="modal fade" id="deleteCategory" tabindex="-1" role="dialog" aria-labelledby="deleteCategory" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete the {{ $category->name }} category?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <form action="{{route('admin.categories.destroy',$category->id)}}}" method="post">
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
                            <a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-sm btn-outline-primary">Edit</a>
                        </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
    {{-- Create Model Component --}}
    <x-create-category :products="$products"/>

    @isset($editCategory)
    {{-- Edit Model Component --}}
    <x-edit-category :products="$products" :editCategory="$editCategory"/>
  @endisset
@endsection

@push('scripts')
    <!-- Page level plugins -->
    <script src="http://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
      $.noConflict();
      jQuery( document ).ready(function( $ ) {
        $('#dataTable').DataTable();

        @isset($editCategory)
          $('#editCategoryModel').modal('show');
        @endisset
      });

    </script>

@endpush