<?php
function route($page, $type)
{
    if (isset($_GET['page']) && $_GET['page'] === $page && isset($_GET['type']) && $_GET['type'] === $type) {
        return true;
    }
}


$dashboard = route("dashboard", "view");
$inventory = route("inventory", "view");
$inventory_add = route("inventory", "add");
$sales = route("sales", "view");
$clients = route("clients", "view");
$add_products = route("inventory", "add");
$category_add = route("category", "add");
$del_product = route("inventory", "delete");
$edit_product = route("inventory", "edit");
$website_settings = route("website_settings", "view");
$inventory_more = route("inventory", "view_more");
$category = route("category", "view");
$invoice = route("invoices", "view");
$invoice_gen = route("invoices", "add");
$del_invoice = route("invoices", "delete");
$invoice_more = route("invoices", "view_more");
$category_edit = route("category", "edit");
$social_links = route("website", "social_links");
$factory_page = route("website", "factory_page");
$contact_page = route("website", "contact_page");
$projects_page = route("website", "projects_page");
$products = route("website", "products_page");
$slider = route("website", "slider");
$config = route("website", "website");
$contact_responses = route("contact_responses", "view");
$del_resp_c = route("contact_reponses", "delete");
$about_page = route("website", "about_page");
$home_page = route("website", "home_page");
$gen_inv = route("invoice", "gen");
$view_invoices = route("invoice", "view");
$delete_invoice  = route("invoices", "del");
$select_product_to_gen_inv = route("invoice", "select");
$manage_acc = route("manage_acc", "view");
$invoice_for_selected = route("invoice", "gen_selected");
$sales_page = route("sales", "view");
$edit_users = route("manage_acc", "edit");
$notification_settings = route("notifications", "settings");
$del_category = route("category", "delete");
