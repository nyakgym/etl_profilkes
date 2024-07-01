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
                <div class="row">
                <!-- Form URL Profilkes -->
                <div class="col-lg-3 col-md-auto col-sm-12">
                    <h5 class="text" for="urlProfilkes" style="color: black;">URL Profilkes</h5>
                    <div class="input-group">
                        <input id="urlProfilkes" name="urlProfilkes" class="form-control" type="text" placeholder="Ketik URL" value="https://profilkes.acehprov.go.id/">
                        <button class="btn btn-success" id="loadButton" type="submit" style="background-color: #66CDAA; border-color: 66CDAA;">Cari data</button>
                    </div>
                </div>

                <!-- Dropdown Wilayah Profilkes -->
                    <div class="col-lg-3 col-md-auto col-sm-12">
                    <h5 class="text" style="color: black;">Wilayah Profilkes</h5>
                        <select id='wilayahDropdown' class='form-select'>
                            <option selected>Pilih Wilayah</option>
                        </select>
                    </div>
                <!-- Dropdown Tahun Profilkes -->
                    <div class="col-lg-3 col-md-auto col-sm-12">
                        <h5 class="text" style="color: black;">Tahun Profilkes</h5>
                        <div class='container-fluid'>
                            <div class='row'>
                                <div class='col'>
                                    <select id='tahunDropdown' class='form-select'>
                                        <option selected>Pilih Tahun</option>";
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Dropdown Dataset Profilkes -->
                    <div class="row mt-2 mb-2">
                        <div class="col-lg-6 col-md-auto col-sm-12">
                            <h5 class="text" style="color: black;">Dataset Profilkes</h5>
                            <select id='datasetDropdown' class='form-select'>
                                <option selected>Pilih dataset</option>
                            </select>
                        </div>
                    </div>
            </div>
            <!-- Tab Extract, Transform, Load -->
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

                <!-- Tabpanel -->
                <div class="tab-content">
                    <!-- Tabpanel Extract -->
                    <div class="tab-pane fade show active" id="extracttabpanel" role="tabpanel" aria-labelledby="extract-tab">
                        <div class="card  mb-3" style="border-color: #66CDAA;">
                            <h5 class="card-header" style="background-color: #66CDAA; border-color: #66CDAA;">Tabel Dataset</h5>
                            <div class="card-body"> 
                                <div class='col'>
                                    <div id='tabledata' class='table-responsive'></div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- akhir tabpanel Extract -->

                    <!-- Tabpanel Transform -->
                    <div class="tab-pane fade" id="trasformtabpanel" role="tabpanel" aria-labelledby="trasform-tab">
                        <div class="row mb-3">
                            <div class="col-lg-3 col-md-auto col-sm-12">
                                <h5 class="text" style="color: black;">URL SatuData</h5>
                                <input id="apiUrlSatudata" name="apiUrlSatudata" class="form-control" type="text" placeholder="Ketik URL" aria-label="urlsatudata" value="https://satudata.latih.id/">
                            </div>
                            <div class="col-lg-3 col-md-auto col-sm-12">
                                <h5 class="text" style="color: black;">Key App SatuData</h5>
                                <div class="input-group">
                                <input id="apiKeySatudata" name="apiKeySatudata" class="form-control" type="text" placeholder="Ketik Key App" aria-label="keyappsatudata" value="$2b$10$tifEFHrbIcCvJAjabsuEOueM8PFNnnFYfUBp3U9Tmb/SSZcsF1kym">
                                <!-- <button id="searchButton" name="searchButton" class="btn btn-success" type="submit">Search</button> -->
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-auto col-sm-12">
                                <h5 class="text" style="color: black;">Tahun SatuData</h5>
                                <input id="tahunDropdown" name="tahunDropdown" class="form-control" type="text" placeholder="" aria-label="default input example" disabled>    
                            </div>
                            <div class="col-lg-6 col-md-auto col-sm-12 mt-2">
                                <h5 class="text" style="color: black;">Cari Dataset SatuData</h5>
                                <div class="input-group">
                                    <input id="findNameInput" name="findNameInput" type="text" class="form-control" placeholder="Cari Dataset"  aria-label="Find" aria-describedby="basic-addon2">
                                    <button id="findButton" name="findButton" class="btn btn-success"><i class="bi bi-search"></i> Find</button>
                                    
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-auto col-sm-12 mt-2">
                                <h5 class="text" style="color: black;">Dataset SatuData</h5>
                                <select id='DatasetSatudataDropdown' name="DatasetSatudataDropdown" class='form-select'>
                                    <option selected>Pilih Dataset</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-2 col-md-auto col-sm-12">
                                <!-- Form Kolom Dataset Profilkes -->
                                <div class="card mb-3" style="border-color: #66CDAA;">
                                    <h5 class="card-header" style="color: white; background-color: #66CDAA; border-color: #66CDAA;">Dataset Profilkes</h5>
                                    <div class="card-body">
                                        <form class="mb-4"> <!-- Ubah id formulir agar unik -->
                                            <label for="kolomDatasetProfilkes" class="form-label multiple">Pilih Kolom Dataset: </label>
                                            <div id="kolomDatasetProfilkes">
                                            <select id="selectkolomDatasetProfilkes" class="form-select" multiple>
                                                <!-- <option value=""></option> -->
                                            </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> 

                            <!-- Button Move Column -->
                            <div class="col-lg-1 col-md-auto col-sm-12 align-self-center text-center">
                                <div class="mb-2">
                                    <button type="button" id="moveRightProfilkes" class="btn btn-primary" style="background-color: #66CDAA; border-color: #66CDAA;">&gt;&gt;</button>
                                </div>
                                <div class="mb-2">
                                    <button type="button" id="moveLeftProfilkes" class="btn btn-primary" style="background-color: #66CDAA; border-color: #66CDAA;">&lt;&lt;</button>
                                </div>
                            </div>

                            <!-- Form Transform Fields -->
                            <div class="col-lg-2 col-md-auto col-sm-12">
                                <div class="card mb-3" style="border-color: #66CDAA;">
                                    <h5 class="card-header" style="color: white; background-color: #66CDAA; border-color: #66CDAA;">Transform Fields</h5>
                                    <div class="card-body">
                                        <form class="mb-4">
                                            <label for="transformFields" class="form-label multiple">Pilih Transform Fields: </label>
                                            <div id="transformFields">
                                                <select id="selectTransformFields" class="form-select" multiple>
                                                    <!-- <option value=""></option> -->
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> 

                            <!-- Button Matching -->
                            <div class="col-lg-2 col-md-auto col-sm-12 align-self-center text-center">
                                <div class="mb-2">
                                    <button type="button" id="matchButton" class="btn btn-primary" style="background-color: #66CDAA; border-color: #66CDAA;">Match</button>
                                </div>
                            </div>

                            <!-- Form Kolom Insert SatuData -->
                            <div class="col-lg-2 col-md-auto col-sm-12">
                                <div class="card mb-3" style="border-color: #66CDAA;">
                                    <h5 class="card-header" style="color: white; background-color: #66CDAA; border-color: #66CDAA;">Insert SatuData</h5>
                                    <div class="card-body">
                                        <form class="mb-4">
                                            <label for="kolomInsertSatuData" class="form-label multiple">Pilih Kolom Insert: </label>
                                            <div id="kolomInserttSatuData">
                                                <select id="selectkolomInsertSatuData" class="form-select" multiple>
                                                    <!-- <option value=""></option> -->
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> 

                            <!-- Button Move Column -->
                            <div class="col-lg-1 col-md-auto col-sm-12 align-self-center text-center">
                                <div class="mb-2">
                                    <button type="button" id="moveRightSatuData" class="btn btn-primary" style="background-color: #66CDAA; border-color: #66CDAA;">&gt;&gt;</button>
                                </div>
                                <div class="mb-2">
                                    <button type="button" id="moveLeftSatuData" class="btn btn-primary" style="background-color: #66CDAA; border-color: #66CDAA;">&lt;&lt;</button>
                                </div>
                            </div>

                            <!-- Form Kolom Dataset SatuData -->
                            <div class="col-lg-2 col-md-auto col-sm-12">
                                <div class="card mb-3" style="border-color: #66CDAA;">
                                    <h5 class="card-header" style="color: white; background-color: #66CDAA; border-color: #66CDAA;">Dataset SatuData</h5>
                                    <div class="card-body">
                                        <form class="mb-4">
                                            <label for="kolomDatasetSatuData" class="form-label multiple">Pilih Kolom Dataset: </label>
                                            <div id="kolomDatasetSatuData">
                                                <select id="selectkolomDatasetSatuData" class="form-select" multiple>
                                                    <!-- <option value=""></option> -->
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> 
                        </div> <!-- row -->
                    </div> <!-- akhir tabpanel Transform-->
                    
                    <!-- Tabpanel Load -->
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
                    </div> <!-- akhir tabpanel Load -->

                </div> <!-- akhir tab-content -->
                </div> <!-- akhir col-12 -->
                </div> <!-- Card  BODY ETL PROCESS -->

            </div> <!-- Card ETL PROCESS -->
        </div> <!-- akhir row -->
        </div> <!-- akhir Tabpanel ETL PROCESS -->

        <!-- Tabpanel INFO -->
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
        // Form URL Profilkes id=urlProfilkes
        var urlProfilkes = $('#urlProfilkes');
        $('#loadButton').click(function() {
            event.preventDefault();
            inputApiURL();
        });

        // Dropdown Wilayah profilkes id=wilayahDropdown
        function inputApiURL() {
            var urlProfilkesValue = urlProfilkes.val();
            $.ajax({
                url: "getWilayah.php",
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
                        // console.log(response);
                        $('#wilayahDropdown').append(
                            '<option value="' + response.kode_wilayah + '">' + response.nama + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Gagal mengambil data wilayah:", error);
                    
                }
            });
        }

        // Ketika dropdown Wilayah Profilkes dipilih
        // Dropdown Tahun profilkes id=tahunDropdown
        $('#wilayahDropdown').change(function() {
            var selectedWilayah = $(this).val();
            var urlProfilkesValue = $('#urlProfilkes').val();
            $.ajax({
                url: "getTahun.php",
                type: "GET",
                data: { kode_wilayah: selectedWilayah, urlProfilkes: urlProfilkesValue },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                        $('#tahunDropdown').empty();
                        $('#tahunDropdown').append('<option value="">Pilih Tahun</option>');
                        $.each(response, function(index, item) {
                            // console.log(response);
                            $('#tahunDropdown').append(
                                `<option value="${item.tahun}">${item.tahun}</option>`
                            );
                        });
                },
                error: function(xhr, status, error) {
                    console.error("Gagal mengambil data tahun:", error);
                }
            });
        });

        // Dropdown Dataset profilkes id=datasetDropdown
        $('#tahunDropdown').change(function() {
            var selectedWilayah = $('#wilayahDropdown').val();
            var selectedTahun = $(this).val();
            var urlProfilkesValue = $('#urlProfilkes').val();
            $.ajax({
                url: "getDataset.php",
                type: "GET",
                data: { kode_wilayah: selectedWilayah, tahun: selectedTahun, urlProfilkes: urlProfilkesValue },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    $('#datasetDropdown').empty();
                    $('#datasetDropdown').append('<option value="">Pilih Dataset</option>');
                    $.each(response, function(index, dataset) {
                        $('#datasetDropdown').append(
                            '<option value="' + dataset.slug + '">' + dataset.nama + '</option>'
                        );
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Gagal mengambil data dataset:", error);
                }
            });
        });

        // TableData id=tabledata
        // Fungsi untuk mendapatkan dan menampilkan data tabel
        $('#datasetDropdown').change(function() {
            var selectedSlug = $(this).val();
            if (selectedSlug) {
                getTabledata(selectedSlug);
            } else {
                $('#tabledata').empty();
                $('#selectkolomDatasetProfilkes').empty().append('<option value=""></option>');
            }
        });

        function getTabledata(slug) {
            var tahun = $('#tahunDropdown').val();
            var urlProfilkesValue = $('#urlProfilkes').val();
            var kodeWilayah = $('#wilayahDropdown').val();
            $.ajax({
                url: "getTableData.php",
                type: "GET",
                data: { slug: slug, tahun: tahun, urlProfilkes: urlProfilkesValue, kode_wilayah: kodeWilayah },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response && response.length > 0) {
                        // Membuat tabel dari data yang diterima
                        var tableHtml = "<table class='table table-bordered border-dark table-striped'>";
                        tableHtml += "<thead><tr>";
                        for (var key in response[0]) {
                            tableHtml += "<th>" + key + "</th>";
                        }
                        tableHtml += "</tr></thead>";
                        tableHtml += "<tbody class='table-group-divider'>";
                        response.forEach(function(data) {
                            tableHtml += "<tr>";
                            for (var key in data) {
                                tableHtml += "<td>" + data[key] + "</td>";
                            }
                            tableHtml += "</tr>";
                        });
                        tableHtml += "</tbody></table>";
                        $('#tabledata').html(tableHtml);

                        // Mengisi dropdown "Pilih Kolom Dataset" dengan kolom tabel
                        var columnDropdown = $('#selectkolomDatasetProfilkes');
                        // columnDropdown.empty().append('<option value=""></option>');
                        for (var key in response[0]) {
                            columnDropdown.append('<option value="' + key + '">' + key + '</option>');
                        }
                    } else {
                        $('#tabledata').html("<p>Tidak ada datanya</p>");
                        $('#selectkolomDatasetProfilkes').empty().append('<option value=""></option>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#tabledata').html("<p>Error fetching data: " + error + "</p>");
                    $('#selectkolomDatasetProfilkes').empty().append('<option value=""></option>');
                },
            });
        }
        
        //Pada Tabpanel Transform, Find dataset SatuData id=findButton
        $('#findButton').click(function() {
            var apiKey = $('#apiKeySatudata').val();
                var apiUrl = $('#apiUrlSatudata').val();
                var findNameInput = $('#findNameInput').val();
                console.log("API Key:", apiKey);
                console.log("API URL:", apiUrl);
                console.log("Cari:", findNameInput);
                $.ajax({
                    url: "getFindData.php",
                    type: "GET",
                    data: { apiKey: apiKey, apiUrl: apiUrl, findNameInput : findNameInput },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        var options = "<option value=''>Pilih Dataset</option>";
                        var dataset = data.data.rows; 
                        console.log(dataset);
                        for (var i = 0; i < dataset.length; i++) {
                        options += '<option value="' + dataset[i].uuid + '">' + dataset[i].judul + "</option>";
                        }
                        $("#DatasetSatudataDropdown").html(options);
                    },
                    error: function(xhr, status,response, error) {
                        console.log(response);
                        console.error("Gagal mengambil dataset:", error);
                    }
                });
            });

            //
            $("#DatasetSatudataDropdown").change(function () {
                var uuid = $(this).val();
                var apiUrl = $("#apiUrlSatudata").val();
                var apiKey = $("#apiKeySatudata").val();
                console.log(uuid);
                $.ajax({
                type: "GET",
                url: "getDatasetSatuData.php",
                data: {
                    uuid: uuid,
                    apiUrl: apiUrl,
                    apiKey: apiKey,

                },
                dataType: "json",
                success: function (data) {
                    console.log(data)
                    var options = "<option value=''></option>";
                    var dataset = data.data.fields;
                    console.log(dataset);

                    // Mengisi dropdown "Pilih Kolom Dataset SatuData" dengan kolom dataset
                    var columnDropdownSatuData = $('#selectkolomDatasetSatuData');
                    columnDropdownSatuData.empty(); // Kosongkan dropdown sebelum mengisi ulang
                    for (var i = 0; i < dataset.length; i++) {
                        options += '<option value="' + dataset[i] + '">' + dataset[i].name + "</option>";
                    }
                    
                    columnDropdownSatuData.append(options);
                    // columnDropdown.empty().append('<option value=""></option>');
                    // for (var key in dataset[0]) {
                    //         columnDropdownSatuData.append('<option value="' + key + '">' + key + '</option>');
                    //     }
                },
                });
                console.log(apiUrl);
                console.log(apiKey);
            });

            // Loading Spinner
            $(document).ajaxStart(function() {
                $('#loadingSpinner').removeClass('d-none');
            });

            $(document).ajaxComplete(function() {
                $('#loadingSpinner').addClass('d-none');
            });

            // $('select').selectpicker();
            $('#moveRightProfilkes').click(function() {
                $('#selectkolomDatasetProfilkes option:selected').appendTo('#selectTransformFields');
            });

            $('#moveLeftProfilkes').click(function() {
                $('#selectTransformFields option:selected').appendTo('#selectkolomDatasetProfilkes');
            });

            $('#moveRightSatuData').click(function() {
                $('#selectkolomInsertSatuData option:selected').appendTo('#selectkolomDatasetSatuData');
            });

            $('#moveLeftSatuData').click(function() {
                $('#selectkolomDatasetSatuData option:selected').appendTo('#selectkolomInsertSatuData');
            });

    });

        


    </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-K+1/re0NMrn6n1pmzmgOy8cEwA1Zm6a5xkT1IC8OXXg=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>