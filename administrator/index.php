<?php
  session_start();
  include 'components/header.php';
  
?>

<script src="js/script.js"></script>
<div class="container">
  <div class="row">
    <div class="col-xl-12">
      <div class="card m-0">
        <div class="card-body bs-0 bg-transparent p-0">
          <div class="row">
            <div class="col-xl-3 col-sm-6">
              <div class="stat-widget d-flex align-items-center">
                <div class="widget-icon me-3 bg-primary">
                  <span><i class="ri-user-3-line"></i></span>
                </div>
                <div class="widget-content">
                  <h3 id="jumlahpengguna"></h3>
                  <p>Pengguna</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6">
              <div class="stat-widget d-flex align-items-center">
                <div class="widget-icon me-3 bg-success">
                  <span><i class="ri-file-list-3-line"></i></span>
                </div>
                <div class="widget-content">
                  <h3 id="jumlahpengaduan">0</h3>
                  <p>Pengaduan</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6">
              <div class="stat-widget d-flex align-items-center">
                <div class="widget-icon me-3 bg-warning">
                  <span><i class="ri-quill-pen-line"></i></span>
                </div>
                <div class="widget-content">
                  <h3 id="jumlahproses">0</h3>
                  <p>Diproses</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6">
              <div class="stat-widget d-flex align-items-center">
                <div class="widget-icon me-3 bg-danger">
                  <span><i class="ri-check-double-line"></i></span>
                </div>
                <div class="widget-content">
                  <h3 id="jumlahselesai">0</h3>
                  <p>Selesai</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header">
          Graph
        </div>
        <div class="card-body bs-0 bg-transparent p-0">
          <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-12">
              <div class="card" id="user-activity" style="height: 300px;">
                <div class="card-body">
                <canvas id="chart" style="height: 280px;"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-12 my-3 my-md-0">
              <div class="card" id="piechart" style="height: 300px;">
                <div class="card-body">
                <canvas id="most-selling-items"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<?php
  include 'components/footer.php';
?>