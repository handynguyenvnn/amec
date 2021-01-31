<?php

/**
 * change date format yy-mm-dd to yy/mm/dd
 *
 * @param string $date
 * @return string
 */
function dateFormat($date)
{
    return str_replace('-', '/', $date);
}

/**
 * Get permissions by roles
 * @param array $roles
 * @return array
 */
function getPermissionsByRole(array $roles)
{
    $mappings = [
        'account_management' => 'account.admin',
        'master_management' => 'master.admin',
        'access_management' => 'access_analysis.admin',
        'content_management' => 'content.admin',
        'collection_management' => 'collection.admin',
        'user_management' => 'user.admin',
        'notification' => 'notification.admin',
        'terms_of_service' => 'terms_of_service.admin',
    ];
    $permissions = [];
    foreach ($roles as $role) {
        if (array_key_exists($role, $mappings)) {
            $permissions[$mappings[$role]] = true;
        }
    }
    return $permissions;
}