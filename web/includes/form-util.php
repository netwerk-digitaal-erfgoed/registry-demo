<?php

$selects=array();

function echo_datasetfields($screen) {
	global $datasetfields;
	
	echo '<table class="table">';
	foreach($datasetfields as $datasetfield) {
		if (isset($datasetfield["screen"]) && $datasetfield["screen"]==$screen) {
			echo field($datasetfield);
		}
	}
	echo '</table>';
}

function echo_datasetscript() {
	global $datasetscript,$select,$datasetfields,$distributionfields,$contactPointfields;
	
	echo 'var selects=["'.join('","',$select).'"];'."\n";
	echo 'var pluss={};'."\n";
	
	foreach($datasetfields as $datasetfield) {
		if (isset($datasetfield["multiple"]) && $datasetfield["multiple"]==1) {
			echo 'pluss["id_'.$datasetfield["id"].'"]=0;'."\n";
		}
	}
	foreach($distributionfields as $distributionfield) {
		if (isset($distributionfield["multiple"]) && $distributionfield["multiple"]==1) {
			echo 'pluss["id_'.$distributionfield["id"].'"]=0;'."\n";
		}
	}
	
	echo $datasetscript;

	# examples
	
	echo 'function fill_with_example_data() {';
	
	foreach(array_merge($datasetfields,$contactPointfields,$distributionfields) as $field) {
		if (isset($field["example"])) {
			if(isset($field["radio"])) {
				
				echo '$(\'input:radio[name="id_'.$field["id"].'"]\').filter(\'[value="'.$field["example"].'"]\').attr(\'checked\', true);';
			
			} else {
				echo '$("#id_'.$field["id"];
				if (isset($field["multiple"]) && $field["multiple"]==1) { echo '_0'; }
				echo '").val("';
				echo $field["example"];
				echo '");';
				if (isset($field["select"])) {
					
				}
				if (isset($field["select"])) {
					echo '$("#id_'.$field["id"];
					if (isset($field["multiple"]) && $field["multiple"]==1) { echo '_0'; }
					echo '").trigger("chosen:updated");';
				}
			}
		}
	}

	echo '}';
		
}

function echo_script_jsonld_dcat() {
	global $datasetfields,$distributionfields;

	echo 'var dataset={};'."\n";
	echo 'dataset["@type"]="dcat:Dataset";'."\n";
	foreach($datasetfields as $datasetfield) {
		if (isset($datasetfield["script_dcat"])) {
			echo $datasetfield["script_dcat"]."\n";
		}
	}
	
	echo 'dataset["dcat:distribution"]=[];'."\n";
    echo 'if ($("#id_distribution_0_accessURL").val()) {'."\n";   # id_distribution_0_accessURL
	echo 'var dataset_idx=0;'."\n";
	echo 'while ($("#id_distribution_"+dataset_idx+"_accessURL").val()) {'."\n";

	echo 'var distribution={};'."\n";
	echo 'distribution["@id"]="_:"+uuidv4();'."\n";
	echo 'distribution["@type"]="dcat:Distribution";'."\n";
	
	foreach($distributionfields as $distributionfield) {
		if (isset($distributionfield["script_dcat"])) {
			echo $distributionfield["script_dcat"]."\n";
		}
	}

	echo 'dataset["dcat:distribution"][dataset_idx]={};'."\n";
	echo 'dataset["dcat:distribution"][dataset_idx]["@id"]=distribution["@id"];'."\n";
	echo 'dcat["@graph"].push(distribution);'."\n";
	echo 'dataset_idx++;'."\n";
	echo '}'."\n";
	echo '}'."\n";
	
	echo 'dcat["@graph"].push(dataset);'."\n";
}


function echo_script_jsonld_schema() {
	global $datasetfields,$distributionfields;

	echo 'var schema = {};';
	echo 'schema["@context"] = "http://schema.org/";';
	echo 'schema["@type"] = "Dataset";';
	
	foreach($datasetfields as $datasetfield) {
		if (isset($datasetfield["script_schema"])) {
			echo $datasetfield["script_schema"]."\n";
		}
	}
	
	echo 'schema["distribution"]=[];'."\n";
	
    echo 'if ($("#id_distribution_0_accessURL").val()) {'."\n";
	echo 'var dataset_idx=0;'."\n";
	echo 'while ($("#id_distribution_"+dataset_idx+"_accessURL").val()) {'."\n";

	echo 'var distribution={};'."\n";
	echo 'distribution["@type"]="DataDownload";'."\n";
	
	foreach($distributionfields as $distributionfield) {
		if (isset($distributionfield["script_schema"])) {
			echo $distributionfield["script_schema"]."\n";
		}
	}

	echo 'schema["distribution"].push(distribution);'."\n";
	echo 'dataset_idx++;'."\n";
	echo '}'."\n";
	echo '}'."\n";
	
}

