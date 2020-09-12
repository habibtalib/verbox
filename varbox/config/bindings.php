<?php

/*
| ------------------------------------------------------------------------------------------------------------------
| Class Bindings
| ------------------------------------------------------------------------------------------------------------------
|
| FQNs of the classes used by the Varbox platform internally to achieve different functionalities.
| Each of these classes represents a concrete implementation that is bound to the Laravel's IoC container.
|
| If you need to extend or modify a functionality, you can swap the implementation below with your own class.
| Swapping the implementation, requires some steps, like extending the core class, or implementing an interface.
|
*/
return [

    /*
    | --------------------------------------------------------------------------------------------------------------
    | Service Class Bindings
    | --------------------------------------------------------------------------------------------------------------
    */
    'services' => [

        /*
        |
        | Concrete implementation for the "upload service".
        | To extend or replace this functionality, change the value below with your full "upload service" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Services\UploadService" class
        | - or at least implement the "Varbox\Contracts\UploadServiceContract" interface
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('upload.service') OR app('\Varbox\Contracts\UploadServiceContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'upload_service' => \Varbox\Services\UploadService::class,

    ],

    /*
    | --------------------------------------------------------------------------------------------------------------
    | Model Class Bindings
    | --------------------------------------------------------------------------------------------------------------
    */
    'models' => [

        /*
        |
        | Concrete implementation for the "user model".
        | To extend or replace this functionality, change the value below with your full "user model" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Models\User" class
        | - or at least implement the "Varbox\Contracts\UserModelContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('user.model') OR app('\Varbox\Contracts\UserModelContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'user_model' => \Varbox\Models\User::class,

        /*
        |
        | Concrete implementation for the "role model".
        | To extend or replace this functionality, change the value below with your full "role model" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Models\Role" class
        | - or at least implement the "Varbox\Contracts\RoleModelContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('role.model') OR app('\Varbox\Contracts\RoleModelContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'role_model' => \Varbox\Models\Role::class,

        /*
        |
        | Concrete implementation for the "permission model".
        | To extend or replace this functionality, change the value below with your full "permission model" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Models\Permission" class
        | - or at least implement the "Varbox\Contracts\PermissionModelContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('permission.model') OR app('\Varbox\Contracts\PermissionModelContract')
        | - or you could even use your own class as a direct implementation
        */
        'permission_model' => \Varbox\Models\Permission::class,

        /*
        |
        | Concrete implementation for the "upload model".
        | To extend or replace this functionality, change the value below with your full "upload model" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Models\Upload" class
        | - or at least implement the "Varbox\Contracts\UploadModelContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('upload.model') OR app('\Varbox\Contracts\UploadModelContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'upload_model' => \Varbox\Models\Upload::class,

    ],

    /*
    | --------------------------------------------------------------------------------------------------------------
    | Controller Class Bindings
    | --------------------------------------------------------------------------------------------------------------
    */
    'controllers' => [

        /*
        |
        | Concrete implementation for the "dashboard controller".
        | To extend or replace this functionality, change the value below with your full "dashboard controller" FQN.
        |
        | Your class will have to:
        | - extend the "Varbox\Controllers\DashboardController" class
        |
        */
        'dashboard_controller' => \Varbox\Controllers\DashboardController::class,

        /*
        |
        | Concrete implementation for the "login controller".
        | To extend or replace this functionality, change the value below with your full "login controller" FQN.
        |
        | Your class will have to:
        | - extend the "Varbox\Controllers\LoginController" class
        |
        */
        'login_controller' => \Varbox\Controllers\LoginController::class,

        /*
        |
        | Concrete implementation for the "password forgot controller".
        | To extend or replace this functionality, change the value below with your full "password forgot controller" FQN.
        |
        | Your class will have to:
        | - extend the "Varbox\Controllers\ForgotPasswordController" class
        |
        */
        'password_forgot_controller' => \Varbox\Controllers\ForgotPasswordController::class,

        /*
        |
        | Concrete implementation for the "password reset controller".
        | To extend or replace this functionality, change the value below with your full "password reset controller" FQN.
        |
        | Your class will have to:
        | - extend the "Varbox\Controllers\ResetPasswordController" class
        |
        */
        'password_reset_controller' => \Varbox\Controllers\ResetPasswordController::class,

        /*
        |
        | Concrete implementation for the "users controller".
        | To extend or replace this functionality, change the value below with your full "users controller" FQN.
        |
        | Your class will have to:
        | - extend the "Varbox\Controllers\UsersController" class
        |
        */
        'users_controller' => \Varbox\Controllers\UsersController::class,

        /*
        |
        | Concrete implementation for the "admins controller".
        | To extend or replace this functionality, change the value below with your full "admins controller" FQN.
        |
        | Your class will have to:
        | - extend the "Varbox\Controllers\AdminsController" class
        |
        */
        'admins_controller' => \Varbox\Controllers\AdminsController::class,

        /*
        |
        | Concrete implementation for the "roles controller".
        | To extend or replace this functionality, change the value below with your full "roles controller" FQN.
        |
        | Your class will have to:
        | - extend the "Varbox\Controllers\RolesController" class
        |
        */
        'roles_controller' => \Varbox\Controllers\RolesController::class,

        /*
        |
        | Concrete implementation for the "permissions controller".
        | To extend or replace this functionality, change the value below with your full "permissions controller" FQN.
        |
        | Your class will have to:
        | - extend the "Varbox\Controllers\PermissionsController" class
        |
        */
        'permissions_controller' => \Varbox\Controllers\PermissionsController::class,

        /*
        |
        | Concrete implementation for the "upload controller".
        | To extend or replace this functionality, change the value below with your full "upload controller" FQN.
        |
        | Your class will have to:
        | - extend the "Varbox\Controllers\UploadController" class
        |
        */
        'upload_controller' => \Varbox\Controllers\UploadController::class,

        /*
        |
        | Concrete implementation for the "uploads controller".
        | To extend or replace this functionality, change the value below with your full "uploads controller" FQN.
        |
        | Your class will have to:
        | - extend the "Varbox\Controllers\UploadsController" class
        |
        */
        'uploads_controller' => \Varbox\Controllers\UploadsController::class,

        /*
        |
        | Concrete implementation for the "wysiwyg controller".
        | To extend or replace this functionality, change the value below with your full "wysiwyg controller" FQN.
        |
        | Your class will have to:
        | - extend the "Varbox\Controllers\WysiwygController" class
        |
        */
        'wysiwyg_controller' => \Varbox\Controllers\WysiwygController::class,

    ],

    'form_requests' => [

        /*
        |
        | Concrete implementation for the "user form request".
        | To extend or replace this functionality, change the value below with your full "user form request" FQN.
        |
        | Your class will have to (first options is recommended):
        | - extend the "\Varbox\Requests\UserRequest" class
        | - or extend the "\Illuminate\Foundation\Http\FormRequest" class.
        |
        */
        'user_form_request' => \Varbox\Requests\UserRequest::class,

        /*
        |
        | Concrete implementation for the "admin form request".
        | To extend or replace this functionality, change the value below with your full "admin form request" FQN.
        |
        | Your class will have to (first options is recommended):
        | - extend the "\Varbox\Requests\AdminRequest" class
        | - or extend the "\Illuminate\Foundation\Http\FormRequest" class.
        |
        */
        'admin_form_request' => \Varbox\Requests\AdminRequest::class,

        /*
        |
        | Concrete implementation for the "role form request".
        | To extend or replace this functionality, change the value below with your full "role form request" FQN.
        |
        | Your class will have to (first options is recommended):
        | - extend the "\Varbox\Requests\RoleRequest" class
        | - or extend the "\Illuminate\Foundation\Http\FormRequest" class.
        |
        */
        'role_form_request' => \Varbox\Requests\RoleRequest::class,

        /*
        |
        | Concrete implementation for the "permission form request".
        | To extend or replace this functionality, change the value below with your full "permission form request" FQN.
        |
        | Your class will have to (first options is recommended):
        | - extend the "\Varbox\Requests\PermissionRequest" class
        | - or extend the "\Illuminate\Foundation\Http\FormRequest" class.
        |
        */
        'permission_form_request' => \Varbox\Requests\PermissionRequest::class,

        /*
        |
        | Concrete implementation for the "login form request".
        | To extend or replace this functionality, change the value below with your full "login form request" FQN.
        |
        | Your class will have to (first options is recommended):
        | - extend the "\Varbox\Requests\LoginRequest" class
        | - or extend the "\Illuminate\Foundation\Http\FormRequest" class.
        |
        */
        'login_form_request' => \Varbox\Requests\LoginRequest::class,

        /*
        |
        | Concrete implementation for the "password forgot form request".
        | To extend or replace this functionality, change the value below with your full "password forgot form request" FQN.
        |
        | Your class will have to (first options is recommended):
        | - extend the "\Varbox\Requests\PasswordForgotRequest" class
        | - or extend the "\Illuminate\Foundation\Http\FormRequest" class.
        |
        */
        'password_forgot_form_request' => \Varbox\Requests\PasswordForgotRequest::class,

        /*
        |
        | Concrete implementation for the "password reset form request".
        | To extend or replace this functionality, change the value below with your full "password reset form request" FQN.
        |
        | Your class will have to (first options is recommended):
        | - extend the "\Varbox\Requests\PasswordResetRequest" class
        | - or extend the "\Illuminate\Foundation\Http\FormRequest" class.
        |
        */
        'password_reset_form_request' => \Varbox\Requests\PasswordResetRequest::class,

        /*
        |
        | Concrete implementation for the "upload form request".
        | To extend or replace this functionality, change the value below with your full "upload form request" FQN.
        |
        | Your class will have to (first options is recommended):
        | - extend the "\Varbox\Requests\UploadRequest" class
        | - or extend the "\Illuminate\Foundation\Http\FormRequest" class.
        |
        */
        'upload_form_request' => \Varbox\Requests\UploadRequest::class,

    ],

    /*
    | --------------------------------------------------------------------------------------------------------------
    | Middleware Class Bindings
    | --------------------------------------------------------------------------------------------------------------
    */
    'middleware' => [

        /*
        |
        | Concrete implementation for the "authenticate session middleware".
        | To extend or replace this functionality, change the value below with your full "authenticate session middleware" FQN.
        |
        | Once the value below is changed, your new middleware will be automatically registered with the application.
        |
        | You can then use the middleware by its alias: "varbox.auth.session"
        |
        */
        'authenticate_session_middleware' => \Varbox\Middleware\AuthenticateSession::class,

        /*
        |
        | Concrete implementation for the "authenticated middleware".
        | To extend or replace this functionality, change the value below with your full "authenticated middleware" FQN.
        |
        | Once the value below is changed, your new middleware will be automatically registered with the application.
        |
        | You can then use the middleware by its alias: "varbox.authenticated"
        |
        */
        'authenticated_middleware' => \Varbox\Middleware\Authenticated::class,

        /*
        |
        | Concrete implementation for the "not authenticated middleware".
        | To extend or replace this functionality, change the value below with your full "not authenticated middleware" FQN.
        |
        | Once the value below is changed, your new middleware will be automatically registered with the application.
        |
        | You can then use the middleware by its alias: "varbox.not.authenticated"
        |
        */
        'not_authenticated_middleware' => \Varbox\Middleware\NotAuthenticated::class,

        /*
        |
        | Concrete implementation for the "check roles middleware".
        | To extend or replace this functionality, change the value below with your full "check roles middleware" FQN.
        |
        | Once the value below is changed, your new middleware will be automatically registered with the application.
        |
        | You can then use the middleware by its alias: "varbox.check.roles"
        |
        */
        'check_roles_middleware' => \Varbox\Middleware\CheckRoles::class,

        /*
        |
        | Concrete implementation for the "check permissions middleware".
        | To extend or replace this functionality, change the value below with your full "check permissions middleware" FQN.
        |
        | Once the value below is changed, your new middleware will be automatically registered with the application.
        |
        | You can then use the middleware by its alias: "varbox.check.permissions"
        |
        */
        'check_permissions_middleware' => \Varbox\Middleware\CheckPermissions::class,

    ],

    /*
    | --------------------------------------------------------------------------------------------------------------
    | Helper Class Bindings
    | --------------------------------------------------------------------------------------------------------------
    */
    'helpers' => [

        /*
        |
        | Concrete implementation for the "admin form helper".
        | To extend or replace this functionality, change the value below with your full "admin form helper" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Helpers\AdminFormHelper" class
        | - or at least implement the "Varbox\Contracts\AdminFormHelperContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - form_admin() OR app('admin_form.helper') OR app('\Varbox\Contracts\AdminFormHelperContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'admin_form_helper' => \Varbox\Helpers\AdminFormHelper::class,

        /*
        |
        | Concrete implementation for the "admin menu helper".
        | To extend or replace this functionality, change the value below with your full "admin menu helper" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Helpers\MenuHelper" class
        | - or at least implement the "Varbox\Contracts\MenuHelperContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - menu() OR app('menu.helper') OR app('\Varbox\Contracts\MenuHelperContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'menu_helper' => \Varbox\Helpers\MenuHelper::class,

        /*
        |
        | Concrete implementation for the "flash helper".
        | To extend or replace this functionality, change the value below with your full "flash helper" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Helpers\FlashHelper" class
        | - or at least implement the "Varbox\Contracts\FlashHelperContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - flash() OR app('flash.helper') OR app('\Varbox\Contracts\FlashHelperContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'flash_helper' => \Varbox\Helpers\FlashHelper::class,

        /*
        |
        | Concrete implementation for the "meta helper".
        | To extend or replace this functionality, change the value below with your full "meta helper" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Helpers\MetaHelper" class
        | - or at least implement the "Varbox\Contracts\MetaHelperContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - meta() OR app('meta.helper') OR app('\Varbox\Contracts\MetaHelperContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'meta_helper' => \Varbox\Helpers\MetaHelper::class,

        /*
        |
        | Concrete implementation for the "uploaded helper".
        | To extend or replace this functionality, change the value below with your full "uploaded helper" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Helpers\UploadedHelper" class
        | - or at least implement the "Varbox\Contracts\UploadedHelperContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - uploaded() OR app('uploaded.helper') OR app('\Varbox\Contracts\UploadedHelperContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'uploaded_helper' => \Varbox\Helpers\UploadedHelper::class,

        /*
        |
        | Concrete implementation for the "uploader helper".
        | To extend or replace this functionality, change the value below with your full "uploader helper" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Helpers\UploaderHelper" class
        | - or at least implement the "Varbox\Contracts\UploaderHelperContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - uploader() OR app('uploader.helper') OR app('\Varbox\Contracts\UploaderHelperContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'uploader_helper' => \Varbox\Helpers\UploaderHelper::class,

    ],

    /*
    | --------------------------------------------------------------------------------------------------------------
    | View Composers Class Bindings
    | --------------------------------------------------------------------------------------------------------------
    */
    'view_composers' => [

        /*
        |
        | Concrete implementation for the "admin menu view composer".
        | To extend or replace this functionality, change the value below with your full "admin menu view composer" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Composers\AdminMenuComposer" class
        | - or at least implement the following methods: compose()
        |
        */
        'admin_menu_view_composer' => \Varbox\Composers\AdminMenuComposer::class,

    ],

    /*
    | --------------------------------------------------------------------------------------------------------------
    | Filter Class Bindings
    | --------------------------------------------------------------------------------------------------------------
    */
    'filters' => [

        /*
        |
        | Concrete implementation for the "admin filter".
        | To extend or replace this functionality, change the value below with your full "admin filter" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Filters\AdminFilter" class
        | - or at least implement the "Varbox\Contracts\AdminFilterContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('\Varbox\Contracts\AdminFilterContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'admin_filter' => \Varbox\Filters\AdminFilter::class,

        /*
        |
        | Concrete implementation for the "permission filter".
        | To extend or replace this functionality, change the value below with your full "permission filter" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Filters\PermissionFilter" class
        | - or at least implement the "Varbox\Contracts\PermissionFilterContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('\Varbox\Contracts\PermissionFilterContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'permission_filter' => \Varbox\Filters\PermissionFilter::class,

        /*
        |
        | Concrete implementation for the "role filter".
        | To extend or replace this functionality, change the value below with your full "role filter" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Filters\RoleFilter" class
        | - or at least implement the "Varbox\Contracts\RoleFilterContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('\Varbox\Contracts\RoleFilterContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'role_filter' => \Varbox\Filters\RoleFilter::class,

        /*
        |
        | Concrete implementation for the "upload filter".
        | To extend or replace this functionality, change the value below with your full "upload filter" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Filters\UploadFilter" class
        | - or at least implement the "Varbox\Contracts\UploadFilterContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('\Varbox\Contracts\UploadFilterContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'upload_filter' => \Varbox\Filters\UploadFilter::class,

        /*
        |
        | Concrete implementation for the "user filter".
        | To extend or replace this functionality, change the value below with your full "user filter" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Filters\UserFilter" class
        | - or at least implement the "Varbox\Contracts\UserFilterContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('\Varbox\Contracts\UserFilterContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'user_filter' => \Varbox\Filters\UserFilter::class,

    ],

    /*
    | --------------------------------------------------------------------------------------------------------------
    | Sort Class Bindings
    | --------------------------------------------------------------------------------------------------------------
    */
    'sorts' => [

        /*
        |
        | Concrete implementation for the "admin sort".
        | To extend or replace this functionality, change the value below with your full "admin sort" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Sorts\AdminSort" class
        | - or at least implement the "Varbox\Contracts\AdminSortContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('\Varbox\Contracts\AdminSortContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'admin_sort' => \Varbox\Sorts\AdminSort::class,

        /*
        |
        | Concrete implementation for the "permission sort".
        | To extend or replace this functionality, change the value below with your full "permission sort" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Sorts\PermissionSort" class
        | - or at least implement the "Varbox\Contracts\PermissionSortContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('\Varbox\Contracts\PermissionSortContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'permission_sort' => \Varbox\Sorts\PermissionSort::class,

        /*
        |
        | Concrete implementation for the "role sort".
        | To extend or replace this functionality, change the value below with your full "role sort" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Sorts\RoleSort" class
        | - or at least implement the "Varbox\Contracts\RoleSortContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('\Varbox\Contracts\RoleSortContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'role_sort' => \Varbox\Sorts\RoleSort::class,

        /*
        |
        | Concrete implementation for the "upload sort".
        | To extend or replace this functionality, change the value below with your full "upload sort" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Sorts\UploadSort" class
        | - or at least implement the "Varbox\Contracts\UploadSortContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('\Varbox\Contracts\UploadSortContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'upload_sort' => \Varbox\Sorts\UploadSort::class,

        /*
        |
        | Concrete implementation for the "user sort".
        | To extend or replace this functionality, change the value below with your full "user sort" FQN.
        |
        | Your class will have to (first option is recommended):
        | - extend the "Varbox\Sorts\UserSort" class
        | - or at least implement the "Varbox\Contracts\UserSortContract" interface.
        |
        | Regardless of the concrete implementation below, you can still use it like:
        | - app('\Varbox\Contracts\UserSortContract')
        | - or you could even use your own class as a direct implementation
        |
        */
        'user_sort' => \Varbox\Sorts\UserSort::class,

    ],

];
