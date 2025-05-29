// JavaScript for Dashboard Chart and Print Report

// Dummy Data for Chart
const salesData = [5, 10, 15, 20, 25, 30, 35]; // Example sales data
const labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];

// Render Chart
const ctx = document.getElementById('sales-chart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Penjualan',
            data: salesData,
            backgroundColor: '#5DADE2',
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

// Cetak Laporan
function printReport() {
    alert("Laporan akan dicetak!");
    // Tambahkan logika cetak di sini
}