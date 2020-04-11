<?php

namespace Src\App\Post\Responder\Transformers;

use Src\App\Post\Domain\Model\Post;
use League\Fractal\TransformerAbstract;
use Src\App\Category\Domain\Model\Category;

class SinglePostTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['category'];

	public function transform(Post $post)
	{
		return [
			'id'	=>	(int) $post->id,
			'title' => $post->title,
			'full_description' => (string) $post->full_description,
			'created_at' => $post->created_at->format('Y-m-d'),
			'category' => $post->category
		];
	}

	public function includeCategory(Post $post)
	{
		return $this->item($post->category, new CategoryTransformer);
	}
}


class CategoryTransformer extends TransformerAbstract
{
	public function transform(Category $category)
	{
		return [
			'name' => $category->name,
			'slug' => $category->slug,
		];
	}
}

