import { autocomplete, appendListOptions } from "./Form.module.js";
import { fetchData, createMap } from "./Request.module.js";
const baseUrl = window.location.origin
const cFile = `${baseUrl}/dashboard/TourAndTravel/core2/public/admin/uploadPassport/request/fetchCountryList.php`
const cEl = document.getElementById("country_code");
const country_listcon = document.getElementById("listContainer_country");

let countryList = await fetchData(cFile);
let map = createMap(countryList);
appendListOptions(map, country_listcon);

cEl.addEventListener("input", (e)=>{
    autocomplete(e, map);
})
