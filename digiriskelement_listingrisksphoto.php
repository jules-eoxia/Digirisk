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
 *   	\file       digiriskelement_listingrisksphoto.php
 *		\ingroup    digiriskdolibarr
 *		\brief      Page to view listingrisksphoto
 */

// Load Dolibarr environment
$res = 0;
if (!$res && file_exists("/main.inc.php")) $res = @include "../../../../main.inc.php";
if (!$res && file_exists("/../main.inc.php")) $res = @include "../../../../main.inc.php";
if (!$res && file_exists("../../main.inc.php")) $res = @include "../../../../main.inc.php";
if (!$res && file_exists("../../../main.inc.php")) $res = @include "../../../../main.inc.php";
if (!$res && file_exists("../../../../main.inc.php")) $res = @include "../../../../main.inc.php";
if (!$res) die("Include of main fails");

require_once DOL_DOCUMENT_ROOT.'/core/class/html.formfile.class.php';

dol_include_once('/digiriskdolibarr/class/digiriskelement.class.php');
dol_include_once('/digiriskdolibarr/class/digiriskstandard.class.php');
dol_include_once('/digiriskdolibarr/class/digiriskdocuments/listingrisksphoto.class.php');
dol_include_once('/digiriskdolibarr/lib/digiriskdolibarr_digiriskelement.lib.php');
dol_include_once('/digiriskdolibarr/lib/digiriskdolibarr_digiriskstandard.lib.php');
dol_include_once('/digiriskdolibarr/lib/digiriskdolibarr_function.lib.php');
dol_include_once('/digiriskdolibarr/core/modules/digiriskdolibarr/digiriskdocuments/listingrisksphoto/modules_listingrisksphoto.php');

global $db, $conf, $langs;

// Load translation files required by the page
$langs->loadLangs(array("digiriskdolibarr@digiriskdolibarr", "other"));

// Get parameters
$id     = GETPOST('id', 'int');
$action = GETPOST('action', 'aZ09');

// Initialize technical objects
$object            = new DigiriskElement($db);
$standard          = new DigiriskStandard($db);
$listingrisksphoto = new ListingRisksPhoto($db);
$hookmanager->initHooks(array('digiriskelementlistingrisksphoto', 'globalcard')); // Note that conf->hooks_modules contains array

$object->fetch($id);
$standard->fetch($conf->global->DIGIRISKDOLIBARR_ACTIVE_STANDARD);

$upload_dir         = $conf->digiriskdolibarr->multidir_output[isset($conf->entity) ? $conf->entity : 1];
$permissiontoread   = $user->rights->digiriskdolibarr->listingrisksphoto->read;
$permissiontoadd    = $user->rights->digiriskdolibarr->listingrisksphoto->write;
$permissiontodelete = $user->rights->digiriskdolibarr->listingrisksphoto->delete;

if (!$permissiontoread) accessforbidden();

/*
 * Actions
 */

$parameters = array();
$reshook = $hookmanager->executeHooks('doActions', $parameters, $object, $action); // Note that $action and $object may have been modified by some hooks
if ($reshook < 0) setEventMessages($hookmanager->error, $hookmanager->errors, 'errors');

if (empty($reshook))
{
	$error = 0;

	// Action to build doc
	if ($action == 'builddoc' && $permissiontoadd) {
		$outputlangs = $langs;
		$newlang = '';

		if ($conf->global->MAIN_MULTILANGS && empty($newlang) && GETPOST('lang_id', 'aZ09')) $newlang = GETPOST('lang_id', 'aZ09');
		if (!empty($newlang)) {
			$outputlangs = new Translate("", $conf);
			$outputlangs->setDefaultLang($newlang);
		}

		// To be sure vars is defined
		if (empty($hidedetails)) $hidedetails = 0;
		if (empty($hidedesc)) $hidedesc = 0;
		if (empty($hideref)) $hideref = 0;
		if (empty($moreparams)) $moreparams = null;

		$model      = GETPOST('model', 'alpha');

		if ( $id > 0 ) {
			$moreparams['object'] = $object;
			$moreparams['user']   = $user;
		} else {
			$moreparams['object'] = "";
			$moreparams['user']   = $user;
		}

		$result = $listingrisksphoto->generateDocument($model, $outputlangs, $hidedetails, $hidedesc, $hideref, $moreparams);
		if ($result <= 0) {
			setEventMessages($object->error, $object->errors, 'errors');
			$action = '';
		} else {
			if (empty($donotredirect))
			{
				setEventMessages($langs->trans("FileGenerated") . ' - ' . $listingrisksphoto->last_main_doc, null);

				$urltoredirect = $_SERVER['REQUEST_URI'];
				$urltoredirect = preg_replace('/#builddoc$/', '', $urltoredirect);
				$urltoredirect = preg_replace('/action=builddoc&?/', '', $urltoredirect); // To avoid infinite loop

				header('Location: ' . $urltoredirect . '#builddoc');
				exit;
			}
		}
	}
}

