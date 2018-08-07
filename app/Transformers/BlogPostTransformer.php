<?php

namespace App\Transformers;

use App\Transformers\TransformerAbstract;
use DateTime;

class BlogPostTransformer extends TransformerAbstract
{
    /**
     * Format the blog post
     *
     * @param array $blogPost
     * @return array
     */

    public function transform($blogPost)
    {
        if (!is_null($blogPost)) {
            return [
                'id' => $blogPost['id'],
                'title' => $blogPost['title'],
                'contentTruncated' => $this->substrTextOnly($blogPost['content'], 100, '...'),
                'content' => $blogPost['content'],
                'authorName' => $blogPost['user']['name'],
                'authorEmail' => $blogPost['user']['email'],
                'dateDiff' => formatDateDiff($blogPost['updated_at']),
                'date' => date_format(new DateTime($blogPost['updated_at']), 'F j, Y'),
                'commentsCount' => $blogPost['comments_count'],
            ];
        }
        return null;
    }

    /**
     * Limit the text to be display
     * source: https: //gist.github.com/escapeboy/39ab26e35711f6fbce84
     *
     * @param string $string
     * @param int $limit
     * @param string $end
     */
    private function substrTextOnly($string, $limit, $end = '...')
    {
        $with_html_count = strlen($string);
        $without_html_count = strlen(strip_tags($string));
        $html_tags_length = $with_html_count - $without_html_count;

        return str_limit($string, $limit + $html_tags_length, $end);
    }
}
