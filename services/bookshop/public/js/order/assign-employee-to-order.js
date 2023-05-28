async function assignEmployeeToOrder(orderId, employeeId) {
    const requestBody = {
        orderId: orderId,
        employeeId: employeeId
    };

    try {
        const response = await fetch(assignEmployeeToOrderEndpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(requestBody)
        });

        if (!response.ok) {
            throw new Error('Request failed with status ' + response.status);
        }

        return await response.json();
    } catch (error) {
        throw new Error('Request failed: ' + error.message);
    }
}

function updateAssignedToField(orderId, employee) {
    const assignedToElements = document.querySelectorAll("#order-row-" + orderId + " .order-executor");
    assignedToElements.forEach(element => {
        element.textContent = employee;
    });
}

async function assignToEmployee(orderId, employeeId, employee) {
    try {
        const data = await assignEmployeeToOrder(orderId, employeeId);

        if (data && data.status === 200) {
            updateAssignedToField(orderId, employee);
        } else if (data && data.status === 400) {
            // Fail - employee cannot be applied to the order
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
}