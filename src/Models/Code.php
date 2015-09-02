<?php

namespace Models;

use Models\Base\Code as BaseCode;
use Models\Map\CodeTableMap;

class Code extends BaseCode {

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
            $this->modifiedColumns[CodeTableMap::COL_SCOPE] = true;
        }

        return $this;
    }
}
