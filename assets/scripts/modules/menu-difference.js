document.addEventListener("DOMContentLoaded", () => {
  const nav = document.querySelector(".main-navigation");
  const sections = document.querySelectorAll(".dark-section, .light-section");

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        if (entry.target.classList.contains("light-section")) {
          nav.classList.add("light");
        } else {
          nav.classList.remove("light");
        }
      }
    });
  }, { threshold: 0.1 }); // fires when 10% of section is visible

  sections.forEach(section => observer.observe(section));
});
