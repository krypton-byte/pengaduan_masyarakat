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

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Detail Pengaduan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="file" style="display: none;" name="" id="filemodal">
      <img src="" id="previewmodal" width="100%" class="img-fluid rounded mb-3" alt="">
      <input type="hidden" id="idpengaduan">
      <textarea class="form-control" style="height:100%;" placeholder="Isi Pengaduan" id="isiaduan"></textarea>
      <textarea class="form-control" style="height:100%;" placeholder="Isi Pengaduan" id="isitanggapan" style="display: none;" readonly></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn1modal" class="btn btn-secondary">Hapus</button>
        <button type="button" id="btn2modal" class="btn btn-primary">Edit</button>
      </div>
    </div>
  </div>
</div>
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
                                                <label>Isi Pengaduan</label>
                                                <textarea class="form-control" style="height:100%;" placeholder="" id="isipengaduan"></textarea>
                                                <input type="file" accept="image/*" style="display:none;" id="uploadgambar">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mt-3 mb-3">
                                            <div class="text-start">
                                                <p class="mb-2">Tanggal</p>
                                                <h5 class="text-muted" id="view-tgl"></h5>
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
<style>
</style>
<?php
include 'components/footer.php';
?>