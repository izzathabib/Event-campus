document.addEventListener("DOMContentLoaded", () => {
  const paperWorkNav = document.getElementById("paper-work-nav");
  const paperWorkForm = document.getElementById("paper-work-form");
  const mycsdMapNav = document.getElementById("mycsd-map-nav");
  const mycsdMapForm = document.getElementById("mycsd-map-form");

  // mycsdMapNav
  mycsdMapNav.addEventListener("click", () => {
    // Check MyCSD Mapping Form
    if (mycsdMapForm.classList.contains("hidden")) {
      mycsdMapForm.classList.remove("hidden");
      mycsdMapNav.classList.add("border-purple-800", "text-purple-800");
    }

    // Hide Paper Work Form
    if (!paperWorkForm.classList.contains("hidden")) {
      paperWorkForm.classList.add("hidden");
      paperWorkNav.classList.remove("text-purple-800", "border-purple-800");
    }
    
  });

  // paperWorkNav
  paperWorkNav.addEventListener("click", () => {
    // Check Paper Work Form
    if (paperWorkForm.classList.contains("hidden")) {
      paperWorkForm.classList.remove("hidden");
      paperWorkNav.classList.add("text-purple-800", "border-purple-800");
    }

    // Hide MyCSD Mapping Form
    if (!mycsdMapForm.classList.contains("hidden")) {
      mycsdMapForm.classList.add("hidden");
      mycsdMapNav.classList.remove("text-purple-800", "border-purple-800");
    } 
    
  });


});