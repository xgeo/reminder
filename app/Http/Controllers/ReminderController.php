<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReminderRequest;
use App\Http\Requests\FilterRemindersRequest;
use App\Http\Requests\ListRemindersRequest;
use App\Models\Reminder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


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
     *                 required={"title", "description", "date", "type"},
     *                 @OA\Property(
     *                     property="title",
     *                     type="string"
     *                 ),
     *                  @OA\Property(
     *                     property="description",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="date",
     *                     type="string",
     *                     format="date"
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
    public function store(CreateReminderRequest $createReminderRequest)
    {
        return Auth::user()->reminders()->create($createReminderRequest->all());
    }

    /**
     * @OA\Patch(
     * path="/v1/reminder/{reminder}/resolve",
     * summary="Resolve um lembrete",
     * description="Resolve um lembrete e retorna se foi possível resolver",
     * operationId="resolve",
     * tags={"ReminderController"},
     * security={ {"passport": {} }},
     * @OA\Parameter(
     *         name="reminder",
     *         description="ID do lembrete",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                  @OA\Property(
     *                     property="reminder",
     *                     type="integer"
     *                 ),
     *                 example={ "success": true, "reminder": 1 }
     *             )
     *         )
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *   )
     * )
     * @param Reminder $reminder
     * @return \Illuminate\Http\JsonResponse
     */
    public function resolve(Reminder $reminder)
    {
        return new JsonResponse([
            'success'   => $reminder->resolve(),
            'reminder'  => $reminder->id
        ]);
    }

    /**
     * @OA\Get(
     * path="/v1/reminder/filter",
     * summary="Filtra os lembretes",
     * description="Retorna a lista paginada e filtrada de lembretes de acordo com os parâmetros",
     * operationId="filter",
     * tags={"ReminderController"},
     * security={ {"passport": {} }},
     * @OA\Parameter(
     *         name="paginate",
     *         description="Quantidade da paginação",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         description="Página",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     * @OA\Parameter(
     *         name="starts_at",
     *         description="Período Incial",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             format="date"
     *         )
     *     ),
     * @OA\Parameter(
     *         name="ends_at",
     *         description="Período Final",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string",
     *             format="date"
     *         )
     *     ),
     * @OA\Parameter(
     *         name="is_solved",
     *         description="Informa se um o lembrete foi resolvido",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="boolean"
     *         )
     *     ),
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
     * @param FilterRemindersRequest $filterRequest
     * @param Reminder $reminder
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filter(FilterRemindersRequest $filterRequest, Reminder $reminder)
    {
        $parameters = $filterRequest->only('type', 'is_solved', 'starts_at', 'ends_at', 'paginate');

        return $reminder->filter($parameters);
    }

    /**
     * @OA\Get(
     * path="/v1/reminder/list",
     * summary="Lista os lembretes",
     * description="Retorna a lista paginada de lembretes",
     * operationId="listReminders",
     * tags={"ReminderController"},
     * security={ {"passport": {} }},
     * @OA\Parameter(
     *         name="paginate",
     *         description="Quantidade da paginação",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         description="Página",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
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
     * @param ListRemindersRequest $listRemindersRequest
     * @param Reminder $reminder
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function listReminders(ListRemindersRequest $listRemindersRequest, Reminder $reminder)
    {
        return $reminder->paginate($listRemindersRequest->get('paginate', 10));
    }

    /**
     * @OA\Delete(
     * path="/v1/reminder/{reminder}",
     * summary="Remove um lembrete",
     * description="Remove um lembrete e retorna o sucesso da remoção",
     * operationId="destroy",
     * tags={"ReminderController"},
     * security={ {"passport": {} }},
     * @OA\Parameter(
     *         name="reminder",
     *         description="ID do lembrete",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     * @OA\Response(
     *    response=200,
     *    description="Success",
     *    @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="success",
     *                     type="boolean"
     *                 ),
     *                  @OA\Property(
     *                     property="reminder",
     *                     type="integer"
     *                 ),
     *                 example={ "success": true, "reminder": 1 }
     *             )
     *         )
     *     ),
     * @OA\Response(
     *    response=401,
     *    description="Unauthenticated",
     *   )
     * )
     * @param int $id
     * @param Reminder $reminder
     * @return JsonResponse
     */
    public function destroy(int $id, Reminder $reminder)
    {
        try {
            $reminder = $reminder->findOrFail($id);

            $response = [
                'success'   => $reminder->delete(),
                'reminder'  => $id
            ];

        } catch (\Exception $e) {
            $response = [
                'success'   => false,
                'reminder'  => $id
            ];
        }

        return new JsonResponse($response);
    }
}
