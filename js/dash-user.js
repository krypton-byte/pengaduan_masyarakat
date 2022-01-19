globalThis.TOTAL = -1;
globalThis.OFFSET = 0;
globalThis.LIMIT = 5;
globalThis.allID = [];
globalThis.lastUpdate = new Date();
globalThis.tanggapan = {}
function LihatSelengkapnya(th){
        var data = th.getAttribute('data');
        var jagoankodeblog = document.getElementById(`titik${data}`);
        var selengkapnyaText = document.getElementById(`selengkapnya${data}`);
        var jagoankodecool = document.getElementById(`d${data}`);
        if (jagoankodeblog.style.display === "none") {
            jagoankodeblog.style.display = "inline";
            jagoankodecool.innerHTML = "Baca selengkapnya"; 
            selengkapnyaText.style.display = "none";
        } else {
            jagoankodeblog.style.display = "none";
            jagoankodecool.innerHTML = "Sembunyikan"; 
            selengkapnyaText.style.display = "inline";
        }
}
$(document).ready(()=>{
    document.getElementById('view-tgl').innerHTML = cdate();
    if (((window.innerHeight + window.scrollY) >= document.body.offsetHeight) && (globalThis.TOTAL !== globalThis.OFFSET || Math.floor(((new Date()) - globalThis.lastUpdate)/1000) > 30 )){
        globalThis.lastUpdate = new Date();
        pengaduan();
    }
    document.addEventListener('scroll', (x) => {
        console.log(x);
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight){
            pengaduan();
        }
    })
    document.getElementById('uploadgambar').onchange = event => {
        console.log('tertrigger');
        const [file] = event.target.files;
        if(file){
            console.log(URL.createObjectURL(file));
            document.getElementById('previewupload').src = URL.createObjectURL(file);
        }

    }

})

/**
 * @param {number} num
 */
function monthNum2Str(num){
    const month = [
        "Januari", "Februari", "Maret",
        "April", "Mei", "Juni",
        "Juli", "Agustus", "Septeber",
        "Oktober", "November", "Desember"
    ];
    return month[num]
}
/**
 * 
 * @returns {string}
 */

function cdate(){
    const date = new Date()
    return `${date.getDate()} ${monthNum2Str(date.getMonth())}, ${date.getFullYear()}`;
}

/**
 * 
 * @param {string} id 
 */
function removeCardById(id){
    Array.from(document.getElementsByClassName('col-xxl-3'))
        .filter(x=>x.getAttribute('id'))
            .map(x=>x.remove())
}

function escapeHtml(unsafe)
{
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }

 function unescapeHtml(safe)
{
    return safe
         .replace(/&amp;/g, '&')
         .replace(/&lt;/g, '<')
         .replace(/&gt;/g, '>')
         .replace(/&quot;/, '"')
         .replace("&#039;", '\'');
 }

  /**
   * 
   * @param {string} text
   * @param {Int8Array} id
   * @returns {string}
   */
  function buatSelengkapnya(text, id)
  {
      if((text.match(/\n/g) || []).length || text.length > 29){
          return `${escapeHtml(text.slice(0, 29))}<span id="titik${id}">....</span><span id="selengkapnya${id}" style="display: none;">${escapeHtml(text.slice(29))} </span><span class="clselengkapnya" id="d${id}" data="${id}" onclick="LihatSelengkapnya(this);" style="color: 6F4EF2;">baca selengkapnya</span>`;
      }
      return escapeHtml(text);
  }



  /**
   * 
   * @param {string} image_url 
   * @param {string} tanggal 
   * @param {string} isi 
   * @param {string} status 
   * @param {number} id
   * @returns {string}
   */
  function createCard(image_url, tanggal, isi, status, id)
  {
        const split = tanggal.split(' ')[0].split('-')
        const tgl = tanggal.match('-')?`${split[2]}, ${monthNum2Str(parseInt(split[1])-1)} ${split[0]}`:tanggal;
      return `
      <div class="col-xxl-3 col-xl-6 col-lg-6 col-md-6 col-sm-6" id="i${id}">
                    <div class="card items">
                        <div class="card-body">
                            <div class="items-img position-relative"><img src="${image_url}" id="img${id}" width="100%" class="img-fluid rounded mb-3" alt=""></div>
                            <h4 class="card-title"></h4>
                            <p id="isi-${id}">${isi.length > 29 ?buatSelengkapnya(isi, id):isi}</p>
                            <div class="d-flex justify-content-between">
                                <div class="text-start">
                                    <p class="mb-2">Tanggal</p>
                                    <h5 class="text-muted" id="tgl-${id}">${tgl}</h5>
                                </div>
                                <div class="text-end">
                                    <p class="mb-2">Status : <strong class="text-primary" id="status-${id}">${status}</strong></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-3"><a data="${id}" onclick="detailsItem(this);" class="btn btn-primary"><i class="ri-information-line"></i>  Details</a></div>
                        </div>
                    </div>
                </div>
      `
  }

