<?php

// nonrutin_id
// Nilai

?>
<?php if ($t08_siswanonrutin->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t08_siswanonrutin->TableCaption() ?></h4> -->
<table id="tbl_t08_siswanonrutinmaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t08_siswanonrutin->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t08_siswanonrutin->nonrutin_id->Visible) { // nonrutin_id ?>
		<tr id="r_nonrutin_id">
			<td><?php echo $t08_siswanonrutin->nonrutin_id->FldCaption() ?></td>
			<td<?php echo $t08_siswanonrutin->nonrutin_id->CellAttributes() ?>>
<span id="el_t08_siswanonrutin_nonrutin_id">
<span<?php echo $t08_siswanonrutin->nonrutin_id->ViewAttributes() ?>>
<?php echo $t08_siswanonrutin->nonrutin_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t08_siswanonrutin->Nilai->Visible) { // Nilai ?>
		<tr id="r_Nilai">
			<td><?php echo $t08_siswanonrutin->Nilai->FldCaption() ?></td>
			<td<?php echo $t08_siswanonrutin->Nilai->CellAttributes() ?>>
<span id="el_t08_siswanonrutin_Nilai">
<span<?php echo $t08_siswanonrutin->Nilai->ViewAttributes() ?>>
<?php echo $t08_siswanonrutin->Nilai->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
