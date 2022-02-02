<?php
session_start();
$title = "Daftar Petugas";
include 'components/header.php';
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaltitle">TAMBAH PETUGAS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="id" id="modalID" value="">
        <div class="mb-3 row">
            <label for="inputNama" class="col-sm-2 col-form-label">Nama: </label>
            <div class="col-sm-10">
                <input type="text" id="nama" name="nama" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputUsername" class="col-sm-2 col-form-label">username: </label>
            <div class="col-sm-10">
                <input type="text" id="username" name="username" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" id="inpassword" class="col-sm-2 col-form-label">password: </label>
            <div class="col-sm-10">
                <input type="password" id="password" name="password" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputTelp" class="col-sm-2 col-form-label">telp: </label>
            <div class="col-sm-10">
                <input type="text" id="telp" name="telp" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputLevel" class="col-sm-2 col-form-label">Level: </label>
            <div class="col-sm-10">
                <select class="form-select" name="level" id="level" aria-label="Default select example">
                    <option value="petugas" selected>Petugas</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn1modal" class="btn btn-secondary">Batal</button>
        <button type="button" id="btn2modal" class="btn btn-primary" id="simpan">Tambah</button>
      </div>
    </div>
  </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12">
        <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <button type="button" class="btn btn-primary" id="tambah"><i class="ri-user-add-line"></i>&nbsp;Petugas</button>
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="bid-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Username</th>
                                                    <th>Telp</th>
                                                    <th>Level</th>
                                                    <th style="text-align:center;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4 col-xl-2 offset-md-4 offset-xl-8 px-10">
                                <button class="btn btn-primary" style="float: right;" id="prev" onclick="PrevNextBTN('prev');">Sebelumnya</button>
                            </div>
                            <div class="col-6 col-md-4 col-xl-2">
                                <button class="btn btn-primary" id="next" onclick="PrevNextBTN();">Selanjutnya</button>
                            </div>
                        </div>
        </div>
    </div>
</div>
<script src="js/petugas.js"></script>
<?php
include 'components/footer.php';
?>