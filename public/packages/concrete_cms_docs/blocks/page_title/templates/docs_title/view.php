<?php

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Localization\Service\Date;
use Concrete\Core\Page\Page;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Support\Facade\Url;
use Concrete\Core\User\UserInfo;
use Concrete\Core\User\UserInfoRepository;
use PortlandLabs\ConcreteCms\Documentation\Page\PageInspector;

$page = Page::getCurrentPage();
$app = Application::getFacadeApplication();
/** @var Date $dh */
$dh = $app->make(Date::class);
/** @var UserInfoRepository $userInfoRepository */
$userInfoRepository = $app->make(UserInfoRepository::class);
/** @noinspection PhpUnhandledExceptionInspection */
$date = $dh->formatDate($page->getCollectionDatePublic(), true);
$userInfo = $userInfoRepository->getByID($page->getCollectionUserID());

$inspector = new PageInspector($page);
?>
<div class="ccm-docs-title">
    <h1>
        <?php echo h($title) ?>
    </h1>

    <div class="page-date">
        <?php echo $date; ?>
    </div>

    <?php if ($userInfo instanceof UserInfo) { ?>
        <div class="page-author">
            <?php echo t("By %s", sprintf("<a href=\"#\">%s</a>", $userInfo->getUserDisplayName())); ?>
        </div>
    <?php } ?>

    <?php /*
    <div class="total-comments">
        <i class="far fa-comment"></i> <?php echo $inspector->getTotalComments() ?>
    </div>

    <div class="total-likes">
        <i class="far fa-heart"></i> <?php echo $inspector->getTotalLikes() ?>
    </div>
    */ ?>

    <?php if ($inspector->canEditInDocumentationComposer()) { ?>
        <div class="edit-page">
            <a href="<?php echo (string)Url::to("/contribute", "edit", $page->getCollectionID())?>">
                <?php echo t("Edit"); ?>
            </a>
        </div>
    <?php } ?>

    <div class="clearfix"></div>
</div>