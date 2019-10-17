<?php

namespace App\Listeners;

use DevDojo\Chatter\Events\ChatterAfterNewDiscussion;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class HandleNewDiscussion
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ChatterAfterNewDiscussion  $event
     * @return void
     */
    public function handle(ChatterAfterNewDiscussion $event)
    {
        dd($event->discussion['id']);
        $usersToTag = $event->request->input('userTag');
        foreach( $usersToTag as $user ){
            $theUser = User::find($user);
            $theUser->tag($event->discussion['id']);
        }
    }
}
