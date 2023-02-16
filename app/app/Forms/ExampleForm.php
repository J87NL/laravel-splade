<?php

namespace App\Forms;

use ProtoneMedia\Splade\AbstractForm;
use ProtoneMedia\Splade\Components\FormBuilder\Checkbox;
use ProtoneMedia\Splade\Components\FormBuilder\Color;
use ProtoneMedia\Splade\Components\FormBuilder\Date;
use ProtoneMedia\Splade\Components\FormBuilder\Email;
use ProtoneMedia\Splade\Components\FormBuilder\Hidden;
use ProtoneMedia\Splade\Components\FormBuilder\Input;
use ProtoneMedia\Splade\Components\FormBuilder\Number;
use ProtoneMedia\Splade\Components\FormBuilder\Password;
use ProtoneMedia\Splade\Components\FormBuilder\Radio;
use ProtoneMedia\Splade\Components\FormBuilder\Select;
use ProtoneMedia\Splade\Components\FormBuilder\Submit;
use ProtoneMedia\Splade\Components\FormBuilder\Text;
use ProtoneMedia\Splade\Components\FormBuilder\Textarea;
use ProtoneMedia\Splade\Components\FormBuilder\Time;
use ProtoneMedia\Splade\SpladeForm;

class ExampleForm extends AbstractForm
{
    public function configure(SpladeForm $form)
    {
        $form
            ->action(route('formbuilder.fromClass.store'))
            ->method('POST')
            ->class('space-y-4')
            ->data([
                'hiddenInput1' => 'Test value hidden input 1',
                'hiddenInput2' => 'Test value hidden input 2',
                'inputText1' => 'Test value input text field 1',
                'disabledTextField' => 'This field is dissabled',
                'readonlyTextField' => 'This field is readonly',
                'disabledAndReadonlyTextField' => 'This field is disabled and readonly',
                'colorInput1' => '#ffffff',
                'colorInput2' => '#cccccc',
                'colorInput3' => '#999999',
            ]);
    }

