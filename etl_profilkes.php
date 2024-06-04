<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ETL - PROFILKES</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.4.1/font/bootstrap-icons.min.css" rel="stylesheet">
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
                            <h5 class="text" style="color: black;">URL Profilkes</h5>
                            <input class="form-control" type="text" placeholder="Ketik URL" aria-label="urlprofilkes">
                            <!-- Ajax loader -->
                            <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                                    <span class="visually-hidden">Loading...</span>
                            </div>
                    </div>
                    <div class="col-lg-3 col-md-auto col-sm-12">
                        <h5 class="text" style="color: black;">Wilyah Profilkes</h5>
                        <select id='' class='form-select'>
                            <option selected>Pilih wilayah</option>
                            <option>Aceh</option>
                        </select>
                        <!-- Ajax loader -->
                        <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                                <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-auto col-sm-12">
                        <h5 class="text" style="color: black;">Tahun</h5>
                        <?php 
                        function get_profilkescurl($url) {
                            $ch = curl_init($url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);
                            curl_close($ch);
                            return json_decode($response);
                        }

                        function get_tahun(){
                            $url = "https://profilkes.acehprov.go.id/api/tahun";
                            $response = get_profilkescurl($url);
                            return $response;
                        };

                        // Panggil fungsi untuk mendapatkan data tahun dan simpan dalam variabel $test
                        $test = get_tahun();

                        function get_dataset($tahun = null){
                            $url = "https://profilkes.acehprov.go.id/api/dataset?tahun={$tahun}";
                            $response = get_profilkescurl($url);
                            return $response;
                        };

                        // Buat dropdown untuk menampilkan tahun
                        if (isset($test)) {
                            echo "<div class='container-fluid'>";
                            echo "<div class='row'>";
                            echo "<div class='col'>";
                            echo "<select id='tahunDropdown' class='form-select' onchange='getDataset(this.value)'>";
                            echo "<option selected>Pilih tahun</option>";
                            foreach ($test as $waktu) {
                                echo "<option value='{$waktu->tahun}'>{$waktu->tahun}</option>";
                            }
                            echo "</select>";
                            echo "<div id='loader' class='spinner-border text-light' role='status' style='display: none;'>";
                            echo "<span class='visually-hidden'>Loading...</span>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";
                        } else {
                            echo "<div class='container-fluid mt-3'>";
                            echo "<div class='alert alert-danger' role='alert'>Gagal mengambil data tahun dari API atau tidak ada data yang ditemukan.</div>";
                            echo "</div>";
                        }
                        ?>
                        </div>
                        </div>
                        <div class="row mt-2 mb-2">
                        <div class="col-lg-6 col-md-auto col-sm-12">
                        <h5 class="text" style="color: black;">Dataset</h5>
                        <select id='datasetDropdown' class='form-select' onchange='getKodewilayah(this.value)'>
                            <option selected>Pilih dataset</option>
                        </select>
                        <!-- Ajax loader -->
                        <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                                <span class="visually-hidden">Loading...</span>
                        </div>
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
                            <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                                    <span class="visually-hidden">Loading...</span>
                            </div>
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
                            <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                                    <span class="visually-hidden">Loading...</span>
                            </div>
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

                                                <label for="filterInput" class="form-label multiple">Filter:</label>
                                                <?php
                                                    // Tentukan header tabel secara manual (gantilah dengan header yang sesuai)
                                                    $headers = array("1", "2", "3", "4");
                                                    
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
                                                <label for="filterInput" class="form-label multiple">Hasil:</label>
                                            
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
                                                <label for="filterInput" class="form-label multiple">Hasil:</label>
                                            
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
                <p class="card-text">Ini adalah deskripsi singkat aplikasi. Seharusnya berisi latar belakang serta
                    informasi-informasi singkat terkait dengan keberadaan aplikasi ini. Semoga dengan dua atau tiga kalimat,
                    maka deskripsi ini dapat menjelaskan maksud/tujuan dari adanya aplikasi ini.
                </p>
                </div> <!-- Card  BODY INFO -->
            </div> <!-- Card INFO -->
            </div>
        </div> <!-- akhir tabpanel INFO -->
        </div> <!-- akhir Tabcontent -->
        </div> <!-- akhir container -->

        <!-- Footer -->
        <div class="container">
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

            <div class="col-lg-4 col-md-auto col-sm-12 mb-3">
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
        function getDataset(tahun) {
            var datasetDropdown = document.getElementById("datasetDropdown");
            datasetDropdown.innerHTML = "<option selected>Loading...</option>";

            // Menampilkan spinner loader
            var loader = document.getElementById("loader");
            loader.style.display = "inline-block";

            // Buat request untuk mengambil data dataset berdasarkan tahun yang dipilih
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        datasetDropdown.innerHTML = "<option selected>Pilih dataset</option>";
                        response.forEach(function(dataset) {
                            var option = document.createElement("option");
                            option.value = dataset.slug;
                            option.text = dataset.nama;
                            datasetDropdown.appendChild(option);
                        });
                    } else {
                        datasetDropdown.innerHTML = "<option selected>Error</option>";
                    }
                    // Menyembunyikan spinner loader setelah request selesai
                    loader.style.display = "none";
                }
            };
            xhr.open("GET", "https://profilkes.acehprov.go.id/api/dataset?tahun=" + tahun, true);
            xhr.send();
        }

        function getKodewilayah(slug) {
            var tahun = document.getElementById("tahunDropdown").value;
            var xhr = new XMLHttpRequest();
            
            // Menampilkan spinner loader
            var loader = document.getElementById("loader");
            loader.style.display = "inline-block";
            //Menampilkan tabel
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response && response.length > 0) {
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
                            document.getElementById("tabledata").innerHTML = tableHtml;
                        } else {
                            document.getElementById("tabledata").innerHTML = "<p>Tidak ada datanya</p>";
                        }
                    } else {
                        document.getElementById("tabledata").innerHTML = "<p>Error fetching data.</p>";
                    }
                    // Menyembunyikan spinner loader setelah request selesai
                    loader.style.display = "none";
                }
            };
            xhr.open("GET", "https://profilkes.acehprov.go.id/api/data/?slug=" + slug + "&tahun=" + document.getElementById("tahunDropdown").value, true);
            xhr.send();
        }
        $('select').selectpicker();
        $('#moveRight').click(function() {
        $('#selectFrom option:selected').appendTo('#selectTo');
        });

        $('#moveLeft').click(function() {
            $('#selectTo option:selected').appendTo('#selectFrom');
        });
        $('#selectFrom').submit(function(event) {
            event.preventDefault(); // Menghentikan perilaku default saat mengirim formulir
            var filterValue = $('#filterInput').val(); // Ambil nilai filter dari input
            // Lakukan permintaan AJAX untuk memperbarui tabel dengan filter yang diterapkan
            showLoadingModal(); // Tampilkan modal loading
            var slug = $("#datasetDropdown").val(); // Mengambil slug dataset yang dipilih
            $.ajax({
                url: "https://profilkes.acehprov.go.id/api/data",
                type: "GET",
                data: {
                    slug: slug,
                    tahun: $("#tahunDropdown").val(),
                    filter: filterValue
                },
                success: function(response) {
                    if (response && response.length > 0) {
                        var tableHtml = "<table class='table table-striped'>";
                        tableHtml += "<thead><tr>";
                        for (var key in response[0]) {
                            tableHtml += "<th>" + key + "</th>";
                        }
                        tableHtml += "</tr></thead>";
                        tableHtml += "<tbody>";
                        response.forEach(function(data) {
                            tableHtml += "<tr>";
                            for (var key in data) {
                                tableHtml += "<td>" + data[key] + "</td>";
                            }
                            tableHtml += "</tr>";
                        });
                        tableHtml += "</tbody></table>";
                        
                        $("#tabledata").html(tableHtml);
                    } else {
                        $("#tabledata").html("<p>Tidak ada datanya</p>");
                    }$('#filterForm').submit(function(event) {
                        event.preventDefault(); // Menghentikan perilaku default saat mengirim formulir
                        var filterValue = $('#filterInput').val(); // Ambil nilai filter dari input
                        // Lakukan permintaan AJAX untuk memperbarui tabel dengan filter yang diterapkan
                        showLoadingModal(); // Tampilkan modal loading
                        var slug = $("#datasetDropdown").val(); // Mengambil slug dataset yang dipilih
                        $.ajax({
                            url: "https://profilkes.acehprov.go.id/api/data",
                            type: "GET",
                            data: {
                                slug: slug,
                                tahun: $("#tahunDropdown").val(), // Tambahkan tahun yang dipilih ke dalam data
                                filter: filterValue
                            },
                            success: function(response) {
                                if (response && response.length > 0) {
                                    var tableHtml = "<table class='table table-striped'>";
                                    tableHtml += "<thead><tr>";
                                    for (var key in response[0]) {
                                        tableHtml += "<th>" + key + "</th>";
                                    }
                                    tableHtml += "</tr></thead>";
                                    tableHtml += "<tbody>";
                                    response.forEach(function(data) {
                                        tableHtml += "<tr>";
                                        for (var key in data) {
                                            tableHtml += "<td>" + data[key] + "</td>";
                                        }
                                        tableHtml += "</tr>";
                                    });
                                    tableHtml += "</tbody></table>";

                                    $("#tabledata").html(tableHtml);
                                } else {
                                    $("#tabledata").html("<p>Tidak ada datanya</p>");
                                }
                                hideLoadingModal(); // Sembunyikan modal loading setelah selesai
                            },
                            error: function(xhr, status, error) {
                                console.error("Gagal memperbarui tabel dengan filter:", error);
                                hideLoadingModal(); // Sembunyikan modal loading jika terjadi kesalahan
                            }
                        });
                    });
                    hideLoadingModal(); // Sembunyikan modal loading setelah selesai
                },
                error: function(xhr, status, error) {
                    console.error("Gagal memperbarui tabel dengan filter:", error);
                    hideLoadingModal(); // Sembunyikan modal loading jika terjadi kesalahan
                }
            });
        });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-K+1/re0NMrn6n1pmzmgOy8cEwA1Zm6a5xkT1IC8OXXg=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>