<?php
$pdf = new FPDF("L", "cm", "F4");

$pdf->SetMargins(2, 1, 1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$pdf->Image('assets/img/aplikasi/logo.png', 2.5, 0.5, 3, 2.5);
$pdf->SetX(8);
$pdf->MultiCell(19.5, 0.7, "PONDOK PESANTREN", 0, 'C');
$pdf->SetFont('Arial', 'B', 14);
$pdf->SetX(8);
$pdf->MultiCell(19.5, 0.7, "AL MUNAWWIR KRAPYAK KOMPLEK L YOGYAKARTA", 0, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->SetX(8);
$pdf->MultiCell(19.5, 0.7, 'Jl. KH. Ali Maksum Tromol Pos 5, Krapyak Kulon, Krapyak, Kec. Sewon, Bantul, Daerah Istimewa Yogyakarta
', 0, 'C');
$pdf->Line(2, 3.1, 31, 3.1);
$pdf->SetLineWidth(0.1);
$pdf->Line(2, 3.2, 31, 3.2);
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 11);
$pdf->MultiCell(31, 0.7, "DATA KAS KELUAR", 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(31, 0.7, '' . $ket . '', 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(5, 0.6, "Di cetak pada : " . date("d/m/Y"), 0, 0, 'C');
$pdf->ln(1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'ID KAS', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'TIPE KAS', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'TANGGAL', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, 'KETERANGAN', 1, 0, 'C');
$pdf->Cell(4.5, 0.8, ' NOMINAL', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'SALDO', 1, 0, 'C');
$pdf->ln();
if (!empty($kas_keluar)) {
    $no = 1;
    $saldo = 0;
    foreach ($kas_keluar as $data) {
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(1, 0.6, $no++, 1, 0, 'C');
        $pdf->Cell(4, 0.6, $data['id_kas'], 1, 0, 'C');
        $pdf->Cell(4, 0.6, $data['tipe_kas'], 1, 0, 'C');
        $pdf->Cell(4, 0.6, $data['tgl_transaksi'], 1, 0, 'C');
        $pdf->Cell(4.5, 0.6, $data['keterangan'], 1, 0, 'C');
        $pdf->Cell(4.5, 0.6, 'Rp. ' . number_format($data['nominal'], 0, ',', '.'), 1, 0, 'C');
        if ($data['keterangan'] == 0) {
            $nominal = $data['nominal'];
            $saldo = $saldo + $data['nominal'];
        } 
        $pdf->Cell (4, 0.6, 'Rp. ' . number_format($saldo, 0, ',', '.'), 1, 0, 'C');
        $pdf->ln();
    }
}
$pdf->Output("Laporan Kas Keluar.pdf", "I");
