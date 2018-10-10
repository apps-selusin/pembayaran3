<?php

// Global user functions
// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

function f_isidetailpembayaranrutin($rsold, $rsnew) {

	// ambil data tahun ajaran dan diloop selama satu periode tahun ajaran
	// mulai awal tahun ajaran hingga akhir tahun ajaran

	$q = "select * from t00_tahunajaran";
	$r = Conn()->Execute($q);
	$awal  = $r->fields["Awal_Bulan"].$r->fields["Awal_Tahun"]; // 72018
	$akhir = $r->fields["Akhir_Bulan"].$r->fields["Akhir_Tahun"]; // 62019
	$bulan = $r->fields["Awal_Bulan"] - 1;
	$tahun = $r->fields["Awal_Tahun"];
	while ($awal != $akhir) {
		$bulan++;
		if ($bulan == 13) {
			$bulan = 1;
			$tahun++;
		}
		$q = "insert into
			t06_siswarutinbayar (
				siswa_id,
				rutin_id,
				bulan,
				tahun,
				bayar_jumlah
			) values (
			".$rsnew["siswa_id"].",
			".$rsnew["rutin_id"].",
			".$bulan.",
			".$tahun.",
			".$rsnew["Nilai"]."
			)";
		Conn()->Execute($q);
		$awal = $bulan.$tahun;
	}
}
?>
