<?php 
/**
 * This file will keep the friendlist and chat, and the logged in user will
 * is able to click on a friend and open up their chatroom. Is made to 
 * resemble the facebook messenger. 
 */

// Collects all of the active chatrooms that the user have.
$friends = Friendship::find_active_chatrooms($session->user_id);

// Used when the user enter the page from a profile.
$current_user    = 0;
$current_chat_id = 0;
$current_username ="";

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

            // For each of the objects placed in the $friends array.
            foreach ($friends as $friend) : 

                // Finds out which of the two user-id's is the signed in user's friend.
                if ($friend->user_1 !== $session->user_id) {
                    $user = User::find_by_id($friend->user_1);
                } else {
                    $user = User::find_by_id($friend->user_2);
                }

                // If the user is set, then place the room-id in $current_user.
                if (!isset($_GET["user"])) {
                    $current_user = 0;
                } else {
                    $current_user = $_GET["user"];
                }

                // Sets the value in chatId to this user's room-id.
                if ($current_user == $user->id) {
                    $current_chat_id = $friend->chatroom;
                    $current_username = $user->username;
                }
                ?>

                <!-- The if inside of class will -->
                <div class="user <?php if($_GET["user"] == $user->id) {echo "-active";} ?> " value="<?php echo $friend->chatroom; ?>" 
                        username="<?php echo $user->username; ?>" userId="<?php echo $user->id; ?>" fsId="<?php echo $friend->id; ?>">

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
                <!-- The <a> is sent by the javascript that control the Html and css -->
                <span id="username">
                    
                    <?php 
                    // This is here to show of the correct user's name when one enter the page from the menu.
                    if ($current_username != "") {
                        echo '<a href="profile.php?id=' . $current_user . '" class="username">' . $current_username . '</a>';
                    }
                    ?>

                </span><i class="state -away"></i>
            </div>
            <div class="view">

                <!--  -->
                <div class="message -user">
                    <div><div class="avatar" style="background-image: url(assets/img/avatar.jpg)"></div></div>
                    <div class="content">
                        <div class="info"><a href="#" class="name">Daniel</a><span class="time">08:30</span></div>
                        <p class="text">secret raids on Al-Quaeda, and I have over 300 confirmed kills. I am trained in gorilla warfare and I'm the top sniper in the entire US armed forces. You are nothing to me but just another target. I will wipe you the fuck out with precision the likes of which has never been seen before on this Earth, mark my fucking words. You think you can get away with saying that shit to me over the Internet? Think again, fucker. As we speak I am contacting my secret network of spies across the USA and your IP is bein</p>
                    </div>
                </div>

                <!-- Shows all the messages sent by read_chat.php inside here -->
                <div id="chatOutput"></div>

            </div>

            <div class="input">
                <textarea  rows="1" placeholder="Message" id="chat-input"></textarea>
            </div>

            <!-- Where room-id is stored in the value property -->
            <input id="chatId" style="display: none;" value="<?php echo $current_chat_id; ?>">

            <script src="assets/js/chat.js"></script>
            <script src="assets/js/chat-david.js" async></script>
        </div>
    </div>
</main>


