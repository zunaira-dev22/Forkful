document.addEventListener("DOMContentLoaded", function () {

  /* =========================
     ELEMENTS
  ========================= */

  const categoryButtons = document.querySelectorAll(".category-btn");
  const menuItems = document.querySelectorAll(".menu-item");

  const navbar = document.querySelector(".navbar");
  const cartButton = document.querySelector('.cart-btn[href="#cart"]');

  const menuSection = document.querySelector(".menu-section");
  const cartSection = document.querySelector(".cart-section");
  const footer = document.querySelector(".site-footer");


  /* =========================
     CATEGORY FILTER
  ========================= */

  function showCategory(category) {

    let delay = 0;

    menuItems.forEach((item) => {

      if (item.classList.contains(category)) {

        item.style.display = "block";

        const card = item.querySelector(".menu-card");

        if (card) {

          // Reset animation
          card.classList.remove("menu-card-animate");

          // Force browser to reset animation
          void card.offsetWidth;

          // Animate cards one by one
          setTimeout(() => {
            card.classList.add("menu-card-animate");
          }, delay);

          delay += 100;
        }

      } else {

        item.style.display = "none";

      }

    });

  }


  /* =========================
     CATEGORY BUTTON CLICKS
  ========================= */

  categoryButtons.forEach((button) => {

    button.addEventListener("click", function () {

      const category = this.dataset.category;

      categoryButtons.forEach((btn) => {
        btn.classList.remove("active");
      });

      this.classList.add("active");

      showCategory(category);

    });

  });


  /* =========================
     DEFAULT CATEGORY
  ========================= */

  const activeButton = document.querySelector(".category-btn.active");

  if (activeButton) {

    showCategory(activeButton.dataset.category);

  } else if (categoryButtons.length > 0) {

    categoryButtons[0].classList.add("active");

    showCategory(categoryButtons[0].dataset.category);

  }


  /* =========================
     CART BUTTON BOUNCE
  ========================= */

  const addButtons = document.querySelectorAll(".add-btn");

  addButtons.forEach((button) => {

    button.addEventListener("click", function () {

      sessionStorage.setItem("animateCart", "yes");

    });

  });


  if (
    cartButton &&
    sessionStorage.getItem("animateCart") === "yes"
  ) {

    cartButton.classList.add("cart-bounce");

    sessionStorage.removeItem("animateCart");

    setTimeout(() => {

      cartButton.classList.remove("cart-bounce");

    }, 700);

  }


  /* =========================
     MENU HEADER REVEAL
  ========================= */

  if (menuSection) {

    const menuHeading = menuSection.querySelector("h2");
    const menuTabs = menuSection.querySelector(".menu-tabs");

    const menuObserver = new IntersectionObserver(
      (entries, observer) => {

        entries.forEach((entry) => {

          if (entry.isIntersecting) {

            if (menuHeading) {
              menuHeading.classList.add("menu-heading-reveal");
            }

            if (menuTabs) {

              setTimeout(() => {

                menuTabs.classList.add("menu-tabs-reveal");

              }, 150);

            }

            observer.unobserve(entry.target);

          }

        });

      },
      {
        threshold: 0.2
      }
    );

    menuObserver.observe(menuSection);

  }


  /* =========================
     CART SECTION REVEAL
  ========================= */

  if (cartSection) {

    const orderList = cartSection.querySelector(".order-list");
    const orderSummary = cartSection.querySelector(".order-summary");

    const cartObserver = new IntersectionObserver(
      (entries, observer) => {

        entries.forEach((entry) => {

          if (entry.isIntersecting) {

            // Whole cart section
            cartSection.classList.add("cart-reveal");


            // Left side
            if (orderList) {
              orderList.classList.add("cart-list-reveal");
            }


            // Right side
            if (orderSummary) {

              setTimeout(() => {

                orderSummary.classList.add(
                  "cart-summary-reveal"
                );

              }, 150);

            }

            observer.unobserve(entry.target);

          }

        });

      },
      {
        threshold: 0.2
      }
    );

    cartObserver.observe(cartSection);

  }


  /* =========================
     FOOTER REVEAL
  ========================= */

  if (footer) {

    const footerObserver = new IntersectionObserver(
      (entries, observer) => {

        entries.forEach((entry) => {

          if (entry.isIntersecting) {

            entry.target.classList.add(
              "footer-reveal"
            );

            observer.unobserve(entry.target);

          }

        });

      },
      {
        threshold: 0.15
      }
    );

    footerObserver.observe(footer);

  }


  /* =========================
     NAVBAR SCROLL EFFECT
  ========================= */

  function updateNavbar() {

    if (!navbar) {
      return;
    }

    if (window.scrollY > 40) {

      navbar.classList.add(
        "navbar-scrolled"
      );

    } else {

      navbar.classList.remove(
        "navbar-scrolled"
      );

    }

  }


  updateNavbar();


  window.addEventListener(
    "scroll",
    updateNavbar,
    {
      passive: true
    }
  );

});