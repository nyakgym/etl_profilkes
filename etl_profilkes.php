<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ETL - PROFILKES</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <!-- <h1>ETL - PROFILKES</h1> -->
        <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-dark mb-3" style="background-color: #66CDAA; border-color: 66CDAA;">
            <div class="container-fluid">
                <a class="navbar-brand mb-0 h1 navbar-light"><i class="bi bi-file-earmark-medical"></i> ETL - PROFILKES</a>
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="etl_profilkes.php" style="color: white;">ETL-Process</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color: white;">Info</a>
                    </li>
                </ul>
            </div>
            
        </nav>
        <div class="row px-3">
            <div class="col-lg-3 col-md-auto col-sm-12">
                <div class="card mb-3" style="background-color: #66CDAA; border-color: #66CDAA;" style="width: 18rem;">
                <form action="#" method="POST">
                    <div class="card-body">
                        <h5 class="card-title" style="color: white;">Mencari Dataset</h5>
                        <p class="card-text" style="color: white;">Tahun</p>
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
                            echo "<div class='container-fluid mt-3'>";
                            echo "<div class='row'>";
                            echo "<div class='col mb-3'>";
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
                        <p class="card-text" style="color: white;">Dataset</p>
                        <select id='datasetDropdown' class='form-select' onchange='getKodewilayah(this.value)'>
                            <option selected>Pilih dataset</option>
                        </select>
                        <!-- Ajax loader -->
                        <div id="loader" class="spinner-border text-info" role="status" style="display: none;">
                                <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="col-lg-9 col-md-auto col-sm-12">
                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-data" data-bs-toggle="tab" data-bs-target="#datatabpanel" type="button" role="tab" aria-controls="datatabpanel" aria-selected="true">1. Extract</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="configure-tab" data-bs-toggle="tab" data-bs-target="#configuretabpanel" type="button" role="tab" aria-controls="configuretabpanel" aria-selected="false">2. Transform</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="configure-tab" data-bs-toggle="tab" data-bs-target="#configuretabpanel" type="button" role="tab" aria-controls="configuretabpanel" aria-selected="false">3. Load</button>
                    </li>
                </ul>           
                <div class="tab-content">
                    <!-- tabpanel 1 -->
                    <div class="tab-pane fade show active" id="datatabpanel" role="tabpanel" aria-labelledby="tab-data">
                        <div class="card  mb-3">
                            <h5 class="card-header" style="background-color: #66CDAA; border-color: #66CDAA;">Tabel Dataset</h5>
                            <div class="card-body">
                                <div class='col'>
                                    <div id='tabledata' class='table-responsive'></div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- akhir tabpanel 1 -->
                    <!-- tabpanel 2 -->
                    <div class="tab-pane fade" id="configuretabpanel" role="tabpanel" aria-labelledby="configure-tab">
                        <div class="row">
                            <div class="col-lg-5 col-md-auto col-sm-12">
                                <div class="card mb-3">
                                    <h5 class="card-header" style="background-color: #66CDAA; border-color: #66CDAA;">Select Configure</h5>
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
                                                <button type="submit" class="btn btn-primary">Apply Filter</button>
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
                            <div class="col-lg-6 col-md-auto col-sm-12">
                                <div class="card mb-3">
                                    <h5 class="card-header" style="background-color: #66CDAA; border-color: #66CDAA;">Result</h5>
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
                                            
                                                <button type="submit" class="btn btn-primary">Apply Filter</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- col-6 -->
                        </div> <!-- row -->
                    </div> <!-- akhir tabpanel 2-->
                </div> <!-- akhir tab-content -->
                </div> <!-- akhir col-9 -->
            </div> <!-- akhir row -->
        </div> <!-- akhir container -->
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