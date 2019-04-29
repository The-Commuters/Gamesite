        <?php 

        /**
         * As friendlist_content is renewed as someone delete a
         * user, this need's to be placed here, as it cant find
         * the classes without.
        */

        $path = dirname(__FILE__,2) .DIRECTORY_SEPARATOR."init.php";
        require_once($path); 
        

        /**
         * The upper container holds the friend-requests and shows
         * them up for the user to decide what he/she want to do.
         * They can accept and refuse the request, or visit the  
         * profile of the user.
         */
        $requests = Friendship::find_friend_requests($session->user_id);
        foreach ($requests as $request) : 

            // Collects all the information of the user that sent the request
            $user = User::find_by_id($request->user_1);
            if ($user->signed_in == 1) {
                $signed_in = "-active";
                $status = "Online";
            } else {
                $signed_in = "";
                $status = "Offline";
            }
            ?>

            <div class="friend">
                <div class="friend-info">
                    <div style="background-image: url(<?php echo $user->get_user_image(); ?>" class="avatar -s"></div>
                    <div class="username"><?php echo $user->username; ?><div class="friend-request-notification">New</div></div>
                </div>

                <div class="friend-status">
                    <div class="status <?php echo $signed_in ?>"></div>
                    <div class="description"><?php echo $status ?></div>
                </div>

                <!-- Here the button for the friend request is placed, and the message when it is sent. -->
                <div class="friend-actions" id="handle_friend_request">

                    <a class="action -add" onclick="handleFriendRequest(<?php echo $session->user_id ?>, <?php echo $request->user_1 ?>, 
                        <?php echo $request->id ?>, 1)">
                        <i class="fas fa-fw fa-check"></i>
                    </a>

                    <a class="action -delete" onclick="handleFriendRequest(<?php echo $session->user_id ?>, <?php echo $request->user_1 ?>, 
                        <?php echo $request->id ?>, 0)">
                        <i class="fas fa-fw fa-trash-alt"></i>
                    </a>

                    <a href="profile.php?id=<?php echo $user->id; ?>" class="action">
                        <i class="fas fa-user"></i>
                    </a> 

                </div>
            </div>


        <?php 
        endforeach; 
        ?>

        <?php 
        /**
         * Inside of this div the friendlist is placed, and
         * the user can choose to go to their profile, open 
         * a chatroom and delete from from the friendlist.
         */

        if (!isset($_GET['f'])) {
            $friends = Friendship::find_friends($session->user_id);
        }

        // Lists opp all the friends.
        foreach ($friends as $friend) :

            if ($friend->user_1 !== $session->user_id) {
                $user = User::find_by_id($friend->user_1);
            } else {
                $user = User::find_by_id($friend->user_2);
            }

            if ($user->signed_in == 1) {
                $signed_in = "-active";
                $status = "Online";
            } else {
                $signed_in = "";
                $status = "Offline";
            }
            ?> 

            <div class="friendlist-container">

                <div class="friend">
                    <div class="friend-info">
                        <div style="background-image: url(<?php echo $user->get_user_image(); ?>" class="avatar -s"></div>
                        <div class="username"><?php echo $user->username; ?></div>
                    </div>

                    <div class="friend-status">
                        <div class="status <?php echo $signed_in ?>"></div>
                        <div class="description"><?php echo $status ?></div>
                    </div>

                    <div class="friend-actions">
                        <a href="profile.php?id=<?php echo $user->id; ?>" class="action">
                            <i class="fas fa-user"></i>
                        </a>

                        <a class="action" onclick="startChat(<?php echo $session->user_id . ", " . $user->id ?>)">
                            <i class="fas fa-fw fa-comment-alt"></i>
                        </a>

                        <div class="action -delete" onclick="deleteFriend(<?php echo $session->user_id . ", " . $user->id ?>)">
                            <i class="fas fa-fw fa-user-times"></i>
                        </div>
                    </div>
                </div>

            </div>

        <?php
        endforeach; 
        ?>