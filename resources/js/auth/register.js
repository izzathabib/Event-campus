document.addEventListener("DOMContentLoaded", () => {
  const societyButton = document.getElementById("society");
  const individualButton = document.getElementById("individual");
  const adminButton = document.getElementById("admin");
  const accountTypeInput = document.getElementById("account_type_input");
  const fullName = document.getElementById("full-name");
  const userName = document.getElementById("user-name");
  const emailSection = document.getElementById("email-section");
  const psswrdSection = document.getElementById("psswrd-section");
  const confirmPsswrd = document.getElementById("confirm-psswrd");
  const societyName = document.getElementById("society-name");
  const submitButton = document.getElementById("submit-button");

  // Remove hidden class from name-section if account_type_input has a value
  societyButton.addEventListener("click", () => {
    societyButton.classList.add("roleSelect");
    individualButton.classList.remove("roleSelect");
    adminButton.classList.remove("roleSelect");

    societyName.classList.remove("hidden");
    userName.classList.remove("hidden");
    fullName.classList.add("hidden");
    emailSection.classList.remove("hidden");
    psswrdSection.classList.remove("hidden");
    confirmPsswrd.classList.remove("hidden");
    submitButton.classList.remove("hidden");
  }); 

  individualButton.addEventListener("click", () => {
    individualButton.classList.add("roleSelect");
    societyButton.classList.remove("roleSelect");
    adminButton.classList.remove("roleSelect");

    userName.classList.remove("hidden");
    societyName.classList.add("hidden");
    fullName.classList.remove("hidden");
    psswrdSection.classList.remove("hidden");
    confirmPsswrd.classList.remove("hidden");
    emailSection.classList.remove("hidden");
    submitButton.classList.remove("hidden");

  });

  adminButton.addEventListener("click", () => {
    adminButton.classList.add("roleSelect");
    individualButton.classList.remove("roleSelect");
    societyButton.classList.remove("roleSelect");
    
    userName.classList.remove("hidden");
    societyName.classList.add("hidden");
    fullName.classList.remove("hidden");
    psswrdSection.classList.remove("hidden");
    confirmPsswrd.classList.remove("hidden");
    submitButton.classList.remove("hidden");
    emailSection.classList.remove("hidden");
  });
  

});