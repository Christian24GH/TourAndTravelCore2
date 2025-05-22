import {postData} from "./request.module.js";
const rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
const approveModal = new bootstrap.Modal(document.getElementById('approveModal'));
const applicationIDEL = document.getElementById("applicationID");

document.getElementById("submitRejection").addEventListener("click", async()=>{
    const rejectApplicantFile = `${window.location.origin}/dashboard/TourAndTravel/core2/public/admin/passportInfo/request/rejectApplicant.php`;
    const rejectionLetter = document.getElementById("rejectionLetter");

    const Rejection = {
        applicationID: applicationIDEL.innerText,
        note: rejectionLetter.value
    }
    console.log(Rejection);
    try {
        const data  = await postData(Rejection, rejectApplicantFile);
        console.log(data);
        if(data.status == 'ok'){
            rejectModal.hide();
            window.location.reload();
        }
    } catch (error) {
        console.error("Error parsing JSON:", error);
    }
})

document.getElementById("submitApproval").addEventListener("click", async()=>{
    
    const approvalFile = `${window.location.origin}/dashboard/TourAndTravel/core2/public/admin/passportInfo/request/approveApplicant.php`;
    const Approval = {
        applicationID: applicationIDEL.innerText
    }
    try{
        const data  = await postData(Approval, approvalFile);
        console.log(data);
        if(data.status == 'ok'){
            approveModal.hide();
            window.location.reload();
        }
    }catch(error){
        console.error("Error parsing JSON:", error);
    }
})