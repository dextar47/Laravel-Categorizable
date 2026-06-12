<?php

namespace AliBayat\LaravelCategorizable\Tests;

use Spatie\Sluggable\Actions\GenerateSlugAction;
use Spatie\Sluggable\SlugOptions;

class CustomGenerateSlugAction extends GenerateSlugAction
{
    protected \Illuminate\Database\Eloquent\Model $model;

    protected function generateNonUniqueSlug(\Illuminate\Database\Eloquent\Model $model, SlugOptions $options): string
    {
        $this->model = $model;
        return parent::generateNonUniqueSlug($model, $options);
    }

    public function slugifySource(string $source, SlugOptions $options): string
    {
        if (isset($this->model) && method_exists($this->model, 'slugifySource')) {
            return $this->model->slugifySource($source, $options);
        }
        return parent::slugifySource($source, $options);
    }
}
