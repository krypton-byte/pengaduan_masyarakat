<?php
  include 'components/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-xxl-3 col-xl-12">
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
    <div class="col-xxl-3 col-xl-12">
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

    <!-- <div class="col-12">
      <div class="card" style="height: 200 px;">
          <div class="card-body">
            <div class="row">
              <div class="d-flex col-xl-1 col-sm-2 my-auto justify-content-md-center">
                <h5>Filter</h5>
              </div>
              <div class="d-flex col-xl-11 col-sm-10">
                <select class="form-select"">
                  <option value="all" selected>Semua</option>
                  <option value="0">0</option>
                  <option value="proses">Proses</option>
                  <option value="selesai">Selesai</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    <div class="col-xxl-6 col-xl-8 col-lg-6"></div> -->
      <div class="row" id="pengaduan">
      </div>
    <div class="col-xxl-4 col-xl-12"></div>
  </div>
</div>

<?php
  include 'components/footer.php';
?>