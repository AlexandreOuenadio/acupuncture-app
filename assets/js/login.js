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
