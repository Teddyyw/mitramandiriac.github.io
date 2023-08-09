<?php
// tambahan
require __DIR__ . '/vendor/autoload.php';

require 'function.php';
require 'cek.php';


use Dompdf\Dompdf;

// Function to generate the PDF content
function generatePDF($conn)
{
    ob_start();
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Pesanan PDF</title>
        <!-- Include your CSS styles if needed -->
        <style type="text/css">
            body {
                -webkit-print-color-adjust: exact;
            }

            #table {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
                /* Set the table width to 80% of the page width */
            }

            #table td,
            #table th {
                padding: 5px;
                /* Reduce the padding of table cells */
                border: 1px solid black;
            }

            #table tr {
                padding-top: 5px;
                padding-bottom: 5px;
            }

            #table tr:hover {
                background-color: #ddd;
            }

            #table th {
                padding-top: 5px;
                padding-bottom: 5px;
                text-align: left;
                background-color: #1e277d;
                color: white;
                font-size: 12px;
                /* Reduce the font size of table headers */
            }

            #table td {
                font-size: 11px;
                /* Reduce the font size of table cells */
            }
        </style>
    </head>

    <body>
        <?php
        $selected_teknisi = (isset($_GET['teknisi'])) ? $_GET['teknisi'] : '';
        $selected_layanan = (isset($_GET['jenis_layanan'])) ? $_GET['jenis_layanan'] : ''; ?>
        <center>
            <h1>Data Pesanan</h1>
        </center>
        <?php if (!empty($selected_teknisi)) :
            $t = $conn->query("SELECT * FROM tbl_teknisi WHERE id='$selected_teknisi'");
            $ta = $t->fetch_assoc(); ?>
            Teknisi : <?= $ta['nama'] ?><br>
        <?php endif; ?>
        <?php if (!empty($selected_layanan)) :
            $l = $conn->query("SELECT * FROM tbl_layanan WHERE id='$selected_layanan'");
            $la = $l->fetch_assoc(); ?>
            Jenis Layanan : <?= $la['jenis_layanan'] ?>
        <?php endif; ?>
        <table id="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal Servis</th>
                    <th>Jam Servis</th>
                    <th>Nomor Telepon</th>
                    <th>Nama Customer</th>
                    <th>Jenis Layanan</th>
                    <th>Nama Teknisi</th>
                    <th>Jenis Bayar</th>
                    <th>Harga</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomor = 1;
                $hariini = date('Y-m-d');


                $query = "SELECT * FROM tbl_pesanan LEFT JOIN tbl_customer ON tbl_pesanan.id_customer = tbl_customer.id ";
                // Add the WHERE clause to filter by selected technician, if provided
                if (!empty($selected_teknisi)) {
                    $query .= " WHERE tbl_pesanan.id_teknisi = '$selected_teknisi'";
                }

                if (!empty($selected_layanan)) {
                    if (!empty($selected_teknisi)) {
                        $query .= " AND ";
                    } else {
                        $query .= " WHERE ";
                    }
                    $query .= " tbl_pesanan.id_layanan = '$selected_layanan'";
                }

                $query .= " ORDER BY tbl_pesanan.tgl_servis DESC, tbl_pesanan.id_pesanan DESC";
                $ambil = $conn->query($query);
                while ($data = $ambil->fetch_assoc()) {

                    $layanan = $conn->query("SELECT * FROM tbl_layanan WHERE id='$data[id_layanan]'");
                    $layananac = $layanan->fetch_assoc();

                    $jenisbayar = $conn->query("SELECT * FROM tbl_jenis_bayar WHERE id='$data[id_jenis_bayar]'");
                    $jenisbayarac = $jenisbayar->fetch_assoc();

                    $teknisi = $conn->query("SELECT * FROM tbl_teknisi WHERE id='$data[id_teknisi]'");
                    $teknisiac = $teknisi->fetch_assoc();

                    if ($data['terakhirnotice'] != 'Belum') {
                        $terakhirnotice = $onemonthBefore = date('Y-m-d', strtotime($data["terakhirnotice"] . ' +90 day'));
                        $date1 = new DateTime($data["terakhirnotice"]);
                        $date2 = new DateTime($hariini);
                        $interval = $date1->diff($date2);
                        $days = $interval->days;
                        $warna = "text-dark";
                        if ($days >= 90) {
                            $warna = "text-danger"; // Set the color to red
                        } else {
                            $warna = "text-dark"; // Set the default color
                        }
                    } else {
                        $warna = "text-danger";
                    }
                ?>
                    <tr class="<?= $warna ?>">
                        <td><?php echo $nomor ?></td>
                        <td><?php echo tanggal($data["tgl_servis"]) ?></td>
                        <td><?php echo $data["jam_servis"] ?></td>
                        <td><?php echo $data["no_telp"] ?></td>
                        <td><?php echo $data["nama"] ?></td>
                        <td><?php echo $layananac["jenis_layanan"] ?></td>
                        <td><?php echo $teknisiac["nama"] ?></td>
                        <td><?php echo $jenisbayarac["jenis_bayar"] ?></td>
                        <td><?php echo rupiah($data["harga"]) ?></td>
                        <td><?php echo $data["alamatt"] ?></td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>
    </body>

    </html>
<?php
    $html = ob_get_clean();

    // Initialize Dompdf object
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait'); // Set paper size and orientation

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to the browser
    $dompdf->stream('Data_Pesanan.pdf', ['Attachment' => false]);
}

// Call the function to generate the PDF
generatePDF($conn);
