let messages = '';

function fetchMessages() {
    fetch('fetch_messages.php')
        .then(response => response.text())
        .then(data => {
            console.log("Received data:", data);
            if (data !== messages) {
                messages = data;
                postMessage({ type: 'messages', data: messages });
            }
        })
        .catch(error => console.error('Błąd pobierania wiadomości:', error));
}

function checkNewMessages() {
    fetch('check_new_messages.php')
        .then(response => response.text())
        .then(data => {
            if (data === 'true') {
                fetchMessages();
            }
        })
        .catch(error => console.error('Błąd sprawdzania nowych wiadomości:', error));
}

onmessage = function(e) {
    if (e.data === 'FETCH_MESSAGES') {
        Promise.all([fetchMessages(), checkNewMessages()])
            .then(() => {
                postMessage({ type: 'done' });
            });
    } else if (e.data === 'STOP') {
        close();
    }
};

fetchMessages();
checkNewMessages();
