
<!DOCTYPE html>
<html lang="en">


<div class="topbar">
    <div class="topbar-header">
        <?php
        require_once __DIR__.'/../../../src/common/constants/Role.php';

        if (!isset($_SESSION["authenticated"])) {
            $topbarAboutUrl = "/";
        } elseif ($_SESSION["roleId"] == Role::ROLE_USER) {
            $topbarAboutUrl = "/userDashboard";
        } elseif ($_SESSION["roleId"] == Role::ROLE_EMPLOYEE || $_SESSION["roleId"] == Role::ROLE_ADMIN) {
            $disabledClass = "disabled";
        }

        ?>
        <div class="top-nav">
            <ul>
                <li class="<?= $disabledClass ?? '' ?>">
                    <?php if (isset($topbarAboutUrl)): ?>
                        <a href="<?= $topbarAboutUrl ?>">About</a>
                    <?php else: ?>
                        <a>About</a>
                    <?php endif; ?>
                </li>
                <li class="<?= $disabledClass ?? '' ?>">
                    <?php if (isset($topbarAboutUrl)): ?>
                        <a href="contact">Contact</a>
                    <?php else: ?>
                        <a>Contact</a>
                    <?php endif; ?>
                </li>
                <li class="<?= $disabledClass ?? '' ?>">
                    <?php if (isset($topbarAboutUrl)): ?>
                        <a href="contact">Help</a>
                    <?php else: ?>
                        <a>Help</a>
                    <?php endif; ?>
                </li>
                <li class="<?= $disabledClass ?? '' ?>">
                    <?php if (isset($topbarAboutUrl)): ?>
                        <a href="contact">FAQs</a>
                    <?php else: ?>
                        <a>FAQs</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
        <div class="account-nav">
            <div class="dropdown" onclick="openButton('account')">
                <button class="dropbtn">My Account
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="account">
                    <?php
                        if (isset($_SESSION["authenticated"])) {
                            echo '
                                    <a id="myaccount">My Account</a>
                                    <a href="logout">Logout</a>';
                        } else {
                            echo '
                                    <a href="login">Sign in</a>
                                    <a href="register">Sign up</a>';
                        }
                    ?>
                </div>
            </div>
            <div class="dropdown" onclick="openButton('currency')" >
                <button id="dropdown-currency" class="dropbtn" disabled>USD
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="currency">
                    <a>PLN</a>
                    <a>EUR</a>
                </div>
            </div>
            <div class="dropdown" onclick="openButton('language')" >
                <button id="dropdown-language" class="dropbtn" disabled>EN
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="language">
                    <a>PL</a>
                </div>
            </div>
        </div>
    </div>
</div>