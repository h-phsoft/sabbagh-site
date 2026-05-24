<?php

/*
 * cPhsRest::addRoute($path, $page, $method = self::METHOD_POST, $needAuthentication = true);
 * addFullRoute($path, $page, $needAuthentication = true)
 */
/* Authentication */
cPhsRest::addRoute('Authentication', 'cpy/Authentication/Login', cPhsRest::METHOD_POST, false);
cPhsRest::addRoute('Authentication', 'cpy/Authentication/Logout', cPhsRest::METHOD_DELETE);
/* Check Warranty */
cPhsRest::addRoute('CheckWarranty', 'cpy/Ecom/Sales/CheckWarranty', cPhsRest::METHOD_GET, false);
cPhsRest::addRoute('Ticket', 'cpy/Ecom/Ticket/addTicket', cPhsRest::METHOD_POST, false);
/* Site */
cPhsRest::addRoute('Categories', 'cpy/Ecom/Cat/CatList', cPhsRest::METHOD_OPTIONS, false);
cPhsRest::addRoute('Products', 'cpy/Ecom/Product/ProductList', cPhsRest::METHOD_OPTIONS, false);
/* User */
cPhsRest::addRoute('User/ResetPassword', 'cpy/Copy/User/ResetPassword');
cPhsRest::addRoute('User/ResetPwdCode', 'cpy/Copy/User/ResetPasswordCode');
cPhsRest::addRoute('User/ChangePassword', 'cpy/Copy/User/ChangePassword');
cPhsRest::addRoute('User/ChangeLanguage', 'cpy/Copy/User/ChangeLanguage');
cPhsRest::addFullRoute('PGrp', 'cpy/Copy/PGrp');
cPhsRest::addRoute('PGrp/Perms', 'cpy/Copy/PGrp/UpdatePermissions');
cPhsRest::addFullRoute('User', 'cpy/Copy/User');
cPhsRest::addFullRoute('Branch', 'cpy/Copy/Branch');

/* ECom */
cPhsRest::addRoute('Dashboard/BrandSales', 'cpy/Ecom/Dashboard/SalesByBrand', cPhsRest::METHOD_OPTIONS);
cPhsRest::addRoute('Dashboard/CategorySales', 'cpy/Ecom/Dashboard/SalesByCategory', cPhsRest::METHOD_OPTIONS);
cPhsRest::addRoute('Dashboard/BranchSales', 'cpy/Ecom/Dashboard/SalesByBranch', cPhsRest::METHOD_OPTIONS);
cPhsRest::addRoute('Dashboard/UserSales', 'cpy/Ecom/Dashboard/SalesByUser', cPhsRest::METHOD_OPTIONS);
cPhsRest::addRoute('Dashboard/ProductSales', 'cpy/Ecom/Dashboard/SalesByProducts', cPhsRest::METHOD_OPTIONS);
cPhsRest::addRoute('Dashboard/BrandTickets', 'cpy/Ecom/Dashboard/TicketsByBrand', cPhsRest::METHOD_OPTIONS);
cPhsRest::addRoute('Dashboard/CategoryTickets', 'cpy/Ecom/Dashboard/TicketsByCategory', cPhsRest::METHOD_OPTIONS);
cPhsRest::addRoute('Dashboard/BranchTickets', 'cpy/Ecom/Dashboard/TicketsByBranch', cPhsRest::METHOD_OPTIONS);
//
cPhsRest::addFullRoute('About', 'cpy/Ecom/About');
cPhsRest::addFullRoute('Adv', 'cpy/Ecom/Adv');
cPhsRest::addFullRoute('FAQ', 'cpy/Ecom/Faq');
cPhsRest::addFullRoute('Tag', 'cpy/Ecom/Tag');
cPhsRest::addFullRoute('Service', 'cpy/Ecom/Service');
cPhsRest::addFullRoute('Category', 'cpy/Ecom/Cat');
cPhsRest::addFullRoute('Banner', 'cpy/Ecom/Banner');
cPhsRest::addFullRoute('Brand', 'cpy/Ecom/Brand');
cPhsRest::addFullRoute('Product', 'cpy/Ecom/Product');
cPhsRest::addFullRoute('ProductImages', 'cpy/Ecom/ProdImage');
cPhsRest::addFullRoute('ProductSizes', 'cpy/Ecom/ProdSize');
cPhsRest::addFullRoute('ProductFacts', 'cpy/Ecom/ProdFacts');
//cPhsRest::addRoute('Products', 'cpy/Ecom/Product/Products', cPhsRest::METHOD_OPTIONS);
cPhsRest::addRoute('Product/Autocomplete', 'cpy/Ecom/Product/Autocomplete');
cPhsRest::addFullRoute('Serials', 'cpy/Ecom/ProdSerial');
cPhsRest::addRoute('Serials/Import', 'cpy/Ecom/ProdSerial/Import');
cPhsRest::addRoute('Serial/Autocomplete', 'cpy/Ecom/ProdSerial/Autocomplete');
cPhsRest::addFullRoute('Orders', 'cpy/Ecom/Orders');
cPhsRest::addFullRoute('Sales', 'cpy/Ecom/Sales');
cPhsRest::addFullRoute('Tickets', 'cpy/Ecom/Ticket');
cPhsRest::addFullRoute('Customers', 'cpy/Ecom/Customers');
cPhsRest::addRoute('Customers/ResetPassword', 'cpy/Ecom/Customers/ResetPassword');
//
