<?php

namespace App\Models;

use App\Http\Enums\ReminderStatusEnum;
use App\Http\Enums\ReminderTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

/**
 * Class Reminder
 *
 * @package App\Models\Reminder
 * @OA\Schema (
 *     title="Reminder",
 *     description="Reminder",
 *     @OA\Xml(
 *         name="Reminder"
 *     ),
 *     @OA\Property(
 *      property="id",
 *      type="integer",
 *      description="Identificador do lembrete"
 *      ),
 *     @OA\Property(
 *      property="title",
 *      type="string",
 *      description="Título do lembrete"
 *      ),
 *     @OA\Property(
 *      property="description",
 *      type="string",
 *      description="Descrição do lembrete"
 *      ),
 *     @OA\Property(
 *      property="status",
 *      type="integer",
 *      description="Status do lembrete: 1 - CREATED / 2 - SOLVED"
 *      ),
 *     @OA\Property(
 *      property="full_name",
 *      type="string",
 *      description="Nome do usuário atrelado ao lembrete"
 *      ),
 *     @OA\Property(
 *      property="date",
 *      type="string",
 *      format="date",
 *      description="Data escolhida ou início do período selecionado"
 *      ),
 *     @OA\Property(
 *      property="type",
 *      type="string",
 *      description="Tipo do lembrete: DEFAULT / ONCE / EVERY / WEEKLY / MONTHLY / YEARLY / CUSTOMIZED"
 *      ),
 *     @OA\Property(
 *      property="created_at",
 *      type="string",
 *      format="date",
 *      description="Quando o lembrete foi criado"
 *      )
 * )
 * @property int $id
 * @property string $title
 * @property string|null $description
 * @property bool $status
 * @property int $user_id
 * @property string $starts_at
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder newQuery()
 * @method static \Illuminate\Database\Query\Builder|Reminder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereStartsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Reminder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Reminder withoutTrashed()
 * @mixin \Eloquent
 * @property-read \App\Models\User $user
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $full_name
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reminder whereDeletedAt($value)
 */
class Reminder extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id',
        'date',
        'type'
    ];

    protected $appends = [
        'full_name'
    ];

    public $visible = [
        'id',
        'title',
        'description',
        'status',
        'full_name',
        'date',
        'type',
        'created_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function resolve(): bool
    {
        $this->status = ReminderStatusEnum::SOLVED;
        return $this->save();
    }

    public function getFullNameAttribute()
    {
        return $this->user->full_name;
    }

    public function filter(array $parameters)
    {
        $starts_at  = $parameters['starts_at'] ?? NULL;
        $ends_at    = $parameters['ends_at'] ?? NULL;
        $is_solved  = $parameters['is_solved'] === 'true';
        $status     = $is_solved ? ReminderStatusEnum::SOLVED : ReminderStatusEnum::CREATED;
        $type       = $parameters['type'] ?? NULL;
        $paginate   = $parameters['paginate'] ?? 10;

        $sql = $this->withTrashed()->orWhere(function ($builder) {
            return $builder->whereNull('deleted_at');
        })->orWhere(function ($builder) {
            return $builder->whereNotNull('deleted_at')
                ->where('date', '<', \DB::raw('DATE(deleted_at)'));
        })->where('status', '=', $status);

        if (!is_null($type)) {
            $sql->where('type', '=', $type);
        }

        if (!is_null($starts_at)) {
            $sql->where('date', '>=', $starts_at);
        }

        if (!is_null($ends_at)) {
            $sql->where('date', '<=', $ends_at);
        }

        return $sql->paginate($paginate);
    }

    public function scopeDaily($query, $now)
    {
        return $query->where('status', '=', ReminderStatusEnum::CREATED)
            ->where('date', '=', $now)
            ->where('type', '=', ReminderTypeEnum::DEFAULT);
    }

    /**
     * @param Builder $query
     */
    public function scopeMonthly($query, $now)
    {
        return $query->where(\DB::raw("DATE_FORMAT(date,'%d')"), '=',
            \DB::raw("DATE_FORMAT('{$now}', '%d')"))
        ->where('type', '=', ReminderTypeEnum::MONTHLY);
    }
}
