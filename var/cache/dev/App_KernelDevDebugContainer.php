<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerAX6A2CI\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerAX6A2CI/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerAX6A2CI.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerAX6A2CI\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerAX6A2CI\App_KernelDevDebugContainer([
    'container.build_hash' => 'AX6A2CI',
    'container.build_id' => '2cd872bb',
    'container.build_time' => 1715920210,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerAX6A2CI');
