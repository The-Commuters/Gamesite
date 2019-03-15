<?php 

/**
 * This is the friendlist that will show up on the chat page and the chat
 * that will change depending on which radio-button is pressed..
 */

$friends = Friendship::find_friends($session->user_id);
?>

<div>
 <table>
  <thead>
   <tr>
    <th>Image</th>
    <th>Username</th>
    <th>Chat</th>
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
  <div>
	<td>
		<a href="profile.php?id=<?php echo $user->id; ?>">
			<img src="<?php echo $user->get_user_image();?>" style="height: 100px; width: 100px;">
		</a>
	</td>

	<td><?php echo $user->username; ?></td>
	<td>

    <!-- Here the radiobutton is placed, and pressing it will change the room-id to that persons user_id. -->
    <input type="radio" name="roomId" value="<?php echo $user->id; ?>" onclick="document.getElementById('chatId').value=this.value">
  
  </td>
  </div>
</a>
</tr>

<?php endforeach; ?>


<!--$chatroom_id is set up wherever this is called, and will decide what room id it is.-->
<div id="find_messages">
<div class="chatcontainer" style="float: left;">
  <main>
    <div class="userSettings">
      <input id="chatId" type="text" placeholder="1" maxlength="32" value="1">
    </div>
    <div class="chat">
      <div id="chatOutput"></div>
      <input id="chatInput" type="text" placeholder="Input Text here" maxlength="128">
      <button id="chatSend">Send</button>
    </div>
  </main>
</div>
<script src="assets/js/chat.js"></script>
</div>

</tbody>
</table>
</div>