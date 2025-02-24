document.addEventListener("DOMContentLoaded", () => {
  const toggleBtn = document.getElementById("toggle-btn");
  const sidebar = document.getElementById("sidebar");
  const dashboardText = document.getElementById("dashboard-text");
  const menuTexts = document.querySelectorAll(".menu-text");

  toggleBtn.addEventListener("click", () => {
      // sidebar.classList.toggle("w-16");
      sidebar.classList.toggle("w-64");
      dashboardText.classList.toggle("hidden");
      menuTexts.forEach(text => text.classList.toggle("hidden"));
  });
});