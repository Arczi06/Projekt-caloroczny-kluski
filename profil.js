document.querySelectorAll('tr').forEach(row => {
    const dueDateElement = row.querySelector('.due-date');
    if (dueDateElement) {
        const dueDate = new Date(dueDateElement.innerText);
        const today = new Date();

        // Check if the due date is earlier than today
        if (dueDate < today && row.querySelector('td:last-child').innerText !== 'Returned') {
            row.classList.add('overdue');  // Highlight overdue rows in red
        }
    }
});
