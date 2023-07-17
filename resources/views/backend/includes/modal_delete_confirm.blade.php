<!-- Modal -->
<div class="modal fade" id="{{ 'delete_modal_' . $index }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete this item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
            @if($type == 'product')
            <div class="mb-2">
                <p>Tên sản phẩm: {{ $product->name }}</p>
                <img src="{{ asset('../storage/app/'.$product->thumbnail) }}" class="img-fluid img-thumbnail" height="100" width="100" alt="img" />
            </div>
            @endif
                <p>Are you sure you want to delete it?</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                @if($type == 'product')
                    <form action="{{ route('products.forceDelete', ['id' => $item->id]) }}" method="post">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
                @if($type == 'image')
                    <form action="{{ route('products.deleteImage', ['product' => $item->imageable, 'image' => $item]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
                @if($type == 'category')
                    <form action="{{ route('categories.destroy', ['category' => $item]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
                @if($type == 'orders')
                    <form action="{{ route('orders.forceDelete', ['id' => $item->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
                @if($type == 'news')
                    <form action="{{ route('news.forceDelete', ['id' => $item->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
                @if($type == 'banners')
                    <form action="{{ route('banners.forceDelete', ['id' => $item->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
