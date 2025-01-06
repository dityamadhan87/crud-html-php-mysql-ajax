document.addEventListener("DOMContentLoaded", async () => {
    const promoForm = document.getElementById("promoForm");
    const promoTable = document.getElementById("promoTable").querySelector("tbody");

    const loadPromo = async () => {
        try{
            const response = await fetch("../admin-backend/AdminPromo.php?action=read");
            const promos = await response.json();
            promoTable.innerHTML = "";
            promos.forEach((promo) => addRowToTable(promo));
        } catch (error){
            console.error("Error loading promo:", error);
        }
    }

    document.getElementById("read-button").addEventListener("click", async() => {
        await loadPromo();
    });

    const addRowToTable = (data) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${data.promoType}</td>
            <td>${data.promoCode}</td>
            <td>${data.startDate}</td>
            <td>${data.endDate}</td>
            <td>${data.percentDiscount}</td>
            <td>${data.maxDiscount}</td>
            <td>${data.minPurchase}</td>
        `;
        promoTable.appendChild(row);
    };

    promoForm.addEventListener("submit", async (event) => {
        event.preventDefault();

        const action = event.submitter.value;

        const formData = new FormData(promoForm);
        formData.append("action", action);

        try{
            const response = await fetch("../admin-backend/AdminPromo.php", {
                method: "POST",
                body: formData,
            });
            const result = await response.json();

            if(result.status === "success"){
                alert(result.message);
                if(action === "create" || action === "update"){
                    const newPromo = {
                        promoType: formData.get("promoType"),
                        promoCode: formData.get("promoCode"),
                        startDate: formData.get("startDate"),
                        endDate: formData.get("endDate"),
                        percentDiscount: formData.get("percentDiscount"),
                        maxDiscount: formData.get("maxDiscount"),
                        minPurchase: formData.get("minPurchase"),
                    };
                    if(action === "create"){
                        addRowToTable(newPromo);
                    } else if(action === "update"){
                        loadPromo();
                    }
                    promoForm.reset();
                } else if(action === "delete"){
                    loadPromo();
                }
            } else {
                alert(result.message);
            }
        } catch (error){
            console.error("Error submitting promo form:", error);
        }
    });
});