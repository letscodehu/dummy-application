<?php

use Letscodehu\LocalUserService;
use Letscodehu\ProfileController;
use Letscodehu\ProfileViewTransformer;
use Letscodehu\ServiceContainer as Container;
use Letscodehu\SqlUserDao;
use Letscodehu\UserDao;
use Letscodehu\UserService;
use Letscodehu\UserTransformer;
use Letscodehu\UserViewFacade;

return function(Container $container) {
    $container->bind(ProfileController::class, function(Container $container) {
        $viewFacade = $container->get(UserViewFacade::class);
        return new ProfileController($viewFacade);
    });

    $container->bind(UserViewFacade::class, function(Container $container) {
        $service = $container->get(UserService::class);
        return new UserViewFacade($service);
    });

    $container->put(ProfileViewTransformer::class, new ProfileViewTransformer());
    $container->bind(UserService::class, function(Container $container) {
        $transformer = $container->get(ProfileViewTransformer::class);
        $dao = $container->get(UserDao::class);
        return new LocalUserService($transformer, $dao);
    });
    $container->put(UserTransformer::class, new UserTransformer());
    $container->bind(UserDao::class, function(Container $container) {
        $transformer = $container->get(UserTransformer::class);
        return new SqlUserDao($transformer);
    });
};