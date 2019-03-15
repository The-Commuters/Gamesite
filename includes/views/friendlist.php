<?php 

/**
 * This is the friendlist that will show up on the profile page
 * 
 *
 */

$friends = Friendship::find_friends($session->user_id);
?>

<?php 
$chatroom_id = "h";
include("userchat.php"); 
?>

<div>
 <table>
  <thead>
   <tr>
    <th>Image</th>
    <th>Username</th>
    <th>Chat</th>
    <th>Online?</th>
  </tr>
 </thead>
<tbody>

<?php 
foreach ($friends as $friend) : 
  if ($friend->user_1 !== $session->user_id) {
    $user = User::find_by_id($friend->user_1);
  } else {
    $user = User::find_by_id($friend->user_2);
  }
?>

<tr>

	<td>
		<a href="profile.php?id=<?php echo $user->id; ?>">
			<img src="<?php echo $user->get_user_image();?>" style="height: 100px; width: 100px;">
		</a>
	</td>

	<td><?php echo $user->username; ?></td>
	<td><?php echo "Chat?"; ?></td>
	<td><?php echo "Yes/No" ?></td>

</tr>

<?php endforeach; ?>

</tbody>
</table>
</div>