<?php

namespace App\Transformers;

use App\Models\Image;

class ImageTransformer extends BaseTransformer
{
    /**
     * @param Image|null $image
     * @return array|\League\Fractal\Resource\NullResource
     */
    public function transform(?Image $image)
    {
        if (is_null($image)) {
            return $this->null();
        }
        return [
            'hash' => $image->hash,
            'mime' => $image->mime,
            'width' => $image->width,
            'height' => $image->height,
            'url' => $image->getUrl(),
            'cover_url' => $image->getUrl('cover_url'),
            'is_gif' => str_contains($image->mime, 'gif'),
            // 高宽比大于等于 3 认为是长图
            'is_high' => $image->height / $image->width >= 3
        ];
    }
}
