<?php
/* Copyright (C) 2021 EOXIA <dev@eoxia.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

/**
 *	\file       digiriskdolibarrindex.php
 *	\ingroup    digiriskdolibarr
 *	\brief      Home page of digiriskdolibarr top menu
 */

// Load Dolibarr environment
$res = 0;
if (!$res && file_exists("../../main.inc.php")) $res = @include "../../main.inc.php";
if (!$res) die("Include of main fails");

require_once DOL_DOCUMENT_ROOT.'/core/lib/admin.lib.php';
require_once DOL_DOCUMENT_ROOT.'/projet/class/project.class.php';
require_once DOL_DOCUMENT_ROOT.'/societe/class/societe.class.php';
require_once DOL_DOCUMENT_ROOT.'/core/modules/project/mod_project_simple.php';

// Load translation files required by the page
$langs->loadLangs(array("digiriskdolibarr@digiriskdolibarr"));

// Initialize technical objects
$project     = new Project($db);
$third_party = new Societe($db);
$projectRef  = new $conf->global->PROJECT_ADDON();

// Security check
//if (!$user->rights->digiriskdolibarr->read) accessforbidden();

/*
 * View
 */

$help_url = 'FR:Module_DigiriskDolibarr';
$morejs   = array("/digiriskdolibarr/js/tiny-slider.min.js", "/digiriskdolibarr/js/digiriskdolibarr.js.php");
$morecss   = array("/digiriskdolibarr/css/tiny-slider.min.css", "/digiriskdolibarr/css/digiriskdolibarr.css");

llxHeader("", $langs->trans("DigiriskDolibarrArea"), $help_url, '', '', '', $morejs, $morecss);

