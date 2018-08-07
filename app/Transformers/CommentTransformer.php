<?php

namespace App\Transformers;

use App\Transformers\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{
    /**
     * Format the comment
     *
     * @param array $comment
     * @return array
     */

    public function transform($comment)
    {
        if (!is_null($comment)) {
            return [
                'id' => $comment['id'],
                'body' => $comment['body'],
                'author' => $comment['user']['name'],
                'dateDiff' => formatDateDiff($comment['updated_at']),
            ];
        }
        return null;
    }

}
