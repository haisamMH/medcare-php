/*global $, document, window, lightbox, jQuery, setTimeout, initEvents*/
$(document).ready(function () {

    'use strict';
    toastr.options = {
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
    }

    // ---------------------------------------------- //
    // Navbar Shrinking Behavior
    // ---------------------------------------------- //
    $(window).scroll(function () {
        if ($(window).scrollTop() > 20) {
            $('nav.navbar').addClass('shrink');
        } else {
            $('nav.navbar').removeClass('shrink');
        }
    });

    // ---------------------------------------------- //
    // Menu Section tabs
    // ---------------------------------------------- //
    $('.menu nav a').click(function (e) {
        e.preventDefault();
        $(this).tab('fadeIn');
    });

    // ---------------------------------------------- //
    // OWl Carousel
    // ---------------------------------------------- //
    $('.owl-carousel').owlCarousel({
        loop: false,
        nav: false,
        dots: true,
        navText: [
            "<i class='icon-arrow-left'></i>",
            "<i class='icon-arrow-right'></i>"
        ],
        margin: 15,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            757: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });

    // ---------------------------------------------- //
    // Label color changing on focus
    // ---------------------------------------------- //
    $('input, textarea').focus(function () {
        $(this).parent('label').addClass('active');
    });
    $('input, textarea').blur(function () {
        $(this).parent('label').removeClass('active');
    });

    // ---------------------------------------------- //
    // Date picker initialization
    // ---------------------------------------------- //
//    $('#date').datepicker({
//        todayButton: new Date()
//    });

    // ---------------------------------------------- //
    // Time picker initialization
    // ---------------------------------------------- //
    $('.timepicker').timepicki();

    // ---------------------------------------------- //
    // Time picker initialization
    // ---------------------------------------------- //
    $('body').scrollspy({
        target: '.navbar',
        offset: 80
    });

    // ---------------------------------------------- //
    // Preventing URL update on navigation link click
    // ---------------------------------------------- //
    $('.navbar-nav a, #scroll-down').bind('click', function (e) {
        var anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $(anchor.attr('href')).offset().top
        }, 1000);
        e.preventDefault();
    });

    // ---------------------------------------------- //
    // Scroll to top button
    // ---------------------------------------------- //
    $('#scrollTop').click(function () {
        $('html, body').animate({scrollTop: 0}, 1000);
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() >= 1500) {
            $('#scrollTop').fadeIn();
        } else {
            $('#scrollTop').fadeOut();
        }
    });

    // ---------------------------------------------- //
    // Reservation Modal Opening & Closing
    // ---------------------------------------------- //
    $('#open-reservation').click(function (e) {
        e.preventDefault();
        $('.reservation-overlay').fadeIn();
        $('body').css({'overflow': 'hidden'});

        setTimeout(function () {
            $('#reservation-modal').addClass('is-visible');
        }, 100);
    });

    $('#close').click(function () {
        $('.reservation-overlay').fadeOut();
        setTimeout(function () {
            $('body').css('overflow', 'auto');
        }, 400);
        $('#reservation-modal').removeClass('is-visible');
    });


    // ---------------------------------------------- //
    // Lightbox initialization
    // ---------------------------------------------- //
    lightbox.option({
        'resizeDuration': 400,
        'fadeDuration': 400,
        'alwaysShowNavOnTouchDevices': true
    });

    // ---------------------------------------------- //
    // Booking form validation
    // ---------------------------------------------- //
    $('#booking-form, #booking-form-alternative').validate({
        messages: {
            name: 'please enter your name',
            email: 'please enter your email address',
            number: 'please enter your phone number',
            people: 'please enter how many people',
            date: 'please enter booking date',
            time: 'please enter booking time',
            request: 'please enter your special request'
        }
    });

    // ---------------------------------------------- //
    // Modal booking form validation
    // ---------------------------------------------- //
    $('#booking-form-alternative').validate({
        messages: {
            clientname: 'please enter your name',
            clientemail: 'please enter your email address',
            clientnumber: 'please enter your phone number',
            clientpeople: 'please enter how many people',
            clientdate: 'please enter booking date',
            clienttime: 'please enter booking time',
            clientrequest: 'please enter your special request'
        }
    });


    // ---------------------------------------------- //
    // Feedback form validation
    // ---------------------------------------------- //
    $('#feedback-form').validate({
        messages: {
            username: 'please enter your name',
            useremail: 'please enter your email address',
            message: 'please enter your feedback'
        },
        submitHandler: function (form) {
            $.ajax({
                url: "ajax/feedback.php",
                type: "POST",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == '1') {
                        toastr.success('Thank You for Your Valuable Feedback');
                        $('#feedback-form')[0].reset();
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }
    });

   
    // ---------------------------------------------- //
    // Member signup form validation
    // ---------------------------------------------- //

    jQuery.validator.addMethod("lettersonlys", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    }, "Letters only please");

    $('#signup-form').validate({
        rules: {
            name: {lettersonlys: true, required: true
            },
            number: {
                minlength: 10,
                maxlength: 10
            },
            password: {
                minlength: 6
            },
            password_confirm: {
                minlength: 6,
                equalTo: "#password"
            }
        },
        messages: {
            name: {required: 'please enter your name', lettersonlys: 'Letters only please'},
            number: {required: 'please enter your phone number', maxlength: 'Please enter no more than 10 numbers', minlength: 'Please enter at least 10 numbers'},
            email: 'please enter your email address',
            address: 'please enter your address'
        },
        submitHandler: function (form) {
            $.ajax({
                url: "ajax/signup.php",
                type: "POST",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == '1') {
                        toastr.info('<strong>Sorry !</strong>  Email already exists , Please Try another one');
                    } else if (response == '2') {
                        toastr.success('<strong>Success!</strong> You have been added to the system successfully.');
                        $('#signup-form')[0].reset();
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }

    });
    
    $('#pharmacy-signup-form').validate({
        rules: {
            name: {lettersonlys: true, required: true
            },
            number: {
                minlength: 10,
                maxlength: 10
            },
            password: {
                minlength: 6
            },
            password_confirm: {
                minlength: 6,
                equalTo: "#password"
            }
        },
        messages: {
            name: {required: 'please enter your name', lettersonlys: 'Letters only please'},
            number: {required: 'please enter your phone number', maxlength: 'Please enter no more than 10 numbers', minlength: 'Please enter at least 10 numbers'},
            email: 'please enter your email address',
            address: 'please enter your address'
        },
        submitHandler: function (form) {
            $.ajax({
                url: "ajax/pharmacySignup.php",
                type: "POST",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == '1') {
                        toastr.info('<strong>Sorry !</strong>  Email already exists , Please Try another one');
                    } else if (response == '2') {
                        toastr.success('<strong>Success!</strong> Pharmacy added to the system successfully.');
                        $('#pharmacy-signup-form')[0].reset();
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }

    });
    
    $('#pharmacy-edit-form').validate({
        rules: {
            name: {lettersonlys: true, required: true
            },
            number: {
                minlength: 10,
                maxlength: 10
            },
            password: {
                minlength: 6
            },
            password_confirm: {
                minlength: 6,
                equalTo: "#password"
            }
        },
        messages: {
            name: {required: 'please enter your name', lettersonlys: 'Letters only please'},
            number: {required: 'please enter your phone number', maxlength: 'Please enter no more than 10 numbers', minlength: 'Please enter at least 10 numbers'},
            email: 'please enter your email address',
            address: 'please enter your address'
        },
        submitHandler: function (form) {
            $.ajax({
                url: "ajax/editPharmacy.php",
                type: "POST",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == '1') {
                        toastr.info('<strong>Sorry !</strong>  Email already exists , Please Try another one');
                    } else if (response == '2') {
                        toastr.success('<strong>Success!</strong> Pharmacy has been updated successfully.');
                        $('#pharmacy-signup-form')[0].reset();
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }

    });

    $('#login-form').validate({
        messages: {
            email: 'please enter your email address',
            password: 'please enter your password',
        }, submitHandler: function (form) {
            $.ajax({
                url: "ajax/login.php",
                type: "POST",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == '4') {
                        window.location.href = "dashboard.php";
                    } else if (response == '1') {
                        toastr.error('Invalid login.');
                    } else if (response == '3') {
                        toastr.error('Your are not registered memeber.');
                    } else if (response == '2') {
                        toastr.info('Please activate account through your email');
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }
    });
    
    $('#admin-login-form').validate({
        messages: {
            email: 'please enter your email address',
            password: 'please enter your password',
        }, submitHandler: function (form) {
            $.ajax({
                url: "ajax/adminLogin.php",
                type: "POST",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == '4') {
                        window.location.href = "admin_dashboard.php";
                    } else if (response == '1') {
                        toastr.error('Invalid login.');
                    } else if (response == '3') {
                        toastr.error('Your are not registered memeber.');
                    } else if (response == '2') {
                        toastr.info('Please activate account through your email');
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }
    });
    
    $('#staff-login-form').validate({
        messages: {
            email: 'please enter your email address',
            password: 'please enter your password',
        }, submitHandler: function (form) {
            $.ajax({
                url: "ajax/staffLogin.php",
                type: "POST",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == '4') {
                        window.location.href = "staff_dashboard.php";
                    } else if (response == '1') {
                        toastr.error('Invalid login.');
                    } else if (response == '3') {
                        toastr.error('Your are not registered memeber.');
                    } else if (response == '2') {
                        toastr.info('Please activate account through your email');
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }
    });
    
     $('#create-menu-form').validate({
        rules: {
            UnitDosage: {
                required: true
            },
            UnitType: {
                required: true
            },
            SpecialInstruction: {
                minlength: true
            },
            BrandName: {
                required: true,
            },
            GenericName: {
                number: true,
            },
            Category: {
                required: true,
            },
        },
        messages: {
        }, submitHandler: function (form) {
            $.ajax({
                url: "ajax/createMenu.php",
                type: "POST",
                data: new FormData(form),
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (response) {
                    if (response == '1') {
                        toastr.success("Item created successfully");
                        $('#create-menu-form')[0].reset();
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }
    });

    $('#edit-menu-form').validate({
        rules: {
            UnitDosage: {
                required: true
            },
            UnitType: {
                required: true
            },
            SpecialInstruction: {
                minlength: true
            },
            BrandName: {
                required: true,
            },
            GenericName: {
                number: true,
            },
            Category: {
                required: true,
            }
        },
        messages: {
        }, submitHandler: function (form) {
            $.ajax({
                url: "ajax/editMenu.php",
                type: "POST",
                data: new FormData(form),
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function (response) {
                    if (response == '1') {
                        toastr.success("Item updated successfully");
                        setTimeout(function () {
                            location.reload();
                        }, 3000);
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }
    });

        $('#generic-add-form').validate({
        rules: {
            GenericName: {
                required: true
            },
        },
        messages: {
        }, submitHandler: function (form) {
            $.ajax({
                url: "ajax/addGeneric.php",
                type: "POST",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == '1') {
                        toastr.success("Successfully added");
                        $('#generic-add-form')[0].reset();

                    }else if (response == '2') {
                        toastr.error("Generic Name already added");
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }
    });
    
     $('#brand-add-form').validate({
        rules: {
            BrandName: {
                required: true
            },
        },
        messages: {
        }, submitHandler: function (form) {
            $.ajax({
                url: "ajax/addBrand.php",
                type: "POST",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == '1') {
                        toastr.success("Successfully added");
                        $('#brand-add-form')[0].reset();

                    }else if (response == '2') {
                        toastr.error("Brand Name already added");
                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }
    });
    
    $('#faq-edit-form').validate({
        rules: {
            Question: {
                required: true
            },
            Answer: {
                required: true
            },
        },
        messages: {
        }, submitHandler: function (form) {
            $.ajax({
                url: "ajax/faqUpdate.php",
                type: "POST",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == '1') {
                        toastr.success("Successfully updated");
                        setTimeout(function () {
                            location.reload();
                        }, 3000);

                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }
    });

    $('#faq-create-form').validate({
        rules: {
            Question: {
                required: true
            },
            Answer: {
                required: true
            },
        },
        messages: {
        }, submitHandler: function (form) {
            $.ajax({
                url: "ajax/faqCreate.php",
                type: "POST",
                data: $(form).serialize(),
                success: function (response) {
                    if (response == '1') {
                        toastr.success("Successfully created");
                        $('#faq-create-form')[0].reset();

                    } else {
                        toastr.error('Something went wrong');
                    }
                }
            });
            return false;
        }
    });
    
    $(document).off("click", ".faq_delete").on("click", ".faq_delete", function (e) {
        e.preventDefault();

        var faqid = $(this).attr("faqid");

        $.ajax({
            url: "ajax/faqDelete.php",
            method: "POST",
            dataType: "json",
            data: {id: faqid},
            success: function (data) {
                toastr.success("Successfully deleted");
                setTimeout(function () {
                    location.reload();
                }, 500);
            }
        });

    });

   

   
    $('#btn-reg').click(function (e) {
        e.preventDefault();
        window.location.href = "registration.php";
    });



    // ---------------------------------------------- //
    // Hero Carousel initialization
    // ---------------------------------------------- //
    var Page = (function () {
        var $navArrows = $('#nav-arrows'),
                $nav = $('#nav-dots > span'),
                slitslider = $('#slider').slitslider({
            onBeforeChange: function (slide, pos) {
                $nav.removeClass('nav-dot-current');
                $nav.eq(pos).addClass('nav-dot-current');
            }
        }),
                init = function () {
                    initEvents();
                },
                initEvents = function () {
                    // add navigation events
                    $navArrows.children(':last').on('click', function () {
                        slitslider.next();
                        return false;
                    });
                    $navArrows.children(':first').on('click', function () {
                        slitslider.previous();
                        return false;
                    });
                    $nav.each(function (i) {
                        $(this).on('click', function (event) {
                            var $dot = $(this);
                            if (!slitslider.isActive()) {
                                $nav.removeClass('nav-dot-current');
                                $dot.addClass('nav-dot-current');
                            }
                            slitslider.jump(i + 1);
                            return false;
                        });
                    });
                };
        return {init: init};
    })();
    Page.init();

});