print load_fiche_titre($langs->trans("DigiriskDolibarrArea"), '', 'digiriskdolibarr32px.png@digiriskdolibarr');
?>
<div class="wpeo-carousel">
	<div class="slide-element bloc-1">
		<div class="wpeo-gridlayout grid-gap-0 padding grid-2">
			<div class="content">
				<h2><?php echo $langs->trans("PresentationSlide1Content1"); ?></h2>
				<p><a href="https://www.legifrance.gouv.fr/affichTexte.do?cidTexte=JORFTEXT000000408526&categorieLien=id" class="center" target="_blank"><?php echo $langs->trans("PresentationSlide1Content2"); ?></a></p>
				<p class="light oversize center"><?php echo $langs->trans("PresentationSlide1Content3"); ?></p>
			</div>
			<div>
				<img src="<?php echo DOL_URL_ROOT . '/custom/digiriskdolibarr/img/install/slide-1.jpg'?>" alt="01" />
			</div>
		</div>
	</div>

	<div class="slide-element bloc-2">
		<div class="wpeo-gridlayout grid-gap-0 padding grid-2">
			<div class="content">
				<h2><?php echo $langs->trans("PresentationSlide2Content1"); ?></h2>
				<p><?php echo $langs->trans("PresentationSlide2Content2"); ?></p>
				<p><?php echo $langs->trans("PresentationSlide2Content3"); ?></p>
				<p><?php echo $langs->trans("PresentationSlide2Content4"); ?></p>
				<p><?php echo $langs->trans("PresentationSlide2Content5"); ?></p>
				<ul>
					<li><a href="http://www.inrs.fr/media.html?refINRS=ED%20887" target="_blank"><?php echo $langs->trans("PresentationSlide2Content6"); ?></a></li>
					<li><a href="http://travail-emploi.gouv.fr/publications/picts/bo/05062002/A0100004.htm" target="_blank"><?php echo $langs->trans("PresentationSlide2Content7"); ?></a></li>
				</ul>
			</div>
			<div>
				<img src="<?php echo DOL_URL_ROOT . '/custom/digiriskdolibarr/img/install/slide-2.jpg'?>" alt="02" />
			</div>
		</div>
	</div>

	<div class="slide-element bloc-3">
		<div class="wpeo-gridlayout grid-gap-0 padding grid-2">
			<div class="content">
				<h2 class="center"><?php echo $langs->trans("PresentationSlide3Content1"); ?></h2>
				<p class="center"><a href="http://www.larousse.fr/dictionnaires/francais/risque/69557#8VAKqHCtvXCADLK3.99" target="_blank"><?php echo $langs->trans("PresentationSlide3Content2"); ?></a></p>
			</div>
			<div>
				<img src="<?php echo DOL_URL_ROOT . '/custom/digiriskdolibarr/img/install/slide-3.jpg'?>" alt="03" />
			</div>
		</div>
	</div>

	<div class="slide-element bloc-4">
		<div class="wpeo-gridlayout grid-gap-0 padding grid-2">
			<div class="content">
				<h3><?php echo $langs->trans("PresentationSlide4Content1"); ?></h3>
				<p><?php echo $langs->trans("PresentationSlide4Content2"); ?></p>
				<h3><?php echo $langs->trans("PresentationSlide4Content3"); ?></h3>
				<p><?php echo $langs->trans("PresentationSlide4Content4"); ?></p>
				<h2 class="center"><?php echo $langs->trans("PresentationSlide4Content5"); ?></h2>
			</div>
			<div>
				<img src="<?php echo DOL_URL_ROOT . '/custom/digiriskdolibarr/img/install/slide-4.jpg'?>" alt="04" />
			</div>
		</div>
	</div>

	<div class="slide-element bloc-5">
		<div class="wpeo-gridlayout grid-gap-0 padding grid-2">
			<div class="content">
				<h2><?php echo $langs->trans("PresentationSlide5Content1"); ?></h2>
				<p><?php echo $langs->trans("PresentationSlide5Content2"); ?></p>
				<ul>
					<li><?php echo $langs->trans("PresentationSlide5Content3"); ?></li>
					<li><?php echo $langs->trans("PresentationSlide5Content4"); ?></li>
					<li><?php echo $langs->trans("PresentationSlide5Content5"); ?></li>
				</ul>
			</div>
			<div>
				<img src="<?php echo DOL_URL_ROOT . '/custom/digiriskdolibarr/img/install/slide-5.jpg'?>" alt="05" />
			</div>
		</div>
	</div>

	<div class="slide-element bloc-6">
		<div class="wpeo-gridlayout grid-gap-0 padding grid-2">
			<div class="content">
				<h2><?php echo $langs->trans("PresentationSlide6Content1"); ?></h2>
				<p><?php echo $langs->trans("PresentationSlide6Content2"); ?></p>
				<h3><?php echo $langs->trans("PresentationSlide6Content3"); ?></h3>
				<p><?php echo $langs->trans("PresentationSlide6Content4"); ?></p>
				<ul>
					<li><?php echo $langs->trans("PresentationSlide6Content5"); ?></li>
					<li><?php echo $langs->trans("PresentationSlide6Content6"); ?></li>
					<li><?php echo $langs->trans("PresentationSlide6Content7"); ?></li>
					<li><?php echo $langs->trans("PresentationSlide6Content8"); ?></li>
					<li><?php echo $langs->trans("PresentationSlide6Content9"); ?></li>
				</ul>
				<p><?php echo $langs->trans("PresentationSlide6Content10"); ?></p>
			</div>
			<div>
				<img src="<?php echo DOL_URL_ROOT . '/custom/digiriskdolibarr/img/install/slide-6.jpg'?>" alt="06" />
			</div>
		</div>
	</div>

	<div class="slide-element bloc-7">
		<div class="wpeo-gridlayout grid-gap-0 padding grid-2">
			<div class="content">
				<h2>
					<?php echo $langs->trans("PresentationSlide7Content1"); ?> <a href="http://www.inrs.fr/media.html?refINRS=ED%20840" target="_blank"><?php echo $langs->trans("PresentationSlide7Content2"); ?></a>
				</h2>
				<p><?php echo $langs->trans("PresentationSlide7Content3"); ?></p>
				<ul>
					<li><?php echo $langs->trans("PresentationSlide7Content4"); ?></li>
					<li><?php echo $langs->trans("PresentationSlide7Content5"); ?></li>
					<li><?php echo $langs->trans("PresentationSlide7Content6"); ?></li>
				</ul>
				<p><?php echo $langs->trans("PresentationSlide7Content7"); ?></p>
			</div>
			<div>
				<img src="<?php echo DOL_URL_ROOT . '/custom/digiriskdolibarr/img/install/slide-7.jpg'?>" alt="07" />
			</div>
		</div>
	</div>

	<div class="slide-element bloc-8">
		<div class="wpeo-gridlayout grid-gap-0 padding grid-2">
			<div class="content">
				<h2><?php echo $langs->trans("PresentationSlide8Content1"); ?></h2>
				<ul>
					<li><?php echo $langs->trans("PresentationSlide8Content2"); ?></li>
					<li><?php echo $langs->trans("PresentationSlide8Content3"); ?></li>
				</ul>
				<p><a href="http://www.inrs.fr/media.html?refINRS=outil10" target="_blank"><?php echo $langs->trans("PresentationSlide8Content4"); ?></a></p>
			</div>
			<div>
				<img src="<?php echo DOL_URL_ROOT . '/custom/digiriskdolibarr/img/install/slide-8.jpg'?>" alt="08" />
			</div>
		</div>
	</div>

	<div class="slide-element bloc-9">
		<div class="wpeo-gridlayout grid-gap-0 padding grid-2">
			<div class="content">
				<h2><?php echo $langs->trans("PresentationSlide9Content1"); ?></h2>
				<p><?php echo $langs->trans("PresentationSlide9Content2"); ?></p>
				<ul>
					<li><a href="https://fr.libreoffice.org/" target="_blank"><?php echo $langs->trans("PresentationSlide9Content3"); ?></a> <?php echo $langs->trans("PresentationSlide9Content4"); ?></li>
					<li><a href="https://www.service-public.fr/professionnels-entreprises/vosdroits/F23106" target="_blank"><?php echo $langs->trans("PresentationSlide9Content5"); ?></a></li>
				</ul>
			</div>
			<div>
				<img src="<?php echo DOL_URL_ROOT . '/custom/digiriskdolibarr/img/install/slide-9.jpg'?>" alt="09" />
			</div>
		</div>
	</div>
