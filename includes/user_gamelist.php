<!-- For each loop that runs trough all the elements in the $games array. -->
<?php foreach ($users as $user) : ?>

<tr>

	<td>
		<a href="<?php echo $game->game_path();?>">
			<img src="<?php echo $game->game_image_path();?>" style="height: 100px; width: 100px;">
		</a>
	</td>
	
	<td><?php echo $game->id; ?></td>
	
	<!-- The <a> leads to the canvas that the game is played in. -->
	<td><a href="gamepage.php?game=<?php echo $game->id; ?>"><?php echo $game->filename; ?></a></td>
	<td><?php echo $game->title; ?></td>
	<td><?php echo $game->genre; ?></td>
	<td><?php echo $game->creator; ?></td>
	<td><?php echo $game->size; ?></td>

</tr>

<?php endforeach; ?>