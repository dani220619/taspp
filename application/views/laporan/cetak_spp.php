<?php
$pdf = new FPDF("L", "cm", "F4");

$pdf->SetMargins(2, 1, 1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
$pdf->Image('assets/img/aplikasi/logo.png', 2.5, 0.5, 3, 2.5);
$pdf->SetX(8);
$pdf->MultiCell(19.5, 0.7, "PONDOK PESANTREN", 0, 'C');
$pdf->SetFont('Times', 'B', 14);
$pdf->SetX(8);
$pdf->MultiCell(19.5, 0.7, "AL MUNAWWIR KRAPYAK KOMPLEK L YOGYAKARTA", 0, 'C');
$pdf->SetFont('Times', '', 12);
$pdf->SetX(8);
$pdf->MultiCell(19.5, 0.7, 'Jl. KH. Ali Maksum Tromol Pos 5, Krapyak Kulon, Krapyak, Kec. Sewon, Bantul, Daerah Istimewa Yogyakarta
', 0, 'C');
$pdf->Line(2, 3.1, 31, 3.1);
$pdf->SetLineWidth(0.1);
$pdf->Line(2, 3.2, 31, 3.2);
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->MultiCell(31, 0.7, "DATA PEMBAYARAN SPP SANTRI", 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(31, 0.7, '' . $ket . '', 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(5, 0.6, "Di cetak pada : " . date("d/m/Y"), 0, 0, 'C');
$pdf->ln(1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'ID TRANSAKSI', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'NIS', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'NAMA', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'BULAN', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'TANGGAL BAYAR', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'BESAR SPP', 1, 0, 'C');
$pdf->Cell(5, 0.8, 'METODE PEMBAYARAN', 1, 0, 'C');

$pdf->ln();

if (!empty($spp_bulanan)) {
    $no = 1;
    foreach ($spp_bulanan as $data) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(1, 0.6, $no++, 1, 0, 'C');
        $pdf->Cell(4, 0.6, $data->id_transaksi, 1, 0, 'C');
        $pdf->Cell(3, 0.6, $data->nis, 1, 0, 'C');
        $pdf->Cell(4.5, 0.6, $data->nama_santri, 1, 0, 'C');
        if ($data->id_bulan <= 12) {
            $tahun = substr($data->tahun_ajaran, 0, 4);
        } else {
            $tahun = substr($data->tahun_ajaran, 0, 4);
        }
        $pdf->Cell(3.5, 0.6, $data->nama_bulan . ' ' . $tahun, 1, 0, 'C');
        $pdf->Cell(4, 0.6, date('d-m-Y', strtotime($data->tanggal_bayar)), 1, 0, 'C');
        $pdf->Cell(3, 0.6, 'Rp. ' . number_format($data->besar_spp, 0, ',', '.'), 1, 0, 'C');
        $pdf->Cell(5, 0.6, $data->metode_pembayaran, 1, 0, 'C');
        $pdf->ln();
    }
}
$pdf->Output("Laporan SPP Santri.pdf", "I");
