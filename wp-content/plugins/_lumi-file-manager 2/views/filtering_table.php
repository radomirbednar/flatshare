<p></p>
<hr>
<p></p>

<span class="acf-label"><strong><?php _e( 'Filtrovat ceníky:', LUMI__BE__FILEMANAG__TEXTDOMAIN ); ?></strong></span>

<table class="acf-table acf-input-table" data-js-lumi-be-filtering_table>
	<thead>
	<tr>
		<th class="acf-th"><?php _e( 'Entita', LUMI__BE__FILEMANAG__TEXTDOMAIN ); ?></th>
		<th class="acf-th"><?php _e( 'Komodita', LUMI__BE__FILEMANAG__TEXTDOMAIN ); ?></th>
		<th class="acf-th"><?php _e( 'Zákazník', LUMI__BE__FILEMANAG__TEXTDOMAIN ); ?></th>
		<th class="acf-th"><?php _e( 'Produktová řada', LUMI__BE__FILEMANAG__TEXTDOMAIN ); ?></th>
		<th class="acf-th"><?php _e( 'Distribuční oblast', LUMI__BE__FILEMANAG__TEXTDOMAIN ); ?></th>
		<th class="acf-th"><?php _e( 'Rok', LUMI__BE__FILEMANAG__TEXTDOMAIN ); ?></th>
		<th class="acf-th"><?php _e( 'Verze', LUMI__BE__FILEMANAG__TEXTDOMAIN ); ?></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<?php foreach( $fields_list as $field ): ?>
			<td>
				<select data-js-lumi-be-filter="<?php echo $field; ?>">
					<option value="no_filter">(Nefiltrovat)</option>
					<option value="blank">(Bez hodnoty)</option>
					<?php foreach( $$field as $item ): ?>
						<option value="<?php echo $item['tag']; ?>"><?php echo $item[ 'title' ]; ?></option>
					<?php endforeach; ?>
				</select>
			</td>
		<?php endforeach; ?>
		<td>
			<select data-js-lumi-be-filter="rok">
				<option value="no_filter">(Nefiltrovat)</option>
				<option value="blank">(Bez hodnoty)</option>
				<?php foreach( $years as $item ): ?>
					<option value="<?php echo $item; ?>"><?php echo $item; ?></option>
				<?php endforeach; ?>
			</select>
		</td>
		<td>
			<select data-js-lumi-be-filter="verze">
				<option value="no_filter">(Nefiltrovat)</option>
				<option value="blank">(Bez hodnoty)</option>
				<?php foreach( $verze as $item ): ?>
					<option value="<?php echo $item; ?>"><?php echo $item; ?></option>
				<?php endforeach; ?>
			</select>
		</td>

	</tr>
	</tbody>
</table>
<br>
<button class="acf-button" data-js-lumi-be-filtering_clear><?php _e( 'Vymazat filtr', LUMI__BE__FILEMANAG__TEXTDOMAIN ); ?></button>

<p></p>
<hr>
<p></p>