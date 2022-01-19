<?php
include 'components/header.php';
?>
<script src="js/dash-user.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #previewupload {
        display: block;
        margin: 0 auto;
        object-position: center center;
    }
    #gambarpengaduan {
        object-fit: contain;
        width: 400px;
    }
</style>
<div class="col-12">
    <div class="card filter-tab">
        <div class="card-body bs-0 p-0 bg-transparent">
            <div class="row" id="pengaduan">
                <div class="detailspengaduan" id="detailspengaduan">
                    <div width="100%">
                        <div class="card top-bid">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <img id="previewupload" src="images/upload.png" width="450px" onclick="javascript:$('#uploadgambar').trigger('click');" class="img-fluid rounded" alt="...">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-16 mb-3" >
                                                <label>Pesan</label>
                                                <textarea class="form-control" style="height:100%;" placeholder="Pesan" id="isipengaduan"></textarea>
                                                <input type="file" accept="image/*" style="display:none;" id="uploadgambar">
                                                <input type="hidden" id="idpengaduan">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-3 mb-3">
                                            <div class="text-start">
                                                <p class="mb-2">Tanggal</p>
                                                <h5 class="text-muted" id="view-tgl"></h5>
                                            </div>
                                            <div class="text-end">
                                                <p class="mb-2">Status :
                                                    <!-- --> <strong class="text-primary" id="view-status">Tidak Diketahui</strong>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <a onclick="resetPengaduan();" id="button1btn" class="btn btn-primary">
                                                <i class="ri-restart-fill"></i>  Reset
                                            </a>
                                            <a onclick="buat_pengaduan();" id="button2btn" class="btn btn-secondary">
                                                <i class="ri-send-plane-line"></i>  Kirim</a>
                                        </div>
                                        <div id="tambahpengaduan" class="d-flex justify-content-center">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'components/footer.php';
?>