document.addEventListener("DOMContentLoaded", function () {
    // Dodanie nasłuchiwania kliknięcia na elementy reakcji
    document.querySelectorAll(".reaction").forEach(reaction => {
        reaction.addEventListener("click", function () {
            // Pobieramy ID wydarzenia i typ reakcji z atrybutów data-id i data-reaction
            const eventId = this.getAttribute("data-id");
            const reactionType = this.getAttribute("data-reaction");
            const countSpan = this.querySelector(".count");

            // Wysłanie żądania POST do pliku "reakcja.php" w celu zaktualizowania reakcji w bazie
            fetch("reakcja.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `id=${eventId}&reaction=${encodeURIComponent(reactionType)}`
            })
            .then(response => response.json())  // Oczekujemy odpowiedzi w formacie JSON
            .then(data => {
                if (data.success) {
                    // Jeśli wszystko poszło dobrze, aktualizujemy liczbę reakcji na stronie
                    countSpan.innerText = data.count;  // Aktualizuje liczbę reakcji
                } else {
                    // Jeśli wystąpił błąd, wyświetlamy go w konsoli
                    console.error("Błąd serwera:", data.error);
                }
            })
            .catch(error => {
                // Jeśli wystąpił błąd podczas wysyłania żądania, wyświetlamy go w konsoli
                console.error("Błąd:", error);
            });
        });
    });
});
