document.addEventListener("DOMContentLoaded", () => {
    const customerForm = document.getElementById("customerForm");
    const customerTable = document.getElementById("customerTable").querySelector("tbody");

    const loadCustomers = async () => {
        try {
            const response = await fetch("../admin-backend/AdminCustomer.php?action=read");
            const customers = await response.json();
            customerTable.innerHTML = "";
            customers.forEach((customer) => addRowToTable(customer));
        } catch (error) {
            console.error("Error loading customers:", error);
        }
    };

    document.getElementById("read-button").addEventListener("click", async () => {
        await loadCustomers();
    });

    const addRowToTable = (data) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${data.customerType}</td>
            <td>${data.customerID}</td>
            <td>${data.customerName}</td>
            <td>${data.memberDate || "N/A"}</td>
            <td>${data.openingBalance}</td>
        `;
        customerTable.appendChild(row);
    };

    customerForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        const action = event.submitter.value;

        const formData = new FormData(customerForm);
        formData.append("action", action); 

        try {
            const response = await fetch("../admin-backend/AdminCustomer.php", {
                method: "POST",
                body: formData,
            });
            const result = await response.json();

            if (result.status === "success") {
                alert(result.message);
                if (action === "create" || action === "update") {
                    const newCustomer = {
                        customerType: formData.get("customerType"),
                        customerID: formData.get("customerId"),
                        customerName: formData.get("customerName"),
                        memberDate: formData.get("memberDate"),
                        openingBalance: formData.get("openingBalance"),
                    };
                    if(action === "create"){
                        addRowToTable(newCustomer);
                    } else if(action === "update"){
                        loadCustomers();
                    }
                    customerForm.reset();
                } else if (action === "delete") {
                    loadCustomers();
                } 
            } else {
                alert(result.message);
            }
        } catch (error) {
            console.error("Error creating customer:", error);
        }
    });
});