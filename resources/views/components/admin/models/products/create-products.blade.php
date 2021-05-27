<!-- Create Modal -->

<div class="modal fade" id="createProductModel" tabindex="-1" role="dialog" aria-labelledby="createProductModelTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="productName">Title</label>
                        <input type="text" name="name" id="productName" class="form-control rounded-pill @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="productPrice">Price</label>
                        <input type="number" name="price" step="0.01" id="productPrice" class="form-control rounded-pill @error('price') is-invalid @enderror" required>
                        <small class="form-text text-muted">Use values upto two decimal postions, using a dot "."</small>
                        @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="productCategories">Categories</label>
                        <select multiple name="categories[]" class="form-control @error('categories') is-invalid @enderror" id="productCategories" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                        </select>
                        @error('categories')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="productImg1">Product Image 1</label>
                        <input type="file" class="form-control-file @error('img_1') is-invalid @enderror" name="img_1" id="productImg1" required>
                        @error('img_1')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="productImg2">Product Image 2</label>
                        <input type="file" class="form-control-file @error('img_2') is-invalid @enderror" name="img_2" id="productImg2" required>
                        @error('img_2')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="productImg3">Product Image 3</label>
                        <input type="file" class="form-control-file @error('img_3') is-invalid @enderror" name="img_3" id="productImg3" required>
                        @error('img_3')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="submit" value="Create" class="btn btn-primary btn-block" />
                </div>
            </form>
        </div>
    </div>
</div>
