const eye = document.querySelector(".eye");
const eyeoff = document.querySelector(".eye-off");
const passwordField = document.querySelector("input[type=password]");

/* Fonction pour intéragir avec l'oeil et afficher ou non le mot de passe */

eye.addEventListener("click", () => {
    eye.style.display = "none";
    eyeoff.style.display = "block";
    passwordField.type = "text";
  });
  
eyeoff.addEventListener("click", () => {
  eyeoff.style.display = "none";
  eye.style.display = "block";
  passwordField.type = "password";
});

/* Fonction pour changer le type de formulaire (login ou sign up) */

const switchToLoginBtn = document.getElementById('switch-to-login');
const switchToSignUpBtn = document.getElementById("switch-to-signup");
const cursorChoice = document.getElementById('cursor-choice');
const loginForm = document.getElementById('login-form');
const signUpForm = document.getElementById('signup-form');

switchToLoginBtn.addEventListener('click', ()=>{
  switchToLoginBtn.classList.add('active');
  loginForm.classList.add('active');
  switchToSignUpBtn.classList.remove('active');
  signUpForm.classList.remove('active');
  cursorChoice.style.left = "-5rem";
})

switchToSignUpBtn.addEventListener('click', ()=>{
  switchToSignUpBtn.classList.add('active');
  signUpForm.classList.add('active');
  switchToLoginBtn.classList.remove('active');
  loginForm.classList.remove('active');
  cursorChoice.style.left = "14rem";
})
