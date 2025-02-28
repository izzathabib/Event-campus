document.addEventListener("DOMContentLoaded", () => {
  const toggleBtn = document.getElementById("toggle-btn");
  const sidebar = document.getElementById("sidebar");
  const dashboardText = document.getElementById("dashboard-text");
  const bottomNav = document.getElementById("bottomNav");
  const menuTexts = document.querySelectorAll(".menu-text");
  const eventManagementSubmenu = document.getElementById("event-management-submenu");
  const sidebarDropdownIcon = document.getElementById("sidebar-dropdown-menu"); // Dropdown icon only
  const eventManagementToggle = document.getElementById("event-management-toggle"); // Event management menu including icon + dropwdown toogle

  function hideEventManagementSubmenu() {
    if (eventManagementSubmenu.classList.contains("hidden")) {
      eventManagementSubmenu.classList.add("");
    } else {
      eventManagementSubmenu.classList.add("hidden");
    }
  }

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
        sidebarDropdownIcon.classList.toggle("hidden");
        hideEventManagementSubmenu()
        break;
      default:
        bottomNav.classList. add("hidden");
        sidebar.classList.remove("hidden");
        sidebar.classList.remove("w-16");
        sidebar.classList.add("w-64");
        dashboardText.classList.remove("hidden");
        menuTexts.forEach(text => text.classList.remove("hidden"));
        sidebarDropdownIcon.classList.toggle("hidden");
        break;
    }
  }

  // Resizes sidebar
  window.addEventListener("resize", responsiveSidebar);

  toggleBtn.addEventListener("click", () => {
    sidebar.classList.toggle("w-16");
    dashboardText.classList.toggle("hidden");
    menuTexts.forEach(text => text.classList.toggle("hidden"));
    sidebarDropdownIcon.classList.toggle("hidden");
    sidebar.classList.toggle("w-64");
    eventManagementSubmenu.classList.toggle("hidden"); 
    hideEventManagementSubmenu()
  });

  // Event management dropdown menu button
  eventManagementToggle.addEventListener("click", () => {
    eventManagementSubmenu.classList.toggle("hidden");
  });
  
});