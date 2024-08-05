$(document).on("click", ".sidebar li", function () {
    $(this).addClass("active").siblings().removeClass("active");
});

// =========== left menu sidebar dp toggle ====================

// $(".sub-menu ul").hide();
$(".has-submenu a").click(function () {
    $(this).parent(".nav-link").children("ul").slideToggle("100");
    $(this).find(".right").toggleClass("fa-angle-up fa-angle-down");
});

// ========== Sidebar Toggler ==============

$(document).ready(function () {
    $("#toggleSidebar").click(function () {
        $(".left-menu").toggleClass("hide");
        $(".content-wrapper").toggleClass("hide");
        $(".fixed_company_name").toggleClass("hide");
    });
});

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".sidebar .nav-link").forEach(function (element) {
        element.addEventListener("click", function (e) {
            let nextEl = element.nextElementSibling;
            let parentEl = element.parentElement;

            if (nextEl) {
                e.preventDefault();
                let mycollapse = new bootstrap.Collapse(nextEl);

                if (nextEl.classList.contains("show")) {
                    mycollapse.hide();
                } else {
                    mycollapse.show();
                    // find other submenus with class=show
                    var opened_submenu =
                        parentEl.parentElement.querySelector(".submenu.show");
                    // if it exists, then close all of them
                    if (opened_submenu) {
                        new bootstrap.Collapse(opened_submenu);
                    }
                }
            }
        }); // addEventListener
    }); // forEach
});
// DOMContentLoaded  end
