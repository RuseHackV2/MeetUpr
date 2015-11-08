<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getUserTags($userId)
    {
        $userTags = \DB::table('tag_user')
            ->join('tags', 'tag_user.tag_id', '=', 'tags.id')
            ->groupBy('tags.id')
            ->select(array('tags.name', \DB::raw('count(tags.id) AS count_tags')))
            ->where('user_id', '=', $userId)
            ->get();

        $result = [];
        if(!empty($userTags))
        {
            foreach($userTags as $userTag) {
                $result[] = [
                    'name' => $userTag->name,
                    'count_tags' => $userTag->count_tags,
                ];
            }
        }

        return response()->json($result);
    }

    public function addUserTag($userId, $tagId)
    {
        $count = (\DB::table('tag_user')
            ->where('from_user_id', '=', \Auth::user()->id)
            ->where('user_id', '=', $userId)
            ->where('tag_id', '=', $tagId)
            ->count());

        //todo check if player has game with $userId

        if(\Auth::user()->id == $userId) {
            return response()->json(['success' => false]);
        }

        if($count != 0) {
            return response()->json(['success' => false]);
        }

        try {
            \DB::table('tag_user')->insert([
                'from_user_id' => \Auth::user()->id,
                'user_id' => $userId,
                'tag_id' => $tagId,
                'created_at' => date('Y-m-d H:i')
            ]);
        }catch (\Exception $e) {
            return response()->json(['success' => false]);
        }

        return response()->json(['success' => true]);
    }
}