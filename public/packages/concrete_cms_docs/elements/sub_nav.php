<?php

/**
 * @project:   ConcreteCMS Docs
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Page\Page;
use Concrete\Core\Support\Facade\Url;
use Concrete\Core\User\User;
use Concrete\Core\Validation\CSRF\Token;
use Concrete\Core\Support\Facade\Application;

$c = Page::getCurrentPage();
$user = new User();
$app = Application::getFacadeApplication();
/** @var Token $token */
$token = $app->make(Token::class);
?>

<div id="ccm-sub-nav">
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>
                    <?php echo t("Documentation"); ?>
                </h3>

                <nav>
                    <ul>
                        <li class="<?php echo strpos($c->getCollectionPath(), "/user-guide") !== false ? "active" : "";?>">
                            <a href="<?php echo (string)Url::to("/user-guide");?>">
                                <?php echo t("User Guide"); ?>
                            </a>
                        </li>

                        <li class="<?php echo strpos($c->getCollectionPath(), "/developers") !== false ? "active" : "";?>">
                            <a href="<?php echo (string)Url::to("/developers");?>">
                                <?php echo t("Developers"); ?>
                            </a>
                        </li>

                        <li class="<?php echo strpos($c->getCollectionPath(), "/videos") !== false ? "active" : "";?>">
                            <a href="<?php echo (string)Url::to("/videos");?>">
                                <?php echo t("Videos"); ?>
                            </a>
                        </li>

                        <li class="<?php echo strpos($c->getCollectionPath(), "/tutorials") !== false ? "active" : "";?>">
                            <a href="<?php echo (string)Url::to("/tutorials");?>">
                                <?php echo t("Tutorials"); ?>
                            </a>
                        </li>

                        <li class="<?php echo strpos($c->getCollectionPath(), "/contribute") !== false ? "active" : "";?>">
                            <a href="<?php echo (string)Url::to("/contribute");?>">
                                <?php echo t("Contribute"); ?>
                            </a>
                        </li>

                        <?php if ($user->isRegistered()) { ?>
                            <li class="<?php echo strpos($c->getCollectionPath(), "/contributions") !== false ? "active" : "";?>">
                                <a href="<?php echo (string)Url::to("/contributions");?>">
                                    <?php echo t("Your Contributions"); ?>
                                </a>
                            </li>

                            <li>
                                <a href="<?php echo (string)Url::to('/login', 'do_logout', $token->generate('do_logout')); ?>">
                                    <?php echo t("Sign Out"); ?>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a href="<?php echo (string)Url::to('/login') ?>">
                                    <?php echo t("Sign In"); ?>
                                </a>
                            </li>
                        <?php } ?>

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>