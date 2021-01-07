<?php


namespace App\Http\Schemas;

/**
 * Class LaravelPaginate
 * @package App\Models\Rest
 *  @OA\Schema (
 *     title="LaravelPaginate",
 *     description="Laravel Paginator",
 *     @OA\Xml(
 *         name="LaravelPaginate"
 *     ),
 *     @OA\Property(
 *      property="total",
 *      type="integer",
 *      description="Quantidade de itens"
 *      ),
 *     @OA\Property(
 *      property="per_page",
 *      type="integer",
 *      description="Itens por paágina"
 *      ),
 *     @OA\Property(
 *      property="current_page",
 *      type="integer",
 *      description="Página atual"
 *      ),
 *     @OA\Property(
 *      property="last_page",
 *      type="integer",
 *      description="Última página"
 *      ),
 *     @OA\Property(
 *      property="first_page_url",
 *      type="string",
 *      description="Primeira página"
 *      ),
 *     @OA\Property(
 *      property="last_page_url",
 *      type="string",
 *      description="Última página"
 *      ),
 *      @OA\Property(
 *      property="prev_page_url",
 *      type="string",
 *      description="Próxima página",
 *      nullable="true"
 *      ),
 *      @OA\Property(
 *      property="path",
 *      type="string",
 *      description="Caminho"
 *      ),
 *      @OA\Property(
 *      property="from",
 *      type="integer",
 *      description="De"
 *      ),
 *      @OA\Property(
 *      property="to",
 *      type="integer",
 *      description="Para"
 *      ),
 *      @OA\Property(
 *      property="data",
 *      type="array",
 *      @OA\Items(type="object"),
 *      description="Dados paginados - normalmente um modelo eloquent"
 *      )
 * )
 */
class LaravelPaginate
{

}
