<div id="userPopup" class="popup">
    <div class="popup-content">
        <span class="close-btn">&times;</span>
        <button type="button" id="chooseSelectedBtn" class="choose-btn">Wybierz</button> <!-- Nowy przycisk Wybierz -->
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

<style>
    
.choose-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #4CAF50; /* Kolor przycisku (można zmienić) */
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 14px;
    cursor: pointer;
}

.choose-btn:hover {
    background-color: #45a049;
}

</style>