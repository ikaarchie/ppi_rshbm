<div class="modal fade" id="preview{{ $isi->id }}" tabindex="-1" data-bs-backdrop="static"
    aria-labelledby="modalPreview" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPreview"><strong>Preview Dokumen</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <iframe width="100%" height="1000vh" src="dokumen/{{$isi->dokumen}}" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>