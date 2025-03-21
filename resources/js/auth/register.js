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
  const submitButton = document.getElementById("submit-button");
  const fullnameLabel = document.getElementById("fullname-label");
  const societyLabel = document.getElementById("society-label");
  const inputName = document.getElementById("name");


  // Remove hidden class from name-section if account_type_input has a value
  societyButton.addEventListener("click", () => {
    accountTypeInput.value = "1";
    societyButton.classList.add("roleSelect");
    individualButton.classList.remove("roleSelect");
    adminButton.classList.remove("roleSelect");

    userName.classList.remove("hidden");
    fullName.classList.remove("hidden");
    fullnameLabel.classList.add("hidden");
    societyLabel.classList.remove("hidden");
    emailSection.classList.remove("hidden");
    psswrdSection.classList.remove("hidden");
    confirmPsswrd.classList.remove("hidden");
    submitButton.classList.remove("hidden");
    inputName.placeholder = "e.g., Computer Science Society";
  }); 

  individualButton.addEventListener("click", () => {
    accountTypeInput.value = "2";
    individualButton.classList.add("roleSelect");
    societyButton.classList.remove("roleSelect");
    adminButton.classList.remove("roleSelect");

    userName.classList.remove("hidden");
    fullName.classList.remove("hidden");
    fullnameLabel.classList.remove("hidden");
    societyLabel.classList.add("hidden");
    psswrdSection.classList.remove("hidden");
    confirmPsswrd.classList.remove("hidden");
    emailSection.classList.remove("hidden");
    submitButton.classList.remove("hidden");
    inputName.placeholder = "e.g., Ahmad Bin Saiful";
  });

  adminButton.addEventListener("click", () => {
    accountTypeInput.value = "3";
    adminButton.classList.add("roleSelect");
    individualButton.classList.remove("roleSelect");
    societyButton.classList.remove("roleSelect");
    
    userName.classList.remove("hidden");
    fullName.classList.remove("hidden");
    fullnameLabel.classList.remove("hidden");
    societyLabel.classList.add("hidden");
    psswrdSection.classList.remove("hidden");
    confirmPsswrd.classList.remove("hidden");
    submitButton.classList.remove("hidden");
    emailSection.classList.remove("hidden");
    inputName.placeholder = "e.g., Ahmad Bin Saiful";
  });
  

});