<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReminderRequest;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    protected function store(CreateReminderRequest $createReminderRequest)
    {

    }

    protected function resolve()
    {

    }

    /**
     * @OA\Get(
     * path="/v1/reminder/list",
     * summary="Lista os lembretes",
     * description="Retorna a lista paginada de lembretes",
     * operationId="listReminders",
     * tags={"ReminderController"},
     * security={ {"passport": {} }},
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/ReminderPaginated")
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *   )
     * )
     */
    protected function listReminders()
    {

    }

    protected function destroy()
    {

    }
}
