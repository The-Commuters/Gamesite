
<tr>

	<td>
		<a href="<?php echo $game->game_path();?>">
			<img src="<?php echo $game->game_image_path();?>" style="height: 100px; width: 100px;">
		</a>
	</td>

	<td><?php echo $game->id; ?></td>
	
	<!-- The <a> leads to the canvas that the game is played in. -->
	<td><a href="gamepage.php?game=<?php echo $game->game_path(); ?>"><?php echo $game->filename; ?></a></td>
	<td><?php echo $game->title; ?></td>
	<td><?php echo $game->size; ?></td>
	<td><a href="admin_includes/delete_game.php?id=<?php echo $game->id; ?>">Delete</a></td>

</tr>
