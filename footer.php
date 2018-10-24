<?php if (@$gsExport == "") { ?>
<?php if (@!$gbSkipHeaderFooter) { ?>
				<!-- right column (end) -->
				<?php if (isset($gTimer)) $gTimer->Stop() ?>
			</div>
		</div>
	</div>
	<!-- content (end) -->
	<!-- footer (begin) --><!-- ** Note: Only licensed users are allowed to remove or change the following copyright statement. ** -->
	<div id="ewFooterRow" class="ewFooterRow">	
		<div class="ewFooterText"><?php echo $Language->ProjectPhrase("FooterText") ?></div>
		<!-- Place other links, for example, disclaimer, here -->		
	</div>
	<!-- footer (end) -->	
</div>
<?php } ?>
<!-- modal dialog -->
<div id="ewModalDialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>
<!-- modal lookup dialog -->
<div id="ewModalLookupDialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>
<!-- message box -->
<div id="ewMsgBox" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton" data-dismiss="modal"><?php echo $Language->Phrase("MessageOK") ?></button></div></div></div></div>
<!-- prompt -->
<div id="ewPrompt" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton"><?php echo $Language->Phrase("MessageOK") ?></button><button type="button" class="btn btn-default ewButton" data-dismiss="modal"><?php echo $Language->Phrase("CancelBtn") ?></button></div></div></div></div>
<!-- session timer -->
<div id="ewTimer" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton" data-dismiss="modal"><?php echo $Language->Phrase("MessageOK") ?></button></div></div></div></div>
<!-- tooltip -->
<div id="ewTooltip"></div>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript">
jQuery.get("<?php echo $EW_RELATIVE_PATH ?>phpjs/userevt13.js");
</script>
<script type="text/javascript">

// Write your global startup script here
// document.write("page loaded");
	// Table 't06_siswarutinbayar_2' Field 'siswarutinbayar1_id'

	$('[data-table=t06_siswarutinbayar_2][data-field=x_siswarutinbayar1_id]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var allbayar1 = $row["siswarutinbayar1_id"].find("option:selected").text();
				var allbayar1_2 = allbayar1.split(",");
				tanggal1 = allbayar1_2[1];
				var jumlah1_asli = allbayar1_2[2];
				var jumlah1_clean = jumlah1_asli.replace(/,/g, '');
				jumlah1 = parseFloat(jumlah1_clean);
				var tanggal1_array = tanggal1.split("-");
				dt1 = new Date(tanggal1_array[0], tanggal1_array[1], tanggal1_array[2]);
				var allbayar2 = $row["siswarutinbayar2_id"].find("option:selected").text();
				var allbayar2_2 = allbayar2.split(",");
				tanggal2 = allbayar2_2[1];
				var jumlah2_asli = allbayar2_2[2];
				var jumlah2_clean = jumlah2_asli.replace(/,/g, '');
				jumlah2 = parseFloat(jumlah2_clean);
				var tanggal2_array = tanggal2.split("-");
				dt2 = new Date(tanggal2_array[0], tanggal2_array[1], tanggal2_array[2]);
				if (tanggal2 < tanggal1) {
					alert("Periode kedua harus lebih besar atau sama dengan Periode pertama");
					$row["Bayar_Jumlah"].val(0);
				}
				else {
					var lama_periode = diff_months(dt2, dt1);
					var bayar_jumlah = (diff_months(dt2, dt1) + 1) * jumlah1;
					$row["Bayar_Jumlah"].val(format_koma(bayar_jumlah));
				}
			}
		}
	);

	// Table 't06_siswarutinbayar_2' Field 'siswarutinbayar2_id'
	$('[data-table=t06_siswarutinbayar_2][data-field=x_siswarutinbayar2_id]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var allbayar1 = $row["siswarutinbayar1_id"].find("option:selected").text();
				var allbayar1_2 = allbayar1.split(",");
				tanggal1 = allbayar1_2[1];
				var jumlah1_asli = allbayar1_2[2];
				var jumlah1_clean = jumlah1_asli.replace(/,/g, '');
				jumlah1 = parseFloat(jumlah1_clean);
				var tanggal1_array = tanggal1.split("-");
				dt1 = new Date(tanggal1_array[0], tanggal1_array[1], tanggal1_array[2]);
				var allbayar2 = $row["siswarutinbayar2_id"].find("option:selected").text();
				var allbayar2_2 = allbayar2.split(",");
				tanggal2 = allbayar2_2[1];
				var jumlah2_asli = allbayar2_2[2];
				var jumlah2_clean = jumlah2_asli.replace(/,/g, '');
				jumlah2 = parseFloat(jumlah2_clean);
				var tanggal2_array = tanggal2.split("-");
				dt2 = new Date(tanggal2_array[0], tanggal2_array[1], tanggal2_array[2]);
				if (tanggal2 < tanggal1) {
					alert("Periode kedua harus lebih besar atau sama dengan Periode pertama");
					$row["Bayar_Jumlah"].val(0);
				}
				else {
					var lama_periode = diff_months(dt2, dt1);
					var bayar_jumlah = (diff_months(dt2, dt1) + 1) * jumlah2;
					$row["Bayar_Jumlah"].val(format_koma(bayar_jumlah));
				}
			}
		}
	);

function diff_months(dt2, dt1) {
	var diff =(dt2.getTime() - dt1.getTime()) / 1000;
	diff /= (60 * 60 * 24 * 7 * 4);
	return Math.abs(Math.round(diff));
}

function format_koma(p_bilangan) {
	var bilangan = p_bilangan;
	var	reverse = bilangan.toString().split('').reverse().join(''),
	ribuan 	= reverse.match(/\d{1,3}/g);
	ribuan	= ribuan.join(',').split('').reverse().join('');

	// Cetak hasil	
	//document.write(ribuan); // Hasil: 23.456.789

	return ribuan;
}
</script>
<?php } ?>
</body>
</html>
