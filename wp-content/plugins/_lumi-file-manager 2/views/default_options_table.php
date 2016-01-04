<p></p>
<hr>
<p></p>

<span class="acf-label"><strong><?php _e( 'Přednastavit tyto hodnoty pro nově přidané ceníky:', LUMI__BE__FILEMANAG__TEXTDOMAIN ); ?></strong></span>

<table class="acf-table acf-input-table" data-js-lumi-be-defaults_table style="width: auto;">
	<thead>
		<tr>
			<th class="acf-th"><?php _e( 'Publikovat od', LUMI__BE__FILEMANAG__TEXTDOMAIN ); ?></th>
			<th class="acf-th"><?php _e( 'Publikovat do', LUMI__BE__FILEMANAG__TEXTDOMAIN ); ?></th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<input type="text" data-js-default="publish_at" data-js-timepicker />
			</td>
			<td>
				<input type="text" data-js-default="publish_until" data-js-timepicker />
			</td>
		</tr>
	</tbody>
</table>