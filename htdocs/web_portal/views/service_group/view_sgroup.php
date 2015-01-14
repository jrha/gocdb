<?php 
$serivceGroupProperties = $params['sGroup']->getServiceGroupProperties();
?>

<script type="text/javascript" src="<?php echo \GocContextPath::getPath()?>javascript/confirm.js"></script>
<div class="rightPageContainer">
    <div style="float: left;">
        <img src="<?php echo \GocContextPath::getPath()?>img/virtualSite.png" class="pageLogo" />
    </div>
    <div style="float: left;">
        <h1 style="float: left; margin-left: 0em;">
                Service Group: <?php echo $params['sGroup']->getName()?>
        </h1>
        <span style="clear: both; float: left; padding-bottom: 0.4em;"><?php echo $params['sGroup']->getDescription()?></span>
    </div>

    <!--  Edit Virtual Site link -->
    <!--  only show this link if we're in read / write mode -->
    <?php if(!$params['portalIsReadOnly']): ?>
        <div style="float: right;">
            <div style="float: right; margin-left: 2em;">
                <a href="index.php?Page_Type=Edit_Service_Group&id=<?php echo $params['sGroup']->getId()?>">
                    <img src="<?php echo \GocContextPath::getPath()?>img/pencil.png" height="25px" style="float: right;" />
                    <br />
                    <br />
                    <span>Edit</span>
                </a>
            </div>
            <div style="float: right;">
                <script type="text/javascript" src="<?php echo \GocContextPath::getPath()?>javascript/confirm.js"></script>
                <a onclick="return confirmSubmit()"
                    href="index.php?Page_Type=Delete_Service_Group&id=<?php echo $params['sGroup']->getId()?>">
                    <img src="<?php echo \GocContextPath::getPath()?>img/cross.png" height="25px" style="float: right; margin-right: 0.4em;" />
                    <br />
                    <br />
                    <span>Delete</span>
                </a>
            </div>
        </div>
    <?php endif; ?>

    <!-- Virtual Site Properties container div -->
    <div style="float: left; width: 100%; margin-top: 2em;">
        <!--  Data -->
        <div class="tableContainer" style="width: 55%; float: left;">
            <span class="header" style="vertical-align:middle; float: left; padding-top: 0.9em; padding-left: 1em;">Properties</span>
            <img src="<?php echo \GocContextPath::getPath()?>img/contact_card.png" height="25px" style="float: right; padding-right: 1em; padding-top: 0.5em; padding-bottom: 0.5em;" />
            <table style="clear: both; width: 100%;">
                <tr class="site_table_row_1">
                    <td class="site_table">Monitored</td><td class="site_table">
                    <?php
                        switch($params['sGroup']->getMonitored()) {
                            case true:
                                ?>
                                <img src="<?php echo \GocContextPath::getPath()?>img/tick.png" height="22px" style="vertical-align: middle;" />
                                <?php
                                break;
                            case false:
                                ?>
                                <img src="<?php echo \GocContextPath::getPath()?>img/cross.png" height="22px" style="vertical-align: middle;" />
                                <?php
                                break;
                        }
                        ?></td>
                </tr>
                <?php 
                if($params['sGroup']->getScopes() != null && $params['sGroup']->getScopes()->first() != null && 
                        $params['sGroup']->getScopes()->first()->getName() == "Local") { 
                    $style = " style=\"background-color: #A3D7A3;\""; } else { $style = ""; } 
                ?>
                <tr class="site_table_row_2" <?php echo $style ?>>
                    <td class="site_table">
                        <a href="index.php?Page_Type=Scope_Help" style="word-wrap: normal">Scope(s)</a>
                    </td>
                    <td class="site_table">
                        <?php echo $params['sGroup']->getScopeNamesAsString()?>
                    </td>
                </tr>
                <tr class="site_table_row_1">
                    <td class="site_table">Contact E-Mail</td>
                    <td class="site_table">
                        <a href="mailto:<?php echo $params['sGroup']->getEmail(); ?>">
                            <?php echo $params['sGroup']->getEmail(); ?>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!--  Services -->
    <div class="tableContainer" style="width: 99.5%; float: left; margin-top: 3em; margin-right: 10px;">
        <span class="header" style="vertical-align:middle; float: left; padding-top: 0.9em; padding-left: 1em;">Services</span>
        <img src="<?php echo \GocContextPath::getPath()?>img/service.png" height="25px" style="float: right; padding-right: 1em; padding-top: 0.5em; padding-bottom: 0.5em;" />
        <table style="clear: both; width: 100%;">
            <tr class="site_table_row_1">
                <th class="site_table">Hostname (service type)</th>
                <th class="site_table">Description</th>
                <th class="site_table">Production</th>
                <th class="site_table"><a href="index.php?Page_Type=Scope_Help">Scope(s)</a></th>
            </tr>

            <?php
            $num = 2;

			foreach($params['sGroup']->getServices() as $se) {

	            if($se->getScopes()->first()->getName() == "Local") {
					$style = " style=\"background-color: #A3D7A3;\"";
				} else {
					$style = "";
				}

            ?>

            <tr class="site_table_row_<?php echo $num ?>"<?php echo $style; ?>>
                <td class="site_table">
                    <div style="background-color: inherit;">
                       <div style="background-color: inherit;">
                            <span style="vertical-align: middle;">
                                <a href="index.php?Page_Type=Service&id=<?php echo $se->getId() ?>">
                                    <?php echo $se->getHostname() . " (" . $se->getServiceType()->getName() . ")";?>
                                </a>
                            </span>
                        </div>
                    </div>
                </td>
                <td class="site_table"><?php echo $se->getDescription() ?></td>
                <td class="site_table">
				<?php
				switch($se->getProduction()) {
					case true:
						?>
						<img src="<?php echo \GocContextPath::getPath()?>img/tick.png" height="22px" style="vertical-align: middle;" />
						<?php
						break;
					case false:
						?>
						<img src="<?php echo \GocContextPath::getPath()?>img/cross.png" height="22px" style="vertical-align: middle;" />
						<?php
						break;
				}
				?>
				</td>
                <td class="site_table">
				<?php echo $se->getScopeNamesAsString() ?>
                </td>
            </tr>
            <?php
				if($num == 1) { $num = 2; } else { $num = 1; }
            } // End of the foreach loop iterating over SEs
            ?>
        </table>
        <!--  only show this link if we're in read / write mode -->
        <?php if(!$params['portalIsReadOnly']): ?>
            <!-- Add new Service Link -->
            <a href="index.php?Page_Type=Add_Service_Group_SEs&id=<?php echo $params['sGroup']->getId();?>">
                <img src="<?php echo \GocContextPath::getPath()?>img/add.png" height="50px" style="float: left; padding-top: 0.9em; padding-left: 1.2em; padding-bottom: 0.9em;"/>
                <span class="header" style="vertical-align:middle; float: left; padding-top: 1.1em; padding-left: 1em; padding-bottom: 0.9em;">
                        Add Services
                </span>
            </a>
            <!-- Remove Service Link -->
            <a href="index.php?Page_Type=Remove_Service_Group_SEs&id=<?php echo $params['sGroup']->getId();?>">
                <img src="<?php echo \GocContextPath::getPath()?>img/cross.png" height="50px" style="float: left; padding-top: 0.9em; padding-left: 1.2em; padding-bottom: 0.9em;"/>
                <span class="header" style="vertical-align:middle; float: left; padding-top: 1.1em; padding-left: 1em; padding-bottom: 0.9em;">
                        Remove Services
                </span>
            </a>
        <?php endif; ?>
    </div>

    <!-- Roles -->
    <div class="tableContainer" style="width: 99.5%; float: left; margin-top: 3em; margin-right: 10px;">
        <span class="header" style="vertical-align:middle; float: left; padding-top: 0.9em; padding-left: 1em;">Roles</span>
        <img src="<?php echo \GocContextPath::getPath()?>img/people.png" height="25px" style="float: right; padding-right: 1em; padding-top: 0.5em; padding-bottom: 0.5em;" />
        <table style="clear: both; width: 100%;">
            <tr class="site_table_row_1">
                <th class="site_table">Name</th>
                <th class="site_table">Role</th>
                <?php if(!$params['portalIsReadOnly']): ?>
                    <th class="site_table">Revoke</th>
                <?php endif; ?>
            </tr>
            <?php
                $num = 2;
                foreach($params['Roles'] as $role) {
            ?>
            <tr class="site_table_row_<?php echo $num ?>">
                <td class="site_table">
                    <div style="background-color: inherit;">
                        <img src="<?php echo \GocContextPath::getPath()?>img/person.png" style="vertical-align: middle; padding-right: 1em;" />
                        <a style="vertical-align: middle;" href="index.php?Page_Type=User&id=<?php echo $role->getUser()->getId()?>">
                            <?php echo $role->getUser()->getFullName()/*.' ['.$role->getUser()->getId().']' */?>
                        </a>
                    </div>
                </td>
                <td class="site_table">
                	<?php echo $role->getRoleType()->getName() ?>
                </td>
                <?php if(!$params['portalIsReadOnly']): ?>
                    <td class="site_table"><a href="index.php?Page_Type=Revoke_Role&id=<?php echo $role->getId()?>" onclick="return confirmSubmit()">Revoke</a></td>
                <?php endif; ?>
            </tr>
            <?php
                if($num == 1) { $num = 2; } else { $num = 1; }
                } // End of the foreach loop iterating over user roles
            ?>
        </table>
        <!--  only show this link if we're in read / write mode -->
        <?php if(!$params['portalIsReadOnly']): ?>
            <!-- Request role Link -->
            <a href="index.php?Page_Type=Request_Role&id=<?php echo $params['sGroup']->getId();?>">
                <img src="<?php echo \GocContextPath::getPath()?>img/add.png" height="50px" style="float: left; padding-top: 0.9em; padding-left: 1.2em; padding-bottom: 0.9em;"/>
                <span class="header" style="vertical-align:middle; float: left; padding-top: 1.1em; padding-left: 1em; padding-bottom: 0.9em;">
                        Request Role
                </span>
            </a>
        <?php endif; ?>
    </div>

    <!--  Service Group Properties -->
    <div class="tableContainer" style="width: 99.5%; float: left; margin-top: 3em; margin-right: 10px;">
        <span class="header" style="vertical-align:middle; float: left; padding-top: 0.9em; padding-left: 1em;">Service Group Extension Properties</span>        
        <img src="<?php echo \GocContextPath::getPath()?>img/keypair.png" height="25px" style="float: right; padding-right: 1em; padding-top: 0.5em; padding-bottom: 0.5em;" />
        <table style="clear: both; width: 100%;">
            <tr class="site_table_row_1">
                <th class="site_table">Name</th>
                <th class="site_table" >Value</th>  
                <?php if(!$params['portalIsReadOnly']): ?>
                <th class="site_table" >Edit</th>  
                <th class="site_table" >Remove</th>  
                <?php endif; ?>              
            </tr>
            <?php
            $num = 2;
            foreach($serivceGroupProperties as $sp) {
	            ?>

	            <tr class="site_table_row_<?php echo $num ?>">
	                <td style="width: 35%;"class="site_table"><?php echo $sp->getKeyName(); ?></td>
	                <td style="width: 35%;"class="site_table"><?php echo $sp->getKeyValue(); ?></td>
	                <?php if(!$params['portalIsReadOnly']): ?>	                
	               	<td style="width: 10%;"align = "center"class="site_table"><a href="index.php?Page_Type=Edit_Service_Group_Property&propertyid=<?php echo $sp->getId();?>&id=<?php echo $params['sGroup']->getId();?>"><img height="25px" src="<?php echo \GocContextPath::getPath()?>img/pencil.png"/></a></td>
	                <td style="width: 10%;"align = "center"class="site_table"><a href="index.php?Page_Type=Delete_Service_Group_Property&propertyid=<?php echo $sp->getId();?>&id=<?php echo $params['sGroup']->getId();?>"><img height="25px" src="<?php echo \GocContextPath::getPath()?>img/cross.png"/></a></td>
	                <?php endif; ?>
	            </tr>
	            <?php
	            if($num == 1) { $num = 2; } else { $num = 1; }
            }
            ?>
        </table>
        <!--  only show this link if we're in read / write mode -->
        <?php if(!$params['portalIsReadOnly']): ?>
            <!-- Add new data Link -->
            <a href="index.php?Page_Type=Add_Service_Group_Property&serviceGroup=<?php echo $params['sGroup']->getId()?>">
                <img src="<?php echo \GocContextPath::getPath()?>img/add.png" height="50px" style="float: left; padding-top: 0.9em; padding-left: 1.2em; padding-bottom: 0.9em;"/>
                <span class="header" style="vertical-align:middle; float: left; padding-top: 1.1em; padding-left: 1em; padding-bottom: 0.9em;">
                        Add Properties
                </span>
            </a>
		<?php endif; ?>
    </div>
    
    <!--  Downtimes -->
    <div class="tableContainer" style="width: 99.5%; float: left; margin-top: 3em; margin-right: 10px;">
        <span class="header" style="vertical-align:middle; float: left; padding-top: 0.9em; padding-left: 1em;">Recent Downtimes</span>
        <a href="index.php?Page_Type=SGroup_Downtimes&id=<?php echo $params['sGroup']->getId(); ?>" style="vertical-align:middle; float: left; padding-top: 1.3em; padding-left: 1em; font-size: 0.8em;">(View all Downtimes)</a>
        <img src="<?php echo \GocContextPath::getPath()?>img/down_arrow.png" height="25px" style="float: right; padding-right: 1em; padding-top: 0.5em; padding-bottom: 0.5em;" />
        <table style="clear: both; width: 100%;">
            <tr class="site_table_row_1">
                <th class="site_table">Description</th>
                <th class="site_table">From</th>
                <th class="site_table">To</th>
            </tr>
            <?php
            $num = 2;
            foreach($params['downtimes'] as $d) {
            ?>

            <tr class="site_table_row_<?php echo $num ?>">
                <td class="site_table">
                	<a style="padding-right: 1em;" href="index.php?Page_Type=Downtime&id=<?php echo $d->getId() ?>">
                		<?php echo $d->getDescription() ?>
                	</a>
               	</td>
                <td class="site_table"><?php echo $d->getStartDate()->format($d::DATE_FORMAT) ?></td>
                <td class="site_table"><?php echo $d->getEndDate()->format($d::DATE_FORMAT) ?></td>
            </tr>
            <?php
            if($num == 1) { $num = 2; } else { $num = 1; }
            }
            ?>
        </table>
    </div>
</div>