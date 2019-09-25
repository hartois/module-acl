<?php
/**
 *  DVelum project https://github.com/dvelum/dvelum , https://github.com/k-samuel/dvelum , http://dvelum.net
 *  Copyright (C) 2011-2017  Kirill Yegorov
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
 *
 */
declare(strict_types=1);
namespace Dvelum\App\Backend\Orm\Controller;

use Dvelum\App\Backend\Controller;
use Dvelum\File;
use Dvelum\Utils;


class Acl extends Controller
{
    public function getModule(): string
    {
        return 'Orm';
    }
    /**
     * Get list of ACL adapters
     */
    public function listAction()
    {
        $list = [['id' => '', 'title' => '---']];
        $files = File::scanFiles('./modules/dvelum/module-acl/classes/Dvelum/App/Acl', ['.php'], true, File::FILES_ONLY);
        foreach ($files as $v) {
            $path = str_replace(['./modules/dvelum/module-acl/classes/'], [''], $v);
            $name = Utils::classFromPath($path, true);
            $list[] = ['id' => $name, 'title' => $name];
        }
        $this->response->success($list);
    }
}