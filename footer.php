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
	// Table 't06_siswarutinbayar_2' Field 'periode_awal'

	$('[data-table=t06_siswarutinbayar_2][data-field=x_periode_awal]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				var all = $row["periode_awal"].find("option:selected").text();

				//$row["Bayar_Titipan"].val($row["pinjamantitipan_id"].find("option:selected").text());
				/*// denda
				var denda_asli = $row["TotalDenda"].val();
				var denda_clean = denda_asli.replace(/,/g, '');
				var denda = parseFloat(denda_clean);

				// bayar titipan
				var titipan_asli = $row["Bayar_Titipan"].val();
				var titipan_clean = titipan_asli.replace(/,/g, '');
				var titipan = parseFloat(titipan_clean);

				// bayar non titipan
				var nontitipan_asli = $row["Bayar_Non_Titipan"].val();
				var nontitipan_clean = nontitipan_asli.replace(/,/g, '');
				var nontitipan = parseFloat(nontitipan_clean);

				// bayar_total
				var bayar_total = denda + titipan + nontitipan;
				$row["Bayar_Total"].val(bayar_total);*/

				//alert($row["periode_awal"].val());
				//alert($row["id"].val());

				alert(all);
			}
		}
	);

	// Table 't06_siswarutinbayar_2' Field 'periode_akhir'
	$('[data-table=t06_siswarutinbayar_2][data-field=x_periode_akhir]').on(
		{ // keys = event types, values = handler functions
			"change keyup": function(e) {
				var $row = $(this).fields();
				/*// denda
				var denda_asli = $row["TotalDenda"].val();
				var denda_clean = denda_asli.replace(/,/g, '');
				var denda = parseFloat(denda_clean);

				// bayar titipan
				var titipan_asli = $row["Bayar_Titipan"].val();
				var titipan_clean = titipan_asli.replace(/,/g, '');
				var titipan = parseFloat(titipan_clean);

				// bayar non titipan
				var nontitipan_asli = $row["Bayar_Non_Titipan"].val();
				var nontitipan_clean = nontitipan_asli.replace(/,/g, '');
				var nontitipan = parseFloat(nontitipan_clean);

				// bayar_total
				var bayar_total = denda + titipan + nontitipan;
				$row["Bayar_Total"].val(bayar_total);*/

				//alert($row["periode_akhir"].val());
				alert($row["id"].val());
			}
		}
	);
</script>
<?php } ?>
</body>
</html>
