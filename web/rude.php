<?php
/// MAIN
ini_set('display_errors', 1);
error_reporting(E_ALL);


$dirname = dirname(__FILE__);
$path[] = $dirname . DIRECTORY_SEPARATOR . '../lib/utils';
$path[] = get_include_path();
set_include_path(implode(PATH_SEPARATOR, $path));

require_once('Zend/Loader/Autoloader.php');
Zend_Loader_Autoloader::getInstance()->registerNamespace('Zend');
////// END MAIN


// DATABASE
mysql_connect('localhost', 'root', 'profesionales');
mysql_select_db('school');

function getObject($query)
{
    $rowset = array();
    $res = mysql_query($query);    
    
    while(($row = mysql_fetch_object($res)))
    {        
        $rowset[] = $row;
    }
        
    return $rowset;
}

// END DATABASE

$fileName = 'rude.pdf';
$fileName2 = 'rude2.pdf';
define('PAGE_TOP', 925);

$pdf = Zend_Pdf::load($fileName);
$font1 = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA);
$font2 = Zend_Pdf_Font::fontWithName(Zend_Pdf_Font::FONT_HELVETICA_BOLD);

unset($pdf->pages[1]);
$page = $pdf->pages[0];

function dTextSep($text, $left, $top, $sep = 12, $fontSize = 9, $charSet = 'UTF-8')
{
    $exploded = preg_split('//', $text, -1, PREG_SPLIT_NO_EMPTY);

    foreach ($exploded as $l)
    {
        dText($l, $left, $top, $fontSize, $charSet);
        $left += $sep;
    }
}


function dText($text, $left, $top, $fontSize = 9, $charSet = 'UTF-8')
{
	global $page;
	global $font1;
	
	$newTop = PAGE_TOP - $top;
	
	$page->setFont($font1, $fontSize);
        $text = utf8_encode($text);
	$page->drawText($text, $left, $newTop, $charSet);
}

function dSign($left, $top, $fontSize = 12)
{
	global $page;
	global $font2;
	
	$newTop = PAGE_TOP - $top;

	$page->setFont($font2, $fontSize);
	$page->drawText('x', $left, $newTop);
}

// consulta para obtener al estudiente del que quieren el rude
$query = "SELECT * FROM sch_student WHERE id = {$_GET['id']}";
$rowset_student = getObject($query);

$row_student = $rowset_student[0];

$year = '';
$month = '';
$day = '';

if(!empty($row_student->birth_date))
{
   $array_explode_birht_date = explode('-', $row_student->birth_date);         
   
   $year = $array_explode_birht_date[0];   
   $month = $array_explode_birht_date[1];   
   
   $array_day = explode(' ', $array_explode_birht_date[2]);
   
   $day = $array_day[0];   
}


// NRO.
dText('0001', 539, 62);

// CÓDIGO SIE DE LA UNIDAD EDUCATIVA
dText('906789032 90', 480, 84);

//unidad privada
dSign(219, 112);

//nombre del colegio
dText('Gabriel Rene Moreno', 250, 111);

// 1.3. DISTRITO EDUCATIVO
dText('DIST', 151, 129);

dText('DISTRITO EDUCATIVO', 196, 129);

// II. DATOS DE LA O EL ESTUDIANTE (Solo debe ser llenado para estudiantes nuevos en la Unidad Educativa)

//Apellido paterno
dTextSep($row_student->father_name, 83, 173, 12);

////Apellido materno
dTextSep($row_student->mother_name, 83, 189);

//nombres
dTextSep($row_student->first_name, 83, 207);

//codigo rude
dText($row_student->rude, 359, 174);

//fecha nacimiento dia
dTextSep($day, 367, 230);

//fecha nacimiento mes
dTextSep($month, 399, 230);

//fecha nacimiento anio
dTextSep($year, 433, 230);



// consulta para obtener los atributos de este estudiante
$query_attribute = "SELECT * FROM sch_attribute WHERE person_id = {$row_student->person_id}";
$rowset_attribute = getObject($query_attribute);

