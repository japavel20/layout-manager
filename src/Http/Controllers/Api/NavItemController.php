<?php

namespace Layout\Manager\Http\Controllers\Api;

use Layout\Manager\Models\NavItem;
use Pondit\Authorize\Models\Role;

class NavItemController extends NavItemBaseController
{
    public function getNavitemWithSelected($roleId)
    {
        $role = Role::find($roleId);



        $navitems = NavItem::all()->sortBy('title');

        $collection = [];
        foreach ($navitems as $navitem) {
            if ($role->navitems->contains($navitem->id)) {
                $collection[] = ['id' => $navitem->id, 'title' => $navitem->title, 'isSelected' => 1];
            } else {
                $collection[] = ['id' => $navitem->id, 'title' => $navitem->title, 'isSelected' => 0];
            }
        }
        $navItems = collect($collection)->chunk(count($collection) / 2);
        return response()->json($navItems, 200);
    }
}
