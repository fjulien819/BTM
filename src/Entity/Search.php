<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Search
{

    /**
     * @Assert\NotBlank
     * @Assert\Type("string")
     *
     */
    private $searchTerm;

    public function getSearchTerm(): ?string
    {
        return $this->searchTerm;
    }

    public function setSearchTerm(string $searchTerm): self
    {
        $this->searchTerm = $searchTerm;

        return $this;
    }



}
