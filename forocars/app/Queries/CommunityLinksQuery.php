<?php

namespace App\Queries;

use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinksQuery
{
    public function getByChannel(Channel $channel = null, $popular = false, $search = null)
    {
        $query = CommunityLink::where('approved', true);

        if ($channel !== null) {
            $query->where('channel_id', $channel->id);
        }

        if ($popular) {
            $query->withCount('users')->orderBy('users_count', 'desc');     
        } else {
            $query->latest('updated_at');
        }

        return $query->paginate(5);
    }

    public function getAll($popular = false, $search = null)
    {
        return $this->getByChannel(null, $popular, $search);
    }

    public function getMostPopular($search = null)
    {
        return $this->getByChannel(null, true, $search);
    }
    
    public function getSearch($search = null, $popular = false)
    {
        $query = CommunityLink::where(function ($query) use ($search) {
            foreach ($search as $value) {
                $query->orWhere('title', 'LIKE', "%$value%");
            }
        });
    
        if ($popular) {
            $query->withCount('users')->orderBy('users_count', 'desc');
        } else {
            $query->latest('updated_at');
        }
    
        return $query->paginate(5);
    }
    
}
