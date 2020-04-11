<?php

namespace Src\Shared\Http;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
	protected $guarded = [];

	/**
     * store method is using to create / update
     *
     * @param $data
     * @return obj
     */
	public function store(array $data) : object
	{
		$id = isset($data['id']) ? $data['id'] : null;

        if ($model = $this->findOrNew($id)) {
            $model->fill($data)->save();
            return $model;
        }
	}
}