    <?php 
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
                
                <a class="action" onclick="start_chat(<?php echo $session->user_id . ", " . $user->id ?>)">
                    <i class="fas fa-fw fa-comment-alt"></i>
                </a>

                <div class="action -delete">
                    <i class="fas fa-fw fa-user-times"></i>
                </div>
            </div>
        </div>

    </div>

    <?php
        endforeach; 
    ?>