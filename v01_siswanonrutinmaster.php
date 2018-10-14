<?php

// Siswa_Nomor_Induk
// Siswa_Nama
// nonrutin_id
// Nilai
// Terbayar
// Sisa

?>
<?php if ($v01_siswanonrutin->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $v01_siswanonrutin->TableCaption() ?></h4> -->
<table id="tbl_v01_siswanonrutinmaster" class="table table-bordered table-striped ewViewTable">
<?php echo $v01_siswanonrutin->TableCustomInnerHtml ?>
	<tbody>
<?php if ($v01_siswanonrutin->Siswa_Nomor_Induk->Visible) { // Siswa_Nomor_Induk ?>
		<tr id="r_Siswa_Nomor_Induk">
			<td><?php echo $v01_siswanonrutin->Siswa_Nomor_Induk->FldCaption() ?></td>
			<td<?php echo $v01_siswanonrutin->Siswa_Nomor_Induk->CellAttributes() ?>>
<span id="el_v01_siswanonrutin_Siswa_Nomor_Induk">
<span<?php echo $v01_siswanonrutin->Siswa_Nomor_Induk->ViewAttributes() ?>>
<?php echo $v01_siswanonrutin->Siswa_Nomor_Induk->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($v01_siswanonrutin->Siswa_Nama->Visible) { // Siswa_Nama ?>
		<tr id="r_Siswa_Nama">
			<td><?php echo $v01_siswanonrutin->Siswa_Nama->FldCaption() ?></td>
			<td<?php echo $v01_siswanonrutin->Siswa_Nama->CellAttributes() ?>>
<span id="el_v01_siswanonrutin_Siswa_Nama">
<span<?php echo $v01_siswanonrutin->Siswa_Nama->ViewAttributes() ?>>
<?php echo $v01_siswanonrutin->Siswa_Nama->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($v01_siswanonrutin->nonrutin_id->Visible) { // nonrutin_id ?>
		<tr id="r_nonrutin_id">
			<td><?php echo $v01_siswanonrutin->nonrutin_id->FldCaption() ?></td>
			<td<?php echo $v01_siswanonrutin->nonrutin_id->CellAttributes() ?>>
<span id="el_v01_siswanonrutin_nonrutin_id">
<span<?php echo $v01_siswanonrutin->nonrutin_id->ViewAttributes() ?>>
<?php echo $v01_siswanonrutin->nonrutin_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($v01_siswanonrutin->Nilai->Visible) { // Nilai ?>
		<tr id="r_Nilai">
			<td><?php echo $v01_siswanonrutin->Nilai->FldCaption() ?></td>
			<td<?php echo $v01_siswanonrutin->Nilai->CellAttributes() ?>>
<span id="el_v01_siswanonrutin_Nilai">
<span<?php echo $v01_siswanonrutin->Nilai->ViewAttributes() ?>>
<?php echo $v01_siswanonrutin->Nilai->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($v01_siswanonrutin->Terbayar->Visible) { // Terbayar ?>
		<tr id="r_Terbayar">
			<td><?php echo $v01_siswanonrutin->Terbayar->FldCaption() ?></td>
			<td<?php echo $v01_siswanonrutin->Terbayar->CellAttributes() ?>>
<span id="el_v01_siswanonrutin_Terbayar">
<span<?php echo $v01_siswanonrutin->Terbayar->ViewAttributes() ?>>
<?php echo $v01_siswanonrutin->Terbayar->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($v01_siswanonrutin->Sisa->Visible) { // Sisa ?>
		<tr id="r_Sisa">
			<td><?php echo $v01_siswanonrutin->Sisa->FldCaption() ?></td>
			<td<?php echo $v01_siswanonrutin->Sisa->CellAttributes() ?>>
<span id="el_v01_siswanonrutin_Sisa">
<span<?php echo $v01_siswanonrutin->Sisa->ViewAttributes() ?>>
<?php echo $v01_siswanonrutin->Sisa->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
