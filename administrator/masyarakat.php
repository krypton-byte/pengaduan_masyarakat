<?php
session_start();
include 'components/header.php';
?>
<div class="container">
    <div class="row">
        <div class="col-12">
        <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Data Masyarakat
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="bid-table">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    
                                                    <th>Nama</th>
                                                    <th>NIK</th>
                                                    <th>Username</th>
                                                    <th>Telp</th>
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
    var LIMIT = 5;
    var OFFSET = 0;
    var TOTAL = -1;
    var masyarakat = {};
    function addItem(NIK, avatar, name, username, phone){
        $('tbody').append(`<tr id="id${NIK}">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                        <img src="../images/avatar/${avatar}" alt="" width="60" class="me-3 rounded">
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-0" id="name${NIK}">${name}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>${NIK}</td>
                                                    <td>${username}</td>
                                                    <td>${phone}</td>
                                                    <td style="text-align:center;">
                                                        <button onclick="hapusUser('${NIK}');" class="btn btn-outline-primary"><i class="ri-delete-bin-line"></i> Hapus</button>
                                                    </td>
                                                </tr>
        `);
    }

    function PrevNextBTN(prev){
        if(prev){
            OFFSET = OFFSET<(LIMIT*2)?0:OFFSET-LIMIT*2
        }
        dataUser();
    }
    function hapusUser(nik){
        Swal.fire({
            title: `Apakah Anda yakin ingin menghapus ?`,
            background:localStorage.theme?'#1D1933':'white',
            showCancelButton: true,
            cancelButtonText:'Batal',
            confirmButtonText: 'Hapus',
        }).then((result) => {
            if(result.isConfirmed){
                const form = new FormData();
                form.append('nik', nik);
                fetch('api/hapususer.php', {
                    method: 'POST',
                    body: form
                }).then(async (resp)=>{
                    const rstatus = await resp.json();
                    Swal.fire({
                            position: 'top-end',
                            background:localStorage.theme?'#1D1933':'white',
                            icon: 'success',
                            title: `User ${rstatus?'Berhasil':'Gagal'} dihapus`,
                            showConfirmButton: false,
                            timer: 1500
                    });
                    rstatus !== false && $(`#id${nik}`).remove();

                })
            }
        })
    }
    function dataUser(){
        const form = new FormData();
        form.append('offset', OFFSET);
        form.append('limit', LIMIT);
        if(TOTAL === OFFSET)return 
        fetch('api/masyarakat.php', {
            method: 'POST',
            body: form
        }).then( async (resp)=>{
            masyarakat = {};
            const js = await resp.json();
            $('tbody').empty()
            TOTAL=js.total;;
            js.masyarakat.forEach(x=>{
                if(!Object.keys(masyarakat).includes(x.nik)){
                    addItem(x.nik, x.avatar, x.nama, x.username, x.telp);
                    masyarakat[x.nik] = x;
                    OFFSET+=1;
                    if(OFFSET<=LIMIT){
                        document.getElementById('prev').style.display = 'none';
                    }else{
                        document.getElementById('prev').style.display = '';
                    }
                }
            })
            if(OFFSET + LIMIT > TOTAL){
                document.getElementById('next').style.display = 'none'; 
            }else{
                document.getElementById('next').style.display = '';
            }

        })
    }
    $(document).ready(()=>{
        PrevNextBTN();
    })

</script>
<?php
include 'components/footer.php';
?>