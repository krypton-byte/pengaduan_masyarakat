<?php
session_start();
include 'components/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-12">
        <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Petugas</h4>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3"><label class="form-label">Nama</label><input name="nama" type="text" class="form-control" value=""></div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3"><label class="form-label">Telp</label><input name="telp" type="text" class="form-control" value=""></div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3"><label class="form-label">Username</label><input name="username" type="username" class="form-control" value=""></div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3"><label class="form-label">Level</label><select id="level" class="form-control">
                                            <option value="Petugas">Petugas</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                                    <div class="col-xxl-6 col-xl-6 col-lg-6 mb-3"><label class="form-label">Password</label><input name="password" type="password" class="form-control" value=""></div>
                                    
                                </div>
                                <div class="mt-3"><button class="btn btn-primary mr-2" id="simpan">Simpan</button></div>
                        </div>
                    </div>
        </div>
    </div>
</div>
<script>
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