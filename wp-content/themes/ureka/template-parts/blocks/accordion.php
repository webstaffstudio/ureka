<?php
/**
 * Block Name: Accordion
 * Description: A customizable accordion block for displaying collapsible content sections.
 * Icon: list-view
 * Keywords: accordion, toggle, collapse, content
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */
?>
<?php
$title = get_field('acc_title');
$accordion = get_field('accordion');

if ($accordion): ?>
    <section class="accordion-block section-md bg-default">
        <div class="container">
            <div id="accordion" role="tablist">
                <?php foreach ($accordion as $index => $item):
                    $icon = $item['icon'];
                    $title = $item['title'];
                    $text = $item['text'];
                    $label = $item['label'];

                    if (strpos($icon, 'lnr-') === 0) {
                        $icon = substr($icon, 4);
                    }
                    ?>
                    <div class="card card-custom">
                        <div class="card-custom-heading" id="accordionHeading<?= $index; ?>" role="tab">
                            <h5 class="card-custom-title">
                                <a class="collapsed" role="button" data-bs-toggle="collapse" data-bs-parent="#accordion"
                                   href="#accordionCollapse<?= $index; ?>"
                                   aria-controls="accordionCollapse<?= $index; ?>">
                                    <?= ($icon) ? '<span class="icon linear-icon-' . $icon . '"></span>' : ''; ?>
                                    <?= ($title) ? '<span class="card-title">' . $title . '</span>' : ''; ?>
                                    <?= ($label) ? '<span class="card-label">' . $label . '</span>' : ''; ?>
                                </a>
                            </h5>
                        </div>
                        <div class="card-custom-collapse collapse" id="accordionCollapse<?= $index; ?>"
                             data-bs-parent="#accordion" role="tabpanel"
                             aria-labelledby="accordionHeading<?= $index; ?>">
                            <div class="card-custom-body">
                                <?= ($text) ??  ''; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

