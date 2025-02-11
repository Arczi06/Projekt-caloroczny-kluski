document.addEventListener("DOMContentLoaded", () => {
    // JavaScript for Librarian Dashboard

    document.getElementById('add-book').addEventListener('click', function() {
        console.log('Dodawanie książki button clicked');
        window.location.href = 'add_book.html'; // Navigate to add book page
    });

    document.getElementById('edit-book').addEventListener('click', function() {
        console.log('Edytowanie książki button clicked');
        window.location.href = 'edit_book.html'; // Navigate to edit book page
    });

    document.getElementById('delete-book').addEventListener('click', function() {
        console.log('Usuwanie książki button clicked');
        window.location.href = 'delete_book.html'; // Navigate to delete book page
    });

    document.getElementById('view-users').addEventListener('click', function() {
        console.log('Zobacz użytkowników button clicked');
        window.location.href = 'view_users.html'; // Navigate to view users page
    });

    document.getElementById('edit-user').addEventListener('click', function() {
        console.log('Edytowanie użytkownika button clicked');
        window.location.href = 'edit_user.html'; // Navigate to edit user page
    });

    document.getElementById('manage-books').addEventListener('click', function() {
        console.log('Zarządzaj książkami button clicked');
        fetch('manage_books.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => console.error('Error:', error));
    });

    document.getElementById('view-activity').addEventListener('click', function() {
        console.log('Zobacz aktywność użytkowników button clicked');
        fetch('view_activity.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => console.error('Error:', error));
    });

    document.getElementById('handle-reservations').addEventListener('click', function() {
        console.log('Zarządzanie rezerwacjami button clicked');
        fetch('handle_reservations.php')
            .then(response => response.json())
            .then(data => {
                console.log(data);
            })
            .catch(error => console.error('Error:', error));
    });
});
