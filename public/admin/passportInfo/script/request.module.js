export function createMap(obj){
    const map = new Map();
    
    for(const [key, value] of Object.entries(obj)){
        map.set(Number(key), value);
    }
    return map;
}

export async function fetchData(file){
    const result = await fetch(file);
    const items = await result.json();
    
    return items;
}
export async function postData(object, targetFile){
    const response = await fetch(targetFile, {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(object)
    })
    const data =  await response.json();
    return data;
}




