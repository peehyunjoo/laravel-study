<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $fillatble=['name','slug'];
	
	public function articles(){
		return $this->belongsToMany(Article::class);

	}
}
