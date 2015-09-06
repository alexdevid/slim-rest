<?php
/**
 * Created by PhpStorm.
 * User: devid
 * Date: 06.09.15
 * Time: 16:02
 */

namespace Exceptions;


class ResourceNotFoundException extends \Exception {

    public function __construct($id) {
        parent::__construct('Resource with id #' . $id . ' not found', 404, NULL);
    }
}