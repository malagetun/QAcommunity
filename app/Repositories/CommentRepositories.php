<?php

namespace App\Repositories;
use App\Comment;

/**
 * Class CommentRepositories
 *
 * @package \App\Repositories
 */
class CommentRepositories
{
    public function create(array $attributes){
        return Comment::create($attributes);
    }
}
