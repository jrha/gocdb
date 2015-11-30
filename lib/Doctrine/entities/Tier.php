<?php
/*
 * Copyright (C) 2015 STFC
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @deprecated since version 5.4
 * @author John Casson
 * @Entity @Table(name="Tiers")
 */
class Tier {

    /** @Id @Column(type="integer") @GeneratedValue */
    protected $id;

    /** @Column(type="string", unique=true) */
    protected $name;

    /** @OneToMany(targetEntity="Site", mappedBy="tier") */
    protected $sites = null;

    public function getId() {
	return $this->id;
    }

    public function getName() {
	return $this->name;
    }

    public function setName($name) {
	$this->name = $name;
    }

    public function getSites() {
	return $this->sites;
    }

    public function addSiteDoJoin($site) {
	$this->sites[] = $site;
	$site->setTier($this);
    }

    public function __construct() {
	$this->sites = new ArrayCollection();
    }

}
