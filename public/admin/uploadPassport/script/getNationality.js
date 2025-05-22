import { autocomplete, appendListOptions } from "./Form.module.js";
import { fetchData, createMap } from "./Request.module.js";
const baseUrl = window.location.origin
const nFile = `${baseUrl}/dashboard/TourAndTravel/core2/public/admin/uploadPassport/request/fetchNationality.php`
const nEl = document.getElementById("nationality");
const listContainer_nationality = document.getElementById("listContainer_nationality");

let nationalityList = await fetchData(nFile);
let map = createMap(nationalityList);
appendListOptions(map, listContainer_nationality);

nEl.addEventListener("input", (e)=>{
    autocomplete(e, map);
})

