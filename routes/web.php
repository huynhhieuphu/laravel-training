<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\Builder;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $users = DB::table('users')->get();
//    dd($users);

    $user = DB::table('users')->first();
//    dd($user);

    $users = DB::table('users')
        ->select('user_firstname', 'user_email')
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->select('user_firstname AS firstname', 'user_email AS email')
        ->get();
    dd($users);
});

Route::get('/where', function () {
    $users = DB::table('users')
        ->where('user_id', 1)
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->where('user_id', '=', 1)
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->where('user_id', '>', 4)
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->where('user_id', '<', 4)
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->where('user_id', '<>', 4)
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->where('user_id', '!=', 4)
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->where('user_group_id', '=', 1)
        ->where('user_status', '=', 1)
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->where([
            ['user_group_id', '=', 1],
            ['user_status', '=', 1]
        ])->get();
//    dd($users);

    $users = DB::table('users')
        ->where('user_group_id', '=', 1)
        ->orWhere('user_lastname', '=', 'le')
        ->get();
//    dd($users);

    $user_id = 1;
    $users =
        DB::table('users')
            ->where('user_group_id', '=', 2)
            ->orWhere(function ($query) use ($user_id) {
                $query->where('user_lastname', '=', 'huynh')
                    ->where('user_id', $user_id);
            })->get();
//    dd($users);

    $users = DB::table('users')
        ->where('user_email', 'LIKE', '%local%')
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->whereBetween('user_id', [2, 5])
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->whereNotBetween('user_id', [2, 5])
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->whereIn('user_group_id', [1, 2])
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->whereNotIn('user_group_id', [1, 2])
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->whereNull('user_updated_at')
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->whereNotNull('user_updated_at')
        ->get();
//    dd($users);
});

Route::get('/date', function () {
    $users =
        DB::table('users')
            ->whereDate('user_created_at', '2023-04-01')
            ->get();
//   dd($users);

    $users = DB::table('users')
        ->whereYear('user_created_at', '2022')
        ->get();
//   dd($users);

    $users = DB::table('users')
        ->whereMonth('user_created_at', '03')
        ->get();
//   dd($users);

    $users = DB::table('users')
        ->whereDay('user_created_at', '01')
        ->get();
//   dd($users);

    $users = DB::table('users')
        ->whereColumn('user_created_at', 'user_updated_at')
        ->get();
//   dd($users);

    $users = DB::table('users')
        ->whereColumn('user_created_at', '<', 'user_updated_at')
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->whereColumn([
            ['user_created_at', '<', 'user_updated_at'],
            ['user_group_id', '=', 'user_status']
        ])
        ->get();
//    dd($users);
});

Route::get('/join', function () {
    $users = DB::table('users')
        ->join('groups', 'group_id', 'user_group_id')
        ->get();
//   dd($users);

    $users = DB::table('users')
        ->select('users.*', 'groups.group_name')
        ->join('groups', 'group_id', 'user_group_id')
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->leftJoin('groups', 'group_id', 'user_group_id')
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->rightJoin('groups', 'group_id', 'user_group_id')
        ->get();
    dd($users);
});

Route::get('/order', function () {
    $users = DB::table('users')
        ->orderBy('user_id', 'desc')
        ->get();
//   dd($users);

    $users = DB::table('users')
        ->orderBy('user_group_id', 'desc')
        ->orderBy('user_id', 'desc')
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->inRandomOrder()
        ->get();
    dd($users);
});

Route::get('/group', function () {
    $users = DB::table('users')
        ->select(DB::raw('count(user_group_id) as count_group'), 'user_group_id')
        ->groupBy('user_group_id')
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->select(DB::raw('count(user_group_id) as count_group'), 'user_group_id')
        ->groupBy('user_group_id')
        ->having('count_group', '=', 1)
        ->get();
    dd($users);
});

Route::get('/limit', function () {
    $users =
        DB::table('users')
            ->offset(2)
            ->limit(3)
            ->get();
//    dd($users);

    $users =
        DB::table('users')
            ->skip(2)
            ->take(3)
            ->get();
    dd($users);
});

Route::get('/insert', function () {
//    $user = DB::table('users')->insert(
//        [
//            'user_firstname' => 'thao',
//            'user_email' => 'thao@gmail.com',
//            'user_group_id' => 3,
//            'user_status' => 1,
//            'user_created_at' => date('Y-m-d', time())
//        ]
//    );

//    $user = DB::table('users')->insert([
//        [
//            'user_firstname' => 'linh',
//            'user_lastname' => 'bui',
//            'user_email' => 'linh@gmail.com',
//            'user_group_id' => 3,
//            'user_status' => 1,
//            'user_created_at' => date('Y-m-d', time())
//        ],
//        [
//            'user_firstname' => 'phan',
//            'user_lastname' => 'bui',
//            'user_email' => 'phan@gmail.com',
//            'user_group_id' => 3,
//            'user_status' => 1,
//            'user_created_at' => date('Y-m-d', time())
//        ],
//    ]);

//    $user = DB::table('users')->insert(
//            [
//                'user_firstname' => 'test',
//                'user_email' => 'test@gmail.com',
//                'user_group_id' => 3,
//                'user_status' => 1,
//                'user_created_at' => date('Y-m-d', time())
//            ]
//        );
//    $userId = DB::getPdo()->lastInsertId();
//    dd($userId);

//    $userId = DB::table('users')->insertGetId(
//        [
//            'user_firstname' => 'demo',
//            'user_email' => 'demo@gmail.com',
//            'user_group_id' => 3,
//            'user_status' => 1,
//            'user_created_at' => date('Y-m-d', time())
//        ]
//    );
//    dd($userId);
});

Route::get('/update', function () {
//    $user = DB::table('users')
//        ->where('user_id', 14)
//        ->update([
//            'user_lastname' => 'choi',
//            'user_updated_at' => date('Y-m-d H:i:s', time())
//        ]);
//    dd($user);
});

Route::get('/delete', function () {
//    $user = DB::table('users')
//        ->where('user_id', 15)
//        ->delete();
//    dd($user);
});

Route::get('/count', function () {
    $count = DB::table('users')->count();
    dd($count);
});

Route::get('/raw', function () {
    $users = DB::table('users')
        ->select(DB::raw('count(user_id) as count_user'))
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->selectRaw('count(?) as count_user', ['user_id'])
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->whereRaw('user_group_id = ?', [3])
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->where('user_group_id', 2)
        ->orWhereRaw('user_lastname = ?', ['nguyen'])
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->orderByRaw('user_firstname asc, user_id desc')
        ->get();
//    dd($users);


    $users = DB::table('users')
        ->selectRaw('count(?) as count_group, user_group_id', ['user_group_id'])
        ->groupByRaw('user_group_id')
        ->havingRaw('count_group >= 3')
        ->get();
//    dd($users);

    $users = DB::table('users')
        ->where('user_group_id', function (Builder $query){
            $query->select('group_id')
                ->from('groups')
                ->where('group_name', 'admin');
        })->get();
//    dd($users);

    $users = DB::table('users')
        ->whereIn('user_group_id', function (Builder $query){
            $query->select('group_id')
                ->from('groups')
                ->where('group_id','>=', 2);
        })->get();
    dd($users);
});

Route::get('/debug', function () {
    $users = DB::table('users')->toSql();
//   dd($users);

    DB::enableQueryLog();

    //Truy vấn Query Builder
    $users = DB::table('users')->get();

    dd(DB::getQueryLog());
});

