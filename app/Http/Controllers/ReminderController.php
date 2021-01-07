<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReminderRequest;
use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    /**
     * @OA\Post(
     * path="/v1/reminder",
     * summary="Cria um lembrete",
     * description="Cria um lembrete e retorna o lembrete criado.",
     * operationId="store",
     * tags={"ReminderController"},
     * security={ {"passport": {} }},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 required={"title", "description", "starts_at", "type"},
     *                 @OA\Property(
     *                     property="title",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="starts_at",
     *                     type="string",
     *                     format="date-time"
     *                 ),
     *                  @OA\Property(
     *                     property="ends_at",
     *                     type="string",
     *                     format="date-time"
     *                 ),
     *                  @OA\Property(
     *                     property="type",
     *                     type="string",
     *                     description="DEFAULT / ONCE / EVERY / WEEKLY / MONTHLY / YEARLY / CUSTOMIZED"
     *                 )
     *             )
     *         )
     *     ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/Reminder")
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *   )
     * )
     * @param CreateReminderRequest $createReminderRequest
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function store(CreateReminderRequest $createReminderRequest)
    {
        return \Auth::user()->reminders()->create($createReminderRequest->all());
    }

    /**
     * @OA\Patch(
     * path="/v1/reminder/{reminder}/resolve",
     * summary="Resolve um lembrete",
     * description="Resolve um lembrete e retorna se foi possível resolver",
     * operationId="resolve",
     * tags={"ReminderController"},
     * security={ {"passport": {} }},
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/Reminder")
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *   )
     * )
     */
    protected function resolve()
    {

    }

    /**
     * @OA\Get(
     * path="/v1/reminder/filter",
     * summary="Filtra os lembretes",
     * description="Retorna a lista paginada e filtrada de lembretes de acordo com os parâmetros",
     * operationId="filter",
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
    protected function filter()
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

    /**
     * @OA\Delete(
     * path="/v1/reminder/{reminder}",
     * summary="Remove um lembrete",
     * description="Remove um lembrete e retorna o sucesso da remoção",
     * operationId="destroy",
     * tags={"ReminderController"},
     * security={ {"passport": {} }},
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\JsonContent(ref="#/components/schemas/Reminder")
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *   )
     * )
     */
    protected function destroy()
    {

    }
}
