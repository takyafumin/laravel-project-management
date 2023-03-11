<?php

namespace Tag\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Types\Tag;

/**
 * Tag Index Controller
 */
class TagIndexController extends Controller
{
    /**
     * index
     *
     * @param  Tag $tag タグ
     * @return string
     */
    public function index(
        Tag $tag
    ): string {
        return $tag->message();
    }
}
