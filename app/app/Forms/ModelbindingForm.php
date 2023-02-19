<?php

namespace App\Forms;

use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\Components\FormBuilder\Datetime;
use ProtoneMedia\Splade\Components\FormBuilder\Select;
use ProtoneMedia\Splade\Components\FormBuilder\Submit;
use ProtoneMedia\Splade\Components\FormBuilder\Text;
use ProtoneMedia\Splade\Components\FormBuilder\Textarea;
use ProtoneMedia\Splade\SpladeForm;

class ModelbindingForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('formbuilder.model.store'))
            ->method('POST')
            ->class('space-y-4');
    }

    public function fields(): array
    {
        return [
            Datetime::make('publish_from')
                ->label(__('Publish from')),

            Text::make('title')
                ->label(__('Title')),

            Text::make('slug')
                ->label(__('Slug')),

            Textarea::make('body')
                ->label(__('Body'))
                ->autosize(),

            Select::make('tags')
                ->label(__('Tags'))
                ->multiple()
                ->choices()
                ->options([
                    'laravel' => 'laravel',
                    'splade' => 'splade',
                    'test' => 'test',
                    'formbuilder' => 'formbuilder',
                    'options' => 'options',
                ]),

            Submit::make()->label(__('Save')),
        ];
    }
}