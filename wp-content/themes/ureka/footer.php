</div><!-- #content -->
<?php
$fields = get_fields('options');

$form_title = $fields['footer_form_title'] ?? '';
$form_id = $fields['footer_form_id'] ?? '';
$portal_id = $fields['footer_portal_id'] ?? '';
$footer_contacts_title = $fields['footer_contacts_title'] ?? '';
$contacts_address = $fields['contacts_address'] ?? '';
$contacts_phone = $fields['contacts_phone'] ?? '';
$contacts_email = $fields['contacts_email'] ?? '';
$contacts_linkedin = $fields['contacts_linkedin'] ?? '';
$cta_title = $fields['cta_title'] ?? '';
$cta_text = $fields['cta_text'] ?? '';
$cta_button = $fields['cta_button'] ?? '';
$cta_email_subject = $fields['cta_email_subject'] ?? '';
$page_disable_cta = get_field('call_to_action_disable', get_queried_object_id());


if ($cta_button && strpos($cta_button['url'], 'mailto:') === 0) {
    $cta_button_url = $cta_button['url'] . '?subject=' . rawurlencode($cta_email_subject);
} else {
    $cta_button_url = $cta_button['url'] ?? '';
}
?>
<?php
if (!$page_disable_cta):
    if ($cta_title || $cta_text || $cta_button):

        ?>
        <section class="cta">
            <div class="container">
                <div class="cta__wrapper">
                    <?= ($cta_title) ? '<h3 class="cta__wrapper-title">' . $cta_title . '</h3>' : ''; ?>
                    <?= ($cta_text) ? '<p class="cta__wrapper-text">' . $cta_text . '</p>' : ''; ?>
                    <?= ($cta_button) ? '<a href="' . $cta_button_url . '" class="button button-primary">' . $cta_button['title'] . '</a>' : '';?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
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
                                    portalId: "<?= $portal_id;?>",
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
                                    <a href="<?= $contacts_linkedin; ?>" target="_blank">LinkedIn</a>
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
