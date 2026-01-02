<div class="modal fade" id="variantModal" tabindex="-1" aria-labelledby="variantModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="variantForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="variantModalLabel">Add Variant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="editIndex" value="">

                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" id="variantName" class="form-control" placeholder="Variant Name"
                                required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="sku" class="form-control" placeholder="SKU" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" id="variant_qty" class="form-control" name="variant_qty" placeholder="Quantity"
                                required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" id="variant_price" class="form-control" name="price" step="0.01"
                                min="0" placeholder="Price (MYR)" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Variant</button>
                </div>
            </form>
        </div>
    </div>
</div>