function updateUICard(image_url, tanggal, isi, id, status){
    const split = tanggal.split(' ')[0].split('-')
    const tgl = `${split[2]}, ${monthNum2Str(parseInt(split[1])-1)} ${split[0]}`;
    document.getElementById(`img${id}`).src = image_url;
    document.getElementById(`isi-${id}`).innerHTML = isi.length > 29 ?buatSelengkapnya(isi, id):isi;
    document.getElementById(`tgl-${id}`).innerHTML = tgl;
    document.getElementById(`status-${id}`).innerHTML = status;


}
function detailsItem(th){
    const id = th.getAttribute('data');
    setDetailsFromID(id);
}
function setDetailsFromID(id_=''){
    const id = id_ || document.getElementById('idpengaduan').value
    document.getElementById('view-tgl').innerHTML = document.getElementById(`tgl-${id}`).innerHTML;
    document.getElementById('previewupload').src = document.getElementById(`img${id}`).getAttribute('src');
    document.getElementById(`view-status`).innerHTML = document.getElementById(`status-${id}`).innerHTML;
    document.getElementById('idpengaduan').value = id;
    document.getElementById('button1btn').innerHTML = '<i class="ri-delete-bin-line"></i>  Hapus';
    document.getElementById('button1btn').setAttribute('onclick', 'deletePengaduan();')
    document.getElementById('tambahpengaduan').innerHTML='<a href="#" onclick="toTulisPengaduan();" class="btn btn-primary" style="width: 100%;"><i class="ri-add-circle-line"></i>  Buat Pengaduan</a>';
    document.getElementById('isipengaduan').value = unescapeHtml(document.getElementById(`isi-${id}`).innerHTML.match(/<span.*?>/g)?/(.*?)<span id=.*?>[\.]+<\/span><span .*?>(.*?)<\/span>/.exec(document.getElementById(`isi-${id}`).innerHTML).slice(1, 3).join(''):document.getElementById(`isi-${id}`).innerHTML);
    window.scrollTo(0, 0);
    readOnlyPengaduan(id);
}


function toUpdateMode(){
    $('#uploadgambar').val('');
    document.getElementById('previewupload').setAttribute('onclick', "javascript:$('#uploadgambar').trigger('click');");
    document.getElementById('isipengaduan').removeAttribute('readonly');
    $('#tambahpengaduan').empty();
    document.getElementById('button1btn').innerHTML = '<i class="ri-arrow-go-back-line"></i>  Batal';
    document.getElementById('button2btn').innerHTML = '<i class="ri-send-plane-line"></i>  Update';
    document.getElementById('button1btn').setAttribute('onclick',`setDetailsFromID();`);
    document.getElementById('button2btn').setAttribute('onclick', 'updatePengaduan();');

}
function toTulisPengaduan(){
    document.getElementById('view-tgl').innerHTML = cdate();
    document.getElementById(`view-status`).innerHTML = 'Tidak Diketahui';
    document.getElementById('previewupload').setAttribute('onclick', "javascript:$('#uploadgambar').trigger('click');");
    document.getElementById('isipengaduan').removeAttribute('readonly');
    document.getElementById('button1btn').innerHTML = '<i class="ri-restart-fill"></i>  Reset';
    document.getElementById('button1btn').setAttribute('onclick', 'resetPengaduan();');
    document.getElementById('button2btn').innerHTML = '<i class="ri-send-plane-line"></i>  Kirim'; 
    document.getElementById('button2btn').setAttribute('onclick', 'buat_pengaduan();'); 
    $('#tambahpengaduan').empty(); 
    document.getElementById('isipengaduan').value = ''
    document.getElementById('previewupload').src = 'images/upload.png';
    $('#uploadgambar').val('');
}
function resetPengaduan(){
    document.getElementById('view-tgl').innerHTML = cdate();
    document.getElementById('isipengaduan').value = '';
    document.getElementById('previewupload').src = 'images/upload.png';
}

