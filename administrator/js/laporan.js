var dataPengaduan = [];
    function escapeHtml(unsafe)
    {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
    function klikCetak(){
        $('.modal-backdrop').remove();
    }
    function autoBR(text, length){
        return escapeHtml(text.slice(0, length)) + (text.slice(length)?('<br>' + autoBR(text.slice(length), length)):'');
    }
    function disableZeroValue(){
        if(document.getElementsByName('limit')[0].value == '0'){
            document.getElementById('limitcheckbox').click();
        }
    }
    function limitCheckBox(){
        if(document.getElementById('inputlimit')){
            $('#inputlimit').remove();
        }
        else{
            $('#modalBody').append(`
            <div class="mb-3" id="inputlimit">
                <input type="number" class="form-control" type="number" name="limit" onkeyup="disableZeroValue();">
        </div>`);
        }
    }
    function setBorderColor(color){
        Array.from(document.getElementsByTagName('td')).forEach(x => {
            x.style.border = `1px solid ${color}`;
        })
        Array.from(document.getElementsByTagName('th')).forEach(x => {
            x.style.border = `1px solid ${color}`;
        })
        document.getElementsByTagName('table')[0].style.border = `1px solid ${color}`;
    }
    $('span.light').on('click', ()=>setBorderColor('black'));
    $('span.dark').on('click', ()=>setBorderColor('white'));
    localStorage.theme && setBorderColor('white');
    function buatTable(NIK, tanggal, nama, username, telp, aduan, status){
        document.getElementById('table').insertAdjacentHTML('beforeend', `
        <tr>
          <td class="text-center">${autoBR(tanggal, 22)}</td>
          <td>${autoBR(NIK, 16)}</td>
          <td>${autoBR(nama, 10)}</td>
          <td>${autoBR(telp, 13)}</td>
          <td>${autoBR(aduan, 50)}</td>
          <td id="status">${status}</td>
        </tr>`)
    }
    function Cetak(){
        var dd = {
            pageSize:'A4',
            info:{
                author: 'Puja',
                title: 'Laporan Pengaduan',
                subject: 'Laporan Pengaduan',
                keyword: 'laporan'
            },
            content: [
                {text: 'LAPORAN PENGADUAN', fontSize: 16, alignment:'center', lineHeight: 2}, 
                {
                table: {
                    headerRows: 1,
                    widths: ['auto', 'auto', 60, 270, 40],
                    body: [
                        [{text: 'No', alignment:'center'}, {text: 'NIK', alignment:'center'}, {text: 'Nama', alignment: 'center'}, {text:'Aduan', alignment:'center'}, {text:'status', alignment: 'center'}]
                    ]
                }
                }
            ]
            };
        const form = new FormData();
        document.getElementsByName('limit')[0] && document.getElementsByName('limit')[0].value && form.append('limit', Number(document.getElementsByName('limit')[0].value));
        document.getElementById('statusaduan').value !== '' && form.append('status', document.getElementById('statusaduan').value);
        fetch('api/data.php', {
            method: 'POST',
            body: form
        }).then(async (resp)=>{
            const num2str = num => [
                "Januari", "Februari", "Maret",
                "April", "Mei", "Juni",
                "Juli", "Agustus", "September",
                "Oktober", "November", "Desember"
            ][num];
          const jsres = await resp.json();
          if(jsres.status !== false){
              jsres.forEach((x, y)=>{
                dd.content[1].table.body.push([
                    (y+1).toString(),
                    x.nik,
                    x.nama,
                    x.isi,
                    {text:x.status, alignment: 'center'}
                ])
              });
            const doc = pdfMake.createPdf(dd);
            switch(document.getElementById('method').value){
                case 'download':
                    doc.download('laporan pengaduan.pdf');
                    break;
                case 'open':
                    doc.open();
                    break;
                case 'print':
                    doc.print();
                    break;
                    
            }

          }  
        })
        


    }
    $(document).ready(()=>{
        const num2str = num => [
            "Januari", "Februari", "Maret",
            "April", "Mei", "Juni",
            "Juli", "Agustus", "Septeber",
            "Oktober", "November", "Desember"
        ][num];
        function tgl(s){
            const spl = s.split(' ')[0].split('-');
            return `${spl[2]} ${num2str(Number(spl[1])-1)} ${spl[0]}`
        }
        (function (){
            fetch('api/data.php', {method: 'POST'}).then(async (resp)=>{
                const js = await resp.json();
                if(js.status !== false){
                    js.forEach(x=>{
                        buatTable(x.nik, tgl(x.tgl), x.nama, x.username, x.telp, x.isi, x.status);
                    })
                }
            })
        })()
    })