<!-- Edit Modal -->
<form action="{{ route('product.update', $product->id) }}" method="POST" style="display: inline;"
    enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" role="dialog"
        aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $product->id }}">
                        Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $product->name) }}">
                    </div>
                    <div class="mb-3">
                        <label for="category">Category</label>
                        <select class="form-select" name="category_id">
                            @foreach ($categories as $category)
                                @if (old('category_id', $product->category_id) == $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="supplier">Supplier</label>
                        <select class="form-select" name="supplier_id">
                            @foreach ($suppliers as $supplier)
                                @if (old('supplier_id', $product->supplier_id) == $supplier->id)
                                    <option value="{{ $supplier->id }}" selected>{{ $supplier->name }}</option>
                                @else
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description">Description</label>
                        <input type="text" name="description" id="description" class="form-control"
                            value="{{ old('description', $product->description) }}">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="hidden" name="imageOld" value="{{ $product->image }}">
                        <input class="form-control" type="file" name="image" id="image">
                    </div>
                    <div class="mb-3">
                        <label for="stock">Stock</label>
                        <input type="number" name="stock" id="stock" class="form-control"
                            value="{{ old('stock', $product->stock) }}">
                    </div>
                    <div class="mb-3">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control"
                            value="{{ old('price', $product->price) }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#editModal">Save</button>
                </div>
            </div>
        </div>

</form>
