<?php
session_start();
include 'components/header.php';
?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TAMBAH PETUGAS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="id" value="">
        <div class="mb-3 row">
            <label for="inputNama" class="col-sm-2 col-form-label">Nama: </label>
            <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputUsername" class="col-sm-2 col-form-label">username: </label>
            <div class="col-sm-10">
                <input type="text" name="nama" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">password: </label>
            <div class="col-sm-10">
                <input type="password" name="nama" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputTelp" class="col-sm-2 col-form-label">telp: </label>
            <div class="col-sm-10">
                <input type="text" name="telp" class="form-control" id="inputPassword">
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputLevel" class="col-sm-2 col-form-label">Level: </label>
            <div class="col-sm-10">
                <select class="form-select" aria-label="Default select example">
                    <option value="petugas" selected>Petugas</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary" id="simpan">Tambah</button>
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" id="tambah"><i class="ri-user-add-line"></i>&nbsp;Petugas</button>
                            </h4>
                        </div>
                        <div class="card-body">
                        </div>
                    </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('tambah').onclick = (el) => {
        $('.modal-backdrop').remove();

    }
    document.getElementById()
    document.getElementById('simpan').onclick = (ev) =>{
        const form = new FormData();
        Array.from(document.getElementsByTagName('input')).forEach(x=>{
            form.append(x.name, x.value);
        })
        form.append('level', document.getElementById('level').value);
        fetch('api/tambahuser.php', {
            method: 'POST',
            body: form
        }).then(async (x)=>{
            if((await x.json()).status){
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Berhasil',
                    showConfirmButton: false,
                    timer: 2000
                });
            }else{
                Swal.fire({
                    position: 'top-end',
                    icon: 'error',
                    title: 'Gagal',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        })
    }
</script>
<?php
include 'components/footer.php';
?>