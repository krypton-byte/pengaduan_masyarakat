var dataPengaduan = {};

/**
 * 
 * @param {string} id 
 */
 function removeCardById(id){
    Array.from(document.getElementsByClassName('col-xxl-3'))
        .filter(x=>x.getAttribute('id') === `i${id}`)
            .map(x=>x.remove())
}

function lihatTanggapan(id){
    document.getElementById('isiTanggapan').value = dataPengaduan[id].tanggapan || '';
    document.getElementById('isiTanggapan').style.display = ''
    document.getElementById('isiAduan').style.display = 'none'
    document.getElementById('isiTanggapan').setAttribute('readonly', '')
    const btn1 = document.getElementById('btn1');
    const btn2 = document.getElementById('btn2');
    btn1.removeAttribute('data-bs-dismiss');
    btn1.innerHTML = 'Kembali';
    btn1.setAttribute('onclick', `lihatPengaduan(${id})`);
    btn2.innerHTML = '<i class="ri-check-double-line"></i> Selesai';
    btn2.setAttribute('onclick', `selesai(${id});`);
}


function tulisTanggapan(ids){
    document.getElementById('isiTanggapan').style.display = ''
    document.getElementById('isiAduan').style.display = 'none'
    const btn1 = document.getElementById('btn1');
    const btn2 = document.getElementById('btn2');
    btn1.removeAttribute('data-bs-dismiss');
    btn1.innerHTML = 'Kembali';
    btn1.setAttribute('onclick', `lihatPengaduan(${ids})`);
    btn2.innerHTML = 'Kirim';
    btn2.setAttribute('onclick', `kirimTanggapan(${ids})`);
}

/**
 * 
 * @param {Number} id 
 */
function lihatPengaduan(id){
    document.getElementById('isiAduan').style.display = ''
    document.getElementById('isiAduan').value = dataPengaduan[id].isi;
    document.getElementById('idaduan').value = id;
    document.getElementById('isiTanggapan').style.display = 'none'
    const btn1 = document.getElementById('btn1')
    const btn2 = document.getElementById('btn2');
    if(dataPengaduan[id].status === 'proses'){
        btn1.setAttribute('data-bs-dismiss','modal');
        btn1.removeAttribute('onclick');
        btn1.innerHTML = 'Tutup';
        btn2.innerHTML = 'Tanggapan'
        btn2.setAttribute('onclick', `lihatTanggapan(${id})`);
    }else if(dataPengaduan[id].status === 'selesai'){
        btn1.setAttribute('data-bs-dismiss','modal');
        btn1.removeAttribute('onclick');
        btn1.innerHTML = 'Tutup';
        btn2.innerHTML = 'Tanggapan'
        btn2.setAttribute('onclick', `lihatTanggapan(${id})`);
    }else if(dataPengaduan[id].status === '0'){
        btn1.setAttribute('data-bs-dismiss','modal');
        btn1.innerHTML = 'Tutup';
        btn2.innerHTML = 'Tanggapi';
        btn2.setAttribute('onclick', `tulisTanggapan(${id})`);
    }
}

function btnTanggapan(id){
    $('.modal-backdrop').remove();
    lihatPengaduan(id);

}

function kirimTanggapan(id){
    const isi = document.getElementById('isiTanggapan').value
    const form = new FormData();
    form.append('id', id);
    form.append('tanggapan', isi);
    fetch('api/tanggapi.php', {
        method:'POST',
        body: form
    }).then(async (resp)=>{
        const json = await resp.json();
        if(json.status === true){
            document.getElementById('isiTanggapan').setAttribute('readonly', '');
            dataPengaduan[id] = json.data;
            EditStatusByID(id, json.data.status);
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Berhasil Ditanggapi',
                showConfirmButton: false,
                timer: 2000
            });

        }
    })
    
}

function readOnly(th){
    document.getElementById('tanggapan').setAttribute('readonly','');
    document.getElementById('tanggapan').value = unescapeHtml(document.getElementById(`isi-${id}`).innerHTML.match(/<span.*?>/g)?/(.*?)<span id=.*?>[\.]+<\/span><span .*?>(.*?)<\/span>/.exec(document.getElementById(`isi-${id}`).innerHTML).slice(1, 3).join(''):document.getElementById(`isi-${id}`).innerHTML);
}

