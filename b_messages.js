document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("userPopup");
    const openBtn = document.getElementById("chooseUserBtn");
    const closeBtn = document.querySelector(".close-btn");
    const recipientName = document.getElementById("recipient_name");
    const recipientId = document.getElementById("recipient_id");
    const userTiles = document.querySelectorAll(".user-tile");

    // Otwórz pop-up
    openBtn.addEventListener("click", () => {
        popup.style.display = "flex";
    });

    // Zamknij pop-up
    closeBtn.addEventListener("click", () => {
        popup.style.display = "none";
    });

    // Wybór użytkownika
    userTiles.forEach(tile => {
        tile.addEventListener("click", () => {
            recipientName.value = tile.dataset.name;
            recipientId.value = tile.dataset.id;
            popup.style.display = "none";
        });
    });

    // Zamknij pop-up po kliknięciu poza nim
    popup.addEventListener("click", (e) => {
        if (e.target === popup) {
            popup.style.display = "none";
        }
    });
});
