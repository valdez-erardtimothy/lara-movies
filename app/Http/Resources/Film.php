<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Film extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->film_title, 
            'story' => $this->story,
            'release_date' => $this->release_date,
            'duration' => $this->duration,
            'additional_info' => $this->additional_info,
            'genre' => $this->genre->genre,
            'image' => $this->getFirstMediaUrl(),
            'link' => action('FilmController@show', $this->id)
        ];
    }
}
