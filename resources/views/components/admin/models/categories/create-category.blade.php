<!-- Create Modal -->

<div class="modal fade" id="createCategoryModel" tabindex="-1" role="dialog" aria-labelledby="createCategoryModelTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('admin.categories.store')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Create Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryName">Title</label>
                        <input type="text" name="name" id="categoryName" class="form-control rounded-pill @error('name') is-invalid @enderror" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="categoryDescription">Description</label>
                        <textarea name="description"  id="categoryDescription" class="form-control rounded @error('description') is-invalid @enderror" required></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="productCategories">Products</label>
                        <select multiple name="products[]" class="form-control @error('categories') is-invalid @enderror" id="productCategories">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('products')
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
