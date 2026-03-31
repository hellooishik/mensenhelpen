/**
 * MensenHelpen Main JS
 * Handles AJAX, Modals, and UI Interactions
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        
        /* --- Modal Logic --- */
        const $modals = $('.modal-overlay');
        const $modalClose = $('.js-modal-close');
        
        $('.js-open-register').on('click', function(e) {
            e.preventDefault();
            $modals.removeClass('active'); // Close any open modal
            $('#register-modal').addClass('active');
        });

        $('.js-open-login').on('click', function(e) {
            e.preventDefault();
            $modals.removeClass('active'); // Close any open modal
            $('#login-modal').addClass('active');
        });

        $modalClose.on('click', function() {
            $modals.removeClass('active');
        });

        $(window).on('click', function(e) {
            if ($(e.target).hasClass('modal-overlay')) {
                $modals.removeClass('active');
            }
        });

        /* --- AJAX: Register User --- */
        $('#register-form').on('submit', function(e) {
            e.preventDefault();
            const $form = $(this);
            const $msg = $form.find('.js-form-message');
            const data = {
                action: 'mensenhelpen_register',
                nonce: mensenhelpenAjax.nonce,
                mensenhelpen_name: $('#reg_name').val(),
                mensenhelpen_email: $('#reg_email').val(),
                mensenhelpen_password: $('#reg_password').val(),
                mensenhelpen_address: $('#reg_address').val(),
                mensenhelpen_age_range: $('#reg_age').val(),
                mensenhelpen_categories: []
            };

            // Get checked categories
            $form.find('input[name="categories[]"]:checked').each(function() {
                data.mensenhelpen_categories.push($(this).val());
            });

            $.ajax({
                url: mensenhelpenAjax.ajaxurl,
                type: 'POST',
                data: data,
                beforeSend: function() {
                    $form.find('button').prop('disabled', true).text('Processing...');
                },
                success: function(response) {
                    if (response.success) {
                        $msg.html('<div class="alert alert-success">' + response.data.message + '</div>');
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        $msg.html('<div class="alert alert-error">' + response.data.message + '</div>');
                        $form.find('button').prop('disabled', false).text('Sign Up Free');
                    }
                }
            });
        });

        /* --- AJAX: Brand Inquiry --- */
        $('#brand-inquiry-form').on('submit', function(e) {
            e.preventDefault();
            const $form = $(this);
            const $msg = $form.find('.js-form-message');

            $.ajax({
                url: mensenhelpenAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'mensenhelpen_brand_inquiry',
                    nonce: mensenhelpenAjax.nonce,
                    brand_company: $('#brand_company').val(),
                    brand_name: $('#brand_name').val(),
                    brand_email: $('#brand_email').val(),
                    brand_message: $('#brand_message').val()
                },
                beforeSend: function() {
                    $form.find('button').prop('disabled', true).text('Sending...');
                },
                success: function(response) {
                    if (response.success) {
                        $msg.html('<div class="alert alert-success">' + response.data.message + '</div>');
                        $form[0].reset();
                    } else {
                        $msg.html('<div class="alert alert-error">' + response.data.message + '</div>');
                    }
                    $form.find('button').prop('disabled', false).text('Send Inquiry');
                }
            });
        });

        /* --- AJAX: Product Filtering --- */
        $('.js-filter-select').on('change', function() {
            filterProducts();
        });

        $('#reset-filters').on('click', function() {
            $('.js-filter-select').val('0');
            $('#sort-products').val('latest');
            filterProducts();
        });

        function filterProducts() {
            const $container = $('.js-ajax-products-container');
            const $loader = $('.js-ajax-loader');

            $.ajax({
                url: mensenhelpenAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'mensenhelpen_filter_products',
                    nonce: mensenhelpenAjax.nonce,
                    category: $('#filter-category').val(),
                    brand: $('#filter-brand').val(),
                    sort: $('#sort-products').val()
                },
                beforeSend: function() {
                    $loader.fadeIn(200);
                    $container.css('opacity', '0.5');
                },
                success: function(response) {
                    if (response.success) {
                        $container.html(response.data.html);
                    }
                    $loader.fadeOut(200);
                    $container.css('opacity', '1');
                }
            });
        }

        /* --- AJAX: Review Submission --- */
        $('#submit-review-form').on('submit', function(e) {
            e.preventDefault();
            const $form = $(this);
            const $msg = $form.find('.js-review-message');

            $.ajax({
                url: mensenhelpenAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'mensenhelpen_submit_review',
                    nonce: mensenhelpenAjax.nonce,
                    product_id: $('#review_product_id').val(),
                    rating: $('input[name="rating"]:checked').val(),
                    review_title: $('#review_title').val(),
                    review_text: $('#review_text').val(),
                    review_pros: $('#review_pros').val(),
                    review_cons: $('#review_cons').val()
                },
                beforeSend: function() {
                    $form.find('button').prop('disabled', true).text('Posting...');
                },
                success: function(response) {
                    if (response.success) {
                        $msg.html('<div class="alert alert-success">' + response.data.message + '</div>');
                        setTimeout(() => window.location.reload(), 1500);
                    } else {
                        $msg.html('<div class="alert alert-error">' + response.data.message + '</div>');
                        $form.find('button').prop('disabled', false).text('Post Review');
                    }
                }
            });
        });

        /* --- UI: Category Interactivity --- */
        $('.js-category-checkbox').on('change', function() {
            $(this).closest('.category-checkbox-card').toggleClass('selected', this.checked);
        });

        /* --- UI: Mobile Menu --- */
        $('.menu-toggle').on('click', function() {
            $('body').toggleClass('nav-open');
            $(this).attr('aria-expanded', function(_, attr) { return attr == 'true' ? 'false' : 'true'; });
        });

    });

})(jQuery);
