<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tworzenie wydarzeń</title>
    <link rel="stylesheet" href="event.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Tworzenie wydarzeń</h1>
        </header>

        <main class="main-content">
            <section class="event-form">
                <h2>Dodaj nowe wydarzenie</h2>
                <form action="add_event.php" method="POST" enctype="multipart/form-data">
                    <label for="event-name">Nazwa wydarzenia:</label>
                    <input type="text" id="event-name" name="event_name" required>

                    <label for="event-date">Data wydarzenia:</label>
                    <input type="date" id="event-date" name="event_date" required>

                    <label for="event-time">Godzina:</label>
                    <input type="time" id="event-time" name="event_time" required>

                    <label for="event-location">Miejsce:</label>
                    <input type="text" id="event-location" name="event_location" required>

                    <label for="event-description">Opis wydarzenia:</label>
                    <textarea id="event-description" name="event_description" rows="4" required></textarea>

                    <button type="submit" class="submit-btn">Dodaj wydarzenie</button>
                </form>
            </section>
            <section class="upcoming-events">
                <h2>Nadchodzące wydarzenia</h2>
                <div class="events-list">
                    <div class="event-item">
                        <h3>Wydarzenie 1</h3>
                        <p><strong>Data:</strong> 2025-04-01</p>
                        <p><strong>Godzina:</strong> 18:00</p>
                        <p><strong>Miejsce:</strong> Aula Główna</p>
                        <p>Opis wydarzenia: To jest przykładowe wydarzenie, które możesz dodać.</p>
                    </div>
                    <div class="event-item">
                        <h3>Wydarzenie 2</h3>
                        <p><strong>Data:</strong> 2025-04-10</p>
                        <p><strong>Godzina:</strong> 19:30</p>
                        <p><strong>Miejsce:</strong> Sala konferencyjna</p>
                        <p>Opis wydarzenia: Kolejne przykładowe wydarzenie.</p>
                    </div>
                </div>
            </section>
        </main>

        <footer class="footer">
            <p>© 2025 Tworzenie wydarzeń. Wszelkie prawa zastrzeżone.Twoja mama.</p>
        </footer>
    </div>
</body>
</html>
