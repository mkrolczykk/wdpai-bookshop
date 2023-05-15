const assignEmployeeToOrderEndpoint = 'http://localhost:8180/api/v1/orders/assign-employee-to-order.php';

function assignEmployeeToOrder(orderId, employeeId) {
    const requestBody = {
        orderId: orderId,
        employeeId: employeeId
    };

    fetch(assignEmployeeToOrderEndpoint, {
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
                // Success - employee has been assigned to the order
                alert(data.message);
            } else if (data && data.status === 400) {
                // Fail - employee cannot be applied to the order
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
}

function assignToEmployee(orderId, employeeId, employee) {
    assignEmployeeToOrder(orderId, employeeId);
    updateAssignedToField(orderId, employee);
}

function updateAssignedToField(orderId, employee) {
    const assignedToElements = document.querySelectorAll("#order-row-" + orderId + " .order-executor");
    assignedToElements.forEach(element => {
        element.textContent = employee;
    });
}

