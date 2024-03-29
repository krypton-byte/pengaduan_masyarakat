<?php
session_start();
$title = "Buat Laporan";
include 'components/header.php';
?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Buat Laporan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalBody">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Status: </label>
            <select class="form-select" id="statusaduan" aria-label="Default select example">
                <option value="" selected>Semua</option>
                <option value="0">0</option>
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>
        <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Aksi: </label>
                <select class="form-select" aria-label="Default select example" id="method">
                    <option value="download" selected>Download</option>
                    <option value="print">Print</option>
                    <option value="open">Buka di tab baru</option>
                </select>
        </div>
        <input class="form-check-input" type="checkbox" onchange="limitCheckBox();" id="limitcheckbox">
        <label class="form-check-label" for="flexCheckDefault">
            Limit
        </label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" onclick="Cetak();"class="btn btn-primary">Terapkan</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
<div class="card">
    <div class="card-header">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="klikCetak();">
    <i class="ri-add-line"></i> Laporan
</button>
    </div>
    <div class="card-body d-flex" style="height: 500px;overflow-y: scroll;overflow-x: auto;">
        <div class="scrshotable align-items-center" id="fly" style="width: 100%;justify-content: center;align-items: center;">
            <table id="table" align="center" width="30px">
                <tr>
                    <th colspan="7" class="text-center py-3">
                        DATA PENNGADUAN
                    </th>
                </tr>
                <tr>
                    <th class="text-center px-5">Tanggal</th>
                    <th class="text-center px-5">NIK</th>
                    <th class="text-center px-5">Nama</th>
                    <th class="text-center px-5">Telp</th>
                    <th class="text-center px-5">Aduan</th>
                    <th class="text-center px-5">Status</th>
                </tr>
            </table>
        </div>
    </div>
</div>
      <style>
          .text-center 
{
    flex-grow: 1;
}
          table, th, td {
              border: 1px solid black;
              border-collapse: collapse;
              width: 100px;
              
          }
          table tr td {
              text-overflow:ellipsis;
              overflow:hidden;
              white-space:nowrap;
          }
          td {
              padding: 10px;
          }
          #status {
              text-align: center;
          }
      </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.1/pdfmake.min.js" integrity="sha512-G332POpNexhCYGoyPfct/0/K1BZc4vHO5XSzRENRML0evYCaRpAUNxFinoIJCZFJlGGnOWJbtMLgEGRtiCJ0Yw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.1/vfs_fonts.min.js" integrity="sha512-6RDwGHTexMgLUqN/M2wHQ5KIR9T3WVbXd7hg0bnT+vs5ssavSnCica4Uw0EJnrErHzQa6LRfItjECPqRt4iZmA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.1/fonts/Roboto.min.js" integrity="sha512-pGCzTqMr/3jV+O3cu9KXYTO0/0UHJba6H09poX7vS66l4w73yalUZDb/u10WBVt9gtRI2dRcOoKPWriyqfV1hA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/laporan.js"></script>
</div>
<?php
include 'components/footer.php';
?>