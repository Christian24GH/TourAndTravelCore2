import {postData} from "./request.module.js";
import { createMap } from "./request.module.js";

const applicationIDEl = document.getElementById("applicationID");
const customerNameEl = document.getElementById("customerName");
const dateofbirthEl = document.getElementById("dateofbirth");
const document_sectionEl = document.getElementById("document_section");

async function getPassInfo(dataValue, callback){
    const file = `${window.location.origin}/dashboard/TourAndTravel/core2/public/admin/passportInfo/request/getInfoTabData.php`;
    const data = await postData(dataValue, file);
    callback(data);
}

document.getElementById("passportList").addEventListener("click",(e)=>{
    const data = {
        applicationID: null,
        documentID: null,
        passportID: null,
        passportNumber: null,
        documentList: []
    };
    if(e.target.matches("li.list-group-item, li.list-group-item *")){
        data.applicationID = e.target.dataset.aid;
        data.documentID = e.target.dataset.did;
        data.passportID = e.target.dataset.pid;
        data.passportNumber = e.target.dataset.ppn;
        getPassInfo(data, placeValues)
    }
})
document.getElementById("document_section").addEventListener("click", (e)=>{
    const serverDocumentPath  = `${location.origin}/dashboard/TourAndTravel/core2/public/server/documents`;
    if(e.target.tagName === "A"){
        window.open(`${serverDocumentPath}/${e.target.dataset.loc}`);
    }
})
function placeValues(data){
    console.log(data);
    const fullName = `${data.lastName}, ${data.firstName}`;
    
    applicationIDEl.innerText = data.applicationID;
    customerNameEl.value = fullName;
    dateofbirthEl.value = data.dateOfBirth;
    data.documentList.forEach(doc => {
        createList(doc);
    });
}

function createList(doc){
    const li = document.createElement("li");
    const i = document.createElement("i");
    const a = document.createElement("a");
    i.classList.add("bi", "bi-file-earmark");
    li.classList.add("list-group-item");
    a.innerText = " "+doc.documentName;
    a.dataset.loc = doc.documentName;
    
    i.appendChild(a);
    li.appendChild(i);
    
    document_sectionEl.innerHTML = "";
    document_sectionEl.appendChild(li);
}

function disableFields(){
    applicationIDEl.disabled = true;
    customerNameEl.disabled = true;
    dateofbirthEl.disabled = true; 
}
disableFields();