<?php

namespace App\Providers;

use App\Models\Comment;
use App\Policies\CommentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        // Comment::class => CommentPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //gate
        //define
        // Gate::define('edit-comment', function (User $user, Comment $comment) {
        //     return $user->id == $comment->user_id;
        // });

        // Gate::define('update-comment', [CommentPolicy::class, 'update']);

        //before
        // Gate::before(function (User $user, $ability) {
        //     //if($user->isSuperAdmin())
        //     if (false) {
        //         return true; // cho phép truy cập tất cả
        //     } else {
        //         //return false; // không cho phép truy cập tất
        //         return null; // tiếp tục gate tiếp theo
        //     }
        // });

        //after
        // Gate::after(function(User $user, $ability, $result, $arguments) {

        // });


        //policy

        // Gate::define('comments.view', 'CommentPolicy@view');
        // Gate::define('comments.create', 'CommentPolicy@create');
        // Gate::define('comments.update', 'CommentPolicy@update');
        // Gate::define('comments.delete', 'CommentPolicy@delete');

        Gate::resource('comments', 'CommentPolicy');
    }
}
