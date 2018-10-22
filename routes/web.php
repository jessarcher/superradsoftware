<?php

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
    return view('welcome');
});

Route::get('/database', function () {
    App\User::updateOrCreate(
        [
            'id' => 1,
        ],
        [
            'name' => 'Jess',
            'email' => 'jess@example.com',
            'password' => bcrypt(str_random(32)),
        ]
    );

    dump(
        App\User::all()
    );
});

Route::get('/cache', function () {
    $users = Cache::remember('users', $minutes = 1, function () {
        dump('fetching users from DB...');

        return App\User::all();
    });

    dump($users);

    $id = 1;

    $user = Cache::remember('user:' . $id, $minutes = 1, function () use ($id) {
        dump('fetching user from DB...');

        return App\User::findOrFail($id);
    });

    dump($user);
});

Route::get('/cache/forget', function () {
    dump(
        Cache::forget('user:' . 1),
        Cache::forget('users')
    );
});
