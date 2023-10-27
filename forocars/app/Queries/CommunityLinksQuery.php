<?php

namespace App\Queries;

use App\Models\Channel;
use App\Models\CommunityLink;

class CommunityLinksQuery
{
    public function getByChannel(Channel $channel = null, $popular = false)
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

    public function getAll($popular = false)
    {
        return $this->getByChannel(null, $popular);
    }

    public function getMostPopular()
    {
        return $this->getByChannel(null, true);
    }
}
