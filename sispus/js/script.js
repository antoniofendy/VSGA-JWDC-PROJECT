
$(function () {
    // Navbar Scroll
    let str = window.location.href;
    // if (str.match(/form.php|edit.php/)) {
    if (str.match(/view_book.php/)) {
        let get_navbar = document.querySelector(".fixed-top");
        get_navbar.style.backgroundColor = "#007bff";
    }
    else {
        $(document).scroll(function () {
            var $nav = $(".fixed-top");
            $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
        });
    }

    // Search on key up
    $("#keyword").keyup(function () {

        function fillData(itemList) {
            let title = "<div class='col-12 mb-4 text-center'>"
                + "<h1>Hasil <span style='color: #007bff; '>Pencarian</span></h1>"
                + "</div>"
                + itemList

            return title;
        }

        let xhr = new XMLHttpRequest();

        // Checikng ajax availablity
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                $('#benefits').html("");
                $("#old_page").html("");
                $('#benefits').css({ "padding": "0", "margin": "0" })
                $("#konten").html(fillData(xhr.responseText));
            }
        }

        if ($("#keyword").val() != "") {
            xhr.open('GET', 'ajax/cari.php?keyword=' + $("#keyword").val(), true);
            xhr.send();
        }
        else {
            $('.pagination li a').remove();
        }

    })

    // Pagination code
    $(".pagination li a").click(function () {
        e.preventDefault();
        var pageId = $(this).attr("id");

        function fillData(itemList) {
            let title = "<div class='col-12 mb-4 text-center'>"
                + "<h1>Hasil <span style='color: #007bff; '>Pencarian</span></h1>"
                + "</div>"
                + itemList

            return title;
        }

        let xhr = new XMLHttpRequest();

        // Checikng ajax availablity
        xhr.onreadystatechange = () => {
            if (xhr.readyState == 4 && xhr.status == 200) {
                $('#benefits').html("");
                $("#old_page").html("");
                $('#benefits').css({ "padding": "0", "margin": "0" })
                $("#konten").html(fillData(xhr.responseText));
            }
        }

        if ($("#keyword").val() != "") {
            xhr.open('GET', 'ajax/cari.php?keyword=' + $("#keyword").val() + '&page=' + pageId, true);
            xhr.send();
        }
    })


});

// // Hiding scroll to top button
// window.onscroll = () => {
//     const scrollToTop = document.getElementById('BtnScrollToTop');
//     if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
//         scrollToTop.style.display = "flex";
//     }
//     else {
//         scrollToTop.style.display = "none";
//     }
// }

// //Jquery
// $('document').ready(function () {

//     // ScrollToTop
//     $(window).scroll(function () {
//         if ($(this).scrollTop() > 500) {
//             $('#BtnScrollToTop').fadeIn();
//         } else {
//             $('#BtnScrollToTop').fadeOut();
//         }
//     });

//     $('#BtnScrollToTop').click(function () {
//         $('html, body').animate({ scrollTop: 0 }, 300);
//         return false;
//     });
// });
