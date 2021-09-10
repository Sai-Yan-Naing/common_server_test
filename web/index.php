<?php   
$url = $_SERVER['REQUEST_URI'];
$request = parse_url($url);
switch ($request['path']) {
    case '/' : include 'views/login.php';break;
    case '/login' : include 'views/login.php';break;
    case '/admin' : include 'views/admin/index.php';break;
    case '/admin/contactus' : include 'views/admin/contactus.php';break;
    case '/admin/domain-transfer' : include 'views/admin/domain_transfer.php';break;
    case '/admin/add-server' : include 'views/admin/add_server.php';break;
    case '/admin/dns' : include 'views/admin/dns.php';break;

    // admin share
    case '/admin/share/server' : include 'views/admin/share/server/index.php'; break;
    case '/admin/share/mail' : include 'views/admin/share/mail/index.php'; break;
    case '/admin/share/various' : include 'views/admin/share/various/index.php'; break;
    case '/admin/share/contactus' : include 'views/admin/share/contactus/index.php'; break;

    // admin vps
    case '/admin/vps/server' : include 'views/admin/vps/server/index.php'; break;
    case '/admin/vps/various' : include 'views/admin/vps/various/index.php'; break;
    case '/admin/vps/contactus' : include 'views/admin/vps/contactus/index.php'; break;
    // case '/admin/share/mail' : include 'views/admin/share/mail/index.php'; break;
    // case '/admin/share/various' : include 'views/admin/share/various/index.php'; break;
    // case '/admin/share/contactus' : include 'views/admin/share/contactus/index.php'; break;

    //default
    default: http_response_code(404); include'views/404.php'; break;
}