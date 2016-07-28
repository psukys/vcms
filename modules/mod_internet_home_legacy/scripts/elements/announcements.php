<?php
/*
This file is part of VCMS.

VCMS is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

VCMS is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with VCMS. If not, see <http://www.gnu.org/licenses/>.
*/

if(!is_object($libGlobal))
	exit();


echo '<div class="row">';

$stmt = $libDb->prepare("SELECT * FROM mod_internethome_nachricht WHERE startdatum < NOW() AND (verfallsdatum > NOW() || verfallsdatum = '0000-00-00 00:00:00') ORDER BY startdatum DESC LIMIT 0,2");
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
	echo '<div class="col-sm-6">';
	echo '<div class="panel panel-default">';
	echo '<div class="panel-body">';
	echo '<div class="row">';

	$image = $libModuleHandler->getModuleDirectory(). '/custom/img/' .$row['id']. '.jpg';
	$imageExists = is_file($image);

	if($imageExists){
		echo '<div class="col-xs-12 col-sm-6">';
		echo '<p><img src="' .$image. '" class="img-responsive center-block" alt="" /></p>';
		echo '</div>';
	}

	if($imageExists){
		echo '<div class="col-xs-12 col-sm-6">';
	} else {
		echo '<div class="col-xs-12">';
	}

	echo '<p>' .$libString->parseBBCode(nl2br(trim($row['text']))). '</p>';
	echo '</div>';

	echo '</div>';
	echo '</div>';
	echo '</div>';
	echo '</div>';
}

echo '</div>';
?>