<?php


namespace App\Http\Schemas;

/**
 * Class ReminderPaginated
 * @package App\Http\Schemas
 *
 * @OA\Schema (
 *     title="ReminderPaginated",
 *     description="Paginação - Reminders",
 *     @OA\Xml(
 *         name="ReminderPaginated",
 *     ),
 *     allOf={
 *       @OA\Schema(ref="#/components/schemas/LaravelPaginate"),
 *       @OA\Schema(
 *           required={"data"},
 *           @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Reminder"))
 *       )
 *   }
 * )
 */
class ReminderPaginated
{

}
