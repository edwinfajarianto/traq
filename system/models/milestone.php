<?php
/*
 * Traq
 * Copyright (C) 2009-2012 Jack Polgar
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

class Milestone extends Model
{
	protected static $_name = 'milestones';
	protected static $_properties = array(
		'id',
		'name',
		'slug',
		'codename',
		'info',
		'changelog',
		'due',
		'is_completed',
		'is_cancelled',
		'is_locked',
		'project_id',
		'displayorder'
	);
	
	protected static $_has_many = array('tickets');
	protected static $_belongs_to = array('project');
	
	public function href()
	{
		return $this->project->slug . "/milestone/" . $this->slug;
	}
}