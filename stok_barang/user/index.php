<?php 
require '../koneksi.php';
require '../ceklog.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Stok Barang</title>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">BerlianTenology.net</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar-->
            <li class="navbar-nav nav-item dropdown ml-auto">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
            </li>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">BARANG</div>
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                Stok Barang
                            </a>
                            <a class="nav-link" href="barangMasuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                Barang Masuk
                            </a>
                            <a class="nav-link" href="barangKeluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-file"></i></div>
                                Barang Keluar
                            </a>                    
                        </div>
                    </div>
                    
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">STOK BARANG</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Catatan stok barang BerlianTenology.net</li>
                        </ol>
                        

                        <div class="card mb-4">
                            <div class="card-header">
                            <a href="../print.php" class='btn btn-info'>Export</a>                           
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Deskripsi</th>
                                                <th>Stok</th>                                                
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $semuadata = mysqli_query($conn, "select * from stokbarang");
                                            $i = 1;
                                            while($data=mysqli_fetch_array($semuadata)){
                                                $namabarang = $data['namaBarang'];
                                                $deskripsi = $data['deskripsi'];
                                                $stok = $data['stok'];
                                                $idb = $data['idBarang']
                                            ?>

                                            <tr>
                                                <td><?=$i++;?></td>
                                                <td><?=$namabarang;?></td>
                                                <td><?=$deskripsi;?></td>
                                                <td><?=$stok;?></td>
                                                
                                            </tr>
                                            
                                               

                                            <?php
                                            };
                                            ?>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/chart-area-demo.js"></script>
        <script src="../assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="../assets/demo/datatables-demo.js"></script>
        
    </body>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
        
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            
                <!-- Modal body -->
                <form method="post">
                <div class="modal-body">
                <label class="small mb-1" for="inputEmailAddress">Nama Barang</label>
                <input type="text" name="namaBarang" placeholder="Nama Barang" class="form-control" required>
                <br>
                <label class="small mb-1" for="inputEmailAddress">Deskripsi Barang</label>
                <input type="text" name="deskripsi" placeholder="Deskripsi Barang" class="form-control" required>
                <br>
                <label class="small mb-1" for="inputEmailAddress">Stok</label>
                <input type="number" name="stok" class="form-control" value="0" readonly>
                <br>
                <button type="submit" class="btn btn-info" name="addnewbarang">Tambah</button>                

                </div>
                </form>
                                
            </div>
        </div>
    </div>
                                     
</html>
