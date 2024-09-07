/*----------------------------------------------
*
* [Admin Scripts]
*
* Theme    : Leverage
* Version  : 2.0
* Author   : Codings
* Support  : codings.dev
* 
----------------------------------------------*/

/*----------------------------------------------

[ALL CONTENTS]

1. Section Preview
2. ACF
3. OCDI
4. Load
5. Release Notes
----------------------------------------------*/

/*----------------------------------------------
1. Section Preview
----------------------------------------------*/

jQuery(function ($) {

    'use strict';

    var btn = $('.leverage-builder-sections a[data-name="add-layout"]');

    btn.each(function() {

        var btn_ctrl = $(this).parents().eq(1).data('layout');

        if($(this).text() === 'Add Content Section' || $(this).text() === 'Add Hero Section' || btn_ctrl == 'slider' || btn_ctrl == 'carousel' || btn_ctrl == 'about' || btn_ctrl == 'video' || btn_ctrl == 'fun_facts' || btn_ctrl == 'skills' || btn_ctrl == 'features' || btn_ctrl == 'services' || btn_ctrl == 'portfolio' || btn_ctrl == 'portfolio_grid' || btn_ctrl == 'team' || btn_ctrl == 'testimonials' || btn_ctrl == 'partners' || btn_ctrl == 'pricing' || btn_ctrl == 'custom_feature') {
            
            $(this).addClass('leverage-builder-add-section');
        }
    })

    $(document).on('click', '.leverage-builder-add-section', function() {

        var modal = $('.acf-fc-popup');
        var item  = $('.acf-fc-popup a');

        modal.addClass('leverage-modal');
        modal.prepend('<span class="close dashicons dashicons-no-alt"></span>');

        item.each(function() {

            var item_this = $(this);

            function add_image(section, image, title) {

                if(item_this.data('layout') == section) {
                    item_this.html('<img src="'+leverage_dir_uri+'/assets/images/'+image+'" alt="'+title+'"/><h4>'+title+'</h4>');
                } 
            }

            add_image('slider', 'section-slider.jpg', 'Slider / Banner');
            add_image('carousel', 'section-carousel.jpg', 'Carousel');
            add_image('about', 'section-about.jpg', 'About / Video');
            add_image('video', 'section-video.jpg', 'Video');
            add_image('fun_facts', 'section-funfacts.jpg', 'Fun Facts');
            add_image('skills', 'section-skills.jpg', 'Skills');
            add_image('features', 'section-features.jpg', 'Features');
            add_image('services', 'section-services.jpg', 'Services');
            add_image('portfolio', 'section-portfolio.jpg', 'Portfolio');
            add_image('portfolio_grid', 'section-portfolio-grid.jpg', 'Portfolio Grid');
            add_image('team', 'section-team.jpg', 'Team');
            add_image('testimonials', 'section-testimonials.jpg', 'Testimonials');
            add_image('partners', 'section-partners.jpg', 'Partners / Clients');
            add_image('pricing', 'section-pricing.jpg', 'Pricing Table');
            add_image('custom_feature', 'section-custom-feature.jpg', 'Custom Feature');
        })
    })
})

/*----------------------------------------------
2. ACF
----------------------------------------------*/

jQuery(function ($) {

    'use strict';

    function updateIcon(timeout) {
        setTimeout(function() {
            let item = $('.select2-results__option');
            item.each(function() {          
                let value = $(this).text();
                $(this).addClass('leverage-icon-item').html('<i class="icon-'+value+'" title="'+value+'"></i>'+value);
            })
        }, timeout)
    }

    $( document ).on( 'select2:opening', '.leverage-icon select', function() {
        updateIcon(100);
        updateIcon(800);
        updateIcon(1600);
    })

    $(document).on('keyup', '.select2-dropdown:not(.fa-select2-drop) .select2-search__field', function () {
        updateIcon(100);
        updateIcon(800);
        updateIcon(1600);
    })
})

jQuery(function ($) {

    'use strict';

    $('.leverage-tab-fix .acf-tab-wrap').hide();

    $(document).on('click', '.leverage-tab-fix .acf-true-false input', function() {
        $('.leverage-tab-fix .acf-tab-wrap').toggle();
    })
})

/*----------------------------------------------
3. OCDI
----------------------------------------------*/

jQuery(function ($) {

    'use strict';
    
    $('#leverage-import-demo-data a[href="#multi-page"]').click();

})

/*----------------------------------------------
4. Load
----------------------------------------------*/

jQuery(function($) {
    $('.acf-settings-wrap').addClass('ready');
    $('.toplevel_page_leverage-release-notes').addClass('ready');
    $('.appearance_page_pt-one-click-demo-import').addClass('ready');
})

/*----------------------------------------------
5. Release Notes
----------------------------------------------*/

jQuery(function ($) {

    'use strict';

    $('a[href="admin.php?page=theme-settings-support"]').attr('href', 'admin.php?page=leverage-release-notes');
})