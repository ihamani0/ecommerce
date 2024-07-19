<?php

namespace App\Constants;

class  Constants {

    /********App**********************************************************************************/
    public const CreatedApp = "2024";

    //******** Route *********************************************************************************/
    /********Web PAGe Route**********************************************************************************/
    public const WELCOME = "web.welcome";
    public const WEB_Products_Details = "web.product.details";
    public const WEB_Vendor_Details = "web.vendor.details";
    public const WEB_All_Vendors = "web.all.vendors";
    public const WEB_Products_By_Category = "web.product.by.category";
    public const WEB_Products_By_Subcategory = "web.product.by.subcategory";
    /********Cart shop Route**********************************************************************************/
    public const CART_INDEX = "web.cart.index" ;
    public const ADD_TO_CART = "api.add.to.cart";
    public const GET_CART = "api.get.cart";
    public const  REMOVE_FROM_CART = "api.remove.from.cart";


    /*********************Route******************************************************************************************
    /******************************************************************************************/
    /********** Routes User **********************************************************************************************************/
    /********************************************************************************************/
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
            public const USER_ACCOUNT_DASHBOARD = "user.account.dashboard";
            public const USER_ACCOUNT_Orders = "user.account.orders.index ";
            public const USER_ACCOUNT_Orders_Return = "user.account.orders.return ";
            public const USER_ACCOUNT_INDEX_Return_Orders = "user.account.index.return.orders";
            public const USER_ACCOUNT_Track_Orders = "user.account.track.orders.index";
            public const USER_ACCOUNT_ADDRESS_DETAILS = "user.account.address.index";
            public const USER_ACCOUNT_CHANGE_PASSWORD = "user.account.change.password";
            public const DOWNLOAD_INVOICE = "user.create.invoice";


    public const USER_ACCOUNT_UPDATE_INDEX = "user.account.index.update";
            public const USER_ACCOUNT_UPDATE  = "user.account.update";

            public const USER_ACCOUNT_DELETE_INDEX = "user.account.index.delete";
            public const USER_ACCOUNT_DELETE = "user.account.delete";


            //wishList
            public const USER_WISH_LIST = 'user.wish.list' ;
            public const USER_WISHLIST_DESTROY_PRODUCT = 'user.wish.list.destroy.product' ;
            public const  USER_COMPARE_LIST = "user.compare.list";
            public const  USER_COMPARE_DESTROY_PRODUCT = "user.compare.destroy.product";

            //checkout
            public const USER_INDEX_CHECKOUT_CART= "user.checkout.index";
            public const USER_STORE_CHECKOUT_CART= "user.checkout.store";

            //payment
            public const CASH_PAYMENT_INDEX= "user.cashOnDelivery.index";
            public const CASH_PAYMENT_STORE= "user.cashOnDelivery.store";

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
    /*****************Coupons Route****************/
    /*********************************************/
    public const Admin_Coupon_INDEX = "admin.coupon.index";
    public const Admin_Coupon_ADD = "admin.coupon.add";
    public const Admin_Coupon_EDIT = "admin.coupon.edit";
    public const Admin_Coupon_STORE = "admin.coupon.store";
    public const Admin_Coupon_UPDATE = "admin.coupon.update";
    public const Admin_Coupon_DESTORY = "admin.coupon.destroy";
    public const Admin_Coupon_STATUS = "admin.coupon.status";
    /*****************************************************/
    public const Admin_Order_INDEX = "admin.order.index";
    public const Admin_Order_Return_INDEX = "admin.order.return.index";
    public const Admin_Order_VIEW = "admin.order.view";
    public const Admin_Order_Change_Status = "admin.order.change.status";
    /*****************************************************/
    public const Admin_Report_Index = "admin.report.index";
    public const Admin_Report_SearchByDate = "admin.report.search.by.date";
    public const Admin_Report_SearchByWeek = "admin.report.search.by.week";
    public const Admin_Report_SearchByMonth = "admin.report.search.by.month";
    public const Admin_Report_SearchByYear = "admin.report.search.by.year";
    /*********************************************/
    public const Admin_Register_Users = "admin.register.users";
    public const Admin_Register_Vendor = "admin.register.vendor";
    /*********************************************/
    public const Admin_Review_List = "admin.review.list";
    public const Admin_Review_Approve = "admin.review.approve";
    /*********************************************/
    /*********************************************/
    public const Admin_Setting_Index = "admin.setting.index";
    public const Admin_Setting_Add = "admin.setting.add";
    public const Admin_Setting_Store = "admin.setting.store";
    public const Admin_Setting_Edite = "admin.setting.edite";
    public const Admin_Setting_Update = "admin.setting.update";
    public const Admin_Setting_Delete = "admin.setting.delete";
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
    /*****************************************************/
    public const Vendor_ORDER_INDEX = "vendor.order.index";
    public const Vendor_ORDER_VIEW = "vendor.order.view";
    public const Vendor_ORDER_RETURN = "vendor.order.return";
    public const Vendor_Order_Change_Status  = "vendor.order.change.status";
    /*****************************************************/

    public const Vendor_Review_List = "vendor.review.list";
    public const Vendor_Review_Approve = "vendor.review.approve";

}
