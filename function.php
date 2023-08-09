<?php
date_default_timezone_set('Asia/Jakarta');
session_start();
//untuk koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "servis_ac");

function tanggal($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = bulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}
function bulan($bln)
{
    switch ($bln) {
        case 1:
            return "January";
            break;
        case 2:
            return "February";
            break;
        case 3:
            return "March";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "May";
            break;
        case 6:
            return "June";
            break;
        case 7:
            return "July";
            break;
        case 8:
            return "August";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "October";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "December";
            break;
    }
}



//Menambahkan data customer
if (isset($_POST['addnewcustomer'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    echo $nama;
    echo '<br><br>';
    echo $alamat;
    echo '<br><br>';
    echo $no_telp;
    echo '<br><br>';

    $addtodata_customer = mysqli_query($conn, "insert into tbl_customer (nama, alamat, no_telp) values('$nama', '$alamat', '$no_telp')") or die(mysqli_error($conn));
    echo "<script>alert('Data Berhasil Di Simpan');</script>";
    echo "<script> location ='data_customer.php';</script>";
}

//Menambahkan data customer
if (isset($_POST['addnewteknisi'])) {
    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];
    echo $nama;
    echo '<br><br>';
    echo $no_telp;
    echo '<br><br>';

    $addtodata_customer = mysqli_query($conn, "insert into tbl_teknisi (nama, no_telp) values('$nama', '$no_telp')") or die(mysqli_error($conn));
    echo "<script>alert('Data Berhasil Di Simpan');</script>";
    echo "<script> location ='data_teknisi.php';</script>";
}

//Menambahkan data Pembayaran
if (isset($_POST['addnewbayar'])) {
    $jenis_bayar = $_POST['jenis_bayar'];
    echo $jenis_bayar;
    echo '<br><br>';

    $addtodata_jenis_bayar = mysqli_query($conn, "insert into tbl_jenis_bayar (jenis_bayar) values('$jenis_bayar')") or die(mysqli_error($conn));

    echo "<script>alert('Data Berhasil Di Simpan');</script>";
    echo "<script> location ='data_jenis_bayar.php';</script>";
}

//Menambahkan data jenis layanan
if (isset($_POST['addnewlayanan'])) {
    $jenis = $_POST['jenis_layanan'];
    $harga = $_POST['harga'];
    echo $jenis;
    echo '<br><br>';
    echo $harga;
    echo '<br><br>';

    $addtodata_layanan = mysqli_query($conn, "insert into tbl_layanan ( jenis_layanan, harga ) values( '$jenis', '$harga')") or die(mysqli_error($conn));
    echo "<script>alert('Data Berhasil Di Simpan');</script>";
    echo "<script> location ='data_layanan.php';</script>";
}

//Menambahkan data pesanan
if (isset($_POST['addnewpesanan'])) {
    $tgl_servis = $_POST['tgl_servis'];
    $jam_servis = $_POST['jam_servis'];
    $id_customer = $_POST['id_customer'];
    $id_layanan = $_POST['id_layanan'];
    $id_jenis_bayar = $_POST['id_jenis_bayar'];
    $id_teknisi = $_POST['id_teknisi'];
    $harga = $_POST['harga'];
    $alamatt = $_POST['alamatt'];
    // tambahan
    $terakhirnotice = 'Belum';
    $addtodata_pesanan = mysqli_query($conn, "insert into tbl_pesanan (tgl_servis, jam_servis, id_customer, id_layanan, id_jenis_bayar, id_teknisi, harga, alamatt, terakhirnotice) values('$tgl_servis', '$jam_servis', '$id_customer', '$id_layanan', '$id_jenis_bayar', '$id_teknisi', '$harga', '$alamatt', '$terakhirnotice')") or die(mysqli_error($conn));
    echo "<script>alert('Data Berhasil Di Simpan');</script>";
    echo "<script> location ='data_pesanan.php';</script>";
}


if (isset($_POST['editcustomer'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];

    $addtodata_pemesanan = mysqli_query($conn, "UPDATE tbl_customer SET nama='$nama', alamat='$alamat', no_telp='$no_telp'  WHERE id = '$id'") or die(mysqli_error($conn));
    echo "<script>alert('Data Berhasil Di Ubah');</script>";
    echo "<script> location ='data_customer.php';</script>";
}

if (isset($_POST['editteknisi'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $no_telp = $_POST['no_telp'];

    $addtodata_pemesanan = mysqli_query($conn, "UPDATE tbl_teknisi SET nama='$nama',  no_telp='$no_telp'  WHERE id = '$id'") or die(mysqli_error($conn));
    echo "<script>alert('Data Berhasil Di Ubah');</script>";
    echo "<script> location ='data_teknisi.php';</script>";
}

if (isset($_POST['editjenis_bayar'])) {
    $id = $_POST['id'];
    $jenis_bayar = $_POST['jenis_bayar'];

    $addtodata_jenis_bayar = mysqli_query($conn, "UPDATE tbl_jenis_bayar SET jenis_bayar='$jenis_bayar' WHERE id = '$id'") or die(mysqli_error($conn));
    echo "<script>alert('Data Berhasil Di Ubah');</script>";
    echo "<script> location ='data_jenis_bayar.php';</script>";
}

if (isset($_POST['editlayanan'])) {
    $id = $_POST['id'];
    $jenis = $_POST['jenis_layanan'];
    $harga = $_POST['harga'];

    $addtodata_perjalanan = mysqli_query($conn, "UPDATE tbl_layanan SET jenis_layanan='$jenis', harga='$harga' WHERE id = '$id'") or die(mysqli_error($conn));
    echo "<script>alert('Data Berhasil Di Ubah');</script>";
    echo "<script> location ='data_layanan.php';</script>";
}

if (isset($_POST['editpesanan'])) {
    $id_pesanan = $_POST['id_pesanan'];
    $tgl_servis = $_POST['tgl_servis'];
    $jam_servis = $_POST['jam_servis'];
    $id_customer = $_POST['id_customer'];
    $id_layanan = $_POST['id_layanan'];
    $id_jenis_bayar = $_POST['id_jenis_bayar'];
    $id_teknisi = $_POST['id_teknisi'];
    $harga = $_POST['harga'];
    $alamatt = $_POST['alamatt'];
    $$addtodata_pesanan = mysqli_query($conn, "UPDATE tbl_pesanan SET tgl_servis = '$tgl_servis', jam_servis = '$jam_servis', id_customer = '$id_customer', id_layanan = '$id_layanan', id_jenis_bayar = '$id_jenis_bayar', id_teknisi = '$id_teknisi', harga = '$harga', alamatt = '$alamatt' WHERE id_pesanan = '$id_pesanan'") or die(mysqli_error($conn));

    echo "<script>alert('Data Berhasil Di Ubah');</script>";
    echo "<script> location ='data_pesanan.php';</script>";
}

function rupiah($angka)
{
    if ($angka != "") {
        $angkafix = $angka;
    } else {
        $angkafix = 0;
    }
    $hasilrupiah = "Rp " . number_format($angkafix, 0, '.', '.');
    return $hasilrupiah;
}
