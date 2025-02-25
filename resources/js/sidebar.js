document.addEventListener("DOMContentLoaded", () => {
  const toggleBtn = document.getElementById("toggle-btn");
  const sidebar = document.getElementById("sidebar");
  const dashboardText = document.getElementById("dashboard-text");
  const menuTexts = document.querySelectorAll(".menu-text");

  // Display the sidebar in mobile and tablet view
  function responsiveSidebar() {
      if (window.innerWidth <= 1024) {
          sidebar.classList.remove("w-64");
          sidebar.classList.add("w-16");
          dashboardText.classList.add("hidden");
          menuTexts.forEach(text => text.classList.add("hidden"));
      } else {
          sidebar.classList.remove("w-16");
          sidebar.classList.add("w-64");
          dashboardText.classList.remove("hidden");
          menuTexts.forEach(text => text.classList.remove("hidden"));
      }
  }

  

  toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("w-16");
    dashboardText.classList.toggle("hidden");
    menuTexts.forEach(text => text.classList.toggle("hidden"));
    sidebar.classList.toggle("w-64"); // When clicking back the button, the sidebar will change from w-16 to w-64
  });

  // Hide sidebar when window resizes below 1024px
  window.addEventListener("resize", responsiveSidebar);
});