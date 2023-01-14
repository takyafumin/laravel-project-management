<?php

namespace Support\Domain\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;
use Throwable;

/**
 * DomainRuleException
 *
 * @property string $message
 */
class DomainRuleException extends Exception
{
    /**
     * @param string $message エラーメッセージ
     */
    public function __construct(
        string $message
    ) {
        parent::__construct($message);
    }

    /**
     * @param mixed $request Request
     * @return RedirectResponse
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function render($request)
    {
        return redirect()
            ->back()
            ->with('message.error', $this->message)
            ->withInput();
    }
}
