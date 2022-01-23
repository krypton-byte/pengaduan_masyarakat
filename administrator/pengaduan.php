<?php
include 'components/header.php';
?>
<script src="js/card.js"></script>
<div class="container">
    <div class="modal fade" data-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tanggapan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <div class="modal-body">
                    <textarea style="width: 100%; height: 221px;" class="form-control" id="tanggapan"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Tanggapi</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card filter-tab">
            <div class="card-body bs-0 p-0 bg-transparent">
                <div class="row" id="pengaduan">
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'components/footer.php';
?>