<?php

namespace Mvdgeijn\Halon\Requests;

use Mvdgeijn\Halon\Commands\Smtpd;
use Mvdgeijn\Halon\MultiNodeCommand;
use Mvdgeijn\Halon\Node;
use Mvdgeijn\Halon\Responses\QuarantineMailsResponse;

class QuarantineMailRequest extends MultiNodeCommand
{
    public function get( Smtpd $smtpd )
    {
        $allResponses = [];

        foreach( $this->cluster as $node ) {
            /** @var Node $node */
            $allResponses[] = $node->command($smtpd, QuarantineMailsResponse::class);
        }

        /** @var QuarantineMailsResponse $allItems */
        $allItems = $allResponses[0];

        $index = 1;
        while( isset( $allResponses[$index] ) ) {
            foreach( $allResponses[$index]->items as $item ) {
                $allItems->addItem( $item );
            }
            $index++;
        }

        $allItems->sortByTs();

        return $allItems;
    }
}
