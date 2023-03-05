<?php

namespace ProtoneMedia\Splade\Components\FormBuilder;

use ProtoneMedia\Splade\Components\Form\Submit as SpladeSubmit;
use ProtoneMedia\Splade\Components\FormBuilder\Concerns\HasValue;

class Button extends Component
{
    use HasValue;

    protected bool $danger = false;
    protected bool $secondary = false;
    protected bool $spinner = true;
    protected string $type = 'button';

    /**
     * Set the @click="..."
     *
     * @param string $value
     * @return $this
     */
    public function click(string $value): self
    {
        $this->attributes['@click'] = $value;

        return $this;
    }

    /**
     * Applies danger-styling to the button
     *
     * @param bool $danger
     * @return $this
     */
    public function danger(bool $danger = true): self
    {
        $this->danger = $danger;

        return $this;
    }

    /**
     * Applies secondary-styling to the button
     *
     * @param bool $danger
     * @return $this
     */
    public function secondary(bool $secondary = true): self
    {
        $this->secondary = $secondary;

        return $this;
    }

    /**
     * Renders the SpladeButton
     *
     * @return \Closure|\Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $object = new SpladeSubmit(
            label:     $this->label,
            type:      $this->type,
            spinner:   $this->spinner,
            name:      $this->name,
            value:     $this->value ?? null,
            danger:    $this->danger,
            secondary: $this->secondary
        );

        $object->withAttributes($this->attributes);

        return $object->render()->with($object->data())->with(['slot' => '']);
    }
}