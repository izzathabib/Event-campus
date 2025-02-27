document.addEventListener("DOMContentLoaded", () => {
  const toggleBtn = document.getElementById("toggle-btn");
  const sidebar = document.getElementById("sidebar");
  const dashboardText = document.getElementById("dashboard-text");
  const bottomNav = document.getElementById("bottomNav");
  const menuTexts = document.querySelectorAll(".menu-text");

  // Sidebar behavior based on screen size 
  function responsiveSidebar() {
    const width = window.innerWidth;
    switch (true) {
      case (width <= 640):
        sidebar.classList.add("hidden");
        bottomNav.classList.remove("hidden");
        break;
      case (width <= 1024 && width > 640):
        bottomNav.classList.add("hidden");
        sidebar.classList.remove("hidden");
        sidebar.classList.add("w-16");
        sidebar.classList.remove("w-64");
        dashboardText.classList.add("hidden");
        menuTexts.forEach(text => text.classList.add("hidden"));
        break;
      default:
        bottomNav.classList. add("hidden");
        sidebar.classList.remove("hidden");
        sidebar.classList.remove("w-16");
        sidebar.classList.add("w-64");
        dashboardText.classList.remove("hidden");
        menuTexts.forEach(text => text.classList.remove("hidden"));
        break;
    }
  }

  // Hide sidebar when window resizes below 1024px
  window.addEventListener("resize", responsiveSidebar);

  toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("w-16");
    dashboardText.classList.toggle("hidden");
    menuTexts.forEach(text => text.classList.toggle("hidden"));
    sidebar.classList.toggle("w-64"); // When clicking back the button, the sidebar will change from w-16 to w-64
  });

  
});