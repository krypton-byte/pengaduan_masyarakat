<?php
session_start();
include 'components/header.php';
?>
<script src="js/pengaduan.js"></script>
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card" style="height: 200 px;">
                <div class="card-header">
                    <h3>DATA PENGADUAN</h3>
                </div>
            <div class="card-body">
                <div class="row">
                    <div class="d-flex col-xl-1 col-sm-2 my-auto justify-content-md-center">
                        <h5>Filter</h5>
                    </div>
                    <div class="d-flex col-xl-11 col-sm-10">
                        <select class="form-select" id="filter">
                            <option value="" selected>Semua</option>
                            <option value="0">0</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                        </select>
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
</div>
<!-- Modal -->
<div class="modal fade" data-backdrop="static" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tanggapan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idaduan">
                    <textarea style="width: 100%; height: 221px;" class="form-control" id="isiAduan" readonly></textarea>
                    <textarea style="width: 100%; height: 221px;" class="form-control" id="isiTanggapan" style="display: none;"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn1">Batal</button>
                    <button type="button" class="btn btn-primary" id="btn2">Tanggapi</button>
                </div>
            </div>
        </div>
    </div>
<?php
include 'components/footer.php';
?>