function readOnlyPengaduan(id){
    document.getElementById('previewupload').removeAttribute('onclick');
    document.getElementById('isipengaduan').setAttribute('readonly', '');
    document.getElementById('button1btn').innerHTML = '<i class="ri-delete-bin-line"></i>  Hapus';
    document.getElementById('button1btn').setAttribute('onclick', 'deletePengaduan();')
    document.getElementById('button2btn').innerHTML = globalThis.tanggapan[id]?'<i class="ri-chat-check-line"></i>  Tanggapan':'<i class="ri-edit-line"></i>  Edit';
    document.getElementById('button2btn').setAttribute('onclick', globalThis.tanggapan[id]?'lihatTanggapan();':'toUpdateMode();');
}
function lihatTanggapan(){
    const id = document.getElementById('idpengaduan').value;
    document.getElementById('isipengaduan').value = globalThis.tanggapan[id].tanggapan;
    document.getElementById('button2btn').innerHTML = '<i class="ri-arrow-go-back-line"></i>  Kembali';
    document.getElementById('button2btn').setAttribute('onclick', 'setDetailsFromID();');
    $('#tambahpengaduan').empty();

}
function deletePengaduan(){
    const form = new FormData();
    form.append('id', document.getElementById('idpengaduan').value);
        fetch('api/hapus.php', {
            method:'POST',
            body: form
        
       }).then(async (resp)=>{
           const json = await resp.json();
           if(json.status){
               $(`#i${document.getElementById('idpengaduan').value}`).remove();
               Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Berhasil Dihapus',
                showConfirmButton: false,
                timer: 1500
              });
              toTulisPengaduan();
           }else{
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Gagal Dihapus',
                showConfirmButton: false,
                timer: 1500
              })
           }
       })
}

function pengaduan(){
    if(globalThis.OFFSET !==  globalThis.TOTAL){
        const form = new FormData();
        form.append('limit', 5);
        form.append('offset', OFFSET)
        fetch('api/data.php', {
            method:'POST',
            body: form
        }).then(async (response) => {
            const js = await response.json();
            globalThis.TOTAL = js.total;
            js.hasil.map(x => {
                if(!(globalThis.allID.includes(x.id))){
                    $('#pengaduan').append(createCard(x.foto, cdate(), x.isi, x.status, x.id));
                    globalThis.allID.push(x.id);
                    globalThis.OFFSET++;
                    if(x.tanggapan_id){
                        const split = x.waktu_tanggapan.split(' ')[0].split('-')
                        globalThis.tanggapan[x.id] = {
                            tgl: `${split[2]}, ${monthNum2Str(parseInt(split[1])-1)} ${split[0]}`,
                            tanggapan: x.tanggapan
                        }
                    }
                }
                
            
            });
            
        })
    }
}

function updatePengaduan(){
    const form = new FormData();
    document.getElementById('uploadgambar').files.length && form.append('image',document.getElementById('uploadgambar').files[0])
    form.append('isi', document.getElementById('isipengaduan').value);
    form.append('id', document.getElementById('idpengaduan').value)
    fetch('api/update.php', {
        method: 'POST',
        body: form
    }).then(async (response) => {
        const js = await response.json();
        if(js.status){
            updateUICard(js.hasil.foto, js.hasil.tgl, js.hasil.isi, js.hasil.id, js.hasil.status);
            setDetailsFromID(js.id);
            readOnlyPengaduan();
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Pengaduan Berhasil diubah',
                showConfirmButton: false,
                timer: 1500
            })
        }else{
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Pengaduan Gagal diubah',
                showConfirmButton: false,
                timer: 1500
            })
        }

    })
}

function buat_pengaduan()
{
 const form = new FormData();
 form.append('image', document.getElementById('uploadgambar').files[0]);
 form.append('isi', document.getElementById('isipengaduan').value);
 fetch('api/pengaduan.php', {
     method: 'POST',
     body:form
 }).then(async (response) => {
     const json = await response.json();
     if(json.status !== false ){
        document.getElementById('previewupload').removeAttribute('onclick');
        document.getElementById('isipengaduan').setAttribute('readonly', '');
        $('#pengaduan').append(createCard(json.foto, json.tgl, json.isi, json.status));
        Swal.fire({
           position: 'top-end',
           icon: 'success',
           title: 'Pengaduan Berhasil dibuat',
           showConfirmButton: false,
           timer: 1500
       });
       globalThis.allID.push(json.id)
     }else{
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Pengaduan Gagal dibuat',
            showConfirmButton: false,
            timer: 1500
        });
     }
});
}