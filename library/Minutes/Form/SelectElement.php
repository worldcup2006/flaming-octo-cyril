<?php
namespace Minutes\Form;
class SelectElement extends Element
{
    private $selectedValue = array();
    public function render() {
        $output = '<select name="' . $this->getName() . '">';
        if (isset($this->attributes['options']) && is_array($this->attributes['options'])) {
            foreach ($this->attributes['options'] as $name => $value) {
                $output .= '<option value="' . $value . '"';
                if (in_array($value, $this->selectedValue)) {
                    $output .= ' selected="selected" ';
                }
                $output .= '>' . $name . '</option>';
            }
        }
        $output .= '</select>';
        return $output;
    }
    public function setValue($value) {
        if (is_array($value)) {
            $this->selectedValue = $value;
        } else {
            $this->selectedValue[] = $value;
        }
    }
}
/*
<select name="selectbox1">
    <option value="foo">foo</option>
    <option value="bar">bar</option>
    <option value="baz">baz</option>
    <option value="quix">quix</option>
</select>
*/