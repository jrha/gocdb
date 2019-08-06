<?php

require_once __DIR__.'/lib/Gocdb_Services/NotificationService.php';

$site = \Factory::getSiteService()->getSite(3);
$requesting_user = \Factory::getUserService()->getUser(7);
$role_requested = \Factory::getRoleService()->getRoleById(12);

echo $role_requested->getRoleType()->getName();

$notificationService = \Factory::getNotificationService();

$notificationService->roleRequest($role_requested, $requesting_user, $site);

?>
