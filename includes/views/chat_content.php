<?php 
/**
 * This file will keep the friendlist and chat, and the logged in user will
 * is able to click on a friend and open up their chatroom. Is made to 
 * resemble the facebook messenger. 
 */

// If the user is not signed in, send to login.
if (!$session->is_signed_in()) {redirect("login.php");} 

// Collects all of the active chatrooms that the user have.
$friends = Friendship::find_active_chatrooms($session->user_id);

// Used when the user enter the page from a profile.
$current_chat_id  = 0;
$current_username ="";

// If the user is set, then place the room-id in $current_user.
if (!isset($_GET["user"])) {
    $current_user = 0;
} else {
    $current_user = $_GET["user"];
}

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

                /**
                 * Inside of this div is the list of friends that have an 
                 * active userchat open. The user can click on one of
                 * them to show their chat.
                 */

                // For each of the objects placed in the $friends array.
                foreach ($friends as $friend) : 

                    // Finds out which of the two user-id's is the signed in user's friend.
                    if ($friend->user_1 !== $session->user_id) {
                        $user = User::find_by_id($friend->user_1);
                    } else {
                        $user = User::find_by_id($friend->user_2);
                    }

                    // Sets the value in chatId to this user's room-id.
                    if ($current_user == $user->id) {
                        $current_chat_id = $friend->chat_id;
                        $current_username = $user->username;
                    }

                    // Will collect and count all of the unread messages that the current user have.
                    $unread_messages = Message::count_unread_messages($friend->chat_id, $user->id);
                    $counter = count($unread_messages);
                    ?>

                    <!-- The if inside of class will decide if it is active or not, stores collectable information in this div, called parent in the chat-js-->
                    <div class="user <?php if($current_user == $user->id) {echo "-active";} ?> " value="<?php echo $friend->chat_id; ?>" 
                        username="<?php echo $user->username; ?>" userId="<?php echo $user->id; ?>" fsId="<?php echo $friend->id; ?>" 
                        signed_in="<?php echo $user->signed_in; ?>">

                        <!-- Places the avatar inside of the div, then places the username. -->
                        <div class="avatar -s" style="background-image: url(<?php echo $user->get_user_image(); ?>)"></div>
                        <div class="username"><?php echo $user->username; ?></div>

                        <!-- This shows number of unread messages that the user have, if they have any. -->
                        <?php if ($counter > 0): ?> 
                        <div class="notice"><?php echo $counter; ?></div>
                        <?php endif;?>

                        <!-- Closes the chat if the X is clicked. -->
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

                    <?php if ($current_username != ""): ?>
                        <a href="profile.php?id='<?php echo $current_user ?> '" class="username"><?php echo $current_username ?></a>;
                    <?php endif; ?>

                </span>
                <i id="state" class="state -away"></i>
            </div>
            <div class="view" id="view">

                <!-- Shows all the messages sent by read_chat.php inside here -->
                <div id="chatOutput"></div>

            </div>

            <div class="input">
                <textarea  rows="1" placeholder="Message" id="chat-input"></textarea>
            </div>

            <!-- Where room-id is stored in the value property -->
            <input id="chatId" style="display: none;" value="<?php echo $current_chat_id; ?>">

            <!-- The javascript-file that holds the functions needed for the chat -->
            <script src="assets/js/chat_frontend.js"></script>
            <script src="assets/js/chat_backend.js"></script>
        </div>
    </div>
</main>


