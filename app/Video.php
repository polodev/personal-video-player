<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
	protected $guarded = [];
	public function series()
	{
		return $this->belongsTo(Series::class, 'series_id');
	}
 //for adding avatar_url
	// able to access full_path_with_prefix
	// Or FullPathWithPrefix
  public function getFullPathWithPrefixAttribute() {
  	$path_name = $this->path_name;
    return "file://" . $path_name;
  }

  public function video_index() {

  	$videos = Video::where('series_id', $this->series_id)->get()->toArray();

  	foreach($videos as $key => $video) {
  		if ($video['id'] === $this->id) {
  			return $key;
  		}
  	}

  	return 0;

  	// return $videos->first()->extension;
  }

}
