<?php
session_start();
include 'components/header.php';
?>
<img src="" alt="" id="gambaran">
<canvas id="print" width="794px" style="overflow: hidden;">

</canvas>
<div class="container">
<div class="card">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.1/vfs_fonts.min.js" integrity="sha512-6RDwGHTexMgLUqN/M2wHQ5KIR9T3WVbXd7hg0bnT+vs5ssavSnCica4Uw0EJnrErHzQa6LRfItjECPqRt4iZmA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.3.0-beta.1/fonts/Roboto.min.js" integrity="sha512-pGCzTqMr/3jV+O3cu9KXYTO0/0UHJba6H09poX7vS66l4w73yalUZDb/u10WBVt9gtRI2dRcOoKPWriyqfV1hA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function escapeHtml(unsafe)
    {
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    function autoBR(text, length){
        return escapeHtml(text.slice(0, length)) + (text.slice(length)?('<br>' + autoBR(text.slice(length), length)):'');
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
          <td class="text-center">${autoBR(tanggal, 14)}</td>
          <td>${autoBR(NIK, 16)}</td>
          <td>${autoBR(nama, 10)}</td>
          <td>${autoBR(telp, 13)}</td>
          <td>${autoBR(aduan, 50)}</td>
          <td id="status">${status}</td>
        </tr>`)
    }
    function Print(){
        const img = new Image();
        html2canvas(document.getElementsByTagName('table')[0]).then((canvas)=>{
           const padding = 3;
           img.src=canvas.toDataURL("image/jpeg");
           const width = 790;
           const height = img.height/img.width*width;
           if(img.height && img.width){
            const canv = document.getElementById('print');
            const ctx = canv.getContext('2d');
            console.log({origgin: {width: width, height: height}})
            canv.height = height+padding > 1122 ? height+padding:1122;
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0,0, width+padding, canv.height);
            ctx.drawImage(img, padding, padding,width, height);
            pdfMake.createPdf({content: [
                {
                    image:canvas.toDataURL("image/jpeg"),
                    width: 500,
                }
            ]}).download('laporan.pdf');
           }

        });

    }
    document.getElementById('print').hidden = true
</script>
</div>
<?php
include 'components/footer.php';
?>