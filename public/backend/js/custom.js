(function ($) {
    "use strict";
    $(document).ready(function () {
        tinymce.init({
            selector: ".summernote",
            plugins:
                "anchor autolink charmap link lists searchreplace wordcount ",
            toolbar:
                "undo redo | blocks | bold italic underline strikethrough | link mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | removeformat",
            tinycomments_mode: "embedded",
            tinycomments_author: "Author name",
            menubar: false,
            mergetags_list: [
                {
                    value: "First.Name",
                    title: "First Name",
                },
                {
                    value: "Email",
                    title: "Email",
                },
            ],
        });
        $(".select2").select2();
        $(".sub_cat_one").select2();
        $(".tags").tagify();
        $(".datetimepicker_mask").datetimepicker({
            format: "Y-m-d H:i",
        });

        $(".custom-icon-picker").iconpicker({
            templates: {
                popover:
                    '<div class="iconpicker-popover popover"><div class="arrow"></div>' +
                    '<div class="popover-title"></div><div class="popover-content"></div></div>',
                footer: '<div class="popover-footer"></div>',
                buttons:
                    '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm">Cancel</button>' +
                    ' <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm">Accept</button>',
                search: '<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',
                iconpicker:
                    '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
                iconpickerItem:
                    '<a role="button" href="javascript:;" class="iconpicker-item"><i></i></a>',
            },
        });
        $(".datepicker").datepicker({
            format: "yyyy-mm-dd",
            startDate: "-Infinity",
        });
        $(".clockpicker").clockpicker();

        /* Admin menu search method start */
        const inputSelector = "#search_menu";
        const listSelector = "#admin_menu_list";
        const notFoundSelector = ".not-found-message";

        function filterMenuList() {
            const query = $(inputSelector).val().toLowerCase();
            let hasResults = false;

            $(listSelector + " a").each(function () {
                const areaName = $(this).text().toLowerCase();
                const shouldShow = areaName.includes(query);
                $(this).toggleClass("d-none", !shouldShow);
                if (shouldShow) {
                    hasResults = true;
                }
            });

            // Show or hide the "Not Found" message based on search results
            if (hasResults) {
                $(notFoundSelector).addClass("d-none");
            } else {
                $(notFoundSelector).removeClass("d-none");
            }
        }
        $(inputSelector).on("input focus", function () {
            filterMenuList();
            $(listSelector).removeClass("d-none");
        });

        $(document).on("click", function (e) {
            if (
                !$(e.target).closest(inputSelector).length &&
                !$(e.target).closest(listSelector).length
            ) {
                $(listSelector).addClass("d-none");
            }
        });

        $(document).on("click", ".search-menu-item", function (e) {
            const activeTab = $(this).attr("data-active-tab");
            if (activeTab) {
                localStorage.setItem("activeTab", activeTab);
            }
        });
        /* Admin menu search method end */
    });

    $("#setLanguageHeader").on("change", function (e) {
        $(this).trigger("submit");
    });

    $(".change-currency").on("change", function (e) {
        $(".set-currency-header").submit();
    });

    // Nice select
    $(".select_js").niceSelect();
})(jQuery);
// addon side menu hide and show
document.addEventListener("DOMContentLoaded", function () {
    const addonMenu = document.querySelector(".addon_menu");
    const addonSideMenu = document.querySelector("#addon_sidemenu");
    if (addonMenu && addonSideMenu) {
        if (addonMenu.querySelectorAll("li").length === 0) {
            addonSideMenu.style.display = "none";
        }
    }
});
// auto active addon menu when li have class active
document.addEventListener('DOMContentLoaded', () => {
    const addonMenu = document.querySelector('.addon_menu');
    const addonSidemenu = document.getElementById('addon_sidemenu');
    if (addonMenu && addonMenu.querySelector('li.active')) {
        addonSidemenu.classList.add('active', 'show');
    }
});