<?php

namespace App\Repositories;


use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Sentinel;

class Accounts extends Repository
{
    public $action = 'accounts';

    /**
     * Accounts constructor.
     */
    public function __construct()
    {
        parent::__construct(new  Account());
    }

    public function isMaster($id, $type = 0) {
        if ($type == 1) {
            $_acc = Account::where('login_id', $id);
        } else {
            $_acc = Account::find($id);
        }

         return $_acc->where('is_master', 1)
             ->first();
    }
    public function isLock($id) {
            return Account::where('login_id', $id)
                ->where('lock', 1)
                ->first();
    }
    /**
     * This function to search
     *
     * @param array $params
     * @return mixed
     */
    public function search(array $params)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'asc';
        $this->query->orderBy($sortBy, $orderBy);
        $this->query->where('is_master', '<>', 1);

        if (isset($params['name'])) {
            $this->query->where('name', 'LIKE', '%' . $params['name'] . '%');
        }
        if (isset($params['login_id'])) {
            $this->query->where('login_id', 'LIKE', '%' . $params['login_id'] . '%');
        }

        // set older page before update action
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }

        // Set session search params
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    /**
     * Create account
     *
     * @param array $input
     * @return mixed
     */
    public function create(array $input)
    {
        $input['login_miss_times'] = 0;
        $account = Sentinel::registerAndActivate($input);
        $permissions = getPermissionsByRole($input['roles']);
        $account->password = password_hash($input['password'], PASSWORD_BCRYPT);
        $account->name = $input['name'];
        $account->permissions = $permissions;
        return $account->save();
    }

    /**
     * Update account
     *
     * @param $id
     * @param array $input
     * @return mixed
     */
    public function update($id, array $input)
    {
        $account = Sentinel::findById($id);
        if ($account->password != $input['password']) {
            $account->password = password_hash($input['password'], PASSWORD_BCRYPT);
        }
        $account->name = $input['name'];
        $permissions = getPermissionsByRole($input['roles']);
        $account->permissions = $permissions;
        return $account->save();
    }

    /**
     * Delete account
     *
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->query->find($id)->delete();
    }
}