<?php

namespace Src\App\Post\Domain\Model;

use Src\Shared\Http\BaseModel;
use Src\App\Category\Domain\Model\Category;

class Post extends BaseModel
{
	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function user()
	{
		// author info for future		
	}
}