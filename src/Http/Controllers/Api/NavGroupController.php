<?php

namespace Layout\Manager\Http\Controllers\Api;

use Layout\Manager\Models\NavGroup;
use Layout\Manager\Models\NavItem;

class NavGroupController extends NavGroupBaseController
{
    public function getNavItemWithSelected($locationId)
    {
        $navGroup = NavGroup::find($locationId);

        $navItems = NavItem::all();

        $collection = [];
        foreach ($navItems as $navItem) {
            if ($navGroup->navItems->contains($navItem->id)) {
                $collection[] = ['id' => $navItem->id, 'title' => $navItem->title, 'isSelected' => 1];
            } else {
                $collection[] = ['id' => $navItem->id, 'title' => $navItem->title, 'isSelected' => 0];
            }
        }

        return response()->json($collection, 200);
    }
}
