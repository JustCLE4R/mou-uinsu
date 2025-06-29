(function ($) {
    "use strict";

    // MENU
    $(".navbar-collapse a").on("click", function () {
        $(".navbar-collapse").collapse("hide");
    });

    // CUSTOM LINK
    $(".smoothscroll").click(function () {
        var el = $(this).attr("href");
        var elWrapped = $(el);
        var header_height = $(".navbar").height();

        scrollToDiv(elWrapped, header_height);
        return false;

        function scrollToDiv(element, navheight) {
            var offset = element.offset();
            var offsetTop = offset.top;
            var totalScroll = offsetTop - navheight;

            $("body,html").animate(
                {
                    scrollTop: totalScroll,
                },
                300
            );
        }
    });

    const $form = $("form"),
        $nextBtn = $form.find(".nextBtn"),
        $backBtn = $form.find(".backBtn");

    // Fungsi validasi field di halaman pertama
    function validateFirstStep() {
        let isValid = true;

        // Hapus pesan "Wajib diisi" sebelumnya
        $(".first .text-danger.required-msg").remove();

        // Periksa semua field yang required di dalam langkah pertama
        $(".first [required]").each(function () {
            const $field = $(this);

            // Jika kosong
            if (!$field.val()) {
                isValid = false;

                // Cari label yang sesuai berdasarkan atribut for
                const inputId = $field.attr("id");
                const $label = $(`label[for="${inputId}"]`);

                if ($label.length) {
                    // Tambahkan pesan hanya jika belum ada
                    $label.append(
                        '<span class="text-danger ms-2 required-msg">Wajib diisi!</span>'
                    );
                }
            }
        });

        return isValid;
    }

    // Klik tombol "Selanjutnya"
    $nextBtn.on("click", function () {
        if (validateFirstStep()) {
            $form.addClass("secActive");
        }
    });

    // Klik tombol "Kembali"
    $backBtn.on("click", function () {
        $form.removeClass("secActive");
    });

    $(window).on("scroll", function () {
        function isScrollIntoView(elem, index) {
            var docViewTop = $(window).scrollTop();
            var docViewBottom = docViewTop + $(window).height();
            var elemTop = $(elem).offset().top;
            var elemBottom = elemTop + $(window).height() * 0.5;
            if (elemBottom <= docViewBottom && elemTop >= docViewTop) {
                $(elem).addClass("active");
            }
            if (!(elemBottom <= docViewBottom)) {
                $(elem).removeClass("active");
            }
            var MainTimelineContainer = $("#vertical-scrollable-timeline")[0];
            var MainTimelineContainerBottom =
                MainTimelineContainer.getBoundingClientRect().bottom -
                $(window).height() * 0.5;
            $(MainTimelineContainer)
                .find(".inner")
                .css("height", MainTimelineContainerBottom + "px");
        }
        var timeline = $("#vertical-scrollable-timeline li");
        Array.from(timeline).forEach(isScrollIntoView);
    });
})(window.jQuery);
