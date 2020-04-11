<?php

namespace Src\App\Post\Responder\Transformers;

use Src\App\Post\Domain\Model\Post;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
	public function transform(Post $post)
	{
		return [
			'id'	=>	(int) $post->id,
			'title' => $post->title,
			'slug'	=> $post->slug,
			'short_description' => (string) $post->short_description,
			'created_at' => $post->created_at->format('Y-m-d')
		];
	}
}