<?php

namespace App\Http\Actions\Auth;

use App\Domains\Auth\MagicLink\UseMagicLinkAuthentication;
use App\Domains\User\Actions\CreateUserAction;
use App\Enums\GeneralResult;
use App\Http\Requests\MagicLinkAuthenticationRequest;
use App\Models\User;
use Laravel\Cashier\Exceptions\CustomerAlreadyCreated;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Symfony\Component\HttpFoundation\Response;

class MagicLinkAuthenticationAction
{
    /**
     * @throws CustomerAlreadyCreated
     * @throws IncompletePayment
     */
    public function __invoke(
        MagicLinkAuthenticationRequest $request,
        CreateUserAction $createUserAction,
    ): Response {
        $user = User::query()->where('email', $request->email)->first();

        if (empty($user)) {
            $user = $createUserAction->handle($request->email);
        }

        /** @var User $user */
        $result = UseMagicLinkAuthentication::process($user);

        return response()->json(
            data: [
                'message' => __("auth.magic_link.$result->value"),
            ],
            status: $result === GeneralResult::Success ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
    }
}
