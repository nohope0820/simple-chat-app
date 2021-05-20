<?php

namespace App\Services;

use App\Repositories\MessagePersonalRepository;

class MessagePersonalServices
{
    protected $messagePersonalRepository;

    public function __construct(MessagePersonalRepository $messagePersonalRepository)
    {
        $this->messagePersonalRepository = $messagePersonalRepository;
    }

    /**
     * Find messages between sender and receiver
     * @param integer $senderId
     * @param integer $receiverId
     * @param integer $paginate
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function find($senderId, $receiverId, $paginate = 10)
    {
        return $this->messagePersonalRepository->find(
            ['sender_id', 'receiver_id', 'messages'],
            ['sender_id' => $senderId, 'receiver_id' => $receiverId],
            [
                'sender' => function ($query) {
                    $query->select(['id', 'name']);
                },
                'receiver' => function ($query) {
                    $query->select(['id', 'name']);
                }
            ],
            $paginate
        );
    }
}
