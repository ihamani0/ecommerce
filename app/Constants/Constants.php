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
    /*****************Products Route****************/
    /*********************************************/
    public const Admin_Products_INDEX = "admin.products.index";
    public const Admin_Products_ADD = "admin.products.add";
    public const Admin_Products_EDIT = "admin.products.edit";
    public const Admin_Products_STORE = "admin.products.store";
    public const Admin_Products_UPDATE = "admin.products.update";
    public const Admin_Products_DESTORY = "admin.products.destroy";
    public const Admin_Products_UPDATE_Img = "admin.products.update.img";
    public const Admin_Products_UPDATE_MultiImg = "admin.products.update.MultiImg";
    public const Admin_Products_Add_MultiImg = "admin.products.add.MultiImg";
    public const Admin_Products_DESTORY_MultiImg = "admin.products.destroy.MultiImg";
    public const  Admin_Products_Status  = "admin.products.status";
    /*****************************************************/
    /*****************Vendor Status Route****************/
    /*********************************************/
    public const Admin_Vendor_StatusActive_INDEX = "admin.vendor.status.active.index";
    public const Admin_Vendor_StatusInActive_INDEX = "admin.vendor.status.inactive.index";
    public const Admin_Active_Vendor= "admin.status.vendor.active";
    public const Admin_InActive_Vendor = "admin.status.vendor.Inactive";
    /*****************************************************/
    /*****************Slide Route****************/
    /*********************************************/
    public const Admin_Slide_INDEX = "admin.slide.index";
    public const Admin_Slide_ADD = "admin.slide.add";
    public const Admin_Slide_EDIT = "admin.slide.edit";
    public const Admin_Slide_STORE = "admin.slide.store";
    public const Admin_Slide_UPDATE = "admin.slide.update";
    public const Admin_Slide_DESTORY = "admin.slide.destroy";
    /*****************************************************/
    /*****************Banner Route****************/
    /*********************************************/
    public const Admin_Banner_INDEX = "admin.banner.index";
    public const Admin_Banner_ADD = "admin.banner.add";
    public const Admin_Banner_EDIT = "admin.banner.edit";
    public const Admin_Banner_STORE = "admin.banner.store";
    public const Admin_Banner_UPDATE = "admin.banner.update";
    public const Admin_Banner_DESTORY = "admin.banner.destroy";
    /*****************************************************/
    /*********************************************/





    /*********************************************/
    /********** Route Vendors **********************************************************************************************************/
    /*********************************************/
    public const VENDOR_DASHBOARD = 'vendor.dashboard';
    /*********************************************/
    /****************** Profile ***************/
    public const VENDOR_PROFILE_INDEX = 'vendor.profile.index';
    /*********************************************/
    /****************** Auth ***************/
    //Register
    public const VENDOR_REGISTER = 'vendor.register';
    public const VENDOR_REGISTER_STORE = "vendor.register.store";

    //login
    public const VENDOR_LOGIN = 'vendor.login';
    public const VENDOR_LOGIN_STORE = "vendor.login.store";

    /*****************************************************/
    /*****************Products Route****************/
    /*********************************************/
    public const Vendor_Products_INDEX = "vendor.products.index";
    public const Vendor_Products_ADD = "vendor.products.add";
    public const Vendor_Products_EDIT = "vendor.products.edit";
    public const Vendor_Products_STORE = "vendor.products.store";
    public const Vendor_Products_UPDATE = "vendor.products.update";
    public const Vendor_Products_DESTORY = "vendor.products.destroy";
    public const Vendor_Products_UPDATE_Img = "vendor.products.update.img";
    public const Vendor_Products_UPDATE_MultiImg = "vendor.products.update.MultiImg";
    public const Vendor_Products_Add_MultiImg = "vendor.products.add.MultiImg";
    public const Vendor_Products_DESTORY_MultiImg = "vendor.products.destroy.MultiImg";
    public const Vendor_Products_Status  = "vendor.products.status";



}
