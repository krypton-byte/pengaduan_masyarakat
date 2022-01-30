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
    function addItem(id, name, NIK, username, phone){
        $('tbody').append(`<tr id="id${id}">
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-grow-1">
                                                                <h6 class="mb-0" id="name${id}">${name}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>${NIK}</td>
                                                    <td>${username}</td>
                                                    <td>${phone}</td>
                                                    <td style="text-align:center;">
                                                        <button onclick="hapus(${id});" class="btn btn-outline-primary"><i class="ri-information-line"></i> Hapus</button>
                                                    </td>
                                                </tr>
        `);
    }
</script>
<?php
include 'components/footer.php';
?>