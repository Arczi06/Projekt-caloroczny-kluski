function redirectIfNotLoggedIn() {
  // Przykład: sprawdzamy, czy istnieje token autoryzacyjny w localStorage
  const token = localStorage.getItem('authToken');
  
  if (!token) {
    // Jeśli tokenu nie ma, przekierowujemy na stronę logowania
    window.location.href = '/landing.html'; // lub inny adres
  }
}

// Wywołaj funkcję np. na początku ładowania strony
redirectIfNotLoggedIn();