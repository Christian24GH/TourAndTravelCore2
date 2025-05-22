const left_nav = document.getElementById("left_nav");
const main = document.getElementById("main");
document.getElementById("closeBtn").addEventListener("click",()=>{
    closeNav();
});
document.getElementById("openBtn").addEventListener("click",()=>{
    openNav();
});

function openNav(){
    left_nav.style.display = "block";
    left_nav.style.left = "0";
    main.style.marginLeft = "20vw";
}

function closeNav(){
    left_nav.style.left = "-20vw";
    main.style.marginLeft = "0";
    left_nav.style.display = "none";
}

closeNav();