</div>

<div class="wpeo-notice notice-info">
	<div class="notice-content">
		<div class="notice-subtitle"><?php echo $langs->trans("DigiriskIndexNotice1"); ?></div>
	</div>
</div>
<?php

//Check projet
$project->fetch($conf->global->DIGIRISKDOLIBARR_DU_PROJECT);

if ( $conf->global->DIGIRISKDOLIBARR_DU_PROJECT == 0 || $project->statut == 2 ) {
	$project->ref         = $projectRef->getNextValue($third_party, $project);
	$project->title       = $langs->trans('RiskAssessmentDocument');
	$project->description = $langs->trans('RiskAssessmentDocumentDescription');
	$project->date_c      = dol_now();
	$currentYear          = dol_print_date(dol_now(),'%Y');
	$fiscalMonthStart     = $conf->global->SOCIETE_FISCAL_MONTH_START;
	$startdate            = dol_mktime('0','0','0',$fiscalMonthStart ? $fiscalMonthStart : '1', '1', $currentYear);
	$project->date_start  = $startdate;

	$project->usage_task = 1;

	$startdateAddYear      = dol_time_plus_duree($startdate, 1,'y');
	$startdateAddYearMonth = dol_time_plus_duree($startdateAddYear, -1,'d');
	$enddate               = dol_print_date($startdateAddYearMonth, 'dayrfc');
	$project->date_end     = $enddate;
	$project->statut      = 1;
	$project_id = $project->create($user);
	dolibarr_set_const($db, 'DIGIRISKDOLIBARR_DU_PROJECT', $project_id, 'integer', 1, '',$conf->entity);
}

// End of page
llxFooter();
$db->close();
