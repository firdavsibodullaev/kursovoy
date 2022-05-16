<?php

namespace App\Spatie;

use App\Models\BaseModel;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{

    /**
     * @param Media $media
     * @return string
     */
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media);
    }

    /**
     * @param Media $media
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media)
            . 'conversations'
            . DIRECTORY_SEPARATOR;
    }

    /**
     * @param Media $media
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media)
            . 'responsive-images'
            . DIRECTORY_SEPARATOR;
    }


    /**
     * Get a unique base path for the given media.
     * @param Media $media
     * @return string
     */
    protected function getBasePath(Media $media): string
    {
        /** @var BaseModel $class */
        $class = $media->model;

        $base_name = class_basename($class);
        $path = Str::kebab(Str::pluralStudly($base_name));

        $base_path = Str::plural($path)
            . DIRECTORY_SEPARATOR . str_replace('_', '-', $media->collection_name)
            . DIRECTORY_SEPARATOR . $media->getKey();

        if ($prefix = config('media-library.prefix')) {
            return $prefix . DIRECTORY_SEPARATOR . $base_path . DIRECTORY_SEPARATOR;
        }

        return $base_path . DIRECTORY_SEPARATOR;
    }
}
