<?php

namespace App\Repositories;

use App\Models\LogLogin;
use App\Models\User;
use App\Models\NotificationSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Libs\Constants\Constant;
use Illuminate\Support\Facades\Storage;

class Users extends Repository
{

    public $action = 'announcements';
    protected $csvColumn = [
        'email',
        'password',
        'language_id',
        'username',
        'gender',
        'birth_date',
        'area_id',
        'profession_id',
        'address',
        'phone',
        'registration_date',
        'last_login_date',
        'notification_setting_1',
        'notification_setting_2',
        'notification_setting_3',
        'contents',
        'sns_public_setting',
        'device_id'
    ];

    /**
     * Users constructor.
     */
    public function __construct()
    {
        parent::__construct(new User());
    }
    public function search(array $params)
    {
        $params['action'] = $this->action;
        $perPage = isset($params['per_page']) ? $params['per_page'] : 10;
        $sortBy = isset($params['sort_by']) ? $params['sort_by'] : 'id';
        $orderBy = isset($params['order_by']) ? $params['order_by'] : 'desc';
        $this->query = DB::table('users')
            ->leftJoin('possession_certificates', 'possession_certificates.user_id', 'users.id')
            ->join('areas', 'areas.id', 'users.area_id')
            ->select(
                'users.id AS id',
                'users.username AS username',
                'users.email AS email',
                'areas.area AS area',
                'possession_certificates.user_id AS user_id'
                );

        $this->query->orderBy($sortBy, $orderBy);
        if (isset($params['username'])) {
            $this->query->where('users.username', 'LIKE', '%' . $params['username'] . '%')
                ->orWhere('users.email', 'LIKE', '%' . $params['username'] . '%')
                ->orWhere('areas.area', 'LIKE', '%' . $params['username'] . '%');
                if($params['username'] == '有'){
                    $this->query->orWhere('possession_certificates.user_id','!=', '');
                }
                if($params['username'] == '無'){
                    $this->query->orWhere('possession_certificates.user_id', null);
                }
        }
        if (isset($params['current_id'])) {
            $this->getOlderPage($params['current_id'], $perPage);
        }
        Session::put('params', $params);
        return $this->query->paginate($perPage);
    }

    /**
     * Get user by credentials
     *
     * @param array $credentials
     * @return mixed
     */
    public function getUserByCredentials(array $credentials)
    {
//      $user = User::where('email', $credentials['email'])->where('device_id', $credentials['device_id'])->first();
        $user = User::where('email', $credentials['email'])->first();
//        if ($user && password_verify($credentials['password'], $user->password)) {
//            return $user;
//        }
        if ($user) {
            return $user;
        }
        return null;
    }

    /**
     * @param array $input
     * @param Request $request
     */
    public function createUser(array $input, Request $request)
    {
        $user = new User();
        $user->email = $input['email'];
        $user->password = password_hash($input['password'], PASSWORD_BCRYPT);
        $user->language_id = $input['language_id'];
        $user->username = $input['username'];
        $user->gender = $input['gender'];
        $user->area_id = $input['area_id'];
        $user->profession_id = $input['profession_id'];
        $user->phone = $input['phone'];
        $user->registration_date = date('Y-m-d H:i:s');
        $user->contents = $input['contents'];
        $user->device_id = $input['device_id'];
        if($request->hasFile('user_photo')){
            $file = $request->file('user_photo');
            $name = str_random(15).pathinfo($file)['filename'];
            $ext = $file->guessClientExtension();
            if(Storage::disk('s3')->putFileAs('image/common', $request->file('user_photo'), "{$name}.{$ext}", "public")){
                $user->user_photo = Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.'image/common'.DS.$name.'.'.$ext;
            }else{
                $user->user_photo = Constant::NO_IMAGE;
            }
        }
        $user->save();
    }

    /**
     * @param $id
     * @param array $input
     * @param Request $request
     */
    public function updateUser($id=null, array $input, Request $request)
    {
        if($id) {
            $user = User::find($id);
        }else{
            $user = new User();
        }
        $user->email = $input['email'];
        $user->password = password_hash($input['password'], PASSWORD_BCRYPT);
        $user->language_id = $input['language_id'];
        $user->username = $input['username'];
        $user->gender = $input['gender'];
        $user->area_id = $input['area_id'];
        $user->profession_id = $input['profession_id'];
        $user->phone = $input['phone'];
        $user->registration_date = date('Y-m-d H:i:s');
        $user->contents = $input['contents'];
        if($request->hasFile('user_photo')){
            $file = $request->file('user_photo');
            $name = str_random(15).pathinfo($file)['filename'];
            $ext = $file->guessClientExtension();
            if(Storage::disk('s3')->putFileAs('image/common', $request->file('user_photo'), "{$name}.{$ext}", "public")){
                $user->user_photo = Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.'image/common'.DS.$name.'.'.$ext;
            }else{
                $user->user_photo = Constant::NO_IMAGE;
            }
        }
        $user->save();
    }