function Hapus(id){
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
            fetch('api/hapus.php', {
                method:'POST',
                body: form
            }).then(async (resp)=>{
                const js = await resp.json();
                js.status && $(`#i${id}`).remove();
                Swal.fire({
                    position: 'top-end',
                    icon: js.status?'success':'error',
                    title: js.status?'Berhasil':'Gagal',
                    showConfirmButton: false,
                    timer: 2000
                })
            })
        }
    })
}

function selesai(id){
    const form = new FormData();
    form.append('id', id);
    fetch('api/selesai.php', {
        method: 'POST',
        body: form
    }).then(async (response)=>{
        if((await response.json()).status){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Berhasil',
                showConfirmButton: false,
                timer: 2000
            })

        }else{
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Gagal',
                showConfirmButton: false,
                timer: 2000
            })

        }
    })
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
          return `${escapeHtml(text.slice(0, 29))}<span>....</span><a data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="btnTanggapan(${id});" style="color: 6F4EF2;">baca selengkapnya</a>`;
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
  function createCard(image_url, tanggal, isi, status, id, avatar, author)
  {
        const split = tanggal.split(' ')[0].split('-')
        const tgl = tanggal.match('-')?`${split[2]}, ${monthNum2Str(parseInt(split[1])-1)} ${split[0]}`:tanggal;
      return `
      <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-6 col-sm-12 d-xs-flex justify-content-center" id="i${id}" style="animation: fadeInDown;animation-duration: 1s;">
                    <div class="card items">
                        <div class="card-body">
                            <div class="items-img position-relative"><img src="../gambar-aduan/${image_url}" width="100%" class="img-fluid rounded mb-3" alt=""><img src="${avatar}" class="creator" width="50" alt=""></div>
                            <h4 class="card-title">${author}</h4>
                            <p>${isi.length > 29 ?buatSelengkapnya(isi, id):isi}</p>
                            <div class="d-flex justify-content-between">
                                <div class="text-start">
                                    <p class="mb-2">Tanggal</p>
                                    <h5 class="text-muted">${tgl}</h5>
                                </div>
                                <div class="text-end">
                                    <p class="mb-2">Status : <strong class="text-primary" id="status-${id}">${status}</strong></p>
                                </div>
                            </div>
                             <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="btnTanggapan(${id});">
                                                ${status === "0"?'<i class="ri-chat-new-line">  </i>Tanggapi':'<i class="ri-chat-check-line">  </i>Tanggapan'}
                                            </a>
                            <a onclick="Hapus('${id}');" id="button2btn" class="btn btn-secondary">
                            <i class="ri-delete-bin-5-line"></i> Hapus</a>
                        </div>
                    </div>
                </div>
      `
  }

  function EditStatusByID(id, status){
        document.getElementById(`status-${id}`).innerText = status;
  }

/**
 * @param {number} num
 */
function monthNum2Str(num){
    const month = [
        "Januari", "Februari", "Maret",
        "April", "Mei", "Juni",
        "Juli", "Agustus", "September",
        "Oktober", "November", "Desember"
    ];
    return month[num]
}


$(document).ready(()=>{
    var status = '';
    function pengaduan(){
        const form = new FormData();
        if(status)form.append('status', status);
        console.log(form);
        form.append('offset', Object.keys(dataPengaduan).length);
        fetch('api/data.php',{
            method:'POST',
            body: form
        }).then(async (resp)=>{
            const json = await resp.json();
            for(let x of json){
                if(!(x.id in dataPengaduan)){
                    dataPengaduan[x.id] = x;
                    $('#pengaduan').append(createCard(x.foto, x.tgl, x.isi, x.status, x.id, `../images/avatar/${x.avatar}`, x.nama));
                }
            }
        })
    }
    pengaduan();
    document.addEventListener('scroll', (x) => {
        console.log(x);
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight){
            pengaduan();
            console.log('end');
        }
    })
    document.getElementById('filter').onchange = elm => {
        $('#pengaduan').empty();
        dataPengaduan = {};
        status = elm.target.value;
        pengaduan();
    }

})