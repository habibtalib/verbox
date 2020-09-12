<?php

namespace Varbox;

use Illuminate\Config\Repository as ConfigRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Support\Str;
use Varbox\Commands\WysiwygLinkCommand;
use Varbox\Commands\InstallCommand;
use Varbox\Composers\AdminMenuComposer;
use Varbox\Contracts\AdminFilterContract;
use Varbox\Contracts\AdminFormHelperContract;
use Varbox\Contracts\AdminSortContract;
use Varbox\Contracts\MenuHelperContract;
use Varbox\Contracts\FlashHelperContract;
use Varbox\Contracts\MetaHelperContract;
use Varbox\Contracts\PermissionFilterContract;
use Varbox\Contracts\PermissionModelContract;
use Varbox\Contracts\PermissionSortContract;
use Varbox\Contracts\RoleFilterContract;
use Varbox\Contracts\RoleModelContract;
use Varbox\Contracts\RoleSortContract;
use Varbox\Contracts\UploadedHelperContract;
use Varbox\Contracts\UploaderHelperContract;
use Varbox\Contracts\UploadFilterContract;
use Varbox\Contracts\UploadModelContract;
use Varbox\Contracts\UploadServiceContract;
use Varbox\Contracts\UploadSortContract;
use Varbox\Contracts\UserFilterContract;
use Varbox\Contracts\UserModelContract;
use Varbox\Contracts\UserSortContract;
use Varbox\Filters\AdminFilter;
use Varbox\Filters\PermissionFilter;
use Varbox\Filters\RoleFilter;
use Varbox\Filters\UploadFilter;
use Varbox\Filters\UserFilter;
use Varbox\Helpers\AdminFormHelper;
use Varbox\Helpers\MenuHelper;
use Varbox\Helpers\FlashHelper;
use Varbox\Helpers\MetaHelper;
use Varbox\Helpers\UploadedHelper;
use Varbox\Helpers\UploaderHelper;
use Varbox\Commands\UploadsLinkCommand;
use Varbox\Middleware\Authenticated;
use Varbox\Middleware\AuthenticateSession;
use Varbox\Middleware\CheckPermissions;
use Varbox\Middleware\CheckRoles;
use Varbox\Middleware\NotAuthenticated;
use Varbox\Models\Permission;
use Varbox\Models\Role;
use Varbox\Models\Upload;
use Varbox\Models\User;
use Varbox\Services\UploadService;
use Varbox\Sorts\AdminSort;
use Varbox\Sorts\PermissionSort;
use Varbox\Sorts\RoleSort;
use Varbox\Sorts\UploadSort;
use Varbox\Sorts\UserSort;

class VarboxServiceProvider extends BaseServiceProvider
{
    /**
     * @var ConfigRepository
     */
    protected $config;

    /**
     * @var Router
     */
    protected $router;

    /**
     * Create a new service provider instance.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->config = $this->app->config;
    }

    /**
     * Bootstrap the application services.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        $this->router = $router;

        $this->publishConfigs();
        $this->publishMigrations();
        $this->publishViews();
        $this->publishAssets();
        $this->registerCommands();
        $this->registerMiddlewares();
        $this->registerViewComposers();
        $this->registerRouteBindings();
        $this->registerBladeDirectives();
        $this->loadRoutes();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigs();
        $this->registerServiceBindings();
        $this->registerModelBindings();
        $this->registerHelperBindings();
        $this->registerFilterBindings();
        $this->registerSortBindings();
    }

    /**
     * @return void
     */
    protected function publishConfigs()
    {
        $this->publishes([
            __DIR__ . '/../config/admin.php' => config_path('varbox/admin.php'),
            __DIR__ . '/../config/bindings.php' => config_path('varbox/bindings.php'),
            __DIR__ . '/../config/crud.php' => config_path('varbox/crud.php'),
            __DIR__ . '/../config/flash.php' => config_path('varbox/flash.php'),
            __DIR__ . '/../config/meta.php' => config_path('varbox/meta.php'),
            __DIR__ . '/../config/query-cache.php' => config_path('varbox/query-cache.php'),
            __DIR__ . '/../config/upload.php' => config_path('varbox/upload.php'),
            __DIR__ . '/../config/wysiwyg.php' => config_path('varbox/wysiwyg.php'),
        ], 'varbox-config');
    }

