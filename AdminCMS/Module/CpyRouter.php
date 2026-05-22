<?php

/*
 * cPhsRest::addRoute($path, $page, $method = self::METHOD_POST, $needAuthentication = true);
 * addFullRoute($path, $page, $needAuthentication = true)
 */
/* Authentication */
cPhsRest::addRoute('Authentication', 'cpy/Authentication/Login', cPhsRest::METHOD_POST, false);
cPhsRest::addRoute('Authentication', 'cpy/Authentication/Logout', cPhsRest::METHOD_DELETE);
/* Site */
cPhsRest::addRoute('InitSite', 'site/Site/InitSite', cPhsRest::METHOD_POST, false);
cPhsRest::addRoute('getSupplierBrand', 'site/Site/getSupplierBrand', cPhsRest::METHOD_POST, false);
cPhsRest::addRoute('Email', 'site/Ecom/Cont/contactForm', cPhsRest::METHOD_POST);
cPhsRest::addRoute('Categories', 'site/Ecom/Cat/CatList', cPhsRest::METHOD_OPTIONS);
cPhsRest::addRoute('Products', 'site/Ecom/Product/ProductList', cPhsRest::METHOD_OPTIONS);
cPhsRest::addRoute('Search', 'site/Ecom/Product/Search', cPhsRest::METHOD_OPTIONS);
cPhsRest::addRoute('GetProduct', 'site/Ecom/Product/GetProduct', cPhsRest::METHOD_GET);
cPhsRest::addRoute('AddToCart', 'site/Ecom/Cart/Add', cPhsRest::METHOD_POST);
cPhsRest::addRoute('UpdateCart', 'site/Ecom/Cart/Update', cPhsRest::METHOD_POST);
cPhsRest::addRoute('ClearCart', 'site/Ecom/Cart/Clear', cPhsRest::METHOD_POST);
cPhsRest::addRoute('DeleteCart', 'site/Ecom/Cart/Delete', cPhsRest::METHOD_POST);
cPhsRest::addRoute('Checkout', 'site/Ecom/Cart/Checkout', cPhsRest::METHOD_POST);
/* User */
cPhsRest::addRoute('User/ResetPassword', 'cpy/Copy/User/ResetPassword');
cPhsRest::addRoute('User/ResetPwdCode', 'cpy/Copy/User/ResetPasswordCode');
cPhsRest::addRoute('User/ChangePassword', 'cpy/Copy/User/ChangePassword');
cPhsRest::addRoute('User/ChangeLanguage', 'cpy/Copy/User/ChangeLanguage');
cPhsRest::addFullRoute('Logo', 'cpy/Copy/Logo');
cPhsRest::addFullRoute('PGrp', 'cpy/Copy/PGrp');
cPhsRest::addRoute('PGrp/Perms', 'cpy/Copy/PGrp/UpdatePermissions');
cPhsRest::addFullRoute('User', 'cpy/Copy/User');
cPhsRest::addFullRoute('Branch', 'cpy/Copy/Branch');
cPhsRest::addFullRoute('Language', 'cpy/Copy/Language');
/* ECom Queries */
cPhsRest::addRoute('Query/Orders', 'cpy/Ecom/Query/Orders', cPhsRest::METHOD_OPTIONS);
cPhsRest::addRoute('Query/Sales', 'cpy/Ecom/Query/Sales', cPhsRest::METHOD_OPTIONS);
/* ECom Dashboard */
cPhsRest::addRoute('Dashboard/Orders', 'cpy/Ecom/Dashboard/Orders', cPhsRest::METHOD_POST, false);
cPhsRest::addRoute('Dashboard/OrdersByBrand', 'cpy/Ecom/Dashboard/OrdersByBrand', cPhsRest::METHOD_POST);
cPhsRest::addRoute('Dashboard/OrdersByCategory', 'cpy/Ecom/Dashboard/OrdersByCategory', cPhsRest::METHOD_POST);
cPhsRest::addRoute('Dashboard/OrdersByTag', 'cpy/Ecom/Dashboard/OrdersByTag', cPhsRest::METHOD_POST);
cPhsRest::addRoute('Dashboard/OrdersByMonths', 'cpy/Ecom/Dashboard/OrdersByMonths', cPhsRest::METHOD_POST);
cPhsRest::addRoute('Dashboard/OrdersByWeekDays', 'cpy/Ecom/Dashboard/OrdersByWeekDays', cPhsRest::METHOD_POST);
cPhsRest::addRoute('Dashboard/OrdersByHours', 'cpy/Ecom/Dashboard/OrdersByHours', cPhsRest::METHOD_POST);
/* Dist CMS */
cPhsRest::addFullRoute('About', 'cpy/Dist/About');
cPhsRest::addFullRoute('Blog', 'cpy/Dist/Blog');
cPhsRest::addFullRoute('Categories', 'cpy/Dist/Categories');
cPhsRest::addFullRoute('Color', 'cpy/Dist/Color');
cPhsRest::addFullRoute('Country', 'cpy/Dist/Country');
cPhsRest::addFullRoute('Distination', 'cpy/Dist/Distination');
cPhsRest::addFullRoute('Gallery', 'cpy/Dist/Gallery');
cPhsRest::addFullRoute('Groups', 'cpy/Dist/Groups');
cPhsRest::addFullRoute('Team', 'cpy/Dist/Team');
cPhsRest::addFullRoute('Prefs', 'cpy/Dist/Prefs');
cPhsRest::addFullRoute('Products', 'cpy/Dist/Products');
cPhsRest::addFullRoute('Services', 'cpy/Dist/Services');
cPhsRest::addFullRoute('Slider', 'cpy/Dist/Slider');
cPhsRest::addFullRoute('Social', 'cpy/Dist/Social');
cPhsRest::addFullRoute('Suppliers', 'cpy/Dist/Suppliers');
cPhsRest::addFullRoute('Tag', 'cpy/Dist/Tag');
cPhsRest::addFullRoute('Testimonial', 'cpy/Dist/Testimonial');
cPhsRest::addFullRoute('Vpackages', 'cpy/Dist/Vpackages');
cPhsRest::addFullRoute('Vtags', 'cpy/Dist/Vtags');
cPhsRest::addFullRoute('Vtypes', 'cpy/Dist/Vtypes');
//
