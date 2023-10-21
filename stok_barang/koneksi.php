<?php
session_start();

//Membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","stok_barang");

//Tambah Data Barang
if(isset($_POST['addnewbarang'])){
    $namabarang = $_POST['namaBarang'];
    $deskripsi = $_POST['deskripsi'];
    $stok = $_POST['stok'];

    $tambahketabel = mysqli_query($conn, "INSERT into stokbarang (namaBarang, deskripsi, stok) values('$namabarang', '$deskripsi', '$stok')");
    if($tambahketabel){
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

//Tambah Data Barang masuk
if(isset($_POST['barangMasuk'])){
    $selectbarang = $_POST['selectBarang'];
    $ket = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "select * from stokbarang where idBarang='$selectbarang'");
    $ambildata = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildata['stok'];
    $stoktambahqty = $stoksekarang+$qty;

    $tambahkemasuk = mysqli_query($conn, "insert into barangmasuk (idBarang, keterangan, qty) values('$selectbarang', '$ket', '$qty')");
    $upstokmasuk = mysqli_query($conn, "update stokbarang set stok='$stoktambahqty' where idBarang='$selectbarang'");

    if($tambahkemasuk&&$upstokmasuk){
        header('location:barangMasuk.php');

    }else{
        echo"Gagal";
        header('location:barangMasuk.php');
    }
}

//Tambah Data Barang keluar
if(isset($_POST['barangKeluar'])){
    $selectbarang = $_POST['selectBarang'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstoksekarang = mysqli_query($conn, "select * from stokbarang where idBarang='$selectbarang'");
    $ambildata = mysqli_fetch_array($cekstoksekarang);

    $stoksekarang = $ambildata['stok'];
    $stokkurangqty = $stoksekarang-$qty;

    $tambahkeluar = mysqli_query($conn, "insert into barangkeluar (idBarang, penerima, qty) values('$selectbarang', '$penerima', '$qty')");
    $upstokmasuk = mysqli_query($conn, "update stokbarang set stok='$stokkurangqty' where idBarang='$selectbarang'");

    if($tambahkeluar&&$upstokmasuk){
        header('location:barangKeluar.php');

    }else{
        echo"Gagal";
        header('location:barangKeluar.php');
    }
}

// Edit Barang Baru
if(isset($_POST['editbarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namaBarang'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($conn, "update stokbarang set namaBarang = '$namabarang', deskripsi = '$deskripsi' where idBarang = '$idb'");
    if($update){
        header('location:index.php');
    }else{
        echo 'Gagal';
        header('location:index.php');

    }
}

// Hapus Barang Baru
if(isset($_POST['hapusbarang'])){
    $idb = $_POST['idb'];
    
    $hapus = mysqli_query($conn, "delete from stokbarang where idBarang='$idb'");
    if($hapus){
        header('location:index.php');
    }else{
        echo 'Gagal';
        header('location:index.php');

    }
}

// Edit Barang Masuk
if(isset($_POST['editbarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $keterangan = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatbarang = mysqli_query($conn, "select * from stokbarang where idBarang='$idb'");
    $barangnya = mysqli_fetch_array($lihatbarang);
    $barangskrg = $barangnya['stok'];
    
    $qtyskrg = mysqli_query($conn, "select * from barangmasuk where idMasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $slisih = $qty-$qtyskrg;
        $tambah = $barangskrg+$slisih;
        $tambahbarangnya = mysqli_query($conn,"update stokbarang set stok='$tambah' where idBarang='$idb'");
        $updatenya = mysqli_query($conn, "update barangmasuk set qty='$qty', keterangan='$keterangan' where idMasuk='$idm'"); 
        if($kurangbarangnya&&$updatenya){
            header('location:barangMasuk.php');
        }else{
            echo'Gagal';
            header('location:barangMasuk.php');

        }
    }else{
        $slisih = $qtyskrg-$qty;
        $kurang = $barangskrg-$slisih;
        $kurangbarangnya = mysqli_query($conn,"update stokbarang set stok='$kurang' where idBarang='$idb'");
        $updatenya = mysqli_query($conn, "update barangmasuk set qty='$qty', keterangan='$keterangan' where idMasuk='$idm'"); 
        if($kurangbarangnya&&$updatenya){
            header('location:barangMasuk.php');
        }else{
            echo'Gagal';
            header('location:barangMasuk.php');

        } 
    }

}

// Hapus Barang Masuk
if(isset($_POST['hapusbarangmasuk'])){
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $qty = $_POST['kty'];
    
    $getdatabarang = mysqli_query($conn, "select * from stokbarang where idBarang='$idb'");
    $data =mysqli_fetch_array($getdatabarang);
    $stok = $data['stok'];

    $slisih = $stok-$qty;

    $update = mysqli_query($conn, "update stokbarang set stok='$slisih' where idBarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from barangmasuk where idMasuk='$idm'");

    if($update&&$hapusdata){
        header('location:barangMasuk.php');
    }else{
        echo 'Gagal';
        header('location:barangMasuk.php');

    }
}


//Edit Barang Keluar
if(isset($_POST['editbarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $lihatbarang = mysqli_query($conn, "select * from stokbarang where idBarang='$idb'");
    $barangnya = mysqli_fetch_array($lihatbarang);
    $barangskrg = $barangnya['stok'];
    
    $qtyskrg = mysqli_query($conn, "select * from barangkeluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if($qty>$qtyskrg){
        $slisih = $qty-$qtyskrg;
        $kurang = $barangskrg-$slisih;
        $kurangbarangnya = mysqli_query($conn,"update stokbarang set stok='$kurang' where idBarang='$idb'");
        $updatenya = mysqli_query($conn, "update barangkeluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'"); 
        if($kurangbarangnya&&$updatenya){
            header('location:barangKeluar.php');
        }else{
            echo'Gagal';
            header('location:barangKeluar.php');

        }
    
    
    }else{
        $slisih = $qtyskrg-$qty;
        $kurang = $barangskrg+$slisih;
        $kurangbarangnya = mysqli_query($conn,"update stokbarang set stok='$kurang' where idBarang='$idb'");
        $updatenya = mysqli_query($conn, "update barangkeluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'"); 
        if($kurangbarangnya&&$updatenya){
            header('location:barangKeluar.php');
        }else{
            echo'Gagal';
            header('location:barangKeluar.php');

        } 
    }

}

// Hapus Barang Keluar
if(isset($_POST['hapusbarangkeluar'])){
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $qty = $_POST['kty'];
    
    $getdatabarang = mysqli_query($conn, "select * from stokbarang where idBarang='$idb'");
    $data =mysqli_fetch_array($getdatabarang);
    $stok = $data['stok'];

    $slisih = $stok+$qty;

    $update = mysqli_query($conn, "update stokbarang set stok='$slisih' where idBarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from barangkeluar where idkeluar='$idk'");

    if($update&&$hapusdata){
        header('location:barangKeluar.php');
    }else{
        echo 'Gagal';
        header('location:barangKeluar.php');

    }
}




?>