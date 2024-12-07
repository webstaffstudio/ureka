</div><!-- #content -->
<?php
$form_title = get_field('footer_form_title', 'options');
$form_id = get_field('footer_form_id', 'options');
$footer_contacts_title = get_field('footer_contacts_title', 'option');
$contacts_address = get_field('contacts_address', 'option');
$contacts_phone = get_field('contacts_phone', 'option');
$contacts_email = get_field('contacts_email', 'option');
$contacts_linkedin = get_field('contacts_linkedin', 'option');
?>

<footer id="colophon" class="footer pre-footer-corporate bg-gray-dark">
    <div class="container">
        <div class="row justify-content-md-center row-30 row-md-50">
            <?php if ($form_id || $form_title): ?>
                <div class="col-md-11 col-lg-10 col-xl-6">
                    <?= ($form_title) ? '<h6>' . $form_title . '</h6>' : ''; ?>
                    <?php if ($form_id): ?>
                        <div class="footer__form ureka-form">
                            <script charset="utf-8" type="text/javascript"
                                    src="//js-eu1.hsforms.net/forms/embed/v2.js"></script>
                            <script>
                                hbspt.forms.create({
                                    portalId: "143438972",
                                    formId: "<?= $form_id; ?>",
                                    cssClass: "hubspot-form",
                                });
                            </script>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="col-md-11 col-lg-10 col-xl-6">
                <?php if ($footer_contacts_title || $contacts_address || $contacts_phone || $contacts_email): ?>
                    <div class="footer__contacts">
                        <?php if ($footer_contacts_title): ?>
                            <h6><?= $footer_contacts_title ?></h6>
                        <?php endif; ?>
                        <ul>
                            <?php if ($contacts_address): ?>
                                <li>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                    <span><?= $contacts_address ?></span>
                                </li>
                            <?php endif; ?>
                            <?php if ($contacts_phone): ?>
                                <li>
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                    <a href="tel:<?= $contacts_phone ?>"><?= $contacts_phone ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if ($contacts_email): ?>
                                <li>
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                    <a href="mailto:<?= $contacts_email ?>"><?= $contacts_email ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if ($contacts_linkedin): ?>
                                <li>
                                    <i class="fa fa-linkedin-square" aria-hidden="true"></i>
                                    <a href="<?= $contacts_linkedin;?>" target="_blank">LinkedIn</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="footer__copyright"><p>© Copyright Ureka LLC <?= date('Y'); ?></p></div>
    </div>
</footer>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
