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
            . 'conversions'
            . '/';
    }

    /**
     * @param Media $media
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media)
            . 'responsive-images'
            . '/';
    }


    /**
     * Get a unique base path for the given media.
     * @param Media $media
     * @return string
     */
    protected function getBasePath(Media $media): string
    {
        $base_name = class_basename($media->model_type);
        $path = Str::kebab(Str::pluralStudly($base_name));

        $base_path = Str::plural($path)
            . '/' . str_replace('_', '-', $media->collection_name)
            . '/' . $media->getKey();

        if ($prefix = config('media-library.prefix')) {
            return $prefix . '/' . $base_path . '/';
        }

        return $base_path . '/';
    }
}
