document.addEventListener("DOMContentLoaded", () => {
  const accountTypeButton = document.getElementById("account_type_button");
  const accountTypeOptions = document.getElementById("account_type_options");
  const selectedAccountType = document.getElementById("selected_account_type");
  const accountTypeInput = document.getElementById("account_type_input");

  accountTypeButton.addEventListener("click", () => {
    accountTypeOptions.classList.toggle("hidden");
  });

  accountTypeOptions.querySelectorAll("li").forEach(option => {
    option.addEventListener("click", () => {
      const value = option.getAttribute("data-value");
      selectedAccountType.textContent = value;
      accountTypeInput.value = value;
      accountTypeOptions.classList.add("hidden");
    });
  });

  document.addEventListener("click", (event) => {
    if (!accountTypeButton.contains(event.target) && !accountTypeOptions.contains(event.target)) {
      accountTypeOptions.classList.add("hidden");
    }
  });
});