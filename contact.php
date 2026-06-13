<?php
/**
 * Template Name: 联系我们
 *
 * @package mine
 */

get_header();
?>

<div class="location">
    <?php echo mine_breadcrumb(); ?>
</div>
<div class="nbanner nbanner1"><img src="<?php echo get_template_directory_uri(); ?>/assets/uploads/ditu.jpg"></div>
<div class="main">
    <div class="wrap">
        <div class="content">
            <h2 class="title">联系我们</h2>
            <ul class="contact">
                <li class="clearfix">
                    <div class="pic fl">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/uploads/cp.jpg" />
                    </div>
                    <div class="text fr">
                        
                        <p>
                            <?php
                                while ( have_posts() ) :
                                    the_post();
                                    the_content();
                                endwhile;
                            ?>
                        </p>
                        <div id="form">
                            <form id="contact-form" method="post">
                                <?php wp_nonce_field( 'mine_contact_form', 'mine_contact_nonce' ); ?>
                                <div class="form-row">
                                    <div class="form-group form-half">
                                        <input type="text" name="name" id="form-name" placeholder="您的姓名 *" required>
                                    </div>
                                    <div class="form-group form-half">
                                        <input type="tel" name="phone" id="form-phone" placeholder="联系电话">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="form-email" placeholder="电子邮箱 *" required>
                                </div>
                                <div class="form-group">
                                    <textarea name="content" id="form-content" rows="5" placeholder="请描述您的需求，我们将尽快与您联系" required></textarea>
                                </div>
                                <div class="form-group form-submit-wrap">
                                    <button type="submit" id="form-submit" class="form-submit">提交留言</button>
                                </div>
                                <div class="form-message" id="form-message"></div>
                            </form>
                        </div>

                        <style>
                            #form { margin-top: 20px; }
                            #form .form-row { display: flex; gap: 20px; }
                            #form .form-group { margin-bottom: 16px; }
                            #form .form-half { flex: 1; }
                            #form input,
                            #form textarea {
                                width: 100%;
                                padding: 12px 15px;
                                border: 1px solid #e0e0e0;
                                border-radius: 4px;
                                font-size: 14px;
                                color: #333;
                                background: #fafafa;
                                box-sizing: border-box;
                                transition: border-color .3s, background .3s;
                            }
                            #form input:focus,
                            #form textarea:focus {
                                border-color: #f07b38;
                                background: #fff;
                                box-shadow: 0 0 0 2px rgba(240,123,56,0.1);
                            }
                            #form textarea { resize: vertical; min-height: 120px; }
                            #form .form-submit-wrap { text-align: center; margin-bottom: 0; }
                            #form .form-submit {
                                display: inline-block;
                                padding: 12px 50px;
                                background: #f07b38;
                                color: #fff;
                                font-size: 16px;
                                border: none;
                                border-radius: 4px;
                                cursor: pointer;
                                transition: background .3s, transform .2s;
                            }
                            #form .form-submit:hover { background: #e06a2b; transform: translateY(-1px); }
                            #form .form-submit:active { transform: translateY(0); }
                            #form .form-message {
                                text-align: center;
                                margin-top: 12px;
                                font-size: 14px;
                                display: none;
                                padding: 10px 15px;
                                border-radius: 4px;
                            }
                            #form .form-message.success { display: block; color: #2d8a4e; background: #e8f5e9; }
                            #form .form-message.error { display: block; color: #c0392b; background: #fdecea; }
                            @media (max-width: 768px) {
                                #form .form-row { flex-direction: column; gap: 0; }
                                #form .form-submit { width: 100%; }
                            }
                        </style>

                        <script>
                        (function($) {
                            $('#contact-form').on('submit', function(e) {
                                e.preventDefault();
                                var $form = $(this);
                                var $btn = $('#form-submit');
                                var $msg = $('#form-message');

                                $btn.text('提交中...').prop('disabled', true);
                                $msg.removeClass('success error').hide();

                                $.ajax({
                                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                                    type: 'POST',
                                    dataType: 'json',
                                    data: $form.serialize() + '&action=mine_contact_submit',
                                    success: function(res) {
                                        if (res.success) {
                                            $msg.addClass('success').text(res.data).show();
                                            $form[0].reset();
                                        } else {
                                            $msg.addClass('error').text(res.data).show();
                                        }
                                    },
                                    error: function() {
                                        $msg.addClass('error').text('提交失败，请稍后重试').show();
                                    },
                                    complete: function() {
                                        $btn.text('提交留言').prop('disabled', false);
                                    }
                                });
                            });
                        })(jQuery);
                        </script>
                    </div>
                </li>  
            </ul>        
        </div>
    </div>
</div>

<?php get_footer(); ?>
