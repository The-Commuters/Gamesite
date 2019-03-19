<?php 
/**
 * This file will keep the friendlist and chat, and the logged in user will
 * is able to click on a friend and open up their chatroom. Is made to 
 * resemble the facebook messenger. 
 */

$friends = Friendship::find_friends($session->user_id);

?>

	<main>
		<div class="message-center">
            <div class="chatlist" id="chatlist">

                <div class="header">
                    <div class="title">Chats</div>
                </div>

                <!-- This div creates the users to hte left of the screen -->
                <div class="users">

                	<?php 
					foreach ($friends as $friend) : 
					  if ($friend->user_1 !== $session->user_id) {
					    $user = User::find_by_id($friend->user_1);
					  } else {
					    $user = User::find_by_id($friend->user_2);
					  }
                	?>

                    <div class="user">
                        <div class="avatar -s" style="background-image: url(<?php echo $user->get_user_image(); ?>)"></div>
                        <div class="username"><?php echo $user->username; ?></div>
                        <i class="fas fa-times close"></i>
                    </div>

                  	<?php endforeach; ?>

                </div>

            </div>







            <!-- This is where the messages is loaded in. -->
            <div class="chat">
                <div class="header">
                    <a href="#" class="username">Daniel</a><i class="state -away"></i>
                </div>
                <div class="view">
                	<div id="chatOutput">
                		

                	</div>
                	<!--
                    <div class="message">
                        <div><div class="avatar" style="background-image: url(assets/img/avatar.jpg)"></div></div>
                        <div class="content">
                            <div class="info"><a href="#" class="name">Daniel</a><span class="time">08:30</span></div>
                            <p class="text">Oh wow david the chat looks really good and seems very simple to work with!</p>
                        </div>
                    </div>
						-->
    

                    <div class="message -user">
                        <div><div class="avatar" style="background-image: url(assets/img/avatar.jpg)"></div></div>
                        <div class="content">
                            <div class="info"><a href="#" class="name">Daniel</a><span class="time">08:30</span></div>
                            <p class="text">secret raids on Al-Quaeda, and I have over 300 confirmed kills. I am trained in gorilla warfare and I'm the top sniper in the entire US armed forces. You are nothing to me but just another target. I will wipe you the fuck out with precision the likes of which has never been seen before on this Earth, mark my fucking words. You think you can get away with saying that shit to me over the Internet? Think again, fucker. As we speak I am contacting my secret network of spies across the USA and your IP is bein</p>
                        </div>
                    </div>
					
                </div>
                <div class="input">
                    <textarea  rows="1" placeholder="Message" id="chat-input"></textarea>
                </div>
                

   					<!-- Where the room-id is stored -->
			     	<input id="chatId" style="display: none;" placeholder="1" maxlength="32" value="1">
			     	<button id="chatSend">Send</button>

                <script src="assets/js/chat.js"></script>
            </div>
		</div>
	</main>
<?php 
//   include("friendlist.php");
?>

