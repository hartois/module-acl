<?php
/**
 *  DVelum project https://github.com/dvelum/dvelum
 *  Copyright (C) 2011-2019  Kirill Yegorov
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
declare(strict_types=1);

namespace Dvelum\Orm\Property\Validator;

use Dvelum\Lang\Dictionary;
use Dvelum\Orm\Property\ValidatorInterface;
use Dvelum\Request;

class Acl implements ValidatorInterface
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Dictionary
     */
    protected $lang;

    /**
     * @var string|null
     */
    protected $error = null;

    protected $value = false;

    /**
     * @inheritDoc
     */
    public function __construct(Request $request, Dictionary $lang)
    {
        $this->request = $request;
        $this->lang = $lang;
    }

    /**
     * @inheritDoc
     */
    public function isValid(): bool
    {
        $this->error = null;

        $useAcl = $this->request->post('use_acl', 'boolean', false);
        $acl = $this->request->post('acl', 'string', false);

        // check ACL Adapter
        if ($useAcl && (empty($acl) || !class_exists($acl))) {
           $this->error = $this->lang->get('INVALID_VALUE');
           return false;
        }

        if ($useAcl) {
            $this->value = $acl;
        } else {
            $this->value = false;
        }
        return true;
    }
    /**
     * @inheritDoc
     */
    public function getError(): ?string
    {
        return $this->error;
    }
    /**
     * @inheritDoc
     */
    public function getValue()
    {
       return $this->value;
    }
}