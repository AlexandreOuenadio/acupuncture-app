// Animation Up Down dans la bannière de la page d'accueil
const animatedArrow = document.getElementById('animated-arrow');
const whoweare = document.getElementById('whoweare');
animatedArrow.addEventListener('click', ()=>{
    let dy = whoweare.offsetTop;
    window.scrollTo({
        top: dy,
        left: 0,
        behavior: "smooth"
    })
})




