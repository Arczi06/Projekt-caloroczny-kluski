const ctx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [{
            label: 'Sales',
            data: [1200, 1900, 3000, 5000, 2300, 4500],
            backgroundColor: 'rgba(123, 66, 246, 0.2)',
            borderColor: 'rgba(123, 66, 246, 1)',
            borderWidth: 2,
            fill: true,
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        },
        responsive: true,
    }
});