function field($field,$class="") {
	if ($class!="" && !isset($field["class"])) { $field["class"]=$class; }
	
	switch ($field["range"]) {
		case "bcp47:language":
		case "overheid:taxonomiebeleidsagenda":
		case "overheid:license":
		case "DONL:License": 
		case "dcat:mediaType":
		case "mdr:filetype":		
		case "donl:authority": return field_waardelijst($field);  break;
		
		case "vcard:identifier": 
		case "schema:isBasedUrl":
		case "xsd:anyURI" :return field_xsd_anyURI($field); break;

		case "vcard:fn": 
		case "vcard:hasEmail":
		case "xml:string": return field_xml_string($field); break;
		
	
		case "vcard:Individual or vcard:Organization": return field_vcard_organisation($field); brea;
		
		
		case "vcard:Kind": return field_vcard_Kind($field); break;
		case "foaf:Agent": return field_foaf_Agent($field); break;
		
		case "xsd:date": 
		case "xsd:datetime": return field_xsd_date($field); break;

		case "dcat:Distribution": 
		case "schema:DataDownload": return field_Distribution($field); break;
		
		default: error_log("field ".$field["range"]." not defined"); break;
	}
}

function field_xsd_anyURI($field) {
	return field_xml_string($field);
}

function field_xsd_date($field) {
	return field_xml_string($field);
}

function field_foaf_Agent($field) {
	return field_xml_string($field);
}

function field_xml_string($field) {
	global $datasetscript;
	$str='<tr ';
	if (isset($field["class"])) {
		$str.='class="'.$field["class"].'"';
	}
	$str.='><th>';
	
	$id='id_'.$field["id"];
	if (isset($field["multiple"]) && $field["multiple"]==1) {
		$id='id_'.$field["id"].'_0';
		$str.='<span onclick="plus(\''.$id.'\')" class="btn btn-success btn-sm float-right" id="plus_'.$field["id"].'"><i class="fas fa-plus"></i></span>';
	}	
	$str.='<label title="'.$field["title"].' ('.$field["range"].')" for="'.$id.'"';
	if (isset($field["mandatory"]) && $field["mandatory"]==1) {
		$str.=' class="mandatory"';
	}
	$str.='>';
	if (isset($field["property_uri"]) && substr($field["property_uri"],0,6)=="schema") {
		$str.='<a target="schema" href="https://schema.org/'.substr($field["property_uri"],7).'">';
		$str.=$field["label"];
		$str.='</a>';
	} else {
		$str.=$field["label"];
	}

	$str.='</label>';

	$str.='</th><td id="val_'.$id.'">';
	if (isset($field["multiple"]) && $field["multiple"]==1) { $str.='<span class="multi">'; } 
	
	if (isset($field["large"])) {
		$str.='<textarea rows="5" ';
		$str.='class="form-control dsra"'; 

	} else {
		$str.='<input ';
		if ($field["range"]=="xsd:anyURI") {
			$str.='type="url" ';
		}
		if ($field["range"]=="xsd:date") {
			$str.='type="date" ';
		}
		if ($field["range"]=="xsd:datetime") {
			$str.='type="datetime-local" ';
		}	
		if ($field["range"]=="vcard:hasEmail") {
			$str.='type="email" ';
		}
		$str.='class="form-control"'; 
	}
	$str.=' id="'.$id.'" name="'.$field["property_uri"].'"'; 

	if (isset($field["mandatory"]) && $field["mandatory"]==1) {	
		$str.=' required ';
	}
	
	if (isset($field["large"])) {
		$str.='></textarea>';
	} else {
		$str.='value="">';
	}
	
	if (isset($field["lang"]) && $field["lang"]==1) {
		$str.=' <select data-placeholder="'.t('Maak een keuze uit de lijst').'" id="id_'.$field["id"].'_0_lang"><option value="nl">'.t('Nederlands').'</option><option value="en">'.t('Engels').'</option><option value="de">'.t('Duits').'</option><option value="fr">'.t('Frans').'</option></select>';
	}
	
	if (isset($field["multiple"]) && $field["multiple"]==1) { $str.='</span>'; } 
	$str.='</td></tr>';
	
	return $str;
}

function waardenlijst($name) {
	$str='';
	if (file_exists(__DIR__."/waardenlijsten/$name.json")) {
		$waardenlijst=file_get_contents(__DIR__."/waardenlijsten/$name.json");
		$waardenlijst_json=json_decode($waardenlijst,true);
		ksort($waardenlijst_json);
		foreach($waardenlijst_json as $id=>$val) {
			if (isset($waardenlijst_json[$id]) && isset($waardenlijst_json[$id]['labels']) && isset($waardenlijst_json[$id]['labels'][LANGUAGE])) {
				$str.='<option value="'.$id.'">'.$waardenlijst_json[$id]['labels'][LANGUAGE].'</option>'; # 
			} else {
				if (isset($val["id"]) && isset($val["title"])) {
					$str.='<option value="'.$val["id"].'">'.$val["title"].'</option>'; # 
				}
			}
		}
	} else {
		error_log("File ".__DIR__."/waardenlijsten/$name.json is missing");
	}
	return $str;
}

