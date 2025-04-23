document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("userPopup");
    const openBtn = document.getElementById("chooseUserBtn");
    const closeBtn = document.querySelector(".close-btn");
    const recipientName = document.getElementById("recipient_name");
    const recipientId = document.getElementById("recipient_id");
    const userTiles = document.querySelectorAll(".user-tile");
    const chooseSelectedBtn = document.getElementById("chooseSelectedBtn");
    const form = document.querySelector("form");  // Referencja do formularza

    let selectedUsers = [];

    // Otwórz pop-up
    openBtn.addEventListener("click", () => {
        popup.style.display = "flex";
    });

    // Wybór użytkownika
    userTiles.forEach(tile => {
        tile.addEventListener("click", () => {
            const userId = tile.dataset.id;
            const userName = tile.dataset.name;

            // Sprawdzamy, czy użytkownik już jest wybrany
            if (!selectedUsers.some(user => user.id === userId)) {
                selectedUsers.push({ id: userId, name: userName });
                tile.style.backgroundColor = "rgba(0, 123, 255, 0.2)";  // Subtelne tło
                tile.style.border = "2px solid rgba(0, 123, 255, 0.5)"; // Subtelne obramowanie
                tile.style.boxShadow = "0 0 8px rgba(0, 123, 255, 0.3)"; // Subtelny cień
            } else {
                selectedUsers = selectedUsers.filter(user => user.id !== userId);
                tile.style.backgroundColor = "";  // Przywrócenie koloru
                tile.style.border = ""; // Przywrócenie obramowania
                tile.style.boxShadow = ""; // Usunięcie cienia
            }

            // Uaktualniamy nazwę odbiorcy
            recipientName.value = selectedUsers.map(user => user.name).join(", ");
        });
    });

    // Wybór wybranych użytkowników
    chooseSelectedBtn.addEventListener("click", () => {
        if (selectedUsers.length > 0) {
            // Ustawiamy recipient_id na IDs wybranych użytkowników
            recipientId.value = selectedUsers.map(user => user.id).join(",");
            console.log("Wybrani użytkownicy: ", recipientId.value);  // Logowanie do debugowania
            popup.style.display = "none";
        } else {
            alert("Musisz wybrać przynajmniej jednego użytkownika.");
        }
    });

    // Sprawdzamy przed wysłaniem formularza
    form.addEventListener("submit", (e) => {
        if (recipientId.value.trim() === "") {
            e.preventDefault();  // Zatrzymujemy wysyłanie formularza
            alert("Musisz wybrać przynajmniej jednego użytkownika.");
        } else {
            console.log("Odbiorca ustawiony na: ", recipientId.value);  // Logowanie do debugowania
        }
    });

    // Zamknięcie pop-up po kliknięciu poza nim
    popup.addEventListener("click", (e) => {
        if (e.target === popup) {
            popup.style.display = "none";
        }
    });
});
