<?php 

add_action('wp_footer', function () {
    if (is_page('marketing-agency-cyprus')) {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.faq-question').forEach(button => {
                button.addEventListener('click', () => {
                    const faqItem = button.parentElement;
                    const answer = button.nextElementSibling;

                    faqItem.classList.toggle('active');

                    if (faqItem.classList.contains('active')) {
                        answer.style.maxHeight = answer.scrollHeight + "px";
                    } else {
                        answer.style.maxHeight = 0;
                    }
                });
            });
        });
        </script>
        <?php
    }
});