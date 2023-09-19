<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Request;

class ApiException extends Exception
{
    protected $message;
    protected ?string $reason;
    protected ?string $errorMessage;
    protected ?string $type;

    public function __construct(string $reason = null, string $message = null, string $type = null)
    {
        parent::__construct($message);

        $this->reason = $reason;
        $this->errorMessage = $message;
        $this->type = $type;
    }

    public function getReason(): ?string
    {
        return $this->reason;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'error' => [
                'reason' => $this->getReason(),
                'message' => $this->getErrorMessage(),
                'type' => $this->getType(),
            ]
        ]);
    }


    /*  Error 404: Resource not found
        {
            "reason": "notFound",
            "message": "Not found with tag <tag>"
        }
        {
            "reason": "notFound"
        }
    */

    /*  Error 400: Incorrect parameters (negative value)
        {
            "reason": "badRequest",
            "message": "Invalid 'limit' parameter used in the request"
        }

    */
}
