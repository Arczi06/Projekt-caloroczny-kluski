<div id="userPopup" class="popup">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <h2>Wybierz użytkownika</h2>
        <div class="user-groups">
            <?php
            $current_user_id = $_SESSION['user_id'];

            foreach ($users as $group => $members):
            ?>
                <h3><?php echo $group; ?></h3>
                <div class="user-list">
                    <?php
                    foreach ($members as $user):
                        if ($user['id'] == $current_user_id) {
                            continue;
                        }
                    ?>
                        <div class="user-tile" data-id="<?php echo $user['id']; ?>" data-name="<?php echo $user['username']; ?>">
                            <img src="ni/<?php echo $user['profile_image']; ?>" alt="Zdjęcie profilowe" class="user-avatar">
                            <span><?php echo $user['username']; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
