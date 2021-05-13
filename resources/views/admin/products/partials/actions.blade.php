<div class="btn-group">
    <a href="{{$product->getFrontUrl()}}" class="btn btn-info" target="_blank">
        <i class="fas fa-eye"></i>
    </a>
    <a href="{{route('admin.products.edit', ['product' => $product->id])}}" class="btn btn-info">
        <i class="fas fa-edit"></i>
    </a>
    <button 
        type="button" 
        class="btn btn-info" 
        data-toggle="modal" 
        data-target="#delete-modal"
        data-action="delete"
        data-id="{{$product->id}}"
        >
        <i class="fas fa-trash"></i>
    </button>
</div>