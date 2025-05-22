export function appendListOptions(map, listContainer){
    map.forEach((value, key)=>{
        const option = document.createElement("option");
        option.dataset.value = key;
        option.textContent = value;
        listContainer.appendChild(option);
    })
}

export function autocomplete(input, map){
    let characters = input.target.value;
    let list = Array.from(map.values());
    const isValid = list.some(e=> e.startsWith(characters));

    function getByValue(map, targetValue){
        for(let [key, value] of map.entries()){
            if(value === targetValue){
                return key;
            }
        }
    }
    if(isValid){
        let foundKey = getByValue(map, input.target.value);
        if(foundKey !== undefined){
            input.target.dataset.value = foundKey;
            console.log(foundKey);
        }
    }else{
        input.target.value = characters.slice(0, -1);
    }
}

export function Toast(message){
    const toastEl = document.getElementById('toast')
    const toast_body = toastEl.querySelector(".toast-body");
    toast_body.innerText = message;
    
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastEl)
    toastBootstrap.show()
}