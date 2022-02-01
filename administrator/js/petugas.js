var petugas = {};
var LIMIT = 5;
var OFFSET = 0;
var level = '';
var TOTAL = -1;

document.getElementById('tambah').onclick = (el) => {
    document.getElementById('modaltitle').innerText ='Tambah Petugas';
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
    document.getElementById('modaltitle').innerText ='Edit Petugas';
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
    document.getElementById('modaltitle').innerText ='Info Petugas';
    $('#exampleModal').modal('show');
    $('.modal-backdrop').remove();
    detailsPetugas(id);
}

function hapusPetugas(id){
    Swal.fire({
        title: `Apakah Anda yakin ingin menghapus ?`,
        background:localStorage.theme?'#1D1933':'white',
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
                        background:localStorage.theme?'#1D1933':'white',
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
                background:localStorage.theme?'#1D1933':'white',
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