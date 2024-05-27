<?php

namespace App\Constants;

class  Constants {

    //Welcome MAin PAGE
    public const WELCOME = "welcome";

    //------------Route----------------
    /*

    /********** Routes User **********************************************************************************************************/
    /***********************************************/
            //login
            public const USER_LOGIN = "user.login" ;
            public const USER_LOGIN_STORE = "login.store";
            //register
            public const USER_Register = "user.register" ;
            public const USER_Register_STORE = "user.register.store" ;

            //logout
            public const USER_LOGOUT = "user.logout" ;


            //Profile User
            public const USER_ACCOUNT = "user.account";
            public const USER_ACCOUNT_UPDATE  = "user.account.update";
            public const USER_ACCOUNT_DELETE = "user.account.delete";



    /*********************************************/
    /********** Route Admins **********************************************************************************************************/

    public const Admin_DASHBOARD = "admin.dashboard";

    /*********************************************/
    /*****************Brand Route****************/
    /*********************************************/
    public const Admin_BRAND_INDEX = "admin.brand.index";
    public const Admin_BRAND_ADD = "admin.brand.add";
    public const Admin_BRAND_EDIT = "admin.brand.edit";
    public const Admin_BRAND_STORE = "admin.brand.store";
    public const Admin_BRAND_UPDATE = "admin.brand.update";
    public const Admin_BRAND_DESTORY = "admin.brand.destroy";
    /*****************************************************/
    /*****************Category Route****************/
    /*********************************************/
    public const Admin_Category_INDEX = "admin.category.index";
    public const Admin_Category_ADD = "admin.category.add";
    public const Admin_Category_EDIT = "admin.category.edit";
    public const Admin_Category_STORE = "admin.category.store";
    public const Admin_Category_UPDATE = "admin.category.update";
    public const Admin_Category_DESTORY = "admin.category.destroy";
    /*****************************************************/
    /*****************SubCategory Route****************/
    /*********************************************/
    public const Admin_SubCategory_INDEX = "admin.subcategory.index";
    public const Admin_SubCategory_ADD = "admin.subcategory.add";
    public const Admin_SubCategory_EDIT = "admin.subcategory.edit";
    public const Admin_SubCategory_STORE = "admin.subcategory.store";
    public const Admin_SubCategory_UPDATE = "admin.subcategory.update";
    public const Admin_SubCategory_DESTORY = "admin.subcategory.destroy";
    /*****************************************************/
    /*****************Vendor Status Route****************/
    /*********************************************/
    public const Admin_Vendor_StatusActive_INDEX = "admin.vendor.status.active.index";
    public const Admin_Vendor_StatusInActive_INDEX = "admin.vendor.status.inactive.index";

    /*****************************************************/







    /*********************************************/
    /********** Route Vendors **********************************************************************************************************/
    /*********************************************/

    public const VENDOR_DASHBOARD = 'vendor.dashboard';

    /****************** Profile ***************/
    public const VENDOR_PROFILE_INDEX = 'vendor.profile.index';

    /****************** Auth ***************/
    //Register
    public const VENDOR_REGISTER = 'vendor.register';
    public const VENDOR_REGISTER_STORE = "vendor.register.store";

    //login
    public const VENDOR_LOGIN = 'vendor.login';
    public const VENDOR_LOGIN_STORE = "vendor.login.store";



}
