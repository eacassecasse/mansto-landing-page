<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3cfcdd8cb09afbc61a0b7e6bf8e3afbd
{
    public static $files = array (
        '19a7e2c3b1d506dcdc1b60aab8e102e4' => __DIR__ . '/..' . '/tracy/tracy/src/Tracy/shortcuts.php',
        'a12da592622097d2b593a430e32e13fd' => __DIR__ . '/..' . '/nette/utils/src/loader.php',
        'a1d067aa2e53d6b47171c03cfc0ea5be' => __DIR__ . '/..' . '/nette/safe-stream/src/loader.php',
        '320cde22f66dd4f5d3fd621d3e88b98f' => __DIR__ . '/..' . '/symfony/polyfill-ctype/bootstrap.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        '742b7e606e92b28dd726e835467f413a' => __DIR__ . '/..' . '/herrera-io/json/src/lib/json_version.php',
        '9d08842a2aa0dc42ee93aa591835610d' => __DIR__ . '/..' . '/kdyby/events/src/Doctrine/compatibility.php',
        'f0e9d233388e461ee3c460665eb265f0' => __DIR__ . '/..' . '/herrera-io/phar-update/src/lib/constants.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Symfony\\Polyfill\\Ctype\\' => 23,
            'Symfony\\Component\\Yaml\\' => 23,
            'Symfony\\Component\\Debug\\' => 24,
            'Symfony\\Component\\Console\\' => 26,
            'Seld\\JsonLint\\' => 14,
        ),
        'P' => 
        array (
            'Psr\\Log\\' => 8,
        ),
        'M' => 
        array (
            'Michelf\\' => 8,
        ),
        'J' => 
        array (
            'JsonSchema\\' => 11,
        ),
        'A' => 
        array (
            'ApiGen\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Symfony\\Polyfill\\Ctype\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-ctype',
        ),
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
        'Symfony\\Component\\Debug\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/debug',
        ),
        'Symfony\\Component\\Console\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/console',
        ),
        'Seld\\JsonLint\\' => 
        array (
            0 => __DIR__ . '/..' . '/seld/jsonlint/src/Seld/JsonLint',
        ),
        'Psr\\Log\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/log/Psr/Log',
        ),
        'Michelf\\' => 
        array (
            0 => __DIR__ . '/..' . '/michelf/php-markdown/Michelf',
        ),
        'JsonSchema\\' => 
        array (
            0 => __DIR__ . '/..' . '/justinrainbow/json-schema/src/JsonSchema',
        ),
        'ApiGen\\' => 
        array (
            0 => __DIR__ . '/..' . '/apigen/apigen/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'T' => 
        array (
            'TokenReflection' => 
            array (
                0 => __DIR__ . '/..' . '/andrewsville/php-token-reflection',
            ),
        ),
        'S' => 
        array (
            'Symfony\\Component\\OptionsResolver\\' => 
            array (
                0 => __DIR__ . '/..' . '/symfony/options-resolver',
            ),
        ),
        'K' => 
        array (
            'Kdyby\\Events\\' => 
            array (
                0 => __DIR__ . '/..' . '/kdyby/events/src',
            ),
        ),
        'H' => 
        array (
            'Herrera\\Version' => 
            array (
                0 => __DIR__ . '/..' . '/herrera-io/version/src/lib',
            ),
            'Herrera\\Phar\\Update' => 
            array (
                0 => __DIR__ . '/..' . '/herrera-io/phar-update/src/lib',
            ),
            'Herrera\\Json' => 
            array (
                0 => __DIR__ . '/..' . '/herrera-io/json/src/lib',
            ),
        ),
        'F' => 
        array (
            'FSHL' => 
            array (
                0 => __DIR__ . '/..' . '/kukulich/fshl',
            ),
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Kdyby\\Events\\Exception' => __DIR__ . '/..' . '/kdyby/events/src/Kdyby/Events/exceptions.php',
        'Kdyby\\Events\\InvalidArgumentException' => __DIR__ . '/..' . '/kdyby/events/src/Kdyby/Events/exceptions.php',
        'Kdyby\\Events\\InvalidListenerException' => __DIR__ . '/..' . '/kdyby/events/src/Kdyby/Events/exceptions.php',
        'Kdyby\\Events\\InvalidStateException' => __DIR__ . '/..' . '/kdyby/events/src/Kdyby/Events/exceptions.php',
        'Kdyby\\Events\\MemberAccessException' => __DIR__ . '/..' . '/kdyby/events/src/Kdyby/Events/exceptions.php',
        'Kdyby\\Events\\NotSupportedException' => __DIR__ . '/..' . '/kdyby/events/src/Kdyby/Events/exceptions.php',
        'Kdyby\\Events\\OutOfRangeException' => __DIR__ . '/..' . '/kdyby/events/src/Kdyby/Events/exceptions.php',
        'Latte\\CompileException' => __DIR__ . '/..' . '/latte/latte/src/Latte/exceptions.php',
        'Latte\\Compiler' => __DIR__ . '/..' . '/latte/latte/src/Latte/Compiler.php',
        'Latte\\Engine' => __DIR__ . '/..' . '/latte/latte/src/Latte/Engine.php',
        'Latte\\Helpers' => __DIR__ . '/..' . '/latte/latte/src/Latte/Helpers.php',
        'Latte\\HtmlNode' => __DIR__ . '/..' . '/latte/latte/src/Latte/HtmlNode.php',
        'Latte\\ILoader' => __DIR__ . '/..' . '/latte/latte/src/Latte/ILoader.php',
        'Latte\\IMacro' => __DIR__ . '/..' . '/latte/latte/src/Latte/IMacro.php',
        'Latte\\Loaders\\FileLoader' => __DIR__ . '/..' . '/latte/latte/src/Latte/Loaders/FileLoader.php',
        'Latte\\Loaders\\StringLoader' => __DIR__ . '/..' . '/latte/latte/src/Latte/Loaders/StringLoader.php',
        'Latte\\MacroNode' => __DIR__ . '/..' . '/latte/latte/src/Latte/MacroNode.php',
        'Latte\\MacroTokens' => __DIR__ . '/..' . '/latte/latte/src/Latte/MacroTokens.php',
        'Latte\\Macros\\BlockMacros' => __DIR__ . '/..' . '/latte/latte/src/Latte/Macros/BlockMacros.php',
        'Latte\\Macros\\BlockMacrosRuntime' => __DIR__ . '/..' . '/latte/latte/src/Latte/Macros/BlockMacrosRuntime.php',
        'Latte\\Macros\\CoreMacros' => __DIR__ . '/..' . '/latte/latte/src/Latte/Macros/CoreMacros.php',
        'Latte\\Macros\\MacroSet' => __DIR__ . '/..' . '/latte/latte/src/Latte/Macros/MacroSet.php',
        'Latte\\Object' => __DIR__ . '/..' . '/latte/latte/src/Latte/Object.php',
        'Latte\\Parser' => __DIR__ . '/..' . '/latte/latte/src/Latte/Parser.php',
        'Latte\\PhpWriter' => __DIR__ . '/..' . '/latte/latte/src/Latte/PhpWriter.php',
        'Latte\\RegexpException' => __DIR__ . '/..' . '/latte/latte/src/Latte/exceptions.php',
        'Latte\\RuntimeException' => __DIR__ . '/..' . '/latte/latte/src/Latte/exceptions.php',
        'Latte\\Runtime\\CachingIterator' => __DIR__ . '/..' . '/latte/latte/src/Latte/Runtime/CachingIterator.php',
        'Latte\\Runtime\\Filters' => __DIR__ . '/..' . '/latte/latte/src/Latte/Runtime/Filters.php',
        'Latte\\Runtime\\Html' => __DIR__ . '/..' . '/latte/latte/src/Latte/Runtime/Html.php',
        'Latte\\Runtime\\IHtmlString' => __DIR__ . '/..' . '/latte/latte/src/Latte/Runtime/IHtmlString.php',
        'Latte\\Template' => __DIR__ . '/..' . '/latte/latte/src/Latte/Template.php',
        'Latte\\Token' => __DIR__ . '/..' . '/latte/latte/src/Latte/Token.php',
        'Latte\\TokenIterator' => __DIR__ . '/..' . '/latte/latte/src/Latte/TokenIterator.php',
        'Latte\\Tokenizer' => __DIR__ . '/..' . '/latte/latte/src/Latte/Tokenizer.php',
        'NetteModule\\ErrorPresenter' => __DIR__ . '/..' . '/nette/application/src/Application/ErrorPresenter.php',
        'NetteModule\\MicroPresenter' => __DIR__ . '/..' . '/nette/application/src/Application/MicroPresenter.php',
        'Nette\\Application\\AbortException' => __DIR__ . '/..' . '/nette/application/src/Application/exceptions.php',
        'Nette\\Application\\Application' => __DIR__ . '/..' . '/nette/application/src/Application/Application.php',
        'Nette\\Application\\ApplicationException' => __DIR__ . '/..' . '/nette/application/src/Application/exceptions.php',
        'Nette\\Application\\BadRequestException' => __DIR__ . '/..' . '/nette/application/src/Application/exceptions.php',
        'Nette\\Application\\ForbiddenRequestException' => __DIR__ . '/..' . '/nette/application/src/Application/exceptions.php',
        'Nette\\Application\\Helpers' => __DIR__ . '/..' . '/nette/application/src/Application/Helpers.php',
        'Nette\\Application\\IPresenter' => __DIR__ . '/..' . '/nette/application/src/Application/IPresenter.php',
        'Nette\\Application\\IPresenterFactory' => __DIR__ . '/..' . '/nette/application/src/Application/IPresenterFactory.php',
        'Nette\\Application\\IResponse' => __DIR__ . '/..' . '/nette/application/src/Application/IResponse.php',
        'Nette\\Application\\IRouter' => __DIR__ . '/..' . '/nette/application/src/Application/IRouter.php',
        'Nette\\Application\\InvalidPresenterException' => __DIR__ . '/..' . '/nette/application/src/Application/exceptions.php',
        'Nette\\Application\\LinkGenerator' => __DIR__ . '/..' . '/nette/application/src/Application/LinkGenerator.php',
        'Nette\\Application\\PresenterFactory' => __DIR__ . '/..' . '/nette/application/src/Application/PresenterFactory.php',
        'Nette\\Application\\Request' => __DIR__ . '/..' . '/nette/application/src/Application/Request.php',
        'Nette\\Application\\Responses\\CallbackResponse' => __DIR__ . '/..' . '/nette/application/src/Application/Responses/CallbackResponse.php',
        'Nette\\Application\\Responses\\FileResponse' => __DIR__ . '/..' . '/nette/application/src/Application/Responses/FileResponse.php',
        'Nette\\Application\\Responses\\ForwardResponse' => __DIR__ . '/..' . '/nette/application/src/Application/Responses/ForwardResponse.php',
        'Nette\\Application\\Responses\\JsonResponse' => __DIR__ . '/..' . '/nette/application/src/Application/Responses/JsonResponse.php',
        'Nette\\Application\\Responses\\RedirectResponse' => __DIR__ . '/..' . '/nette/application/src/Application/Responses/RedirectResponse.php',
        'Nette\\Application\\Responses\\TextResponse' => __DIR__ . '/..' . '/nette/application/src/Application/Responses/TextResponse.php',
        'Nette\\Application\\Routers\\CliRouter' => __DIR__ . '/..' . '/nette/application/src/Application/Routers/CliRouter.php',
        'Nette\\Application\\Routers\\Route' => __DIR__ . '/..' . '/nette/application/src/Application/Routers/Route.php',
        'Nette\\Application\\Routers\\RouteList' => __DIR__ . '/..' . '/nette/application/src/Application/Routers/RouteList.php',
        'Nette\\Application\\Routers\\SimpleRouter' => __DIR__ . '/..' . '/nette/application/src/Application/Routers/SimpleRouter.php',
        'Nette\\Application\\UI\\BadSignalException' => __DIR__ . '/..' . '/nette/application/src/Application/UI/BadSignalException.php',
        'Nette\\Application\\UI\\Component' => __DIR__ . '/..' . '/nette/application/src/Application/UI/Component.php',
        'Nette\\Application\\UI\\ComponentReflection' => __DIR__ . '/..' . '/nette/application/src/Application/UI/ComponentReflection.php',
        'Nette\\Application\\UI\\Control' => __DIR__ . '/..' . '/nette/application/src/Application/UI/Control.php',
        'Nette\\Application\\UI\\Form' => __DIR__ . '/..' . '/nette/application/src/Application/UI/Form.php',
        'Nette\\Application\\UI\\IRenderable' => __DIR__ . '/..' . '/nette/application/src/Application/UI/IRenderable.php',
        'Nette\\Application\\UI\\ISignalReceiver' => __DIR__ . '/..' . '/nette/application/src/Application/UI/ISignalReceiver.php',
        'Nette\\Application\\UI\\IStatePersistent' => __DIR__ . '/..' . '/nette/application/src/Application/UI/IStatePersistent.php',
        'Nette\\Application\\UI\\ITemplate' => __DIR__ . '/..' . '/nette/application/src/Application/UI/ITemplate.php',
        'Nette\\Application\\UI\\ITemplateFactory' => __DIR__ . '/..' . '/nette/application/src/Application/UI/ITemplateFactory.php',
        'Nette\\Application\\UI\\InvalidLinkException' => __DIR__ . '/..' . '/nette/application/src/Application/UI/InvalidLinkException.php',
        'Nette\\Application\\UI\\Link' => __DIR__ . '/..' . '/nette/application/src/Application/UI/Link.php',
        'Nette\\Application\\UI\\MethodReflection' => __DIR__ . '/..' . '/nette/application/src/Application/UI/MethodReflection.php',
        'Nette\\Application\\UI\\Multiplier' => __DIR__ . '/..' . '/nette/application/src/Application/UI/Multiplier.php',
        'Nette\\Application\\UI\\Presenter' => __DIR__ . '/..' . '/nette/application/src/Application/UI/Presenter.php',
        'Nette\\Application\\UI\\PresenterComponent' => __DIR__ . '/..' . '/nette/application/src/compatibility.php',
        'Nette\\Application\\UI\\PresenterComponentReflection' => __DIR__ . '/..' . '/nette/application/src/compatibility.php',
        'Nette\\ArgumentOutOfRangeException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Bridges\\ApplicationDI\\ApplicationExtension' => __DIR__ . '/..' . '/nette/application/src/Bridges/ApplicationDI/ApplicationExtension.php',
        'Nette\\Bridges\\ApplicationDI\\LatteExtension' => __DIR__ . '/..' . '/nette/application/src/Bridges/ApplicationDI/LatteExtension.php',
        'Nette\\Bridges\\ApplicationDI\\PresenterFactoryCallback' => __DIR__ . '/..' . '/nette/application/src/Bridges/ApplicationDI/PresenterFactoryCallback.php',
        'Nette\\Bridges\\ApplicationDI\\RoutingExtension' => __DIR__ . '/..' . '/nette/application/src/Bridges/ApplicationDI/RoutingExtension.php',
        'Nette\\Bridges\\ApplicationLatte\\ILatteFactory' => __DIR__ . '/..' . '/nette/application/src/Bridges/ApplicationLatte/ILatteFactory.php',
        'Nette\\Bridges\\ApplicationLatte\\Loader' => __DIR__ . '/..' . '/nette/application/src/Bridges/ApplicationLatte/Loader.php',
        'Nette\\Bridges\\ApplicationLatte\\SnippetBridge' => __DIR__ . '/..' . '/nette/application/src/Bridges/ApplicationLatte/SnippetBridge.php',
        'Nette\\Bridges\\ApplicationLatte\\Template' => __DIR__ . '/..' . '/nette/application/src/Bridges/ApplicationLatte/Template.php',
        'Nette\\Bridges\\ApplicationLatte\\TemplateFactory' => __DIR__ . '/..' . '/nette/application/src/Bridges/ApplicationLatte/TemplateFactory.php',
        'Nette\\Bridges\\ApplicationLatte\\UIMacros' => __DIR__ . '/..' . '/nette/application/src/Bridges/ApplicationLatte/UIMacros.php',
        'Nette\\Bridges\\ApplicationLatte\\UIRuntime' => __DIR__ . '/..' . '/nette/application/src/Bridges/ApplicationLatte/UIRuntime.php',
        'Nette\\Bridges\\ApplicationTracy\\RoutingPanel' => __DIR__ . '/..' . '/nette/application/src/Bridges/ApplicationTracy/RoutingPanel.php',
        'Nette\\Bridges\\CacheDI\\CacheExtension' => __DIR__ . '/..' . '/nette/caching/src/Bridges/CacheDI/CacheExtension.php',
        'Nette\\Bridges\\CacheLatte\\CacheMacro' => __DIR__ . '/..' . '/nette/caching/src/Bridges/CacheLatte/CacheMacro.php',
        'Nette\\Bridges\\DITracy\\ContainerPanel' => __DIR__ . '/..' . '/nette/di/src/Bridges/DITracy/ContainerPanel.php',
        'Nette\\Bridges\\Framework\\TracyBridge' => __DIR__ . '/..' . '/nette/bootstrap/src/Bridges/Framework/TracyBridge.php',
        'Nette\\Bridges\\HttpDI\\HttpExtension' => __DIR__ . '/..' . '/nette/http/src/Bridges/HttpDI/HttpExtension.php',
        'Nette\\Bridges\\HttpDI\\SessionExtension' => __DIR__ . '/..' . '/nette/http/src/Bridges/HttpDI/SessionExtension.php',
        'Nette\\Bridges\\HttpTracy\\SessionPanel' => __DIR__ . '/..' . '/nette/http/src/Bridges/HttpTracy/SessionPanel.php',
        'Nette\\Bridges\\MailDI\\MailExtension' => __DIR__ . '/..' . '/nette/mail/src/Bridges/MailDI/MailExtension.php',
        'Nette\\Bridges\\ReflectionDI\\ReflectionExtension' => __DIR__ . '/..' . '/nette/reflection/src/Bridges/ReflectionDI/ReflectionExtension.php',
        'Nette\\Caching\\Cache' => __DIR__ . '/..' . '/nette/caching/src/Caching/Cache.php',
        'Nette\\Caching\\IBulkReader' => __DIR__ . '/..' . '/nette/caching/src/Caching/IBulkReader.php',
        'Nette\\Caching\\IStorage' => __DIR__ . '/..' . '/nette/caching/src/Caching/IStorage.php',
        'Nette\\Caching\\OutputHelper' => __DIR__ . '/..' . '/nette/caching/src/Caching/OutputHelper.php',
        'Nette\\Caching\\Storages\\DevNullStorage' => __DIR__ . '/..' . '/nette/caching/src/Caching/Storages/DevNullStorage.php',
        'Nette\\Caching\\Storages\\FileStorage' => __DIR__ . '/..' . '/nette/caching/src/Caching/Storages/FileStorage.php',
        'Nette\\Caching\\Storages\\IJournal' => __DIR__ . '/..' . '/nette/caching/src/Caching/Storages/IJournal.php',
        'Nette\\Caching\\Storages\\MemcachedStorage' => __DIR__ . '/..' . '/nette/caching/src/Caching/Storages/MemcachedStorage.php',
        'Nette\\Caching\\Storages\\MemoryStorage' => __DIR__ . '/..' . '/nette/caching/src/Caching/Storages/MemoryStorage.php',
        'Nette\\Caching\\Storages\\NewMemcachedStorage' => __DIR__ . '/..' . '/nette/caching/src/Caching/Storages/NewMemcachedStorage.php',
        'Nette\\Caching\\Storages\\SQLiteJournal' => __DIR__ . '/..' . '/nette/caching/src/Caching/Storages/SQLiteJournal.php',
        'Nette\\Caching\\Storages\\SQLiteStorage' => __DIR__ . '/..' . '/nette/caching/src/Caching/Storages/SQLiteStorage.php',
        'Nette\\ComponentModel\\ArrayAccess' => __DIR__ . '/..' . '/nette/component-model/src/ComponentModel/ArrayAccess.php',
        'Nette\\ComponentModel\\Component' => __DIR__ . '/..' . '/nette/component-model/src/ComponentModel/Component.php',
        'Nette\\ComponentModel\\Container' => __DIR__ . '/..' . '/nette/component-model/src/ComponentModel/Container.php',
        'Nette\\ComponentModel\\IComponent' => __DIR__ . '/..' . '/nette/component-model/src/ComponentModel/IComponent.php',
        'Nette\\ComponentModel\\IContainer' => __DIR__ . '/..' . '/nette/component-model/src/ComponentModel/IContainer.php',
        'Nette\\ComponentModel\\RecursiveComponentIterator' => __DIR__ . '/..' . '/nette/component-model/src/ComponentModel/RecursiveComponentIterator.php',
        'Nette\\Configurator' => __DIR__ . '/..' . '/nette/bootstrap/src/Bootstrap/Configurator.php',
        'Nette\\DI\\Compiler' => __DIR__ . '/..' . '/nette/di/src/DI/Compiler.php',
        'Nette\\DI\\CompilerExtension' => __DIR__ . '/..' . '/nette/di/src/DI/CompilerExtension.php',
        'Nette\\DI\\Config\\Adapters\\IniAdapter' => __DIR__ . '/..' . '/nette/di/src/DI/Config/Adapters/IniAdapter.php',
        'Nette\\DI\\Config\\Adapters\\NeonAdapter' => __DIR__ . '/..' . '/nette/di/src/DI/Config/Adapters/NeonAdapter.php',
        'Nette\\DI\\Config\\Adapters\\PhpAdapter' => __DIR__ . '/..' . '/nette/di/src/DI/Config/Adapters/PhpAdapter.php',
        'Nette\\DI\\Config\\Helpers' => __DIR__ . '/..' . '/nette/di/src/DI/Config/Helpers.php',
        'Nette\\DI\\Config\\IAdapter' => __DIR__ . '/..' . '/nette/di/src/DI/Config/IAdapter.php',
        'Nette\\DI\\Config\\Loader' => __DIR__ . '/..' . '/nette/di/src/DI/Config/Loader.php',
        'Nette\\DI\\Container' => __DIR__ . '/..' . '/nette/di/src/DI/Container.php',
        'Nette\\DI\\ContainerBuilder' => __DIR__ . '/..' . '/nette/di/src/DI/ContainerBuilder.php',
        'Nette\\DI\\ContainerLoader' => __DIR__ . '/..' . '/nette/di/src/DI/ContainerLoader.php',
        'Nette\\DI\\DependencyChecker' => __DIR__ . '/..' . '/nette/di/src/DI/DependencyChecker.php',
        'Nette\\DI\\Extensions\\ConstantsExtension' => __DIR__ . '/..' . '/nette/di/src/DI/Extensions/ConstantsExtension.php',
        'Nette\\DI\\Extensions\\DIExtension' => __DIR__ . '/..' . '/nette/di/src/DI/Extensions/DIExtension.php',
        'Nette\\DI\\Extensions\\DecoratorExtension' => __DIR__ . '/..' . '/nette/di/src/DI/Extensions/DecoratorExtension.php',
        'Nette\\DI\\Extensions\\ExtensionsExtension' => __DIR__ . '/..' . '/nette/di/src/DI/Extensions/ExtensionsExtension.php',
        'Nette\\DI\\Extensions\\InjectExtension' => __DIR__ . '/..' . '/nette/di/src/DI/Extensions/InjectExtension.php',
        'Nette\\DI\\Extensions\\PhpExtension' => __DIR__ . '/..' . '/nette/di/src/DI/Extensions/PhpExtension.php',
        'Nette\\DI\\Helpers' => __DIR__ . '/..' . '/nette/di/src/DI/Helpers.php',
        'Nette\\DI\\MissingServiceException' => __DIR__ . '/..' . '/nette/di/src/DI/exceptions.php',
        'Nette\\DI\\PhpGenerator' => __DIR__ . '/..' . '/nette/di/src/DI/PhpGenerator.php',
        'Nette\\DI\\PhpReflection' => __DIR__ . '/..' . '/nette/di/src/DI/PhpReflection.php',
        'Nette\\DI\\ServiceCreationException' => __DIR__ . '/..' . '/nette/di/src/DI/exceptions.php',
        'Nette\\DI\\ServiceDefinition' => __DIR__ . '/..' . '/nette/di/src/DI/ServiceDefinition.php',
        'Nette\\DI\\Statement' => __DIR__ . '/..' . '/nette/di/src/DI/Statement.php',
        'Nette\\DeprecatedException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\DirectoryNotFoundException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\FileNotFoundException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Http\\Context' => __DIR__ . '/..' . '/nette/http/src/Http/Context.php',
        'Nette\\Http\\FileUpload' => __DIR__ . '/..' . '/nette/http/src/Http/FileUpload.php',
        'Nette\\Http\\Helpers' => __DIR__ . '/..' . '/nette/http/src/Http/Helpers.php',
        'Nette\\Http\\IRequest' => __DIR__ . '/..' . '/nette/http/src/Http/IRequest.php',
        'Nette\\Http\\IResponse' => __DIR__ . '/..' . '/nette/http/src/Http/IResponse.php',
        'Nette\\Http\\ISessionStorage' => __DIR__ . '/..' . '/nette/http/src/Http/ISessionStorage.php',
        'Nette\\Http\\Request' => __DIR__ . '/..' . '/nette/http/src/Http/Request.php',
        'Nette\\Http\\RequestFactory' => __DIR__ . '/..' . '/nette/http/src/Http/RequestFactory.php',
        'Nette\\Http\\Response' => __DIR__ . '/..' . '/nette/http/src/Http/Response.php',
        'Nette\\Http\\Session' => __DIR__ . '/..' . '/nette/http/src/Http/Session.php',
        'Nette\\Http\\SessionSection' => __DIR__ . '/..' . '/nette/http/src/Http/SessionSection.php',
        'Nette\\Http\\Url' => __DIR__ . '/..' . '/nette/http/src/Http/Url.php',
        'Nette\\Http\\UrlScript' => __DIR__ . '/..' . '/nette/http/src/Http/UrlScript.php',
        'Nette\\Http\\UserStorage' => __DIR__ . '/..' . '/nette/http/src/Http/UserStorage.php',
        'Nette\\IOException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\InvalidArgumentException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\InvalidStateException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Iterators\\CachingIterator' => __DIR__ . '/..' . '/nette/utils/src/Iterators/CachingIterator.php',
        'Nette\\Iterators\\Mapper' => __DIR__ . '/..' . '/nette/utils/src/Iterators/Mapper.php',
        'Nette\\LegacyObject' => __DIR__ . '/..' . '/nette/utils/src/Utils/LegacyObject.php',
        'Nette\\Loaders\\RobotLoader' => __DIR__ . '/..' . '/nette/robot-loader/src/RobotLoader/RobotLoader.php',
        'Nette\\Localization\\ITranslator' => __DIR__ . '/..' . '/nette/utils/src/Utils/ITranslator.php',
        'Nette\\Mail\\FallbackMailer' => __DIR__ . '/..' . '/nette/mail/src/Mail/FallbackMailer.php',
        'Nette\\Mail\\FallbackMailerException' => __DIR__ . '/..' . '/nette/mail/src/Mail/exceptions.php',
        'Nette\\Mail\\IMailer' => __DIR__ . '/..' . '/nette/mail/src/Mail/IMailer.php',
        'Nette\\Mail\\Message' => __DIR__ . '/..' . '/nette/mail/src/Mail/Message.php',
        'Nette\\Mail\\MimePart' => __DIR__ . '/..' . '/nette/mail/src/Mail/MimePart.php',
        'Nette\\Mail\\SendException' => __DIR__ . '/..' . '/nette/mail/src/Mail/exceptions.php',
        'Nette\\Mail\\SendmailMailer' => __DIR__ . '/..' . '/nette/mail/src/Mail/SendmailMailer.php',
        'Nette\\Mail\\SmtpException' => __DIR__ . '/..' . '/nette/mail/src/Mail/exceptions.php',
        'Nette\\Mail\\SmtpMailer' => __DIR__ . '/..' . '/nette/mail/src/Mail/SmtpMailer.php',
        'Nette\\MemberAccessException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Neon\\Decoder' => __DIR__ . '/..' . '/nette/neon/src/Neon/Decoder.php',
        'Nette\\Neon\\Encoder' => __DIR__ . '/..' . '/nette/neon/src/Neon/Encoder.php',
        'Nette\\Neon\\Entity' => __DIR__ . '/..' . '/nette/neon/src/Neon/Entity.php',
        'Nette\\Neon\\Exception' => __DIR__ . '/..' . '/nette/neon/src/Neon/Exception.php',
        'Nette\\Neon\\Neon' => __DIR__ . '/..' . '/nette/neon/src/Neon/Neon.php',
        'Nette\\NotImplementedException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\NotSupportedException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\OutOfRangeException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\PhpGenerator\\ClassType' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/ClassType.php',
        'Nette\\PhpGenerator\\Closure' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Closure.php',
        'Nette\\PhpGenerator\\Constant' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Constant.php',
        'Nette\\PhpGenerator\\Dumper' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Dumper.php',
        'Nette\\PhpGenerator\\Factory' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Factory.php',
        'Nette\\PhpGenerator\\GlobalFunction' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/GlobalFunction.php',
        'Nette\\PhpGenerator\\Helpers' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Helpers.php',
        'Nette\\PhpGenerator\\Literal' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Literal.php',
        'Nette\\PhpGenerator\\Method' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Method.php',
        'Nette\\PhpGenerator\\Parameter' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Parameter.php',
        'Nette\\PhpGenerator\\PhpFile' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/PhpFile.php',
        'Nette\\PhpGenerator\\PhpLiteral' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/PhpLiteral.php',
        'Nette\\PhpGenerator\\PhpNamespace' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/PhpNamespace.php',
        'Nette\\PhpGenerator\\Printer' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Printer.php',
        'Nette\\PhpGenerator\\Property' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Property.php',
        'Nette\\PhpGenerator\\PsrPrinter' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/PsrPrinter.php',
        'Nette\\PhpGenerator\\Traits\\CommentAware' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Traits/CommentAware.php',
        'Nette\\PhpGenerator\\Traits\\FunctionLike' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Traits/FunctionLike.php',
        'Nette\\PhpGenerator\\Traits\\NameAware' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Traits/NameAware.php',
        'Nette\\PhpGenerator\\Traits\\VisibilityAware' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Traits/VisibilityAware.php',
        'Nette\\PhpGenerator\\Type' => __DIR__ . '/..' . '/nette/php-generator/src/PhpGenerator/Type.php',
        'Nette\\Reflection\\Annotation' => __DIR__ . '/..' . '/nette/reflection/src/Reflection/Annotation.php',
        'Nette\\Reflection\\AnnotationsParser' => __DIR__ . '/..' . '/nette/reflection/src/Reflection/AnnotationsParser.php',
        'Nette\\Reflection\\ClassType' => __DIR__ . '/..' . '/nette/reflection/src/Reflection/ClassType.php',
        'Nette\\Reflection\\Extension' => __DIR__ . '/..' . '/nette/reflection/src/Reflection/Extension.php',
        'Nette\\Reflection\\GlobalFunction' => __DIR__ . '/..' . '/nette/reflection/src/Reflection/GlobalFunction.php',
        'Nette\\Reflection\\Helpers' => __DIR__ . '/..' . '/nette/reflection/src/Reflection/Helpers.php',
        'Nette\\Reflection\\IAnnotation' => __DIR__ . '/..' . '/nette/reflection/src/Reflection/IAnnotation.php',
        'Nette\\Reflection\\Method' => __DIR__ . '/..' . '/nette/reflection/src/Reflection/Method.php',
        'Nette\\Reflection\\Parameter' => __DIR__ . '/..' . '/nette/reflection/src/Reflection/Parameter.php',
        'Nette\\Reflection\\Property' => __DIR__ . '/..' . '/nette/reflection/src/Reflection/Property.php',
        'Nette\\SmartObject' => __DIR__ . '/..' . '/nette/utils/src/Utils/SmartObject.php',
        'Nette\\StaticClass' => __DIR__ . '/..' . '/nette/utils/src/Utils/StaticClass.php',
        'Nette\\StaticClassException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\UnexpectedValueException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\ArrayHash' => __DIR__ . '/..' . '/nette/utils/src/Utils/ArrayHash.php',
        'Nette\\Utils\\ArrayList' => __DIR__ . '/..' . '/nette/utils/src/Utils/ArrayList.php',
        'Nette\\Utils\\Arrays' => __DIR__ . '/..' . '/nette/utils/src/Utils/Arrays.php',
        'Nette\\Utils\\AssertionException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\Callback' => __DIR__ . '/..' . '/nette/utils/src/Utils/Callback.php',
        'Nette\\Utils\\DateTime' => __DIR__ . '/..' . '/nette/utils/src/Utils/DateTime.php',
        'Nette\\Utils\\FileSystem' => __DIR__ . '/..' . '/nette/utils/src/Utils/FileSystem.php',
        'Nette\\Utils\\Finder' => __DIR__ . '/..' . '/nette/finder/src/Utils/Finder.php',
        'Nette\\Utils\\Html' => __DIR__ . '/..' . '/nette/utils/src/Utils/Html.php',
        'Nette\\Utils\\IHtmlString' => __DIR__ . '/..' . '/nette/utils/src/Utils/IHtmlString.php',
        'Nette\\Utils\\Image' => __DIR__ . '/..' . '/nette/utils/src/Utils/Image.php',
        'Nette\\Utils\\ImageException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\Json' => __DIR__ . '/..' . '/nette/utils/src/Utils/Json.php',
        'Nette\\Utils\\JsonException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\ObjectHelpers' => __DIR__ . '/..' . '/nette/utils/src/Utils/ObjectHelpers.php',
        'Nette\\Utils\\ObjectMixin' => __DIR__ . '/..' . '/nette/utils/src/Utils/ObjectMixin.php',
        'Nette\\Utils\\Paginator' => __DIR__ . '/..' . '/nette/utils/src/Utils/Paginator.php',
        'Nette\\Utils\\Random' => __DIR__ . '/..' . '/nette/utils/src/Utils/Random.php',
        'Nette\\Utils\\Reflection' => __DIR__ . '/..' . '/nette/utils/src/Utils/Reflection.php',
        'Nette\\Utils\\RegexpException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\Strings' => __DIR__ . '/..' . '/nette/utils/src/Utils/Strings.php',
        'Nette\\Utils\\UnknownImageFileException' => __DIR__ . '/..' . '/nette/utils/src/Utils/exceptions.php',
        'Nette\\Utils\\Validators' => __DIR__ . '/..' . '/nette/utils/src/Utils/Validators.php',
        'Tracy\\Bar' => __DIR__ . '/..' . '/tracy/tracy/src/Tracy/Bar/Bar.php',
        'Tracy\\BlueScreen' => __DIR__ . '/..' . '/tracy/tracy/src/Tracy/BlueScreen/BlueScreen.php',
        'Tracy\\Bridges\\Nette\\Bridge' => __DIR__ . '/..' . '/tracy/tracy/src/Bridges/Nette/Bridge.php',
        'Tracy\\Bridges\\Nette\\MailSender' => __DIR__ . '/..' . '/tracy/tracy/src/Bridges/Nette/MailSender.php',
        'Tracy\\Bridges\\Nette\\TracyExtension' => __DIR__ . '/..' . '/tracy/tracy/src/Bridges/Nette/TracyExtension.php',
        'Tracy\\Bridges\\Psr\\PsrToTracyLoggerAdapter' => __DIR__ . '/..' . '/tracy/tracy/src/Bridges/Psr/PsrToTracyLoggerAdapter.php',
        'Tracy\\Bridges\\Psr\\TracyToPsrLoggerAdapter' => __DIR__ . '/..' . '/tracy/tracy/src/Bridges/Psr/TracyToPsrLoggerAdapter.php',
        'Tracy\\Debugger' => __DIR__ . '/..' . '/tracy/tracy/src/Tracy/Debugger/Debugger.php',
        'Tracy\\DefaultBarPanel' => __DIR__ . '/..' . '/tracy/tracy/src/Tracy/Bar/DefaultBarPanel.php',
        'Tracy\\Dumper' => __DIR__ . '/..' . '/tracy/tracy/src/Tracy/Dumper/Dumper.php',
        'Tracy\\FireLogger' => __DIR__ . '/..' . '/tracy/tracy/src/Tracy/Logger/FireLogger.php',
        'Tracy\\Helpers' => __DIR__ . '/..' . '/tracy/tracy/src/Tracy/Helpers.php',
        'Tracy\\IBarPanel' => __DIR__ . '/..' . '/tracy/tracy/src/Tracy/Bar/IBarPanel.php',
        'Tracy\\ILogger' => __DIR__ . '/..' . '/tracy/tracy/src/Tracy/Logger/ILogger.php',
        'Tracy\\Logger' => __DIR__ . '/..' . '/tracy/tracy/src/Tracy/Logger/Logger.php',
        'Tracy\\OutputDebugger' => __DIR__ . '/..' . '/tracy/tracy/src/Tracy/OutputDebugger/OutputDebugger.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3cfcdd8cb09afbc61a0b7e6bf8e3afbd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3cfcdd8cb09afbc61a0b7e6bf8e3afbd::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit3cfcdd8cb09afbc61a0b7e6bf8e3afbd::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit3cfcdd8cb09afbc61a0b7e6bf8e3afbd::$classMap;

        }, null, ClassLoader::class);
    }
}
