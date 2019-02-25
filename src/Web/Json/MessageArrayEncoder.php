<?php

namespace Lencse\Queue\Web\Json;

use Lencse\Queue\Logging\Message;

final class MessageArrayEncoder
{
    /**
     * @param Message[] $data
     *
     * @return string
     */
    public function __invoke(array $data): string
    {
        $toJson = array_map(function (Message $message) {
            return [
                'msg' => $message->msg(),
                'time' => $message->time()->format('U.u'),
            ];
        }, $data);
        $result = json_encode($toJson);

        return $result ?: '';
    }
}