function field_waardelijst($field) {
	global $select;
	
	$str='<tr '.(isset($field["class"])?'class="'.$field["class"].'"':'').'><th>';
	
	$id='id_'.$field["id"];
	if (isset($field["multiple"]) && $field["multiple"]==1) {
		$id='id_'.$field["id"].'_0';
		$str.='<span onclick="plus(\''.$id.'\')" class="btn btn-success btn-sm float-right" id="plus_'.$id.'"><i class="fas fa-plus"></i></span>';
	}
	$str.='<label title="'.$field["title"].'" for="id_'.$id.'"';
	if (isset($field["mandatory"]) && $field["mandatory"]==1) {
		$str.=' class="mandatory"';
	}
	$str.='>';
	if (isset($field["property_uri"]) && substr($field["property_uri"],0,6)=="schema") {
		$str.='<a target="schema" href="https://schema.org/'.substr($field["property_uri"],7).'">';
		$str.=$field["label"];
		$str.='</a>';
	} else {
		$str.=$field["label"];
	}
	$str.='</label>';
	
	$str.='</th><td id="val_'.$id.'">'; 
	if (isset($field["multiple"]) && $field["multiple"]==1) { $str.='<span class="multi">'; }

	$str.='<select data-placeholder="'.t('Maak een keuze uit de lijst').'" id="'.$id.'" class="form-control"><option></option>'; # ('.$field["range"].')  $field["title"].' - '.
	$str.=waardenlijst($field["select"]);
	$str.='</select>';
	
	if (isset($field["multiple"]) && $field["multiple"]==1) { $str.='</span>'; }
	$str.='</td></tr>';
	
	$select['id_'.$field["id"]]=$id;
	return $str;
}

function field_vcard_organisation($field) {
	$str='<tr class="'.$field['class'].'"><th><label title="'.$field['title'].'" for="'.$field['id'].'">'.$field['label'].'</label></th><td>';
	foreach ($field['radio'] as $radio) {
		$str.='<input name="id_'.$field['id'].'" type="radio" value="'.$radio['value'].'"> '.$radio['label'].' '; # '_'.$radio['id'].
	}
	$str.='</td></tr>';
	return $str;
}

function field_vcard_Kind($field) {
	global $contactPointfields;
	
	$str ='<tr class="vcard"><th colspan="2">'.$field["label"].'</th></tr>';
	foreach($contactPointfields as $contactPointfield) {
		$str.=field($contactPointfield);
	}
	
	return $str;
}
	

function field_Distribution($field) {
	global $distributionfields,$datasetscript;
	$str ='<tr class="distribution"><th colspan="2">';
	
	$str.='<label title="'.$field["title"].'"';
	if (isset($field["mandatory"]) && $field["mandatory"]==1) {
		$str.=' class="mandatory"';
	}
	$str.='>';
	if (isset($field["property_uri"]) && substr($field["property_uri"],0,6)=="schema") {
		$str.='<a target="schema" href="https://schema.org/'.substr($field["property_uri"],7).'">';
		$str.=$field["label"];
		$str.='</a>';
	} else {
		$str.=$field["label"];
	}
	$str.='</label>';
	
	$field["label"];
	$str.='<span class="btn btn-success btn-sm float-right" id="plus_'.$field["id"].'"><i class="fas fa-plus"></i></span>';
	$str.='</th></tr>';

	$rows='';
	foreach($distributionfields as $distributionfield) {
		$rows.=field($distributionfield,'distribution');
	}
	$str.=$rows;

	$datasetscript.='distribution_html="'.str_replace('"','\"',$rows).'";';
	$datasetscript.='$("#plus_'.$field["id"].'").on("click", function() { ';
	$datasetscript.='pluss["id_'.$field["id"].'"]++;';
	$datasetscript.='pluss["id_distribution_"+pluss["id_'.$field["id"].'"]+"-dct_title"]=0; pluss["id_distribution_"+pluss["id_'.$field["id"].'"]+"-dct_description"]=0;';
	$datasetscript.='$(distribution_html.replace(/distribution_0/g,"distribution_"+pluss["id_'.$field["id"].'"])).insertAfter($(\'[class^="distribution"]\').last());';
	
	foreach($distributionfields as $distributionfield) {
		if (isset($distributionfield["select"])) {
				if (isset($distributionfield["multiple"]) && $distributionfield["multiple"]==1) {
					$id=str_replace('distribution_0','distribution_"+pluss["id_'.$field["id"].'"]+"',$distributionfield["id"]).'_0';
				} else {
					$id=str_replace('distribution_0','distribution_"+pluss["id_'.$field["id"].'"]+"',$distributionfield["id"]);
				}
				$datasetscript.='$("#id_'.$id.'").chosen({width: "100%"});';
		}
	}
	
	$datasetscript.='$("label").tooltip({placement:"right"});';
	$datasetscript.='})'."\n";

	return $str;
}	