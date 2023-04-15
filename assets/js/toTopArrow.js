//Apparition de la flèche To Top 
const toTopArrow = document.getElementById("to-top-arrow");


toTopArrow.addEventListener('click', ()=>{
    window.scrollTo({
        top: 0,
        left: 0,
        behavior: "smooth"
    })
})

console.log(window.location.pathname);

document.addEventListener('scroll', ()=>{
    let ref = null;
    if (window.location.pathname === '/'){
        ref = document.getElementById('whoweare').offsetTop;
    }else{
        ref=1318;
    }
    
    if (window.scrollY > ref){
        toTopArrow.style.visibility = 'visible';
        toTopArrow.style.opacity = 1;
    }else{
        toTopArrow.style.visibility = 'hidden';
        toTopArrow.style.opacity = 0;
    }
})
