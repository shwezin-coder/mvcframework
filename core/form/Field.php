<?php 
namespace app\core\form;
use app\core\Model;
class Field{
    public Model $model;
    public string $type;
    public string $attribute;
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';
    public function __construct(Model $model,string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        $this->model = $model;
        $this->attribute = $attribute;
    }
    public function __toString()
    {
        return sprintf('
            <div class="form-group">
                <label for="first_name">%s</label>
                <input type="%s" id="%s" name="%s" value="%s" class="form-control %s">
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ',$this->model->getLabel($this->attribute), 
         $this->type,
         $this->attribute,
         $this->attribute,
         $this->model->{$this->attribute},
         $this->model->hasError($this->attribute) ? 'is-invalid' : '',
         $this->model->getFirstError($this->attribute)
    );
    }
    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }
}