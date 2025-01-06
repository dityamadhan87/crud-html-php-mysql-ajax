document.addEventListener("DOMContentLoaded", () => {
    const menuForm = document.getElementById("menuForm");
    const menuTable = document.getElementById("menuTable").querySelector("tbody");

    const loadMenu = async () => {
        try{
            const response = await fetch("../admin-backend/AdminMenu.php?action=read");
            const menus = await response.json();
            menuTable.innerHTML = "";
            menus.forEach((menu) => addRowToTable(menu));
        } catch (error){
            console.error("Error loading menu:", error);
        }
    };

    document.getElementById("read-button").addEventListener("click", async() => {
        await loadMenu();
    });

    const addRowToTable = (data) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${data.menuID}</td>
            <td>${data.menuName}</td>
            <td>${data.menuPrice}</td>
        `;
        menuTable.appendChild(row);
    };

    menuForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        const action = event.submitter.value;

        const formData = new FormData(menuForm);
        formData.append("action", action); 

        try {
            const response = await fetch("../admin-backend/AdminMenu.php", {
                method: "POST",
                body: formData,
            });
            const result = await response.json();

            if (result.status === "success") {
                alert(result.message);
                if (action === "create" || action === "update") {
                    const newMenu = {
                        menuID: formData.get("menuId"),
                        menuName: formData.get("menuName"),
                        menuPrice: formData.get("menuPrice"),
                    };
                    if(action === "create"){
                        addRowToTable(newMenu);
                    } else if(action === "update"){
                        loadMenu();
                    }
                    menuForm.reset();
                } else if (action === "delete") {
                    loadMenu();
                } 
            } else {
                alert(result.message);
            }
        } catch (error) {
            console.error("Error creating menu:", error);
        }
    });
})