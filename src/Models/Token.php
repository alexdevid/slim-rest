<?php

namespace Models;

use Models\Base\Token as BaseToken;
use Models\Map\TokenTableMap;

/**
 * Skeleton subclass for representing a row from the 'token' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Token extends BaseToken {

    public function setScope($scope) {
        $v = $scope;
        if (is_array($scope)) {
            $v = implode(' ', $scope);
        }
        if ($v !== null) {
            $v = (string)$v;
        }

        if ($this->scope !== $v) {
            $this->scope = $v;
            $this->modifiedColumns[TokenTableMap::COL_SCOPE] = true;
        }

        return $this;
    }
}