// Delete file in doc form
if ($action == 'remove_file' && $permissiontodelete)
{
	if (!empty($upload_dir)) {
		require_once DOL_DOCUMENT_ROOT.'/core/lib/files.lib.php';

		$langs->load("other");
		$filetodelete = GETPOST('file', 'alpha');
		$file = $upload_dir.'/'.$filetodelete;
		$ret = dol_delete_file($file, 0, 0, 0, $object);
		if ($ret) setEventMessages($langs->trans("FileWasRemoved", $filetodelete), null, 'mesgs');
		else setEventMessages($langs->trans("ErrorFailToDeleteFile", $filetodelete), null, 'errors');

		// Make a redirect to avoid to keep the remove_file into the url that create side effects
		$urltoredirect = $_SERVER['REQUEST_URI'];
		$urltoredirect = preg_replace('/#builddoc$/', '', $urltoredirect);
		$urltoredirect = preg_replace('/action=remove_file&?/', '', $urltoredirect);

		header('Location: '.$urltoredirect);
		exit;
	}
	else {
		setEventMessages('BugFoundVarUploaddirnotDefined', null, 'errors');
	}
}

/*
 * View
 */

$formfile 	 = new FormFile($db);
$emptyobject = new stdClass($db);

$title    = $langs->trans('ListingRisksPhoto');
$help_url = 'FR:Module_DigiriskDolibarr#Listing_des_risques_photo';
$morejs   = array("/digiriskdolibarr/js/digiriskdolibarr.js.php");
$morecss  = array("/digiriskdolibarr/css/digiriskdolibarr.css");

digiriskHeader('', $title, $help_url, '', '', '', $morejs, $morecss); ?>

<div id="cardContent" value="">

<?php $res  = $object->fetch_optionals();

if (!$object->id) {
	$head = digiriskstandardPrepareHead($standard);
} else {
	$head = digiriskelementPrepareHead($object);
}

// Part to show record
dol_fiche_head($head, 'elementListingRisksPhoto', $title, -1, "digiriskdolibarr@digiriskdolibarr");

// Object card
// ------------------------------------------------------------
$width = 80; $cssclass = 'photoref';

$morehtmlref = '<div class="refidno">';
$morehtmlref .= '</div>';

if (isset($object->element_type)) {
	$morehtmlleft .= '<div class="floatleft inline-block valignmiddle divphotoref">'.digirisk_show_photos('digiriskdolibarr', $conf->digiriskdolibarr->multidir_output[$entity].'/'.$object->element_type, 'small', 5, 0, 0, 0, $width,0, 0, 0, 0, $object->element_type, $object).'</div>';
	digirisk_banner_tab($object, 'ref', '', 0, 'ref', 'ref', $morehtmlref, '', 0, $morehtmlleft);
} else {
	$morehtmlleft .= '<div class="floatleft inline-block valignmiddle divphotoref">'.digirisk_show_photos('mycompany', $conf->mycompany->dir_output.'/logos', 'small', 1, 0, 0, 0, $width,0, 0, 0, 0, 'logos', $emptyobject).'</div>';
	digirisk_banner_tab($standard, 'ref', '', 0, 'ref', 'ref', $morehtmlref, '', 0, $morehtmlleft);
}

unset($object->fields['element_type']);
unset($object->fields['fk_parent']);
unset($object->fields['last_main_doc']);
unset($object->fields['entity']);

print '<div class="fichecenter">';
print '<div class="underbanner clearboth"></div>';
print '<table class="border centpercent tableforfield">' . "\n";

// Common attributes
unset($object->fields['import_key']);
unset($object->fields['json']);
unset($object->fields['import_key']);
unset($object->fields['model_odt']);
unset($object->fields['type']);
unset($object->fields['last_main_doc']);
unset($object->fields['label']);
unset($object->fields['description']);

print '</table>';
print '</div>';

dol_fiche_end();

// Document Generation -- Génération des documents
$includedocgeneration = 1;
if ($includedocgeneration) {
	if ($object->id > 0) {
		$objref = dol_sanitizeFileName($object->ref);
		$dir_files = 'listingrisksphoto/' . $objref;
		$filedir = $upload_dir. '/' . $dir_files;
		$urlsource = $_SERVER["PHP_SELF"] . '?id=' . $object->id;
	} else {
		$dir_files = 'listingrisksphoto';
		$filedir = $upload_dir . '/' . $dir_files;
		$urlsource = $_SERVER["PHP_SELF"];
	}

	$modulepart = 'digiriskdolibarr:ListingRisksPhoto';

	print digiriskshowdocuments($modulepart,$dir_files, $filedir, $urlsource, $permissiontoadd, $permissiontodelete, $conf->global->DIGIRISKDOLIBARR_LISTINGRISKSPHOTO_DEFAULT_MODEL, 1, 0, 28, 0, '', $langs->trans('ListingRisksPhoto'), '', $langs->defaultlang, '', $listingrisksphoto);
}


// End of page
llxFooter();
$db->close();
