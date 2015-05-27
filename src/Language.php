<?php
/*!
 * Traq
 * Copyright (C) 2009-2015 Jack Polgar
 * Copyright (C) 2012-2015 Traq.io
 * https://github.com/nirix
 * https://traq.io
 *
 * This file is part of Traq.
 *
 * Traq is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 3 only.
 *
 * Traq is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Traq. If not, see <http://www.gnu.org/licenses/>.
 */

namespace Traq;

use Avalon\Language as AvalonLanguage;

/**
 * Class Language
 *
 * @author Jack Polgar <jack@polgar.id.au>
 * @package Traq
 */
class Language {
    /**
     * Load all translations.
     */
    public static function loadAll()
    {
        foreach (scandir(__DIR__ . "/translations") as $file) {
            if ($file != "." && $file != "..") {
                require __DIR__ . "/translations/{$file}";
            }
        }
    }
}