foreach ($rowset_attribute as $attribute)
{
    // 2.4. DOCUMENTO DE IDENTIFICACIÓN
    if($attribute->key == 'tipo_documento')
    {
        //documento ci
        if($attribute->value == 'estudiante_ci')
        {
            dSign(512	, 185);
        }

        //documento pasaporte
        if($attribute->value == 'estudiante_pasaporte')
        {
            dSign(566	, 185);
        }
    }
    
    // Nº del documento de identificación
    if($attribute->key == 'estudiante_nro_documento')
    {
       //numero documento
       dText($attribute->value, 480, 200);        
    }
    
    // 2.6. SEXO
    if($attribute->key == 'estudiante_genero')
    {
        // masculino
        if($attribute->value == 'MASCULINO')
        {
            dSign(561, 226);
        }
        
        //femenino
        if($attribute->value == 'FEMENINO')
        {
            dSign(561, 239);
        }
    }
    
    // 2.2. LUGAR DE NACIMIENTO
    // País
    if($attribute->key == 'estudiante_nacimiento_pais')
    {
        dText($attribute->value, 83, 231);        
    }
    
    // Departamento
    if($attribute->key == 'estudiante_departamento')
    {
        dText($attribute->value, 83, 250);
    }

    // Provincia    
    if($attribute->key == 'estudiante_provincia')
    {
        dText($attribute->value, 83, 267);
    }
    
    // localidad    
    if($attribute->key == 'estudiante_localidad')
    {
        dText($attribute->value, 83, 284);
    }
    
    // 2.7. CERTIFICADO DE NACIMIENTO
    // Oficialía Nº
    if($attribute->key == 'certificado_nacimiento_oficialia')
    {
        dText($attribute->value, 365, 279);
    }
    
    // Libro Nº
    if($attribute->key == 'certificado_nacimiento_libro')
    {
       dText($attribute->value, 405, 279);
    }
    
    // Partida Nº
    if($attribute->key == 'certificado_nacimiento_partida')
    {
        dText($attribute->value, 500, 279);
    }
    
    // Folio Nº
    if($attribute->key == 'certificado_nacimiento_folio')
    {
       dText($attribute->value, 544, 279); 
    }    
    
}// endforeach

// Period
// 

// consulta para obtener el contrato actual
$query_contract = "SELECT * FROM sch_contract WHERE student_id = {$_GET['id']} AND period_id = {$_GET['p']}";
$rowset_contract = getObject($query_contract);

