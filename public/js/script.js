const categoryButtons = document.querySelectorAll(".category-btn");
const menuItems = document.querySelectorAll(".menu-item");


categoryButtons.forEach((button) => {

  button.addEventListener("click", () => {

    const category = button.dataset.category;


    // Remove active from all buttons
    categoryButtons.forEach((btn) => {
      btn.classList.remove("active");
    });


    // Active current button
    button.classList.add("active");


    // Show selected category
    menuItems.forEach((item) => {

      if (item.classList.contains(category)) {

        item.style.display = "block";

      } else {

        item.style.display = "none";

      }

    });

  });

});