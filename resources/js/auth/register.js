document.addEventListener("DOMContentLoaded", () => {
  const societyButton = document.getElementById("society");
  const individualButton = document.getElementById("individual");
  const adminButton = document.getElementById("admin");
  const accTypeButton = document.getElementById("acc-type");
  const accountTypeOptions = document.getElementById("account_type_options");
  const selectedAccountType = document.getElementById("selected_account_type");
  const accountTypeInput = document.getElementById("account_type_input");
  const nameSection = document.getElementById("name-section");

  // Remove hidden class from name-section if account_type_input has a value
  accTypeButton.addEventListener("click", () => {
    const value = accTypeButton.getAttribute("data-value");
    if(value === "society") {
      nameSection.classList.remove("hidden");
    }
  }); 
  

});