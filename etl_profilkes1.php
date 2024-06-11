<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ETL - PROFILKES</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.1/font/bootstrap-icons.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <!-- <h1>ETL - PROFILKES</h1> -->
        <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark mb-3" style="background-color: #66CDAA; border-color: 66CDAA;">
            <div class="container-fluid">
                <a class="navbar-brand mb-0 h1 navbar-light"><i class="bi bi-globe"></i> ETL - PROFILKES</a>
                <ul class="nav nav-underline justify-content-end" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="etlprocess-tab" data-bs-toggle="tab" data-bs-target="#etlprocesstabpanel" type="button" role="tab" aria-controls="etlprocesstabpanel" aria-selected="true" style="color: white;"><i class="bi bi-list"></i> ETL-Process</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#infotabpanel" type="button" role="tab" aria-controls="infotabpanel" aria-selected="false" style="color: white;"><i class="bi bi-info-circle-fill"></i> Info</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="tab-content"> <!-- tabcontent -->
        <!-- tabpanel ETL PROCESS -->
        <div class="tab-pane fade show active" id="etlprocesstabpanel" role="tabpanel" aria-labelledby="etlprocess-tab">
        <div class="row px-3">
            <div class="card" style="border-color: #66CDAA;"> <!-- Card ETL PROCESS -->
                <div class="card-header" style=" color: white; background-color: #66CDAA; border-color: #66CDAA;"> <!-- Card HEADER ETL PROCESS -->
                    ETL Process
                </div> <!-- Card HEADER ETL PROCESS -->
                <div class="card-body"> <!-- Card  BODY ETL PROCESS -->
                <div class="col-lg-12 col-md-auto col-sm-12">

                <form action="#" method="POST">
                <div class="row">
                <div class="col-lg-3 col-md-auto col-sm-12">
                    <h5 class="text" for="urlProfilkes" style="color: black;">URL Profilkes</h5>
                    <input id="urlProfilkes" class="form-control" type="text" placeholder="Ketik URL" aria-label="urlprofilkes">
                    <button class="btn" id="loadButton" type="submit" style="background-color: #66CDAA; border-color: 66CDAA;">Cari data</button>
                    <!-- Ajax loader -->
                    <!-- <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                        <span class="visually-hidden">Loading...</span>
                    </div> -->
                </div>
                    <div class="col-lg-3 col-md-auto col-sm-12">
                    <h5 class="text" style="color: black;">Wilayah Profilkes</h5>
                        <select id='wilayahDropdown' class='form-select'>
                            <option selected>Pilih wilayah</option>
                        </select>
                        
                        <!-- Ajax loader -->
                        <!-- <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                                <span class="visually-hidden">Loading...</span>
                        </div> -->
                    </div>
                    <div class="col-lg-3 col-md-auto col-sm-12">
                        <h5 class="text" style="color: black;">Tahun</h5>
                        <div class='container-fluid'>
                            <div class='row'>
                                <div class='col'>
                                    <select id='tahunDropdown' class='form-select' onchange='getTahun(this.value)'>
                                        <option selected>Pilih tahun</option>";
                                    </select>
                                    <!-- <div id='loader' class='spinner-border text-light' role='status' style='display: none;'>
                                        <span class='visually-hidden'>Loading...</span>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                            <?php 
                            
                            ?>
                    </div>
                </div>
                    <div class="row mt-2 mb-2">
                        <div class="col-lg-6 col-md-auto col-sm-12">
                            <h5 class="text" style="color: black;">Dataset</h5>
                            <select id='datasetDropdown' class='form-select' onchange='getDataset(this.value)'>
                                <option selected>Pilih dataset</option>
                            </select>
                        <!-- Ajax loader -->
                        <!-- <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                            <span class="visually-hidden">Loading...</span>
                        </div> -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-12 col-md-auto col-sm-12 mt-3">
                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="extract-tab" data-bs-toggle="tab" data-bs-target="#extracttabpanel" type="button" role="tab" aria-controls="extracttabpanel" aria-selected="true">1. Extract</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="trasform-tab" data-bs-toggle="tab" data-bs-target="#trasformtabpanel" type="button" role="tab" aria-controls="trasformtabpanel" aria-selected="false">2. Transform</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="load-tab" data-bs-toggle="tab" data-bs-target="#loadtabpanel" type="button" role="tab" aria-controls="loadtabpanel" aria-selected="false">3. Load</button>
                    </li>
                </ul>           
                <div class="tab-content">
                    <!-- tabpanel 1 -->
                    <div class="tab-pane fade show active" id="extracttabpanel" role="tabpanel" aria-labelledby="extract-tab">
                        <div class="card  mb-3" style="border-color: #66CDAA;">
                            <h5 class="card-header" style="background-color: #66CDAA; border-color: #66CDAA;">Tabel Dataset</h5>
                            <div class="card-body">
                                <div class='col'>
                                    <div id='tabledata' class='table-responsive'></div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- akhir tabpanel 1 -->

                    <!-- tabpanel 2 -->
                    <div class="tab-pane fade" id="trasformtabpanel" role="tabpanel" aria-labelledby="trasform-tab">
                    <div class="row mb-3">
                        <div class="col-lg-3 col-md-auto col-sm-12">
                            <h5 class="text" style="color: black;">URL SatuData</h5>
                            <input class="form-control" type="text" placeholder="Ketik URL" aria-label="urlsatudata">
        
                            <!-- Ajax loader -->
                            <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                                    <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-auto col-sm-12">
                            <h5 class="text" style="color: black;">Key App SatuData</h5>
                            <input class="form-control" type="text" placeholder="Ketik Key App" aria-label="keyappsatudata">
        
                            <!-- Ajax loader -->
                            <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                                    <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-auto col-sm-12">
                            <h5 class="text" style="color: black;">Tahun SatuData</h5>
                            <input class="form-control" type="text" placeholder="2023" aria-label="default input example" disabled>
        
                            <!-- Ajax loader -->
                            <!-- <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                                    <span class="visually-hidden">Loading...</span>
                            </div> -->
                        </div>
                        <div class="col-lg-6 col-md-auto col-sm-12 mt-2">
                            <h5 class="text" style="color: black;">Cari Dataset SatuData</h5>
                            <form class="d-flex" role="search">
                                <input type="search" class="form-control" placeholder="Search"  aria-label="Search" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2"><i class="bi bi-search"></i></span>
                                    <!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
                                    <button class="btn btn-success" class="bi bi-search" type="submit">Find</button>
                            </form>
        
                            <!-- Ajax loader -->
                            <!-- <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                                    <span class="visually-hidden">Loading...</span>
                            </div> -->
                        </div>
                    
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-auto col-sm-12">
                                <div class="card mb-3" style="border-color: #66CDAA;">
                                    <h5 class="card-header" style="color: white; background-color: #66CDAA; border-color: #66CDAA;">Kolom Dataset Profilkes</h5>
                                    <div class="card-body">
                                        <form id="selectFrom"> <!-- Ubah id formulir agar unik -->
                                            <div class="mb-3">
                                            <!-- <label for="tahunDropdown" class="form-label">Tahun:</label>
                                            <select id="tahunDropdown" class="form-select">
                                                <option selected>Pilih Tahun</option>
                                                <?php
                                                
                                                ?>
                                            </select> -->
                                                <?php
                                                    // Tentukan header tabel secara manual (gantilah dengan header yang sesuai)
                                                    // $headers = array("1", "2", "3", "4");
                                                    
                                                    // Mulai membuat dropdown
                                                    echo "<select id='filterDropdown1' class='form-select' multiple>"; // Ubah id dropdown agar unik
                                                

                                                    // Loop melalui setiap header dan tambahkan sebagai opsi dropdown
                                                    foreach ($headers as $header) {
                                                        echo "<option value='" . $header . "'>" . $header . "</option>";
                                                    }

                                                    echo "</select>"; // Selesai dropdown
                                                ?>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- col-5-->
                            <div class="col-lg-1 col-md-auto col-sm-12 align-self-center text-center">
                                <div class="mb-2">
                                    <button type="button" id="moveRight" class="btn btn-primary" style="background-color: #66CDAA; border-color: #66CDAA;">&gt;&gt;</button>
                                </div>
                                <div class="mb-2">
                                    <button type="button" id="moveLeft" class="btn btn-primary" style="background-color: #66CDAA; border-color: #66CDAA;">&lt;&lt;</button>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-auto col-sm-12">
                                <div class="card mb-3" style="border-color: #66CDAA;">
                                    <h5 class="card-header" style="color: white; background-color: #66CDAA; border-color: #66CDAA;">Transform Fields</h5>
                                    <div class="card-body">
                                        <form id="#selectTo"> <!-- Ubah id formulir agar unik -->
                                            <div class="mb-3">
                                                
                                            
                                                <?php
                                                    // Tentukan header tabel secara manual (gantilah dengan header yang sesuai)
                                                    
                                                    $headers = array();

                                                    // Mulai membuat dropdown
                                                    echo "<select id='filterDropdown2' class='form-select' multiple>"; // Ubah id dropdown agar unik
                                                    
                                                    // Loop melalui setiap header dan tambahkan sebagai opsi dropdown
                                                    foreach ($headers as $header) {
                                                        echo "<option value='" . $header . "'>" . $header . "</option>";
                                                    }
                                                    echo "</select>"; // Selesai dropdown
                                                ?>
                                            
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- col-3 -->
                            <div class="col-lg-2 col-md-auto col-sm-12 align-self-center text-center">
                                <div class="mb-2">
                                    <button type="button" id="" class="btn btn-primary" style="background-color: #66CDAA; border-color: #66CDAA;">Match</button>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-auto col-sm-12">
                                <div class="card mb-3" style="border-color: #66CDAA;">
                                    <h5 class="card-header" style="color: white; background-color: #66CDAA; border-color: #66CDAA;">Kolom Dataset SatuData</h5>
                                    <div class="card-body">
                                        <form id="#selectTo"> <!-- Ubah id formulir agar unik -->
                                            <div class="mb-3">
                                                <!-- <label for="filterInput" class="form-label multiple">Hasil:</label> -->
                                            
                                                <?php
                                                    // Tentukan header tabel secara manual (gantilah dengan header yang sesuai)
                                                    
                                                    $headers = array();

                                                    // Mulai membuat dropdown
                                                    echo "<select id='filterDropdown2' class='form-select' multiple>"; // Ubah id dropdown agar unik
                                                    
                                                    // Loop melalui setiap header dan tambahkan sebagai opsi dropdown
                                                    foreach ($headers as $header) {
                                                        echo "<option value='" . $header . "'>" . $header . "</option>";
                                                    }
                                                    echo "</select>"; // Selesai dropdown
                                                ?>
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- col-3 -->
                        </div> <!-- row -->
                    </div> <!-- akhir tabpanel 2-->
                    
                    <!-- tabpanel 3 -->
                    <div class="tab-pane fade" id="loadtabpanel" role="tabpanel" aria-labelledby="load-tab">
                        <div class="row">
                            <div class="col-lg-12 col-md-auto col-sm-12">
                                <div class="card mb-3" style="border-color: #66CDAA;">
                                    <h5 class="card-header" style="background-color: #66CDAA; border-color: #66CDAA;">Load Tabel</h5>
                                    <div class="card-body">
                                        
                                    </div>
                                </div>
                            </div> <!-- col-6 -->
                        </div> <!-- row -->
                    </div> <!-- akhir tabpanel 3-->
                </div> <!-- akhir tab-content -->
                </div> <!-- akhir col-12 -->
                </div> <!-- Card  BODY ETL PROCESS -->
            </div> <!-- Card ETL PROCESS -->
        </div> <!-- akhir row -->
        </div> <!-- akhir Tabpanel ETL PROCESS -->
        <!-- tabpanel INFO -->
        <div class="tab-pane fade" id="infotabpanel" role="tabpanel" aria-labelledby="info-tab">
            <div class="row px-3">
            <div class="card"> <!-- Card INFO -->
                <div class="card-header" style="color: white; background-color: #66CDAA; border-color: #66CDAA;"> <!-- Card HEADER INFO -->
                    Info
                </div> <!-- Card HEADER ETL PROCESS -->
                <div class="card-body"> <!-- Card  BODY INFO -->
                <p class="card-text">
                Dalam upaya meningkatkan pengelolaan data kesehatan di Aceh, Dinas Kesehatan Aceh (Dinkes) telah mengembangkan aplikasi Profil Kesehatan (Profilkes), yang berisi lebih dari 80 dataset standar yang ditentukan oleh Kementerian Kesehatan (Kemenkes). Aplikasi ini mencakup berbagai bentuk capaian dan data dasar kesehatan di tingkat Provinsi, Kota, dan Kabupaten. Setiap tahun, Dinkes Aceh mengkoordinasikan pengisian data Profilkes oleh Dinkes Kabupaten/Kota untuk data dari tahun 2019 hingga 2023. Selain itu, Pemerintah Aceh melalui UPTD Statistik mengelola Portal Satu Data (SatuData) sebagai pusat pengumpulan data sektoral dari berbagai Satuan Kerja Pemerintah Aceh (SKPA), termasuk Dinas Kesehatan Aceh.
                <p>Untuk memastikan data dalam aplikasi Profilkes dan Portal Satu Data tetap sinkron dan terhindar dari pengulangan pengisian data, diperlukan aplikasi yang dapat melakukan proses ekstraksi (extract), transformasi (transform), dan pemuatan (load) data secara otomatis dari Profilkes ke SatuData. Aplikasi ini dikenal dengan istilah ETL (Extract, Transform, Load) dan akan berbasis web untuk efisiensi, akurasi, dan otomatisasi dalam integrasi data antara Profilkes dan SatuData, mendukung pengambilan keputusan yang lebih baik berdasarkan data kesehatan yang terkini dan terpercaya.
                </p>
                Tujuan dari pengembangan aplikasi ETL berbasis web ini adalah untuk menghasilkan sistem yang dapat melakukan ekstraksi, transformasi, dan pemuatan dataset dari Web Profilkes ke Web SatuData secara otomatis. Dengan demikian, aplikasi ini akan mengurangi waktu dan sumber daya yang diperlukan untuk pengisian data secara manual, mengurangi risiko kesalahan data akibat pengisian manual, dan meningkatkan transparansi serta keterbukaan informasi.
                Manfaat signifikan dari pengembangan aplikasi ini termasuk peningkatan akurasi dan keandalan data kesehatan, efisiensi operasional Dinas Kesehatan Aceh, serta pengurangan pekerjaan administratif terkait pengelolaan data. Selain itu, aplikasi ini akan meningkatkan aksesibilitas data kesehatan bagi publik dan pemangku kepentingan, mendukung inisiatif SatuData Aceh dalam menyediakan data yang terintegrasi dan mudah diakses.
                </p>
                </div> <!-- Card  BODY INFO -->
            </div> <!-- Card INFO -->
            </div>
        </div> <!-- akhir tabpanel INFO -->
        </div> <!-- akhir Tabcontent -->
        </div> <!-- akhir container -->
        
        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="d-none position-fixed top-0 start-0 w-100 h-100 d-flex justify-content-center align-items-center bg-white bg-opacity-75">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="container-flex bg-secondary px-3">
        <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
            <div class="col-lg-3 col-md-auto col-sm-12 mb-3">
            <h5 class="text-dark"><i class="bi bi-globe"></i> ETL - PROFILKES </h5>
            </div>

            <div class="col-lg-1 col-md-auto col-sm-12 mb-2">
            </div>

            <div class="col-lg-1 col-md-auto col-sm-12 mb-2">
            </div>

            <div class="col-lg-3 col-md-auto col-sm-12 mb-3">
            <h5>Link Website</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">OpenData</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">SatuData</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">GeoPortal</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pintu</a></li>
            </ul>
            </div>

            <div class="col-lg-3 col-md-auto col-sm-12 mb-3">
            <h5>Kontak Kami</h5>
            <ul class="nav flex-column">
                <li class="nav-item"><p>UPTD Statistik Diskominsa Aceh</p></li>
                <!-- <li class="nav-item"><p></p></li> -->
                <li class="nav-item"><p> Gedung Sentra Telematika Aceh Jl. Teungku Cot Plieng No.48, Kota Baru, Kec. Kuta Alam, Kota Banda Aceh</p></li>
            </ul>
            </div>
        </footer>
        </div>
        <div class="fixed-bottom text-light bg-dark py-2">
        Dikelola oleh UPTD Statistik Diskominsa Aceh
        </div>

    <script>
    // Script Ajax dengan menggunakan jQuery
    $(document).ready(function() {
        var urlProfilkes = $('#urlProfilkes');

        $('#loadButton').click(function() {
            event.preventDefault();
            inputApiURL();
        });

        function inputApiURL() {
            var urlProfilkesValue = urlProfilkes.val();

            $.ajax({
                url: "getWilayahProfilkes.php",
                type: "GET",
                data: { urlProfilkes: urlProfilkesValue },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    // Kosongkan dropdown sebelum menambahkan opsi baru
                    $('#wilayahDropdown').empty();

                    
                    // Tambahkan opsi default
                    $('#wilayahDropdown').append('<option value="">Pilih Wilayah</option>');
                    $('#wilayahDropdown').append('<option value="11">Provinsi Aceh</option>');

                    // Tambahkan opsi untuk setiap entri dalam data
                    $.each(response, function(index, response) {
                        console.log(response);
                        $('#wilayahDropdown').append(
                            '<option value="' + response.kode_wilayah + '">' + response.nama + '</option>');
                    });
                
                },
                error: function(xhr, status, error) {
                    console.error("Gagal mengambil data wilayah:", error);
                    
                }
            });
        }

        // Ketika dropdown subkategori dipilih
        $('#wilayahDropdown').change(function() {
                var selectedWilayah = $(this).val();
                var urlProfilkesValue = $('#urlProfilkes').val();
                
                // showLoadingModal();
                $.ajax({
                    url: "getTahun.php",
                    type: "GET",
                    data: { kode_wilayah: selectedWilayah, urlProfilkes: urlProfilkesValue },
                    dataType: "json",
                    success: function(response) {
                        // $('#subjectDropdown').html(response);
                        // Pastikan dropdown kosong sebelum menambahkan opsi baru
                        $('#tahunDropdown').empty();
                        

                            // Tambahkan opsi default
                            $('#tahunDropdown').append('<option value="">Pilih Tahun</option>');
                            
                            // Loop melalui data dan tambahkan setiap subjek sebagai opsi
                            $.each(response, function(index, tahun) {
                                console.log(response);
                                $('#tahunDropdown').append(
                                    '<option value="' + tahun.tahun + '">' + tahun.tahun + '</option>'
                                );
                            });

                    },
                    error: function(xhr, status, error) {
                        console.error("Gagal mengambil data tahun:", error);
                    }
                });
                
            });
            // Global AJAX event handlers
            $(document).ajaxStart(function() {
                $('#loadingSpinner').removeClass('d-none');
            });

            $(document).ajaxComplete(function() {
                $('#loadingSpinner').addClass('d-none');
            });
    });
        
        // $('#moveRight').click(function() {
        //         $('#selectFrom option:selected').appendTo('#selectTo');
        //     });

        //     $('#moveLeft').click(function() {
        //         $('#selectTo option:selected').appendTo('#selectFrom');
        //     });

        //     // Fungsi untuk menampilkan modal
        //     function showLoadingModal() {
        //         $('#loadingModal').modal('show');
        //     }

        //     // Fungsi untuk menyembunyikan modal
        //     function hideLoadingModal() {
        //         $('#loadingModal').modal('hide');
        //     }

            
 
        // function get_profilkescurl($url) {
        //     $ch = curl_init($url);
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //     $response = curl_exec($ch);
        //     curl_close($ch);
        //     return json_decode($response);
        // }
        // function get_wilayah($url) {
        //     $url ="https://profilkes.acehprov.go.id/api/kode_wilayah";
        //     return get_profilkescurl($url);
        // }

        // function get_tahun(){
        //     $url = "https://profilkes.acehprov.go.id/api/tahun";
        //     $response = get_profilkescurl($url);
        //     return $response;
        // };

        // // Panggil fungsi untuk mendapatkan data tahun dan simpan dalam variabel $test
        // $test = get_tahun();

        // function get_dataset($tahun = null){
        //     $url = "https://profilkes.acehprov.go.id/api/dataset?tahun={$tahun}";
        //     $response = get_profilkescurl($url);
        //     return $response;
        // };
        
        // let urlInput = '';
        // // Event listener untuk memeriksa validitas URL saat pengguna mengetik
        // document.getElementById("urlProfilkes").addEventListener("input", function() {
        //     urlInput = this.value;
            
        //     // Jika URL valid, tampilkan pesan sukses
        //     const apiUrl = `${urlInput}/api/kode_wilayah`;
        //     fetch(apiUrl).then((response)=>{
        //         if (!response.ok) {
        //             throw new Error('Network response was not ok');
        //         }
        //         return response.json();
        //     }).then((data)=>{
        //         console.log(data);
        //         updateDropdown(data);
        //     })
        //     });
        //     function updateDropdown(data) {
        //         // Temukan dropdown dan bersihkan opsi sebelum menambahkan yang baru
        //         var dropdown = document.getElementById('wilayahDropdown');
        //         dropdown.innerHTML += "<option>Provinsi Aceh</option>"

        //         // Buat opsi baru untuk setiap entri dalam data
        //         data.forEach((response) => {
        //             var option = document.createElement('option');
        //             option.value = response.kode_wilayah; // Sesuaikan dengan properti kode wilayah dalam objek JSON
        //             option.text = response.nama; // Sesuaikan dengan properti nama wilayah dalam objek JSON
        //             dropdown.add(option);
        //         });
        // };

        // // Fungsi untuk memperbarui dropdown Tahun berdasarkan pilihan wilayah yang dipilih
        // function updateTahunDropdown(wilayah) {
        //     // Lakukan fetch API untuk mendapatkan data tahun berdasarkan wilayah
        //     const url = `${urlInput}/api/tahun?wilayah=${wilayah}`;
        //     fetch(url)
        //     .then((response) => {
        //         if (!response.ok) {
        //             throw new Error('Network response was not ok');
        //         }
        //         return response.json();
        //     })
        //     .then((data) => {
        //         // Perbarui isi dropdown Tahun dengan data yang diterima dari API
        //         const tahunDropdown = document.getElementById('tahunDropdown');
        //             tahunDropdown.innerHTML = '<option selected>Pilih tahun</option>';
        //             data.forEach(item => {
        //                 const option = document.createElement('option');
        //                 option.value = item.tahun;
        //                 option.text = item.tahun;
        //                 tahunDropdown.add(option);
        //             });
                
        //     })
        //     .catch((error) => {
        //         console.error('There was a problem with the fetch operation:', error);
        //         // Jika ada masalah dengan fetch, kosongkan dropdown Tahun
        //         var tahunDropdown = document.getElementById('tahunDropdown');
        //         tahunDropdown.innerHTML = "<option selected>Pilih tahun</option>";
        //     });
        // }

        // // Event listener untuk memperbarui dropdown Tahun ketika pilihan dropdown Wilayah Profilkes berubah
        // document.getElementById("wilayahDropdown").addEventListener("change", function() {
        //     var wilayah = this.value;
        //     updateTahunDropdown(wilayah);
        // });

        // // Fungsi untuk mendapatkan dataset berdasarkan tahun yang dipilih
        // function getTahun(tahun) {
        //     // Menampilkan spinner loader
        //     var loader = document.getElementById("loader");
        //     loader.style.display = "inline-block";
        //     // Lakukan fetch API untuk mendapatkan dataset berdasarkan tahun
        //     const url = `${urlInput}/api/dataset?tahun=${tahun}`;
        //     fetch(url)
        //     .then((response) => {
        //         if (!response.ok) {
        //             throw new Error('Network response was not ok');
        //         }
        //         return response.json();
        //     })
        //     .then((data) => {
        //         // Lakukan sesuatu dengan dataset yang diperoleh
        //         console.log(data);
        //     })
        //     .catch((error) => {
        //         console.error('There was a problem with the fetch operation:', error);
        //     });
        //     // Menyembunyikan spinner loader setelah request selesai
        //     loader.style.display = "none";
        // }


        // function getTahun(tahun) {
        //     var datasetDropdown = document.getElementById("datasetDropdown");
        //     datasetDropdown.innerHTML = "<option selected>Loading...</option>";

        //     // Menampilkan spinner loader
        //     var loader = document.getElementById("loader");
        //     loader.style.display = "inline-block";

        //     // Buat request untuk mengambil data dataset berdasarkan tahun yang dipilih
        //     var xhr = new XMLHttpRequest();
        //     xhr.onreadystatechange = function() {
        //         if (xhr.readyState == 4) {
        //             if (xhr.status == 200) {
        //                 var response = JSON.parse(xhr.responseText);
        //                 datasetDropdown.innerHTML = "<option selected>Pilih dataset</option>";
        //                 response.forEach(function(dataset) {
        //                     var option = document.createElement("option");
        //                     option.value = dataset.slug;
        //                     option.text = dataset.nama;
        //                     datasetDropdown.appendChild(option);
        //                 });
        //             } else {
        //                 datasetDropdown.innerHTML = "<option selected>Error</option>";
        //             }
        //             // Menyembunyikan spinner loader setelah request selesai
        //             loader.style.display = "none";
        //         }
        //     };
        //     xhr.open("GET", "https://profilkes.acehprov.go.id/api/dataset?tahun=" + tahun, true);
        //     xhr.send();
        // }
        // function updateDatasetDropdown(tahun) {
        // var url = urlInput + "api/dataset?tahun=" + tahun;
        // fetch(url)
        // .then(response => response.json())
        // .then(data => {
        //     var datasetDropdown = document.getElementById('datasetDropdown');
        //     datasetDropdown.innerHTML = "<option selected>Pilih dataset</option>";
        //     data.forEach(item => {
        //         datasetDropdown.innerHTML += "<option value='" + item.slug + "'>" + item.nama + "</option>";
        //     });
        // })
        // .catch(error => console.error('Error:', error));
        // }


    // Fungsi untuk mendapatkan kode wilayah berdasarkan slug dataset yang dipilih
    function getDataset(slug) {
            const tahun = document.getElementById("tahunDropdown").value;
            const url = `${urlInput}/api/data/?slug=${slug}&tahun=${tahun}`;
            const xhr = new XMLHttpRequest();
            const loader = document.getElementById("loader");
            loader.style.display = "inline-block";

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        const response = JSON.parse(xhr.responseText);
                        console.log('Dataset:', response);  // Debug log
                        if (response && response.length > 0) {
                            let tableHtml = "<table class='table table-bordered border-dark table-striped'>";
                            tableHtml += "<thead><tr>";
                            for (const key in response[0]) {
                                tableHtml += `<th>${key}</th>`;
                            }
                            tableHtml += "</tr></thead><tbody class='table-group-divider'>";
                            response.forEach(data => {
                                tableHtml += "<tr>";
                                for (const key in data) {
                                    tableHtml += `<td>${data[key]}</td>`;
                                }
                                tableHtml += "</tr>";
                            });
                            tableHtml += "</tbody></table>";
                            document.getElementById("tabledata").innerHTML = tableHtml;
                        } else {
                            document.getElementById("tabledata").innerHTML = "<p>Tidak ada data</p>";
                        }
                    } else {
                        document.getElementById("tabledata").innerHTML = "<p>Error fetching data.</p>";
                    }
                    loader.style.display = "none";
                }
            };
            xhr.open("GET", url, true);
            xhr.send();
        }

        // function getDataset(slug) {
        //     var tahun = document.getElementById("tahunDropdown").value;
        //     var xhr = new XMLHttpRequest();
            
        //     // Menampilkan spinner loader
        //     var loader = document.getElementById("loader");
        //     loader.style.display = "inline-block";
        //     //Menampilkan tabel
        //     xhr.onreadystatechange = function() {
        //         if (xhr.readyState == 4) {
        //             if (xhr.status == 200) {
        //                 var response = JSON.parse(xhr.responseText);
        //                 if (response && response.length > 0) {
        //                     var tableHtml = "<table class='table table-bordered border-dark table-striped'>";
        //                     tableHtml += "<thead><tr>";
        //                     for (var key in response[0]) {
        //                         tableHtml += "<th>" + key + "</th>";
        //                     }
        //                     tableHtml += "</tr></thead>";
        //                     tableHtml += "<tbody class='table-group-divider'>";
        //                     response.forEach(function(data) {
        //                         tableHtml += "<tr>";
        //                         for (var key in data) {
        //                             tableHtml += "<td>" + data[key] + "</td>";
        //                         }
        //                         tableHtml += "</tr>";
        //                     });
        //                     tableHtml += "</tbody></table>";
        //                     document.getElementById("tabledata").innerHTML = tableHtml;
        //                 } else {
        //                     document.getElementById("tabledata").innerHTML = "<p>Tidak ada datanya</p>";
        //                 }
        //             } else {
        //                 document.getElementById("tabledata").innerHTML = "<p>Error fetching data.</p>";
        //             }
        //             // Menyembunyikan spinner loader setelah request selesai
        //             loader.style.display = "none";
        //         }
        //     };
        //     xhr.open("GET", "https://profilkes.acehprov.go.id/api/data/?slug=" + slug + "&tahun=" + document.getElementById("tahunDropdown").value, true);
        //     xhr.send();
        // }

        // $('select').selectpicker();
        // $('#moveRight').click(function() {
        // $('#selectFrom option:selected').appendTo('#selectTo');
        // });

        // $('#moveLeft').click(function() {
        //     $('#selectTo option:selected').appendTo('#selectFrom');
        // });
        // $('#selectFrom').submit(function(event) {
        //     event.preventDefault(); // Menghentikan perilaku default saat mengirim formulir
        //     var filterValue = $('#filterInput').val(); // Ambil nilai filter dari input
        //     // Lakukan permintaan AJAX untuk memperbarui tabel dengan filter yang diterapkan
        //     showLoadingModal(); // Tampilkan modal loading
        //     var slug = $("#datasetDropdown").val(); // Mengambil slug dataset yang dipilih
        //     $.ajax({
        //         url: "https://profilkes.acehprov.go.id/api/data",
        //         type: "GET",
        //         data: {
        //             slug: slug,
        //             tahun: $("#tahunDropdown").val(),
        //             filter: filterValue
        //         },
        //         success: function(response) {
        //             if (response && response.length > 0) {
        //                 var tableHtml = "<table class='table table-striped'>";
        //                 tableHtml += "<thead><tr>";
        //                 for (var key in response[0]) {
        //                     tableHtml += "<th>" + key + "</th>";
        //                 }
        //                 tableHtml += "</tr></thead>";
        //                 tableHtml += "<tbody>";
        //                 response.forEach(function(data) {
        //                     tableHtml += "<tr>";
        //                     for (var key in data) {
        //                         tableHtml += "<td>" + data[key] + "</td>";
        //                     }
        //                     tableHtml += "</tr>";
        //                 });
        //                 tableHtml += "</tbody></table>";
                        
        //                 $("#tabledata").html(tableHtml);
        //             } else {
        //                 $("#tabledata").html("<p>Tidak ada datanya</p>");
        //             }$('#filterForm').submit(function(event) {
        //                 event.preventDefault(); // Menghentikan perilaku default saat mengirim formulir
        //                 var filterValue = $('#filterInput').val(); // Ambil nilai filter dari input
        //                 // Lakukan permintaan AJAX untuk memperbarui tabel dengan filter yang diterapkan
        //                 showLoadingModal(); // Tampilkan modal loading
        //                 var slug = $("#datasetDropdown").val(); // Mengambil slug dataset yang dipilih
        //                 $.ajax({
        //                     url: "https://profilkes.acehprov.go.id/api/data",
        //                     type: "GET",
        //                     data: {
        //                         slug: slug,
        //                         tahun: $("#tahunDropdown").val(), // Tambahkan tahun yang dipilih ke dalam data
        //                         filter: filterValue
        //                     },
        //                     success: function(response) {
        //                         if (response && response.length > 0) {
        //                             var tableHtml = "<table class='table table-striped'>";
        //                             tableHtml += "<thead><tr>";
        //                             for (var key in response[0]) {
        //                                 tableHtml += "<th>" + key + "</th>";
        //                             }
        //                             tableHtml += "</tr></thead>";
        //                             tableHtml += "<tbody>";
        //                             response.forEach(function(data) {
        //                                 tableHtml += "<tr>";
        //                                 for (var key in data) {
        //                                     tableHtml += "<td>" + data[key] + "</td>";
        //                                 }
        //                                 tableHtml += "</tr>";
        //                             });
        //                             tableHtml += "</tbody></table>";

        //                             $("#tabledata").html(tableHtml);
        //                         } else {
        //                             $("#tabledata").html("<p>Tidak ada datanya</p>");
        //                         }
        //                         hideLoadingModal(); // Sembunyikan modal loading setelah selesai
        //                     },
        //                     error: function(xhr, status, error) {
        //                         console.error("Gagal memperbarui tabel dengan filter:", error);
        //                         hideLoadingModal(); // Sembunyikan modal loading jika terjadi kesalahan
        //                     }
        //                 });
        //             });
        //             hideLoadingModal(); // Sembunyikan modal loading setelah selesai
        //         },
        //         error: function(xhr, status, error) {
        //             console.error("Gagal memperbarui tabel dengan filter:", error);
        //             hideLoadingModal(); // Sembunyikan modal loading jika terjadi kesalahan
        //         }
        //     });
        // });
    </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-K+1/re0NMrn6n1pmzmgOy8cEwA1Zm6a5xkT1IC8OXXg=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>