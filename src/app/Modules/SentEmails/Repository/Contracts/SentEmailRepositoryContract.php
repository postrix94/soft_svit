<?php

namespace App\Modules\SentEmails\Repository\Contracts;

use App\Modules\SentEmails\DTO\SentNewListDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface SentEmailRepositoryContract
{
    /**
     * @return Builder
     */
    public function newQuery(): Builder;

    /**
     * @param SentNewListDTO $email
     * @return null|Model
     */
    public function create(SentNewListDTO $email): null|Model;

    /**
     * @param int $id
     * @return Model|null
     */
    public function findById(int $id): null|Model;
}
