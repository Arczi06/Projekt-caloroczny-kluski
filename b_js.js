// Funkcja obsługująca przeciąganie kafelka użytkownika do pola odbiorcy
document.querySelectorAll('.user-tile').forEach(tile => {
    tile.addEventListener('dragstart', function(e) {
        e.dataTransfer.setData('text', e.target.dataset.id); // Ustawienie ID użytkownika w danych transferu
    });
});

// Funkcja dodająca kafelek użytkownika do pola odbiorcy
document.getElementById('message-recipient').addEventListener('dragover', function(e) {
    e.preventDefault(); // Zapobiega domyślnej akcji przeglądarki (np. otwierania pliku)
});

document.getElementById('message-recipient').addEventListener('drop', function(e) {
    e.preventDefault();
    let userId = e.dataTransfer.getData('text'); // Pobranie ID użytkownika z danych transferu
    let userTile = document.querySelector(`[data-id="${userId}"]`); // Znalezienie kafelka użytkownika

    // Pobranie danych użytkownika
    let username = userTile.dataset.username;
    let role = userTile.dataset.role; // Rola przekazana w postaci tekstowej
    let email = userTile.dataset.email;
    let profileImage = userTile.dataset.profileImage || 'default.jpg'; // Ścieżka do zdjęcia profilowego

    // Używamy case, aby przypisać nazwę roli na podstawie jej wartości
    let roleName = '';
    switch (parseInt(role)) {
        case 0:
            roleName = 'Czytelnik';
            break;
        case 1:
            roleName = 'Bibliotekarz';
            break;
        case 2:
            roleName = 'Administrator';
            break;
        default:
            roleName = 'Nieznana rola';
            break;
    }

    // Tworzymy HTML dla odbiorcy
    let recipientHTML = `
        <div class="recipient-info">
            <img src="ni/${profileImage}" alt="Profilowe" class="recipient-avatar">
            <div class="recipient-details">
                <p><strong>${username}</strong></p>
                <p><strong>Rola:</strong> ${roleName}</p>
                <p><strong>Email:</strong> ${email}</p>
            </div>
        </div>
    `;

    // Aktualizacja pola odbiorcy z pełnymi danymi użytkownika
    let recipientDiv = document.getElementById('message-recipient');
    recipientDiv.innerHTML = recipientHTML;
});