foreach ($rowset_contract as $contract)
{
    $query_grade = "SELECT * FROM sch_grade INNER JOIN sch_contract_grade ON sch_grade.id = sch_contract_grade.grade_id WHERE sch_contract_grade.contract_id = {$contract->id} ORDER BY sch_contract_grade.id DESC LIMIT 1";
    $rowset_grade = getObject($query_grade);
    
    $grade = $rowset_grade[0];
    
    if($grade->degree_id == 1 && $grade->curso_id == 2)
    {
        // INICIAL 1
        dSign(32, 353);        
    }
    
    if($grade->degree_id == 1 && $grade->curso_id == 3)
    {
        // INICIAL 2
        dSign(47, 353);
    }        
    
    
    if($grade->degree_id == 2 && $grade->curso_id == 4)
    {
        // PRIMARIA 1
        dSign(75, 353);        
    }
    
    if($grade->degree_id == 2 && $grade->curso_id == 5)
    {
        // PRIMARIA 2
        dSign(89, 353);       
    }
    
    if($grade->degree_id == 2 && $grade->curso_id == 6)
    {
        // PRIMARIA 3
        dSign(102, 353);     
    }
    
    if($grade->degree_id == 2 && $grade->curso_id == 7)
    {
        // PRIMARIA 4
        dSign(115, 353);    
    }
    
    if($grade->degree_id == 2 && $grade->curso_id == 8)
    {
        // PRIMARIA 5
        dSign(129, 353);   
    }
    
    if($grade->degree_id == 2 && $grade->curso_id == 9)
    {
        // PRIMARIA 6
        dSign(142, 353);  
    }
    
    
    
    if($grade->degree_id == 3 && $grade->curso_id == 4)
    {
        // SECUNDARIA 1
        dSign(166, 353);        
    }
    
    if($grade->degree_id == 3 && $grade->curso_id == 5)
    {
        // SECUNDARIA 2
        dSign(179, 353);
    }
    
    if($grade->degree_id == 3 && $grade->curso_id == 6)
    {
        // SECUNDARIA 3
        dSign(194, 353);        
    }
    
    if($grade->degree_id == 3 && $grade->curso_id == 7)
    {
        // SECUNDARIA 4
        dSign(207, 353);        
    }
    
    if($grade->degree_id == 3 && $grade->curso_id == 8)
    {
        // SECUNDARIA 5
        dSign(220, 353);
    }
    
    if($grade->degree_id == 3 && $grade->curso_id == 9)
    {
        // SECUNDARIA 6
        dSign(233, 353);
    }
    
    
    // NIVELACION DE REZAGO 1
    //dSign(269, 353);

    // NIVELACION DE REZAGO 2
    //dSign(284, 353);

    // NIVELACION DE REZAGO 3
    //dSign(297, 353);

    // NIVELACION DE REZAGO 4
    //dSign(312, 353);
    
    if($grade->paralelo_id == 1)
    {
        // PARALELO A
        dSign(355, 357);
    } 
    
    if($grade->paralelo_id == 2)
    {
        // PARALELO B
        dSign(368, 357);
    }

    //// PARALELO C
    //dSign(381, 357);
    //
    //// PARALELO D
    //dSign(394, 357);
    //
    //// PARALELO E
    //dSign(408, 357);
    //
    //// PARALELO F
    //dSign(421, 357);
    //
    //// PARALELO G
    //dSign(435, 357);
    //
    //// PARALELO H
    //dSign(448, 357);
    //
    //// PARALELO I
    //dSign(460, 357);
    //
    //// PARALELO J
    //dSign(473, 357);
    //
    //// PARALELO K
    //dSign(486, 357);
    //
    //// PARALELO L
    //dSign(499, 357);

    if($grade->timetable_id == 1)
    {
        // TURNO M
        dSign(529, 353);    
    }

    if($grade->timetable_id == 2)
    {
        // TURNO T
        dSign(548, 353);
    }

    if($grade->timetable_id == 3)
    {
        // TURNO N
        dSign(567, 353);
    }
    
    // IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE (Información para uso exclusivo de la Unidad Educativa)
    $query_attribute_contract = "SELECT * FROM sch_attribute_contract WHERE sch_attribute_contract.contract_id = {$contract->id} ";
    $rowset_attribute_contract = getObject($query_attribute_contract);
    
    foreach ($rowset_attribute_contract as $attribute_contract)
    {
        // Provincia
        if($attribute_contract->key == 'estudiante_direccion_provincia')
        {            
            dText($attribute_contract->value, 105, 397);
        }
        
        //seccion
        if($attribute_contract->key == 'estudiante_direccion_session_municipio')
        {
            dText($attribute_contract->value, 105, 413);
        }
        
        //LOCALIDAD
        if($attribute_contract->key == 'estudiante_direccion_localidad_comunidad')
        {
            dText($attribute_contract->value, 105, 430);
        }
        
        //ZONA VILLA
        if($attribute_contract->key == 'estudiante_direccion_zona_villa')
        {
            dText($attribute_contract->value, 330, 397);
        }
        
        //AVENIDA CALLE
        if($attribute_contract->key == 'estudiante_direccion_avenida_calle')
        {
            dText($attribute_contract->value, 330, 413);
        }
        
        //telefono
        if($attribute_contract->key == 'estudiante_direccion_celular')
        {
            dText($attribute_contract->value, 330, 430);
        }
        
        //vivienda
        if($attribute_contract->key == 'estudiante_direccion_numero_vivienda')
        {
          dText($attribute_contract->value, 530, 430);  
        }                        
    }
    
    // V. ASPECTOS SOCIALES (Debe ser llenado por el padre, madre o tutor(a), o la o el estudiante )
    $query_question = "SELECT * FROM sch_question WHERE sch_question.contract_id = {$contract->id} ";
    $rowset_question = getObject($query_question);
    
    // 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE
    foreach ($rowset_question as $question)
    {
        // 5.1.1. ¿Cuál es el idioma que aprendió a hablar en su niñez la o el estudiante?
        if($question->question == 'idioma_nines')
        {
            //idioma_nines
            dText($question->reply, 33, 498);            
        }
        
        // ¿Qué idiomas habla frecuentemente la o el estudiante?
        if($question->question == 'idioma_habla_frecuentemente_1')
        {
            //idioma_nines 1
//            echo $question->reply;
//            exit;            
            dText($question->reply, 33, 531);            
        }
        
        if($question->question == 'idioma_habla_frecuentemente_2')
        {
//            echo $question->reply;
//            exit;            
            //idioma_nines 2
            dText($question->reply, 33, 543);            
        }
        
        if($question->question == 'idioma_habla_frecuentemente_3')
        {
//            echo $question->reply;
//            exit;
            //idioma_nines 3
            dText($question->reply, 33, 555);            
        }
        
        
        if($question->question == 'pertenece' && $question->reply == 'no_pertenece')
        {
            // no pertenece
            dSign(179, 488);            
        }
        

        if($question->question == 'pertenece' && $question->reply == 'aymara')
        {
            // pertenece (aymara)
            dSign(179, 512);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'afroboliviano')
        {
            // pertenece (afroboliviano)
            dSign(179, 496);            
        }
        
        if($question->question == 'pertenece' && $question->reply == 'araona')
        {
            // pertenece (araona)
            dSign(179, 504);            
        }
        
        if($question->question == 'pertenece' && $question->reply == 'baure')
        {
            // pertenece (baure)
            dSign(179, 520);            
        }
        
        if($question->question == 'pertenece' && $question->reply == 'besiro')
        {
            // pertenece (besiro)
            dSign(179, 527);            
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Canichana')
        {
            // pertenece (Canichana)
            dSign(179, 535);            
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Cavinenio')
        {
            // pertenece (Cavinenio)
            dSign(179, 543);            
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Cayubaba')
        {
            // pertenece (Cayubaba)
            dSign(179, 551);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Chacobo')
        {
            // pertenece (Chacobo)
            dSign(179, 558);            
        }
        
        if($question->question == 'pertenece' && $question->reply == 'chiman')
        {
            // pertenece (chiman)
            dSign(249, 488);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Eseejja')
        {        
            // pertenece (Eseejja)
            dSign(249, 496);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'guarani')
        {  
            // pertenece (guarani)
            dSign(249, 504);
        }
        
        
        if($question->question == 'pertenece' && $question->reply == 'guarasuawe')
        {
            // pertenece (guarasuawe)
            dSign(249, 512);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'guarayo')
        {
            // pertenece (guarayo)
            dSign(249, 520);
        }
         if($question->question == 'pertenece' && $question->reply == 'itonoma')
        {
            // pertenece (itonoma)
            dSign(249, 527);
        }
        if($question->question == 'pertenece' && $question->reply == 'leco')
        {
            // pertenece (leco)
            dSign(249, 535);
        }
         if($question->question == 'pertenece' && $question->reply == 'machajuyai-kallawaya')
        {
            // pertenece (machajuyai-kallawaya)
            dSign(249, 543);
        }
        if($question->question == 'pertenece' && $question->reply == 'machineri')
        {
            // pertenece (machineri)
            dSign(249, 551);
        }   
        if($question->question == 'pertenece' && $question->reply == 'maropa')
        {
            // pertenece (maropa)
            dSign(249, 558);
        }


        if($question->question == 'pertenece' && $question->reply == 'Mojenio-ignaciano')
        {
            // pertenece (Mojenio-ignaciano)
            dSign(309, 488);
        }
        if($question->question == 'pertenece' && $question->reply == 'Mojenio-trinitario')
        {
            // pertenece (Mojenio-trinitario)
            dSign(309, 496);
        }
        if($question->question == 'pertenece' && $question->reply == 'More')
        {
            // pertenece (More)
            dSign(309, 504);
        }
        if($question->question == 'pertenece' && $question->reply == 'Moseten')
        {
            // pertenece (Moseten)
            dSign(309, 512);            
        }
        if($question->question == 'pertenece' && $question->reply == 'Movima')
        {
            // pertenece (Movima)
            dSign(309, 520);
        }
        if($question->question == 'pertenece' && $question->reply == 'Tacawara')
        {
            // pertenece (Tacawara)
            dSign(309, 527);
        }
        if($question->question == 'pertenece' && $question->reply == 'Eseejja')
        {
            // pertenece (Puquina)
            dSign(309, 535);
        }
         if($question->question == 'pertenece' && $question->reply == 'Quechua')
         {
            // pertenece (Quechua)
            dSign(309, 543);
         }
         if($question->question == 'pertenece' && $question->reply == 'Siriono')
        {
            // pertenece (Siriono)
            dSign(309, 551);
        }
       if($question->question == 'pertenece' && $question->reply == 'Tacana')
        {
            // pertenece (Tacana)
            dSign(309, 558);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Tapiete')
        {
            // pertenece (Tapiete)
            dSign(362, 488);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Toromona')
        {
            // pertenece (Toromona)
            dSign(362, 496);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Uru-chipaya')
        {
            // pertenece (Uru-chipaya)
            dSign(362, 504);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Weenhayek')
        {
            // pertenece (Weenhayek)
            dSign(362, 512);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Yaminawa')
        {
            // pertenece (Yaminawa)
            dSign(362, 520);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Yuki')
        {
            // pertenece (Yuki)
            dSign(362, 527);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Eseejja')
        {
            // pertenece (Yuracare)
            dSign(362, 535);
        }
        
        if($question->question == 'pertenece' && $question->reply == 'Eseejja')
        {
            // pertenece (Zamuco)
            dSign(362, 543);
        }
            
        if($question->question == 'pertenece' && $question->reply == 'Eseejja')
        {
            // pertenece (Otro)
            dText('otros', 324, 557);
        }
        
        if($question->question == 'hospital' && $question->reply == 1 )
        {
            // hospital (si)
            dSign(542, 480);
        }
        
        if($question->question == 'hospital' && $question->reply == 2 )
        {
            // hospital (no)
            dSign(569, 480);  
        }
        
        if($question->question == 'hospital_veces' && $question->reply == 'veces_1_a_2' )
        {
            // hospital_veces (1 a 2 veces)
            dSign(420, 500);
        }
        
        if($question->question == 'hospital_veces' && $question->reply == 'veces_3_a_5' )
        {
            // hospital_veces (3 a 5 veces)
            dSign(468, 500);
        }
        
        if($question->question == 'hospital_veces' && $question->reply == 'veces_6_mas' )
        {
            // hospital_veces (6 o mas veces)
            dSign(525, 500);
        }
        
        if($question->question == 'hospital_veces' && $question->reply == 'ninguna' )
        {
            // hospital_veces (ninguno)
            dSign(563, 500);
        }
        
        if($question->question == 'discapacidad_sensorial' && $question->reply == 'si' )
        {
            // discapacidad_sensorial (si)
            dSign(444, 528);
        }
        
        if($question->question == 'discapacidad_motriz' && $question->reply == 'si' )
        {
            // discapacidad_motriz (si)
            dSign(444, 537);
        }
        
        if($question->question == 'discapacidad_mental' && $question->reply == 'si' )
        {
            // discapacidad_mental (si)
            dSign(444, 546);
        }
        
        if($question->question == 'discapacidad_sensorial' && $question->reply == 'no' )
        {
            // discapacidad_sensorial (no)
            dSign(483, 528);
        }
        
        if($question->question == 'discapacidad_motriz' && $question->reply == 'no' )
        {
            // discapacidad_motriz (no)
            dSign(483, 537);
        }
        
        if($question->question == 'discapacidad_mental' && $question->reply == 'no' )
        {
            // discapacidad_mental (no)
            dSign(483, 546);
        }
        
         // origen_discapacidad
        
        if($question->question == 'caneria_red')
        {
            //Cañería de red
            dSign(127, 589);
        }
        
        if($question->question == 'pileta_publica')
        {
            //Pileta pública
            dSign(127, 599);            
        }
        
        if($question->question == 'carro_repartidor')
        {
          //Carro repartidor (aguatero)
          dSign(127, 607);  
        }
        
        if($question->question == 'pozo')
        {
            // Pozo (con o sin bomba)
            dSign(127, 615);            
        }
        
        if($question->question == 'rio_vertiente')
        {
            // Río, vertiente, acequia, lago, laguna, curiche
            dSign(127, 625);            
        }
        
        if($question->question == 'otra')
        {
           // otra
            dSign(127, 640);  
        }
        
        // ¿La o el estudiante tiene energía eléctrica en su vivienda?
        if($question->question == 'energia_electrica' && $question->reply == 'si')
        {
            // SI
            dSign(107, 663);
        }
        
        if($question->question == 'energia_electrica' && $question->reply == 'no')
        {
            // NO
            dSign(132, 663);
        }
        
        // El baño, water o letrina de su casa tiene desagüe a:
         
        if($question->question == 'bano' && $question->reply == 'alcantarillado')
        {
            // Alcantarillado
            dSign(105, 688);
        }
        
        if($question->question == 'bano' && $question->reply == 'camara_septica')
        {
           // Cámara séptica
            dSign(105, 698); 
        }
        
        if($question->question == 'bano' && $question->reply == 'pozo_ciego')
        {
            // Pozo ciego
            dSign(105, 706);
        }        
        
        if($question->question == 'bano' && $question->reply == 'calle')
        {
            // A la calle
            dSign(105, 714);
        }
        
        if($question->question == 'bano' && $question->reply == 'quebrada_rio')
        {
            // A quebrada, río lago laguna, curiche 
            dSign(105, 724);
        }
        
        //  ¿Realizó la o el estudiante en los últimos 3 meses alguna de las siguientes actividades?
        if($question->question == 'trabajo' && $question->reply == 'agricultura_agroindustria')
        {
            // Trabajó en agricultura o agroindustria
            dSign(323, 599);
        }
        
        if($question->question == 'trabajo' && $question->reply == 'familiares_agricultura_ganaderia')
        {
            // Ayudó a familiares en agricultura o ganadería
            dSign(323, 607);            
        }
        
        if($question->question == 'trabajo' && $question->reply == 'labores_domesticas_ventas')
        {
            // Ayudó en el hogar en labores domésticas, comercio o ventas
            dSign(323, 617);            
        }
        
        if($question->question == 'trabajo' && $question->reply == 'trabajadora_del_hogar')
        {
            // Trabajó como trabajadora del hogar o niñera
            dSign(323, 625);            
        }
        
        if($question->question == 'trabajo' && $question->reply == 'mineria')
        {
            // Trabajó en minería
            dSign(323, 635);            
        }
        
        if($question->question == 'trabajo' && $question->reply == 'construccion')
        {
            // Trabajó en construcción
            dSign(323, 643);            
        }
        
        if($question->question == 'trabajo' && $question->reply == 'transporte_publico')
        {
            // Trabajó en transporte público
            dSign(323, 653);
        }
        
        if($question->question == 'trabajo' && $question->reply == 'otro_trabajo')
        {
            // Otro trabajo
            dSign(323, 663);
        }
        
        if($question->question == 'trabajo' && $question->reply == 'no_trabajo')
        {
           // No trabajó
           dSign(323, 671); 
        }
        
        if($question->question == 'cuantos_dias_trabajo')
        {
            //  La semana pasada ¿Cuántos días trabajó o ayudó a la familia la o el estudiante?
            dText($question->reply, 165, 699);            
        }                
        
        
        // ¿Recibió algún pago por el trabajo realizado?
        if($question->question == 'recibio_pago' && $question->reply == 'si')
        {
            // si
            dSign(234, 724);
            
        }
        
        if($question->question == 'recibio_pago' && $question->reply == 'no')
        {
            // no
            dSign(258, 724);            
        }
        
        
        //  La o el estudiante accede a internet en:
        if($question->question == 'accede_internet' && $question->reply == 'domicilio')
        {
            // Su domicilio
            dSign(424, 599);
        }  
        
        if($question->question == 'accede_internet' && $question->reply == 'unidad_educativa')
        {
          // En la Unidad Educativa
          dSign(424, 609);  
        }
        
        if($question->question == 'accede_internet' && $question->reply == 'lugares_publicos')
        {
            // Lugares públicos
            dSign(424, 619);
        }
        
        if($question->question == 'accede_internet' && $question->reply == 'no_accede')
        {
            // No accede a internet
            dSign(424, 629);            
        }
        
        
        //  . ¿Con qué frecuencia la o el estudiante accede a internet?
        if($question->question == 'frecuencia_internet' && $question->reply == 'diariamente')
        {
            // Diariamente
            dSign(412, 672);
        }
        
        if($question->question == 'frecuencia_internet' && $question->reply == 'mas_1_semana')
        {
           // Más de una vez a la semana
           dSign(412, 688); 
        }
        
        if($question->question == 'frecuencia_internet' && $question->reply == 'una_mes')
        {
            // Una vez al mes o menos
            dSign(412, 706);
        }
        
        
        // ¿Cómo llega la o el estudiante a la Unidad Educativa?
        if($question->question == 'transporte' && $question->reply == 'a_pie')
        {
            // A pie
            dSign(557, 599);
        }
        
        if($question->question == 'transporte' && $question->reply == 'transporte_terrestre')
        {
            // En vehículo de transporte terrestre
            dSign(557, 611);            
        }
        
        if($question->question == 'transporte' && $question->reply == 'otro_medio')
        {
            // Otro medio
            dText($question->reply, 495, 632);
        }
        
        // En el medio de transporte señalado ¿Cuál es el tiempo máximo que demora en llegar de su casa a la Unidad Educativa o viceversa?
        
        if($question->question == 'tiempo_transporte' && $question->reply == 'menos_media_hora')
        {
            // Menos de media hora
            dSign(546, 689);
        }
        
        if($question->question == 'tiempo_transporte' && $question->reply == 'entre_media_hora_y_una')
        {
            // Entre media hora y una hora
            dSign(546, 699);            
        }               
        
        if($question->question == 'tiempo_transporte' && $question->reply == 'entre_una_a_dos_hora')
        {
            // Entre una a dos horas
            dSign(546, 709);
        }
        
        if($question->question == 'tiempo_transporte' && $question->reply == 'dos_hora_o_mas')
        {
            // Dos horas o más
            dSign(546, 721);
        }
        
    }    
    
    // footer    
    // Lguar de firma del formulario
    dText($contract->city, 80, 855);    
    
    // dividir fecha
    $record_date_year = '';
    $record_date_month = '';
    $record_date_day = '';

    if(!empty($contract->record_date))
    {
       $array_explode_record_date = explode('-', $contract->record_date);         

       $record_date_year = $array_explode_record_date[0];   
       $record_date_month = $array_explode_record_date[1];   

       $array_day = explode(' ', $array_explode_record_date[2]);

       $record_date_day = $array_day[0];   
    }
    
    // Fecha de registro
    // Dia
    dText($record_date_day, 345, 855);

    // Mes
    dText($record_date_month, 400, 855);

    // Anio
    dText($record_date_year, 456, 855);        

}// endforeach

//codigo SIE
//dTextSep('76548713', 105, 307);

// VI. DATOS DEL PADRE, MADRE O TUTOR (a) DE LA O EL ESTUDIANTE
// 6.1. DATOS DEL PADRE O TUTOR (a)
$query_tutor_p = "SELECT * FROM sch_tutor
INNER JOIN sch_student_tutor ON sch_tutor.id = sch_student_tutor.tutor_id
WHERE sch_student_tutor.student_id = {$row_student->id} AND sch_tutor.type_tutor_id > 1 ORDER BY sch_tutor.id LIMIT 1";
$rowset_tutor_p = getObject($query_tutor_p);
$tutor_p = $rowset_tutor_p[0];

// Cédula de Identidad
dText($tutor_p->ci, 121, 766);

// Apellidos
dText($tutor_p->father_name.' '.$tutor_p->mother_name, 121, 779);

// Nombre(s)
dText($tutor_p->first_name, 121, 790);

// Idioma que habla frecuentemente
dText($tutor_p->languaje, 121, 803);

// Ocupación laboral actual
dText($tutor_p->occupation, 121, 816);

// Mayor grado de instrucción alcanzado
dText($tutor_p->degree, 121, 828);

//// En caso de tutor(a) ¿Cuál es el parentesco?
//dText($tutor_m->ci, 137, 841);


// 6.2. DATOS DE LA MADRE
// consulta para obtener el tutor madre de este estudiante
$query_tutor_m = "SELECT * FROM sch_tutor 
INNER JOIN sch_student_tutor ON sch_tutor.id = sch_student_tutor.`tutor_id`
WHERE sch_student_tutor.`student_id` = {$row_student->id} AND sch_tutor.`type_tutor_id` = 1 ORDER BY sch_tutor.id LIMIT 1";

$rowset_tutor_m = getObject($query_tutor_m);
$tutor_m = $rowset_tutor_m[0];

// Cédula de Identidad
dText($tutor_m->ci, 416, 768);

// Apellidos
dText($tutor_m->father_name.' '.$tutor_m->mother_name, 416, 779);

// Nombre(s)
dText($tutor_m->first_name, 416, 794);

// Idioma que habla frecuentemente
dText($tutor_m->languaje, 416, 807);

// Ocupación laboral actual
dText($tutor_m->occupation, 416, 820);

// Mayor grado de instrucción alcanzado
dText($tutor_m->degree, 416, 833);


// Update the PDF document
#$pdf->save($fileName2);
$pdfData = $pdf->render();


header('Content-type: application/pdf');
#readfile($fileName2);
echo $pdfData;