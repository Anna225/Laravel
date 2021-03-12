<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    /**
     * $menu->add('Home',     '#')->data('color', 'red');
     * $menu->add('Home',     ['route'  => 'home.page',  'class' => 'navbar navbar-home', 'id' => 'home']);
     * $menu->add('About',    ['route'  => 'page.about', 'class' => 'navbar navbar-about dropdown']);
     * $menu->add('services', ['action' => 'ServicesController@index']);
     * $menu->add('About',    ['route'  => 'page.about']);
     * $menu->add('Level2', ['url' => 'Link address', 'parent' => $menu->about->id]);
     * $menu->add('Contact',  'contact');
     * $about = $menu->add('About',    ['route'  => 'page.about', 'class' => 'navbar navbar-about dropdown']);
     * $about->link->attr(['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown']);
     * $menu->about->attr(['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'])
     *         ->append(' <b class="caret"></b>')
     *         ->prepend('<span class="glyphicon glyphicon-user"></span> ');
     */

    /* <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Users
            <i class="right fas fa-angle-left"></i>
            </p>
        </a> */
    public function handle($request, Closure $next)
    {
        /* \Menu::make('AdminMenu', function($menu){
            $menu->group(['prefix' => 'admin'], function($admin){
                $users = $admin->add('<p>Users</p>',  ['route'  => 'admin.users.index', 'class' => 'nav-item'])
                            ->append('<i class="right fas fa-angle-left"></i>')
                            ->prepend('<i class="nav-icon fas fa-users"></i>');
                $users->link->attr(['class' => 'nav-link']);
                
                $users->add('Dropdown', ['class' => 'nav-item'])
                        ->parent(['class' => 'nav nav-treeview']);

            });
        }); */
        return $next($request);
    }
}
