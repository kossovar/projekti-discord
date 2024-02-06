document.addEventListener("DOMContentLoaded", function () {
    // regex per cdo input
    let displayNameRegex =/^[a-zA-Z]{3,}$/;
    let usernameRegex = /^[a-zA-Z]{3,}$/;
    let emailRegex = /^[a-zA-Z0-9._-]+@[a-z.]+.[a-z]{2,}$/;
    let passwordRegex = /^[a-zA-Z]{8,}$/;
  
    function registerValidation(event) {
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

      $validationPassed = true;
  
      if (email.value.trim() === "") {
        errorEmail.innerText = "Email cannot be empty";
        errorEmail.style.color = "#C70039";
        $validationPassed = false;
      }

      if (!emailRegex.test(email.value)) {
        errorEmail.innerText = "Invalid email";
        errorEmail.style.color = "#C70039";
        $validationPassed = false;
      }
      
      if (displayName.value.trim() === "") {
        errorDisplayName.innerText = "Display name cannot be empty";
        errorDisplayName.style.color = "#C70039";
        $validationPassed = false;
      }

      if (!displayNameRegex.test(displayName.value)) {
        errorDisplayName.innerText = "Invalid display name";
        errorDisplayName.style.color = "#C70039";
        $validationPassed = false;
      }

      if (username.value.trim() === "") {
        errorUsername.innerText = "Username cannot be empty";
        errorUsername.style.color = "#C70039";
        $validationPassed = false;
      }
    
      if (!usernameRegex.test(username.value)) {
        errorUsername.innerText = "Invalid username";
        errorUsername.style.color = "#C70039";
        $validationPassed = false;
      }

      if (password.value.trim() === "") {
        errorPassword.innerText = "Password cannot be empty";
        errorPassword.style.color = "#C70039";
        $validationPassed = false;
      }
    
      if (!passwordRegex.test(password.value)) {
        errorPassword.innerText = "Invalid password";
        errorPassword.style.color = "#C70039";
        $validationPassed = false;
      }
      if (!$validationPassed) {
        return false;
      }

      document.registerForm.submit();
    }
  
    function loginValidation(event) {
      event.preventDefault();
  
      let email = document.getElementById('email');
      let errorEmail = document.getElementById('errorEmail');
    
      let password = document.getElementById('password');
      let errorPassword = document.getElementById('errorPassword');
  
      errorEmail.innerText = '';
      errorPassword.innerText = '';

      $validationPassed = true;
  
      if (email.value.trim() === "") {
        errorEmail.innerText = "Email cannot be empty";
        errorEmail.style.color = "#C70039";
        $validationPassed = false;
      }

      if (!emailRegex.test(email.value)) {
        errorEmail.innerText = "Invalid email";
        errorEmail.style.color = "#C70039";
        $validationPassed = false;
      }

      if (password.value.trim() === "") {
        errorPassword.innerText = "Password cannot be empty";
        errorPassword.style.color = "#C70039";
        $validationPassed = false;
      }

      if (!passwordRegex.test(password.value)) {
        errorPassword.innerText = "Invalid password";
        errorPassword.style.color = "#C70039";
        $validationPassed = false;
      }

      if(!$validationPassed) {
        return false;
      }

      document.loginForm.submit();
    }

    if (document.getElementById('registration')) {
      document.getElementById('registration').addEventListener('submit', registerValidation);
    }
    if (document.getElementById('login')) {
      document.getElementById('login').addEventListener('submit', loginValidation)
    }
  });