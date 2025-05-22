import { Toast } from "./Form.module.js";
const file = `${window.location.origin}/dashboard/TourAndTravel/core2/public/admin/uploadPassport/request/uploadData.php`;

async function submitForm(data) {
    const formData = new FormData();
    for (let key in data) {
        if (data[key] !== null) {
            formData.append(key, data[key]);
        }
    }
    
    const response = await fetch(file, {
        method: "POST",
        body: formData
    })
    
    
    const json = await response.json();
    if(json.status === "success")
    {
        Toast("Application submitted successfully!");
        return true;
    }
    else
    {
        Toast("An error occured while submitting the application!");
        return false;
    }
}
export async function validateForm(form){
    const Data = {
        customer_id: form.querySelector("#customer_id")?.value || null,
        passport_type: form.querySelector("#passport_type")?.value || null,
        passport_number: form.querySelector("#passport_number")?.value || null,
        issued_date: form.querySelector("#issued_date")?.value || null,
        expiry_date: form.querySelector("#expiry_date")?.value || null,
        Input_file_passport: form.querySelector("#Input_file_passport")?.files[0] || null
    };

    function isEmpty() {
        for (let key in Data) {
            if (Data[key] === null || Data[key] === "") {
                console.log(`Missing: ${key}`);
                return true;
            }
        }
        return false;
    }

    if (!isEmpty()) {   
        return await submitForm(Data);
    } else {
        Toast("Please fill all the required fields!");
        return false;
    }
}
