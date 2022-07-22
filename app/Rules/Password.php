<?php


namespace App\Rules;


use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class Password implements Rule
{
    /**
     * 密码的最小长度
     *
     * @var int
     */
    protected $length = 6;

    /**
     * 密码是否需要包含一个大写字母
     *
     * @var bool
     */
    protected $requireUppercase = true;

    /**
     * 密码是否需要包含至少一位数字
     *
     * @var bool
     */
    protected $requireNumeric = true;

    /**
     * 密码是否需要包含一个特殊字符(符号)
     *
     * @var bool
     */
    protected $requireSpecialCharacter = false;

    /**
     * 验证失败的提示消息
     *
     * @var string
     */
    protected $message;

    /**
     * 确定验证是否通过
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = is_scalar($value) ? (string)$value : '';

        if ($this->requireUppercase && Str::lower($value) === $value) {
            return false;
        }

        if ($this->requireNumeric && !preg_match('/[0-9]/', $value)) {
            return false;
        }

        if ($this->requireSpecialCharacter && !preg_match('/[\W_]/', $value)) {
            return false;
        }

        return Str::length($value) >= $this->length;
    }

    /**
     * 获取验证消息
     *
     * @return string
     */
    public function message()
    {
        if ($this->message) {
            return $this->message;
        }

        switch (true) {
            case $this->requireUppercase
                && !$this->requireNumeric
                && !$this->requireSpecialCharacter:
                return __('密码 至少有 :length 位或者包含大小写', [
                    'length' => $this->length,
                ]);

            case $this->requireNumeric
                && !$this->requireUppercase
                && !$this->requireSpecialCharacter:
                return __('密码长度至少有 :length 个字符且包含数字', [
                    'length' => $this->length,
                ]);

            case $this->requireSpecialCharacter
                && !$this->requireUppercase
                && !$this->requireNumeric:
                return __('密码长度至少有  :length 个字符且包含特殊字符', [
                    'length' => $this->length,
                ]);

            case $this->requireUppercase
                && $this->requireNumeric
                && !$this->requireSpecialCharacter:
                return __('密码长度至少有  :length 个字符并至少包含一个大写字符和数字', [
                    'length' => $this->length,
                ]);

            case $this->requireUppercase
                && $this->requireSpecialCharacter
                && !$this->requireNumeric:
                return __('密码最少 :length 位 并且至少包含一个大写字符和符号', [
                    'length' => $this->length,
                ]);

            case $this->requireUppercase
                && $this->requireNumeric
                && $this->requireSpecialCharacter:
                return __('密码长度至少有  :length 个字符 并且至少包含一个大写字符、数字和符号', [
                    'length' => $this->length,
                ]);

            case $this->requireNumeric
                && $this->requireSpecialCharacter
                && !$this->requireUppercase:
                return __('密码长度至少有  :length 个字符 且至少包含一个数字和符号', [
                    'length' => $this->length,
                ]);

            default:
                return __('test', [
                    'length' => $this->length,
                ]);
        }
    }

    /**
     * Set the minimum length of the password.
     *
     * @param int $length
     */
    public function length(int $length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Indicate that at least one uppercase character is required.
     *
     * @return $this
     */
    public function requireUppercase()
    {
        $this->requireUppercase = true;

        return $this;
    }

    /**
     * Indicate that at least one numeric digit is required.
     *
     * @return $this
     */
    public function requireNumeric()
    {
        $this->requireNumeric = true;

        return $this;
    }

    /**
     * Indicate that at least one special character is required.
     *
     * @return $this
     */
    public function requireSpecialCharacter()
    {
        $this->requireSpecialCharacter = true;

        return $this;
    }

    /**
     * Set the message that should be used when the rule fails.
     *
     * @param string $message
     * @return $this
     */
    public function withMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }
}
