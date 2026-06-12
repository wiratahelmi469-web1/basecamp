<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Str;

class PostObserver
{
    public function creating(Post $post): void
    {
        if (empty($post->slug)) {
            $post->slug = Str::slug($post->title);
        }

        if (
            $post->status === 'published' &&
            !$post->published_at
        ) {
            $post->published_at = now();
        }
    }

    public function updating(Post $post): void
    {
        if ($post->isDirty('title')) {

            $post->slug = Str::slug($post->title);
        }

        if (
            $post->status === 'published' &&
            !$post->published_at
        ) {
            $post->published_at = now();
        }

        if (
            $post->status === 'draft'
        ) {
            $post->published_at = null;
        }
    }

    public function deleted(Post $post): void
    {
        //
    }

    public function restored(Post $post): void
    {
        //
    }

    public function forceDeleted(Post $post): void
    {
        //
    }
}
