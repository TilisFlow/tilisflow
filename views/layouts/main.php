<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.png')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?> | TilisFlow</title>
    <?php $this->head() ?>
</head>
<body class="h-100">
<?php $this->beginBody() ?>



<style>
    #navbarStacked_1 .nav_underline_1 {
        --bs-nav-link-color: rgba(var(--bs-body-color-rgb), .75);
        --bs-nav-link-hover-color: var(--bs-body-color);
        --bs-nav-link-disabled-color: rgba(var(--bs-body-color-rgb), .5);
        --bs-nav-underline-border-width: 3px;
        --bs-nav-underline-link-active-color: var(--bs-body-color);

        /* Border of active color */
        .nav-link.active {
            border-color: var(--bs-primary);
        }
    }

</style>
<?= $this->render('_partials/navigation')?>

<section>
        <!-- Content -->
        <div class="row h-75">
            <div class="col-12">
                <main id="main" class="flex-shrink-0" role="main">
                        <?php if (!empty($this->params['breadcrumbs'])): ?>
                            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
                        <?php endif ?>
                        <?= Alert::widget() ?>
                        <?= $content ?>
                </main>
            </div>
    </div>
</section>

<script>
    window.addEventListener('load', function() {
        // Bootstrap is loaded and available

        // Initialize Bootstrap tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Initialize Bootstrap popovers
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
    });
</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
