<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
/**
 * Class MessagesCollection
 *
 * @package \App
 */
class MessagesCollection extends collection
{
    public function markAsRead(){
        $this->each(function ($message){
            if($message->to_user_id===user()->id){
                $message->markAsRead();
            }
        });
    }
}
