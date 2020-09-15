<?php

require_once "composants/header_options.php";
require_once "composants/footer_options.php";


$request = $_SERVER['REQUEST_URI'];
switch ($request) {
    case '':
    case '/' :
        header_options(["style", "nav", "button", "card"]);
        require 'views/home.php';
        footer_options(["lottie", "navBtn"]);
        break;
    case '/cours' :
        header_options(["style", "nav", "button", "card","cardCours"]);
        require 'views/courses.php';
        footer_options(["lottie", "navBtn", "fonction"]);
        break;
    case '/donner-cours' :
        header_options(["style", "nav", "button", "formCours"]);
        require 'views/createCourses.php';
        footer_options(["lottie", "navBtn", "fonction"]);
        break;
    case '/suggestion-cours' :
        header_options(["style", "nav", "button", "formCours"]);
        require 'views/askForCourses.php';
        footer_options(["lottie", "navBtn", "fonction"]);
        break;
    case '/suggestion-liste':
        header_options(["style", "nav", "button", "card","cardCours"]);
        require 'views/listSuggestions.php';
        footer_options(["lottie","navBtn","fonction"]);
        break;
    case '/tuteur-cours':
        header_options(["style", "nav", "button", "card", "formAdminCours"]);
        require 'views/adminCours.php';
        footer_options(["lottie","navBtn","fonction"]);
        break;
    case '/about' :
        header_options(["style", "nav", "button"]);
        require 'views/about.php';
        break;
    case '/forum' :
        header_options(["style", "nav", "button", "card", "cardForum"]);
        require 'views/forum.php';
        footer_options(["lottie", "navBtn", "fonction"]);
        break;
    case '/admin' :
        header_options(["style", "nav", "button", "card", "formAdmin"]);
        require 'views/panel_admin.php';
        footer_options(["jquery", "panel_admin", "lottie","navBtn","fonction"]);
        break;
    case '/forum/create' :
        header_options(["style", "forum", "nav", "button"]);
        require 'views/forum_create.php';
        footer_options(["lottie", "navBtn", "fonction"]);
        break;
    case (preg_match('/\/forum\/./', $request) ? true : false) :
        header_options(["style", "nav", "button", "card", "cardSujetForum", "modal"]);
        require 'views/forum_question.php';
        footer_options(["lottie", "navBtn", "fonction", "forum"]);
        break;
    default:
        header_options(["style", "404", "nav", "button"]);
        http_response_code(404);
        require 'views/404.php';
        break;
}
