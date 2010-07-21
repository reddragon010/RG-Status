<div id="rgs">
	<table>
		<?php foreach($realms as $realm){ ?>
		<tr>
			<td class="rgs_icon">
				<div class="<?php if($realm->online==1){echo('up');}else{echo('down');} ?>"></div>
			</td>
			<td class="rgs_text">
				<span class="<?php if($realm->online==1){echo('up');}else{echo('down');} ?>"<?php echo($realm->name); ?>"><?php echo($realm->name) ?></span>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>