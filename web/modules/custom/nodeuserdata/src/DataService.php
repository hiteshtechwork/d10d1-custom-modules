<?php

namespace Drupal\nodeuserdata;

use Drupal\Core\Entity\EntityTypeManagerInterface;

class DataService
{

    protected $entityManager;

    public function __construct(EntityTypeManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllData()
    {
        $users = $this->entityManager->getStorage('user')->loadMultiple();
        $user_data = [];

        foreach ($users as $user) {
            if ($user->id() != 0) {
                $account = \Drupal\user\Entity\User::load($user->id());
                $name = $account->get('name')->value;
                $email = $account->get('mail')->value;

                // Get the roles field.
                $roles_field = $account->get('roles');

// Get the array of role IDs.
                $role_ids = $roles_field->getValue();

// Initialize an array to store role names.
                $roles = [];

// Load each role entity and get its label.
                foreach ($role_ids as $role_id) {
                    $role = \Drupal\user\Entity\Role::load($role_id['target_id']);
                    if ($role) {
                        $roles[] = $role->label();
                    }
                }

// Implode role names into a comma-separated string.
                $roles_string = implode(', ', $roles);

                $user_data[] = [
                    'id' => $user->id(),
                    'name' => $name,
                    'email' => $email,
                    'roles' => $roles_string,
                ];

            }

        }

        // $nodes = $this->entityManager->getStorage('node')->loadMultiple();

        return $user_data;

        // return [
        //     'users' => $users,
        //     // 'nodes' => $nodes,
        // ];
    }
}