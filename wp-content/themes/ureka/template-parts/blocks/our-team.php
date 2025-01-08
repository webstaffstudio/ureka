<?php
/**
 * Block Name: Our Team
 * Description: Showcase your team members with photos, names, and roles.
 * Icon: groups
 * Keywords: team, staff, members, people, group
 * Supports: { "align": ["wide", "full"], "anchor": true }
 */
?>
<?php
$team_title = get_field('our_team_title');
$team_members = get_field('team');
$team_grid = get_field('team_grid');
$grid_class = get_bootstrap_grid_class($team_grid);
?>

<?php if ($team_members): ?>
    <section class="our-team section-md bg-default text-center">
        <div class="container">
            <?php if ($team_title): ?>
                <h4 class="heading-decorated"><?= $team_title; ?></h4>
            <?php endif; ?>
            <div class="row row-70 offset-top-1">
                <div class="our-team__wrapper <?=$team_grid;?>">
                    <div class="row">
                        <?php foreach ($team_members as $member): ?>
                            <?php
                            $photo_id = $member['our_team_photo'];
                            $name = $member['our_team_name'];
                            $position = $member['our_team_position'];
                            $email = $member['our_team_email'];
                            $phone = $member['our_team_phone'];
                            $about = $member['about_team_member'];
                            ?>
                            <div class="our-team__wrapper-item <?= esc_attr($grid_class); ?>">
                                <article class="thumb-flat">
                                    <?php if ($photo_id): ?>
                                        <?= get_image_html($photo_id, 'large', 'thumb-flat__image', $name); ?>
                                    <?php endif; ?>
                                    <div class="thumb-flat__body">
                                        <?php if ($name): ?>
                                            <p class="heading-6"><?= $name; ?></p>
                                        <?php endif; ?>
                                        <?php if ($position): ?>
                                            <p class="thumb-flat__subtitle"><?= $position; ?></p>
                                        <?php endif; ?>
                                        <div class="our-team__phone-email">
                                            <?php if ($email): ?>
                                                <p class="our-team-email"><i class="fa fa-envelope"></i><a
                                                            href="mailto:<?= $email; ?>"><?= $email; ?></a></p>
                                            <?php endif; ?>
                                            <?php if ($phone): ?>
                                                <p class="our-team-phone"><i class="fa fa-phone"></i><a
                                                            href="tel:<?= $phone; ?>"><?= $phone; ?></a></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($about): ?>
                                            <p><?= $about; ?></p>
                                        <?php endif; ?>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

