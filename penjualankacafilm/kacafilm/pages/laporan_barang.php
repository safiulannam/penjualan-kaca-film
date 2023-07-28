<?php
require('/xampp/htdocs/penjualankacafilm/penjualankacafilm/kacafilm/fpdf186/fpdf.php');

class PDF extends FPDF
{
    // Fungsi untuk menghasilkan header pada laporan
    function Header()
    {
        // Logo atau gambar header
        // Mendefinisikan path absolut file gambar
$absolutePath = 'C:/xampp/htdocs/penjualankacafilm/penjualankacafilm/kacafilm/logo.png';


// Menggunakan path absolut dalam fungsi Image()
$this->Image($absolutePath, 10, 10, 30);
        // $this->Image('logo.png', 10, 10, 30);

        // Judul laporan
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 15, 'Laporan Penjualan', 0, 1, 'C');

        // Tanggal laporan
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Tanggal: ' . date('d-m-Y'), 0, 1, 'R');

        // Garis pemisah antara header dengan isi laporan
        $this->Line(10, 35, 200, 35);
        $this->Ln(10);
    }

    // Fungsi untuk menghasilkan footer pada laporan
    function Footer()
    {
        // Teks footer
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo(), 0, 0, 'C');
    }

    // Fungsi untuk menghasilkan isi laporan
    function Content()
    {
        // Ambil data dari database
        $koneksi = mysqli_connect('localhost', 'root', '', 'penjualankacafilm');
        $query = "SELECT * FROM jual";
        $result = mysqli_query($koneksi, $query);

        // Tabel isi laporan
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(40, 10, 'Kode Jual', 1, 0, 'C');
        $this->Cell(40, 10, 'Kode User', 1, 0, 'C');
        $this->Cell(40, 10, 'Kode Pelanggan', 1, 0, 'C');
        $this->Cell(40, 10, 'Total', 1, 0, 'C');
        $this->Cell(40, 10, 'Tanggal', 1, 1, 'C');

        $this->SetFont('Arial', '', 10);
        while ($row = mysqli_fetch_array($result)) {
            $this->Cell(40, 10, $row['kode_jual'], 1, 0, 'C');
            $this->Cell(40, 10, $row['kode_user'], 1, 0, 'C');
            $this->Cell(40, 10, $row['kode_pelanggan'], 1, 0, 'C');
            $this->Cell(40, 10, $row['total'], 1, 0, 'C');
            $this->Cell(40, 10, $row['tanggal'], 1, 1, 'C');
        }
    }
}

// Buat objek PDF
$pdf = new PDF();

// Tambahkan halaman
$pdf->AddPage();

// Tampilkan isi laporan
$pdf->Content();

// Outputkan PDF
$pdf->Output();
?>
