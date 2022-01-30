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
<script>
    var petugas = {};
    var LIMIT = 5;
    var OFFSET = 0;
    var level = '';
    var TOTAL = -1;

    document.getElementById('tambah').onclick = (el) => {
        $('#exampleModal').modal('show');
        Array.from(document.getElementsByTagName('input')).forEach(x=>{
            x.value='';
        });
        document.getElementById('level').value = 'petugas';
        $('.modal-backdrop').remove();
        document.getElementById('inpassword').innerText = 'password';
        document.getElementById('modalID').value = ''
        document.getElementById('btn1modal').setAttribute('data-bs-dismiss', 'modal');
        document.getElementById('btn1modal').innerText = 'Batal';
        document.getElementById('btn2modal').innerText = 'Tambah';
        document.getElementById('btn2modal').setAttribute('onclick', 'kirimDataPetugas();')

    }

    function addItem(id, name, username, phone, level){
        $('tbody').append(`<tr id="id${id}">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-0" id="name${id}">${name}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td id="un${id}">${username}</td>
                                                    <td id="ph${id}">${phone}</td>
                                                    <td id="lv${id}">${level}</td>
                                                    <td style="text-align:center;">
                                                        <button onclick="btndetail('${id}');" class="btn btn-outline-primary"><i class="ri-information-line"></i> Details</button>
                                                    </td>
                                                </tr>
        `);
    }
    function editPetugas(id){
        document.getElementById('inpassword').innerText = 'password (opsional)';
        document.getElementById('username').removeAttribute('readonly');
        document.getElementById('nama').removeAttribute('readonly');
        document.getElementById('telp').removeAttribute('readonly');
        document.getElementById('level').removeAttribute('disabled');
        document.getElementById('password').removeAttribute('readonly');
        document.getElementById('btn2modal').innerText = 'Update';
        document.getElementById('btn2modal').onclick = kirimDataPetugas
        document.getElementById('btn1modal').innerText = 'Kembali';
        document.getElementById('btn1modal').setAttribute('onclick', `btndetail('${id}');`);
    }

    function btndetail(id){
        $('#exampleModal').modal('show');
        $('.modal-backdrop').remove();
        detailsPetugas(id);
    }

    function hapusPetugas(id){
        Swal.fire({
            title: `Apakah Anda yakin ingin menghapus ${petugas[id].nama}?`,
            showCancelButton: true,
            cancelButtonText:'Batal',
            confirmButtonText: 'Hapus',
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                const form = new FormData();
                form.append('id', id);
                fetch('api/hapuspetugas.php',{
                    method: 'POST',
                    body: form
                }).then( async (resp)=>{
                    const statuspetugas = (await resp.json()).status;
                    if(statuspetugas){
                        $(`#id${id}`).remove();
                        OFFSET--;
                        $('#exampleModal').modal('hide');
                    }
                    Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: `Petugas ${statuspetugas!== false?'Berhasil':'Gagal'} di hapus`,
                            showConfirmButton: false,
                            timer: 1500
                    });
                })
            }
        })
    }
    function kirimDataPetugas(){
        const id = document.getElementById('modalID').value
        const form = new FormData();
        Array.from(document.getElementsByTagName('input')).forEach(x=>{
            x.value && form.append(x.name, x.value);
        });
        form.append('level', document.getElementById('level').value);
        fetch(`api/${id?'petugas':'tambahuser'}.php`, {
            method: 'POST',
            body: form
        }).then(async (resp)=>{
            const js = await resp.json();
            Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: `Petugas ${js.status!== false?'Berhasil':'Gagal'} di${id?'tambahkan':'ubah'}`,
                    showConfirmButton: false,
                    timer: 1500
            })
            if(js.status !== false){
                $('#exampleModal').modal('hide');
            }
            if(id && js.status !== false){
                editItemByID(js.id, js.nama, js.username, js.telp, js.level);
                petugas[js.id] = js
                
            }
        })
    }
    function detailsPetugas(id){
        document.getElementById('modalID').value = id;
        document.getElementById('inpassword').innerText = 'password';
        const dat = petugas[id];
        if(dat){
            document.getElementById('username').value = dat.username
            document.getElementById('username').setAttribute('readonly','');
            document.getElementById('nama').value = dat.nama
            document.getElementById('nama').setAttribute('readonly','');
            document.getElementById('telp').value = dat.telp
            document.getElementById('telp').setAttribute('readonly','');
            document.getElementById('level').value = dat.level
            document.getElementById('level').setAttribute('disabled','');
            document.getElementById('password').value = '';
            document.getElementById('password').setAttribute('readonly','');
            document.getElementById('btn1modal').removeAttribute('data-bs-dismiss');
            document.getElementById('btn1modal').setAttribute('onclick', '');
            document.getElementById('btn1modal').innerText = 'Hapus';
            document.getElementById('btn1modal').setAttribute('onclick',`hapusPetugas('${id}')`);
            document.getElementById('btn2modal').innerText = 'Edit';
            document.getElementById('btn2modal').setAttribute('onclick', `editPetugas('${id}')`);
        }


    }

    function PrevNextBTN(prev){
        if(prev){
            OFFSET = OFFSET<(LIMIT*2)?0:OFFSET-LIMIT*2
        }
        dataPetugas();
    }
    function dataPetugas(){
        const form = new FormData();
        form.append('offset', OFFSET);
        form.append('limit', LIMIT);
        level && form.append('level', level);
        if(TOTAL === OFFSET)return 
        fetch('api/datapetugas.php', {
            method: 'POST',
            body: form
        }).then( async (resp)=>{
            const js = await resp.json();
            $('tbody').empty()
            TOTAL=js.total;
            petugas = {};
            js.petugas.forEach(x=>{
                x.id = x.id.toString();
                if(!Object.keys(petugas).includes(x.id)){
                    addItem(x.id, x.nama, x.username, x.telp, x.level);
                    petugas[x.id] = x;
                    OFFSET+=1;
                    if(OFFSET<=LIMIT){
                        document.getElementById('prev').style.display = 'none';
                    }else{
                        document.getElementById('prev').style.display = '';
                    }
                }
            })
            if(TOTAL === OFFSET){
                document.getElementById('next').style.display = 'none'; 
            }else{
                document.getElementById('next').style.display = '';
            }

        })
    }
    function editItemByID(id, name, username, phone, level){
        name && (document.getElementById(`name${id}`).innerText = name);
        username && (document.getElementById(`un${id}`).innerText = username);
        phone && (document.getElementById(`ph${id}`).innerText = phone);
        level && (document.getElementById(`lv${id}`).innerText = level);
    }
    $(document).ready(()=>{
        PrevNextBTN();
    })

    // document.getElementById('btn1modal').onclick = (ev) =>{
    //     const form = new FormData();
    //     Array.from(document.getElementsByTagName('input')).forEach(x=>{
    //         form.append(x.name, x.value);
    //     })
    //     form.append('level', document.getElementById('level').value);
    //     fetch('api/tambahuser.php', {
    //         method: 'POST',
    //         body: form
    //     }).then(async (x)=>{
    //         if((await x.json()).status){
    //             Swal.fire({
    //                 position: 'top-end',
    //                 icon: 'success',
    //                 title: 'Berhasil',
    //                 showConfirmButton: false,
    //                 timer: 2000
    //             });
    //         }else{
    //             Swal.fire({
    //                 position: 'top-end',
    //                 icon: 'error',
    //                 title: 'Gagal',
    //                 showConfirmButton: false,
    //                 timer: 2000
    //             });
    //         }
    //     })
   // }
</script>
<?php
include 'components/footer.php';
?>