    public function fields(): array
    {
        return [
            Hidden::make('hiddenInput1')
                ->label('Hidden field using Hidden::make()'),

            Input::make('hiddenInput2')
                ->label('Hidden Input using ->hidden()')
                ->hidden(),

            Input::make('inputText1')
                ->label('Standard input text field')
                ->help('Test help 1')
                ->rules('required'),

            Input::make('inputText2')
                ->label('Input text field (minlength: 2, maxlength: 255)')
                ->placeholder('Placeholder...')
                ->minLength(2)
                ->maxLength(255)
                ->rules('required|max:255'),

            Input::make('inputText3')
                ->label('Input text field with fixed length(6)')
                ->length(6)
                ->prepend('Test prepend'),

            Number::make('inputNumber')
                ->label('Input number field (min 1, max 100)')
                ->numeric()
                ->minValue(1)
                ->maxValue(100)
                ->append('Test append'),

            Number::make('testNumberInput')
                ->label('Or as Number-alias field')
                ->prepend('Test prepend')
                ->append('Test append'),

            Number::make('testNumberInput2')
                ->label('Number field with ->unsigned()')
                ->unsigned(),

            Number::make('testNumberInput3')
                ->label('Number field with ->step(0.01)')
                ->step(0.01),

            Number::make('testNumberInput4')
                ->label('Number field with ->step(10)')
                ->step(10),

            Email::make('inputEmail2')
                ->label('Email field'),

            Input::make('inputEmail3')
                ->label('Input ->email() field')
                ->email(),

            Password::make('inputPassword2')
                ->label('Password field with validation: ->min(8) and ->symbols()')
                ->rules('required', 'string', 'max:255', \Illuminate\Validation\Rules\Password::min(8)->symbols()),

            Input::make('inputPassword3')
                ->label('Input ->password() field')
                ->password(),

            Date::make('inputDate4')
                ->label('Input type: date - with extra FlatPicker date-options: { showMonths: 2 }')
                ->date(['showMonths' => 2]),

            Date::make('inputDate5')
                ->label('Input type: date with time')
                ->time(),

            Date::make('inputDate6')
                ->label('Input type: date with range')
                ->range()
                ->help('Test help 2'),

            Time::make('inputTime1')
                ->label('Input time field - with extra FlatPicker time-options: { time_24hr: false }')
                ->time(['time_24hr' => false]),

            Time::make('inputTime2')
                ->label('Input type: time'),

            Text::make('textField')
                ->label('Text-input (Input-alias)'),

            Text::make('disabledTextField')
                ->label('Disabled text field')
                ->disabled(),

            Text::make('readonlyTextField')
                ->label('Readony text field')
                ->readonly(),

            Text::make('disabledAndReadonlyTextField')
                ->label('Disabled and readony text field')
                ->disabled()
                ->readonly(),

            Text::make('requiredTextInput1')
                ->label('This field is required()')
                ->required(),

            Text::make('requiredTextInput2')
                ->label('This field has both rules(required) and is required()')
                ->placeholder('which is unnecessarily but should still work anyways')
                ->rules('required', 'string')
                ->required(),

            Textarea::make('testTextarea1')
                ->label('Textarea'),

            Textarea::make('testTextarea2')
                ->label('Textarea (with autosize) and an array of rules')
                ->autosize()
                ->help('Test help 3')
                ->rules(['required', 'string', 'max:10']),

            Checkbox::make('testCheckbox[]')->label('Checkbox 1')->value('checkbox-1'),
            Checkbox::make('testCheckbox[]')->label('Checkbox 2')->value('checkbox-2')->help('Test help 4'),

            Radio::make('testRadio')->label('Radio 1')->value('radio-1'),
            Radio::make('testRadio')->label('Radio 2')->value('radio-2'),
            Radio::make('testRadio')->label('Radio 3')->value('radio-3')->help('Test help 5'),

            Select::make('testSelect')
                ->label('Choose a country')
                ->placeholder('Placeholder...')
                ->options([
                    'be' => 'Belgium',
                    'de' => 'Germany',
                    'fr' => 'France',
                    'lu' => 'Luxembourg',
                    'nl' => 'The Netherlands',
                ]),

            Select::make('testSelectWithoutChoices')
                ->label('Choose a country - choices(false)')
                ->placeholder('Placeholder...')
                ->options([
                    'be' => 'Belgium',
                    'de' => 'Germany',
                    'fr' => 'France',
                    'lu' => 'Luxembourg',
                    'nl' => 'The Netherlands',
                ])
                ->choices(false),

            Select::make('testSelectMultiple[]')
                ->label('Choose multiple countries')
                ->placeholder('Placeholder...')
                ->options([
                    'be' => 'Belgium',
                    'de' => 'Germany',
                    'fr' => 'France',
                    'lu' => 'Luxembourg',
                    'nl' => 'The Netherlands',
                ])
                ->multiple(),

            Select::make('testSelectMultipleWithExtraChoicesOptions[]')
                ->label('Choose multiple countries - with extra Choices.js-options: { searchEnabled: false }')
                ->placeholder('Placeholder...')
                ->options([
                        'be' => 'Belgium',
                        'de' => 'Germany',
                        'fr' => 'France',
                        'lu' => 'Luxembourg',
                        'nl' => 'The Netherlands',
                    ])
                ->multiple()
                ->choices(['searchEnabled' => false ]),

            Select::make('testSelectMultipleWithoutChoices[]')
                ->label('Choose multiple countries - choices(false)')
                ->placeholder('Placeholder...')
                ->options([
                    'be' => 'Belgium',
                    'de' => 'Germany',
                    'fr' => 'France',
                    'lu' => 'Luxembourg',
                    'nl' => 'The Netherlands',
                ])
                ->multiple()
                ->choices(false),

            Select::make('fromRemoteUrl')
                ->label('Select with data from a remote URL')
                ->remoteUrl('/api/users1')
                ->choices(false),

            Select::make('fromRemoteUrlWithRemoteRoot')
                ->label('Select with data from a remote URL with a remote root')
                ->remoteUrl('/api/users2')
                ->remoteRoute('data.users')
                ->optionLabel('name')
                ->optionValue('id')
                ->choices(false),

            Select::make('withOptionLabelAndValue')
                ->label('Select with Option Label and Value')
                ->options([
                    ['id' => 10, 'name' => 'Pascal'],
                    ['id' => 20, 'name' => 'Johan'],
                    ['id' => 30, 'name' => 'Olaf'],
                    ['id' => 40, 'name' => 'Kristof'],
                ])
                ->optionLabel('name')
                ->optionValue('id')
                ->choices(false)
                ->help('Test help 6'),

            Input::make('colorInput2')
                ->label('Color input 2: ->color()')
                ->color(),

            Color::make('colorInput3')
                ->label('Color::make()'),

            Submit::make()->label('Send'),
        ];
    }
}
