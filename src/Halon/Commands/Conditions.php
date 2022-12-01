<?php
/*
 * Copyright (c) 2022 by bHosted.nl B.V.  - All rights reserved
 */

namespace Mvdgeijn\Halon\Commands;

class Conditions
{
    public array $queues;

    public array $freezes;

    public array $workings;

    public array $ids;

    public array $serverids;

    public array $senderids;

    public array $transportids;

    public array $jobids;

    public array $stageids;

    public array $senders;

    public array $recipients;

    public array $tss;

    public array $retrytss;

    public array $retrycounts;

    public array $subjects;

    public array $metadatas;

    public array $quotas;

    public array $sizes;

    public array $retryreasons;

    public array $localips;

    public array $remoteips;

    public array $remotemxs;

    public array $tags;

    /**
     * @param MailAddress $recipient
     * @return $this
     */
    public function addRecipient(MailAddress $recipient ): static
    {
        $this->recipients[] = $recipient;

        return $this;
    }

    /**
     * @param MailAddress $sender
     * @return $this
     */
    public function addSender(MailAddress $sender ): static
    {
        $this->senders[] = $sender;

        return $this;
    }

    /**
     * @param Freeze $freeze
     * @return $this
     */
    public function addFreeze( string $freeze ): static
    {
        $this->freezes[] = ['freeze' => $freeze ];

        return $this;
    }
}
