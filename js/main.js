// validimi i formes register


document.addEventListener("DOMContentLoaded", function () {
  // regex per cdo input
  let displayNameRegex = /^[A-Z][a-zA-Z]*$/;
  let usernameRegex = /^[a-zA-Z0-9]{8,15}$/;
  let emailRegex = /^[a-zA-Z0-9._-]+@[a-z.]+\.[a-z]{2,}$/;
  let passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()-_+=])[A-Za-z\d!@#$%^&*()-_+=]{8,}$/;


  function validimi(event) {
    event.preventDefault();
  
    let displayName = document.getElementById('displayName');
    let errorDisplayName = document.getElementById('errorDisplayName');
  
    let username = document.getElementById('username');
    let errorUsername = document.getElementById('errorUsername');
  
    let email = document.getElementById('email');
    let errorEmail = document.getElementById('errorEmail');
  
    let password = document.getElementById('password');
    let errorPassword = document.getElementById('errorPassword');
  
    errorEmail.innerText = '';
    errorDisplayName.innerText = '';
    errorUsername.innerText = '';
    errorPassword.innerText = '';

    if (!emailRegex.test(email.value)) {
      errorEmail.innerText = "Invalid email";
      errorEmail.style.color = "#C70039";
      return false;
    }
  
    if (!displayNameRegex.test(displayName.value)) {
      errorDisplayName.innerText = "Invalid display name";
      errorDisplayName.style.color = "#C70039";
      return false;
    }
  
    if (!usernameRegex.test(username.value)) {
      errorUsername.innerText = "Invalid username";
      errorUsername.style.color = "#C70039";
      return false;
    }
  
    if (!passwordRegex.test(password.value)) {
      errorPassword.innerText = "Invalid password";
      errorPassword.style.color = "#C70039";
      return false;
    }
    return true;
  }
  
  document.getElementById('forma').addEventListener('submit', validimi);
});
