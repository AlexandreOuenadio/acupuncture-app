const userIcon = document.getElementById('user-logged-icon');
const userMenu =document.getElementById('user-logged-menu');  

if (window.innerWidth > 922){

      

    userIcon.addEventListener('click', ()=>{
        userMenu.classList.toggle('active');
    })
    
}else{
    userMenu.classList.remove('active');


}

