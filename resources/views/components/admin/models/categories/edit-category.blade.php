<!-- Create Modal -->

<div class="modal" id="editCategoryModel" tabindex="-1" role="dialog" aria-labelledby="editCategoryModelTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="{{route('admin.categories.update', $editCategory)}}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryName">Title</label>
                        <input type="text" name="name" id="categoryName" value="{{ $editCategory->name }}" class="form-control rounded-pill @error('name') is-invalid @enderror" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="categoryDescription">Description</label>
                        <textarea name="description"  id="categoryDescription"  class="form-control rounded @error('description') is-invalid @enderror" required>{{ $editCategory->description }}</textarea>
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
                                <option
                                    @if (in_array($product->id, $editCategory->products()->pluck('id')->all()))
                                        selected="selected"
                                    @endif 
                                    value="{{ $product->id }}"
                                >
                                    {{ $product->name }}
                                </option>
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
                    <input type="submit" value="Update" class="btn btn-primary btn-block" />
                </div>
            </form>
        </div>
    </div>
</div>
