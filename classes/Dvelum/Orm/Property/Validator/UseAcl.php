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

class UseAcl implements ValidatorInterface
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
        return true;
    }
    /**
     * @inheritDoc
     */
    public function getError(): ?string
    {
        return '';
    }
    /**
     * @inheritDoc
     */
    public function getValue()
    {
        return $this->request->post('use_acl', 'boolean', false);
    }
}