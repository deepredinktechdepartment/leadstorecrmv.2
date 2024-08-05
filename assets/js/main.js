
$(document).ready(function () {
    toastr.clear();

    toastr.options = {
        "closeButton": true,
        "newestOnTop": true,
        "positionClass": "toast-top-right"
    };

});

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

// $(document).ready(function () {
//     $("#toggleSidebar").click(function () {
//         $(".left-menu").toggleClass("hide");
//         $(".content-wrapper").toggleClass("hide");
//         $(".fixed_company_name").toggleClass("hide");
//     });
// });



$(document).ready(function () {
    // Function to toggle sidebar visibility
    function toggleSidebar() {
        $(".left-menu, .content-wrapper, .fixed_company_name").toggleClass("hide");

        // Adjust margin-left of content wrapper based on left menu visibility
        if ($(".left-menu").hasClass("hide")) {
            $(".content-wrapper").css("margin-left", "0px");
        } else {
            // Set the margin-left value according to your requirements
            $(".content-wrapper").css("margin-left", "250px");
        }
    }

    // Initial check on page load
    if ($(window).width() <= 768) {
        $(".left-menu, .fixed_company_name").addClass("hide");
        $(".content-wrapper").css("margin-left", "0px");
    }

    // Click event for toggleSidebar button
    $("#toggleSidebar").click(function () {
        toggleSidebar();
    });

    // Resize event to check window width and toggleSidebar button visibility
    $(window).resize(function () {
        if ($(window).width() <= 768) {
            $(".left-menu, .fixed_company_name").addClass("hide");
            $(".content-wrapper").css("margin-left", "0px");
        } else {
            $(".left-menu, .fixed_company_name").removeClass("hide");
            $(".content-wrapper").css("margin-left", "250px"); // Set the margin-left value according to your requirements
        }
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









$(document).ready(function () {




    $('#master').on('click', function (e) {
        if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
        } else {
            $(".sub_chk").prop('checked', false);
        }
    });


    $('.delete_temp_keywords').on('click', function (e) {

        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr('data-id'));
        });

        if (allVals.length <= 0) {
            toastr.error("Please select row.");
            // alert("Please select row.");
        } else {

            var check = confirm("Are you sure you want to delete this row?");
            if (check == true) {

                var join_selected_values = allVals.join(",");

                $.ajax({
                    url: $(this).data('url'),
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    data: 'ids=' + join_selected_values,
                    beforeSend: function () {
                        //$("#action_happend_status").html("<h4 class='text-danger'><strong>Your action is in progress. Don't click submit button /refresh/close during the upload process.</strong></h4>");

                    },
                    success: function (data) {
                        if (data['success']) {
                            $(".sub_chk:checked").each(function () {
                                $(this).parents("tr").remove();
                            });

                            toastr.success(data['success']);

                        } else if (data['error']) {


                            toastr.error(data['error']);
                        } else {
                            toastr.error("Whoops Something went wrong!!");
                        }

                        //$("#action_happend_status").html("");
                        $("#tr_" + data['RefID']).hide();

                        $('.show_counting').show();
                        $(".show_counting").html(data['series'] + " Record deleted");
                    },
                    error: function (data) {

                        toastr.error(data.responseText);
                    }
                });

                $.each(allVals, function (index, value) {
                    $('table tr').filter("[data-row-id='" + value + "']").remove();
                });
            }
        }
    });

    $('.show_counting').hide();

    $('.update_priority_keywords').on('click', function (e) {


        var allVals = [];
        $(".sub_chk:checked").each(function () {
            allVals.push($(this).attr('data-id'));
        });


        if (allVals.length <= 0) {

            //alert("Please select row.");
            toastr.error("Please select 1 record.");
        } else {

            var check = confirm("Are you sure you want to move this row?");
            if (check == true) {

                var join_selected_values = allVals.join(",");


                var array = join_selected_values.split(",");


                var series = 1;
                for (var index = 0; index < array.length; index++) {
                    var pkid = array[index];

                    series = index + 1;


                    $.ajax({
                        url: $(this).data('url'),
                        type: 'POST',
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                        data: { ids: pkid, series: series, prioriy: $(this).data('prioriykeyword') },
                        success: function (data) {


                            if (data['success']) {
                                $(".sub_chk:checked").each(function () {
                                    //$(this).parents("tr").remove();
                                });
                                //toastr.success(data['success']);


                                //$('.sub_chk:checked').filter("[data-row-id='" + pkid + "']").remove();


                                $("#tr_" + data['RefID']).hide();

                                $('.show_counting').show();

                                $(".show_counting").html(data['series'] + " Record " + data['success']);




                                // make the ajax  call
                                // Use $tr now in your ajax call's success event





                            } else if (data['error']) {
                                toastr.error(data['error']);
                                //alert(data['error']);
                            } else {
                                toastr.error(data['error']);
                                // alert('Whoops Something went wrong!!!');
                            }
                            $("#action_happend_status").html("");
                        },
                        error: function (data) {
                            toastr.error(data.responseText);
                            //alert(data.responseText);
                        }
                    });



                }


            }
        }
    });




    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        onConfirm: function (event, element) {
            element.trigger('confirm');
        }
    });

    $(document).on('confirm', function (e) {
        var ele = e.target;
        e.preventDefault();

        $.ajax({
            url: ele.href,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (data) {
                if (data['success']) {
                    $("#" + data['tr']).slideUp("slow");
                    alert(data['success']);
                } else if (data['error']) {
                    alert(data['error']);
                } else {
                    alert('Whoops Something went wrong!!');
                }
            },
            error: function (data) {
                alert(data.responseText);
            }
        });

        return false;
    });


});





