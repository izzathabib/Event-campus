document.addEventListener("DOMContentLoaded", () => {
  const toggleBtn = document.getElementById("toggle-btn");
  const sidebar = document.getElementById("sidebar");
  const dashboardText = document.getElementById("dashboard-text");
  const menuTexts = document.querySelectorAll(".menu-text");
  const eventManagementSubmenu = document.getElementById("event-management-submenu");
  const sidebarDropdownIcon = document.getElementById("sidebar-dropdown-icon"); // Dropdown icon only
  const eventManagementToggle = document.getElementById("event-management-toggle"); // Event management menu including icon + dropwdown toogle
  const notiProfile = document.getElementById("noti-profile"); 
  const mobileTopNav = document.getElementById("mobile-top-nav"); 
  const mobileSidebarButton = document.getElementById("mobile-sidebar-button");
  const mainSection = document.getElementById("main-section");
  const xIcon = document.getElementById("x-icon");


    // if (sidebar.classList.contains("w-16")) {
    //     mainSection.classList.add("ml-16");
    // } else {
    //     mainSection.classList.add("ml-64");
    // }


  function hideEventManagementSubmenu() {
    
    if (eventManagementSubmenu) {
      if (!eventManagementSubmenu.classList.contains("hidden")) {
        eventManagementSubmenu.classList.add("hidden");
      }
    }
     
  }

  function mobileScreenLayout() {
    sidebar.classList.add("hidden");
    notiProfile.classList.add("hidden");
    mobileTopNav.classList.remove("hidden");
    mainSection.classList.remove("ml-64");
    mainSection.classList.remove("ml-16");
  }

  function tabletScreenLayout() {
    sidebar.classList.remove("hidden");
    notiProfile.classList.remove("hidden");
    sidebar.classList.add("w-16");
    sidebar.classList.remove("w-64");
    dashboardText.classList.add("hidden");
    menuTexts.forEach(text => text.classList.add("hidden"));
    sidebarDropdownIcon.classList.toggle("hidden");
    mobileTopNav.classList.add("hidden");
    mainSection.classList.add("ml-16");
    mainSection.classList.remove("ml-64");
  }

  function largeScreenLayout() {
    sidebar.classList.remove("hidden");
    notiProfile.classList.remove("hidden");
    sidebar.classList.remove("w-16");
    sidebar.classList.add("w-64");
    dashboardText.classList.remove("hidden");
    menuTexts.forEach(text => text.classList.remove("hidden"));

    if (sidebarDropdownIcon) {
      sidebarDropdownIcon.classList.remove("hidden");
    }

    mobileTopNav.classList.add("hidden");
    mainSection.classList.remove("ml-16");
    mainSection.classList.add("ml-64");
  }

  // Sidebar behavior based on screen size 
  function responsiveSidebar() {
    const width = window.innerWidth;
    switch (true) {
      case (width <= 640):
        mobileScreenLayout();
        break;
      case (width <= 1024 && width > 640):
        tabletScreenLayout();
        hideEventManagementSubmenu();
        break;
      default:
        largeScreenLayout();
        break;
    }
  }

  // Hide sidebar on page load if screen width is less than or equal to 640px
  // if (window.innerWidth <= 640) {
  //   mobileScreenLayout();
  // }

  // Resizes sidebar
  window.addEventListener("resize", responsiveSidebar);

  /* 

    # Normal screen sidebar toggle button 
      * This button is used to toggle the sidebar between a collapsed and expanded state when in a normal screen size. *
     
  */
  toggleBtn.addEventListener("click", () => {
    // Toggle sidebar width
    sidebar.classList.toggle("w-64");
    sidebar.classList.toggle("w-16");

    // Toggle visibility of text elements
    dashboardText.classList.toggle("hidden");
    menuTexts.forEach(text => text.classList.toggle("hidden"));

    if (sidebarDropdownIcon) {
      sidebarDropdownIcon.classList.toggle("hidden");
    }

    hideEventManagementSubmenu()
    mainSection.classList.toggle("ml-64");
    mainSection.classList.toggle("ml-16");

    // Adjust main-section margin
    // if (sidebar.classList.contains("w-16")) {
    //     mainSection.classList.remove("ml-64");
    //     mainSection.classList.add("ml-16");
    // } else {
    //     mainSection.classList.remove("ml-16");
    //     mainSection.classList.add("ml-64");
    // }
  });

  /* 
  
    # Mobile screen sidebar toggle button 
      * This button is used to toggle the sidebar between a collapsed and expanded state when in a mobile screen size. *
     
  */
  mobileSidebarButton.addEventListener("click", () => {
    sidebar.classList.remove("hidden");
    sidebar.classList.add("w-full");
    sidebar.classList.remove("w-64");
    mainSection.classList.add("hidden");
    toggleBtn.classList.add("hidden");
    xIcon.classList.remove("hidden");
  });

  // "X" icon to close mobile sidebar
  xIcon.addEventListener("click", () => {
    sidebar.classList.toggle("hidden");
    sidebar.classList.toggle("w-full");
    sidebar.classList.add("w-64");
    mainSection.classList.remove("hidden");
    toggleBtn.classList.remove("hidden");
    xIcon.classList.add("hidden");
  });

  // Event management dropdown menu button
  if (eventManagementToggle) {

    eventManagementToggle.addEventListener("click", () => {
      eventManagementSubmenu.classList.toggle("hidden");
    });

  }
  
});