    /**
     * @param $id
     * @param $request
     * @return mixed|static
     */
    public function uploadPhoto($id, $request)
    {
        $user = User::find($id);
        if($request->hasFile('user_photo')){
            $file = $request->file('user_photo');
            $name = str_random(15).pathinfo($file)['filename'];
            $ext = $file->guessClientExtension();
            if(Storage::disk('s3')->putFileAs('image/common', $request->file('user_photo'), "{$name}.{$ext}", "public")){
                $user->user_photo = Constant::S3_URL.DS.Constant::S3_BUCKET_URL.DS.'image/common'.DS.$name.'.'.$ext;
            }else{
                $user->user_photo = Constant::NO_IMAGE;
            }
        }
        $user->save();
        return $user;
    }

    /**
     * function get user with relations
     *
     * @return mixed
     */
    public function getUser()
    {
        return $this->query->with(['area', 'possession_certificates'])->get();
    }

    /**
     * function get user with relations and parameter id
     * @param $id
     * @return mixed
     */
    public function getUserByID($id)
    {
        return $this->query->with(['area', 'possession_certificates', 'language'])->find($id);
    }

    /**
     * Import CSV
     *
     * @param $data
     */
    public function importCSV($data)
    {
        $insert = array();
        foreach ($data->toArray() as $rows) {
            $record = array();
            $newEmail = $rows[0];
            if (!$this->exitsEmail($newEmail)) {
                foreach ($this->csvColumn as $key => $col) {
                    $record[$col] = $rows[$key];
                }
                $record["password"] = Hash::make($record["password"]);
                array_push($insert, $record);
            }
        }
        DB::beginTransaction();
        if (count($insert)) {
            try {
                $this->query->insert($insert);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
            }
        }
    }

    /**
     * Check if exists email
     *
     * @param $email
     * @return bool
     */
    public function exitsEmail($email)
    {
        return (bool)$this->query->where("email", $email);
    }

    /**
     * Update firebase token
     *
     * @param $id
     * @param $fireBaseToken
     */
    public function updateFireBaseToken($id, $fireBaseToken)
    {
        if ($fireBaseToken) {
            $user = User::find($id);
            $user->firebase_token = $fireBaseToken;
            $user->save();
        }
    }

    /**
     * Get last time user log in
     * @param $user_id
     * @return $lastLogin
     */
    public function getLastLogin($user_id) {
        $result = DB::table('logs_active_time')
                    ->select(DB::raw('MAX(start_time) as last_login'))
                    ->where('user_id', $user_id)->get()->first();
        $lastLogin = null;
        if (is_object($result)) {
            $lastLogin = $result->last_login;
        }
        return $lastLogin;
    }


    /**
     * Get number of days from last user login
     * @param $lastLogin
     * @return mixed
     */
    public function getUserNotificationDate($lastLogin) {
        $lastLogin = new \DateTime($lastLogin);
        $now = new \DateTime();
        $now->format('Y-m-d H:i:s');
        $interval = $lastLogin->diff($now);
        return $interval->format('%d');
    }


    /**
     * Send notification message for user
     * @param  User $user
     * @param string $notificationPeriod
     * @return string
     */
    public function sendUserNotificationMessage(User $user,  $notificationPeriod) {
        // Include push notification library
        require_once base_path('app/Console/push_notifications.php');
        $link = 'http://amec.adnet.space/';
        $title = 'AMEC';
        $result = null;
        $term = NotificationSetting::where('language_id', '=', $user->language_id)->first();
        for ($i = 1; $i <= 4; $i++) {
			$noti_setting = 'notification_' . $i . '_setting';
			$noti_term = 'notification_' . $i . '_term';
			$noti_desc = 'notification_' . $i . '_description';
			if ($term->{$noti_setting} == 1 && $term->{$noti_term} == $notificationPeriod) {
				if (!empty($user->firebase_token)) {
					push_notification_Android($title, $term->{$noti_desc}, $user->firebase_token, $link);
				}
				
				if (!empty($user->ios_token)) {
					push_notification_iOS($title, $term->{$noti_desc}, $user->ios_token, $link);
				}
				
			}
		}
    }

    /**
     * Push notification messages to all users
     */
    public function userPushNotification() {
        $notificationUsers = $this->getAll();
        foreach ($notificationUsers as $user) {
            $lastLogin = $this->getLastLogin($user->id);
            $notificationPeriod = $this->getUserNotificationDate($lastLogin);
			try {
				$this->sendUserNotificationMessage($user, $notificationPeriod);
			}
			catch(\Exception $e) {
				\Log::info($e->getMessage());
				continue;
			}  
        }
    }

}