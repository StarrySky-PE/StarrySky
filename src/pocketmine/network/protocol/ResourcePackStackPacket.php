<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____  
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \ 
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/ 
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_| 
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PocketMine Team
 * @link http://www.pocketmine.net/
 * 
 *
*/

namespace pocketmine\network\protocol;

#include <rules/DataPacket.h>

class ResourcePackStackPacket extends DataPacket{
	const NETWORK_ID = Info::RESOURCE_PACK_STACK_PACKET;

	public $mustAccept;
	public $behaviorPackStack = [];
	public $resourcePackStack = [];

	public function getName(){
		return "ResourcePackStackPacket";
	}

	public function decode(){

	}

	public function encode(){
		$this->reset();
		$this->putBool($this->mustAccept);
		$this->putLShort(count($this->behaviorPackStack));
		foreach($this->behaviorPackStack as $entry){
			$this->putString($entry->getPackId());
			$this->putString($entry->getPackVersion());
		}
		$this->putLShort(count($this->resourcePackStack)); 
		foreach($this->resourcePackStack as $entry){ 
			$this->putString($entry->getPackId());
			$this->putString($entry->getPackVersion());
		}
	}
}
