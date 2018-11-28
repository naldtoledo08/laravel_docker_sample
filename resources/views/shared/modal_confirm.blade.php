<!-- Modal-->
<div id="{{ (isset($modal_id) ? $modal_id : 'modal-confirm') }}" tabindex="-1" role="dialog" aria-labelledby="confirmModal" aria-hidden="true" class="modal fade text-left">
    <div role="document" class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="confirmModal" class="modal-title">{{ $title }} Confirmation</h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <p>{{ $body }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                <button type="button" class="btn {{ $btn_class }}">{{ $title }}</button>
            </div>
        </div>
    </div>
</div>