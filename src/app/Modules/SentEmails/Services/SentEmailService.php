<?php

namespace App\Modules\SentEmails\Services;

use App\Modules\SentEmails\DTO\SentNewListDTO;
use App\Modules\SentEmails\Repository\Contracts\SentEmailRepositoryContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Exceptions\{DatabaseInsertionException,RecordNotFoundException};

class SentEmailService
{
    /**
     * @var SentEmailRepositoryContract
     */
    private SentEmailRepositoryContract $repository;

    /**
     * @param SentEmailRepositoryContract $repository
     */
    public function __construct(SentEmailRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $id
     * @return Model
     * @throws RecordNotFoundException
     */
    public function findById(int $id):Model {
        $email = $this->repository->findById($id);
        if(is_null($email)) throw new RecordNotFoundException;

        return $email;
    }

    /**
     * @param array $emailInfo
     * @return Model
     */
    public function save(array $emailInfo): Model {

        $listInfoDTO = new SentNewListDTO(
            uuid: Str::uuid(),
            from: $emailInfo["from"],
            to: $emailInfo["to"],
            subject: $emailInfo["subject"],
            type: $emailInfo["type_list"],
            body: $emailInfo["body_list"],
            ip: $emailInfo["ip"],
            userAgent: $emailInfo["user_agent"],
            cc: $emailInfo["cc"]
        );

      $email =  $this->repository->create($listInfoDTO);
      if(is_null($email)) throw new DatabaseInsertionException;

      return $email;
    }
}
