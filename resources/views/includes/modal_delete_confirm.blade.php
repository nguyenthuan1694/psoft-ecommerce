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
            <div class="modal-body">
                <p>Are you sure you want to delete it?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                @if($type == 'book')
                    <form action="{{ route('book.forceDelete', ['id' => $item->id]) }}" method="post">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
                @if($type == 'bill')
                    <form action="{{ route('bill.forceDelete', ['id' => $item->bill_id]) }}" method="post">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
                @if($type == 'receipt')
                    <form action="{{ route('receipt.forceDelete', ['id' => $item->id]) }}" method="post">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