    /**
     * @return void
     */
    protected function publishMigrations()
    {
        if (empty(File::glob(database_path('migrations/*_create_varbox_free_tables.php')))) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__ . '/../database/migrations/create_varbox_free_tables.stub' => database_path() . "/migrations/{$timestamp}_create_varbox_free_tables.php",
            ], 'varbox-migrations');
        }
    }

    /**
     * @return void
     */
    protected function publishViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'varbox');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/varbox'),
        ], 'varbox-views');
    }

    /**
     * @return void
     */
    protected function publishAssets()
    {
        $this->publishes([
            realpath(__DIR__ . '/../public/css') => public_path('vendor/varbox/css'),
            realpath(__DIR__ . '/../public/js') => public_path('vendor/varbox/js'),
            realpath(__DIR__ . '/../public/fonts') => public_path('vendor/varbox/fonts'),
            realpath(__DIR__ . '/../public/images') => public_path('vendor/varbox/images'),
        ], 'varbox-public');
    }

    /**
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                UploadsLinkCommand::class,
                WysiwygLinkCommand::class,
            ]);
        }
    }

    /**
     * @return void
     */
    protected function registerMiddlewares()
    {
        $middleware = $this->config['varbox.bindings']['middleware'];

        $this->router->aliasMiddleware('varbox.auth.session', $middleware['authenticate_session_middleware'] ?? AuthenticateSession::class);
        $this->router->aliasMiddleware('varbox.authenticated', $middleware['authenticated_middleware'] ?? Authenticated::class);
        $this->router->aliasMiddleware('varbox.not.authenticated', $middleware['not_authenticated_middleware'] ?? NotAuthenticated::class);
        $this->router->aliasMiddleware('varbox.check.roles', $middleware['check_roles_middleware'] ?? CheckRoles::class);
        $this->router->aliasMiddleware('varbox.check.permissions', $middleware['check_permissions_middleware'] ?? CheckPermissions::class);
    }

    /**
     * @return void
     */
    protected function registerViewComposers()
    {
        $composers = $this->config['varbox.bindings']['view_composers'];

        $this->app['view']->composer(
            'varbox::layouts.partials._menu',
            $composers['admin_menu_view_composer'] ?? AdminMenuComposer::class
        );
    }

    /**
     * @return void
     */
    protected function registerRouteBindings()
    {
        Route::model('user', UserModelContract::class);
        Route::model('role', RoleModelContract::class);
        Route::model('permission', PermissionModelContract::class);
        Route::model('upload', UploadModelContract::class);
    }

    /**
     * @return void
     */
    protected function loadRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/auth.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/home.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/users.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/admins.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/roles.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/permissions.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/uploads.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/wysiwyg.php');
    }

    /**
     * @return void
     */
    protected function mergeConfigs()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admin.php', 'varbox.admin');
        $this->mergeConfigFrom(__DIR__ . '/../config/bindings.php', 'varbox.bindings');
        $this->mergeConfigFrom(__DIR__ . '/../config/crud.php', 'varbox.crud');
        $this->mergeConfigFrom(__DIR__ . '/../config/flash.php', 'varbox.flash');
        $this->mergeConfigFrom(__DIR__ . '/../config/meta.php', 'varbox.meta');
        $this->mergeConfigFrom(__DIR__ . '/../config/query-cache.php', 'varbox.query-cache');
        $this->mergeConfigFrom(__DIR__ . '/../config/upload.php', 'varbox.upload');
        $this->mergeConfigFrom(__DIR__ . '/../config/wysiwyg.php', 'varbox.wysiwyg');
    }

    /**
     * @return void
     */
    protected function registerServiceBindings()
    {
        $binding = $this->config['varbox.bindings'];

        $this->app->singleton(UploadServiceContract::class, $binding['services']['upload_service'] ?? UploadService::class);
        $this->app->alias(UploadServiceContract::class, 'upload.service');
    }

    /**
     * @return void
     */
    protected function registerModelBindings()
    {
        $binding = $this->config['varbox.bindings'];

        $this->app->bind(UserModelContract::class, $binding['models']['user_model'] ?? User::class);
        $this->app->alias(UserModelContract::class, 'user.model');

        $this->app->bind(RoleModelContract::class, $binding['models']['role_model'] ?? Role::class);
        $this->app->alias(RoleModelContract::class, 'role.model');

        $this->app->bind(PermissionModelContract::class, $binding['models']['permission_model'] ?? Permission::class);
        $this->app->alias(PermissionModelContract::class, 'permission.model');

        $this->app->bind(UploadModelContract::class, $binding['models']['upload_model'] ?? Upload::class);
        $this->app->alias(UploadModelContract::class, 'upload.model');
    }

    /**
     * @return void
     */
    protected function registerHelperBindings()
    {
        $binding = $this->config['varbox.bindings'];

        $this->app->singleton(AdminFormHelperContract::class, $binding['helpers']['admin_form_helper'] ?? AdminFormHelper::class);
        $this->app->alias(AdminFormHelperContract::class, 'admin_form.helper');

        $this->app->singleton(MenuHelperContract::class, $binding['helpers']['menu_helper'] ?? MenuHelper::class);
        $this->app->alias(MenuHelperContract::class, 'menu.helper');

        $this->app->bind(FlashHelperContract::class, $binding['helpers']['flash_helper'] ?? FlashHelper::class);
        $this->app->alias(FlashHelperContract::class, 'flash.helper');

        $this->app->singleton(MetaHelperContract::class, $binding['helpers']['meta_helper'] ?? MetaHelper::class);
        $this->app->alias(MetaHelperContract::class, 'meta.helper');

        $this->app->singleton(UploadedHelperContract::class, $binding['helpers']['uploaded_helper'] ?? UploadedHelper::class);
        $this->app->alias(UploadedHelperContract::class, 'uploaded.helper');

        $this->app->singleton(UploaderHelperContract::class, $binding['helpers']['uploader_helper'] ?? UploaderHelper::class);
        $this->app->alias(UploaderHelperContract::class, 'uploader.helper');
    }

    /**
     * @return void
     */
    protected function registerFilterBindings()
    {
        $binding = $this->config['varbox.bindings'];

        $this->app->singleton(AdminFilterContract::class, $binding['filters']['admin_filter'] ?? AdminFilter::class);
        $this->app->singleton(PermissionFilterContract::class, $binding['filters']['permission_filter'] ?? PermissionFilter::class);
        $this->app->singleton(RoleFilterContract::class, $binding['filters']['role_filter'] ?? RoleFilter::class);
        $this->app->singleton(UploadFilterContract::class, $binding['filters']['upload_filter'] ?? UploadFilter::class);
        $this->app->singleton(UserFilterContract::class, $binding['filters']['user_filter'] ?? UserFilter::class);
    }

    /**
     * @return void
     */
    protected function registerSortBindings()
    {
        $binding = $this->config['varbox.bindings'];

        $this->app->singleton(AdminSortContract::class, $binding['sorts']['admin_sort'] ?? AdminSort::class);
        $this->app->singleton(PermissionSortContract::class, $binding['sorts']['permission_sort'] ?? PermissionSort::class);
        $this->app->singleton(RoleSortContract::class, $binding['sorts']['role_sort'] ?? RoleSort::class);
        $this->app->singleton(UploadSortContract::class, $binding['sorts']['upload_sort'] ?? UploadSort::class);
        $this->app->singleton(UserSortContract::class, $binding['sorts']['user_sort'] ?? UserSort::class);
    }

    /**
     * @return void
     */
    protected function registerBladeDirectives()
    {
        Blade::if('permission', function ($permission) {
            return auth()->check() && (auth()->user()->isSuper() || auth()->user()->hasPermission($permission));
        });

        Blade::if('haspermission', function ($permission) {
            return auth()->check() && (auth()->user()->isSuper() || auth()->user()->hasPermission($permission));
        });

        Blade::if('hasanypermission', function ($permissions) {
            return auth()->check() && (auth()->user()->isSuper() || auth()->user()->hasAnyPermission($permissions));
        });

        Blade::if('hasallpermissions', function ($permissions) {
            return auth()->check() && (auth()->user()->isSuper() || auth()->user()->hasAllPermissions($permissions));
        });

        Blade::if('role', function ($role) {
            return auth()->check() && (auth()->user()->isSuper() || auth()->user()->hasRole($role));
        });

        Blade::if('hasrole', function ($role) {
            return auth()->check() && (auth()->user()->isSuper() || auth()->user()->hasRole($role));
        });

        Blade::if('hasanyrole', function ($roles) {
            return auth()->check() && (auth()->user()->isSuper() || auth()->user()->hasAnyRole($roles));
        });

        Blade::if('hasallroles', function ($roles) {
            return auth()->check() && (auth()->user()->isSuper() || auth()->user()->hasAllRoles($roles));
        });
    }

    /**
     * @return bool
     */
    protected function isOnAdminRoute()
    {
        return Str::startsWith(Route::current()->uri(), config('varbox.admin.prefix', 'admin') . '/');
    }
}
