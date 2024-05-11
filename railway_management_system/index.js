// Get references to all sections
const sections = document.querySelectorAll('div[id$="_section"]');

// Hide all sections except the login section initially
sections.forEach(section => {
    if (section.id !== 'login_section') {
        section.style.display = 'none';
    }
});

// Function to show the selected section and hide others
function showSection(sectionId) {
    sections.forEach(section => {
        if (section.id === sectionId) {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
        }
    });
}

// Function to cancel a ticket
function cancelTicket(ticketId) {
    // Send a POST request to cancel_ticket.php with the ticket ID to cancel
    fetch('cancel_ticket.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // Change content type
        },
        body: 'cancel_ticket_id=' + ticketId, // Send data as form-urlencoded
    })
    .then(response => response.text())
    .then(result => {
        console.log(result); // Log the cancellation result

        // Reload the booking history after cancellation
        fetchBookingHistory();
    })
    .catch(error => console.error('Error cancelling ticket:', error));
}


// Function to fetch booking history data from booking_history.php
function fetchBookingHistory() {
    fetch('booking_history.php')
    .then(response => response.json())
    .then(data => {
        showSection('history_section');

        // Get the table body element
        const tbody = document.getElementById('booking_history_body');
        tbody.innerHTML = ''; // Clear existing rows before populating new ones

        // Loop through the data and create table rows
        data.forEach(booking => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${booking['TicketID']}</td>
                <td>${booking['TrainID']}</td>
                <td>${booking['BookingDate']}</td>
                <td>${booking['Fare']}</td>
                <td>${booking['Status']}</td>
                <td><button onclick="cancelTicket(${booking['TicketID']})">Cancel</button></td>
            `;
            tbody.appendChild(row);
        });
    })
    .catch(error => console.error('Error fetching booking history:', error));
}

// Fetch booking history data initially
fetchBookingHistory();
