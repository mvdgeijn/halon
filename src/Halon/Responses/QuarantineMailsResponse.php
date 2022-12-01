<?php

namespace Mvdgeijn\Halon\Responses;

class QuarantineMailsResponse
{
    public array $items;

    public array $paging;

    /**
     * @param QuarantineMailResponse $item
     * @return $this
     */
    public function addItem(QuarantineMailResponse $item): static
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return $this
     */
    public function sortByTs(): static {
        usort( $this->items, function($a, $b) {
            return bccomp( $a->ts, $b->ts, 4 );
        });

        return $this;
    }
}
