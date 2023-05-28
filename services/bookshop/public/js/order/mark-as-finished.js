async function markAsFinished(orderId) {
    const requestBody = {
        orderId: orderId
    };

    try {
        const response = await fetch(markAsFinishedEndpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestBody)
        });

        if (!response.ok) {
            throw new Error('Request failed with status ' + response.status);
        }

        const data = await response.json();

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
    } catch (error) {
        // HTTP exceptions
        alert('Request failed: ' + error.message);
        console.log(error);
    }

    // remove from table
    const row = document.getElementById(`order-row-${orderId}`);
    if (row) {
        row.remove();
    }
}