<?php

namespace App\Http\Requests;

use Illuminate\Database\Eloquent\Builder;

trait RequestScopedAdditional
{
    public function getConditionedQuery(string $modelClassName, Builder $query): Builder
    {
        foreach ($this->applyScopes() as $requestKey => $scopeName) {
            if (
                $this->filled($requestKey) &&
                method_exists($modelClassName, 'scope' . ucfirst($scopeName))
            ) {
                $query->{$scopeName}($this->input($requestKey));
            }
        }

        return $query;
    }
}
