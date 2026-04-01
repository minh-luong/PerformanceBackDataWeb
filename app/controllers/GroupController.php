<?php

namespace App\Controllers;

use App\Cores\Controller;
use App\Cores\Auth;
use App\Models\Group;

require_once '../app/cores/Controller.php';

class GroupController extends Controller
{
    public function joinedGroupsPage()
    {
        $this->view('groups/groups', [
            'menuItems' => Auth::menuItems(),
            'groups' => $this->model(Group::class)->getJoinedGroups()
        ]);
    }

    public function groupMemberPage($id)
    {
        $this->view('groups/group_member', [
            'menuItems' => Auth::menuItems(),
            'group' => $this->model(Group::class)->getGroupById($id),
            'members' => $this->model(Group::class)->getMembersByGroupId($id)
        ]);
    }
}
?>