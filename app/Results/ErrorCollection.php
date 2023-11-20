<?php

namespace App\Results;

class ErrorCollection
{
    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $message;

    public function __construct($code = null, $message = null)
    {
        $this->code = $code ?? 0;
        $this->message = $message ?? '';
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     *
     * @return self
     */
    public function setCode(int $code): int
    {
        return $this->code = $code;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $data
     *
     * @return self
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
        return $this;
    }
}
