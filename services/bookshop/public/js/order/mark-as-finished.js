
const markAsFinishedEndpoint = 'http://localhost:8180/api/v1/orders/mark-as-finished.php';

function markAsFinished(orderId) {

    const requestBody = {
        orderId: orderId
    };

    fetch(markAsFinishedEndpoint, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(requestBody)
    })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Request failed with status ' + response.status);
            }
        })
        .then(data => {
            if (data && data.status === 200) {
                // Success - marked as finished
                alert(data.message);
            } else if (data && data.status === 400) {
                // Fail - Order status already updated
                alert(data.message);
            } else {
                // Internal server errors
                alert('Server error: ' + data.message);
            }
        })
        .catch(error => {
            // HTTP exceptions
            alert('Request failed: ' + error.message);
            console.log(error);
        });

    // remove from table
    const row = document.getElementById(`order-row-${orderId}`);
    if (row) {
        row.remove();
    }
}
