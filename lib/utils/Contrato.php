<?php
include_once 'ZendDate.php';
class Contrato
{

   /*
    *
    *   1.- En fecha…………………………….,    la suma de (Bs.-………………………….)
2.- En fecha 10 de febrero de 2012        la suma de (Bs.-………………………….)
3.- En fecha 10 de marzo de 2012          la suma de (Bs.-………………………….)
4.- En fecha 10 de abril de 2012             la suma de (Bs.-…………………………..)
5.- En fecha 10 de mayo de 2012           la suma de (Bs.-……………………………)
6.- En fecha 10 de junio de 2012            la suma de (Bs.-……………………………)
7.- En fecha 10 de julio de 2012              la suma de (Bs.-……………………………)
8.- En fecha 10 de agosto  de 2012        la suma de (Bs.-……………………………)
9.- En fecha 10 de septiembre de 2012, la suma de (Bs.-……………………………)
10.- En fecha 10 de octubre  de 2012    la suma de (Bs.-………………….…………)
    *
    *
    */

   static function get($contract_id, $tutor_id)
   {
      $contract = ContractPeer::retrieveByPK($contract_id);
      $student = $contract->getStudent();
      $period = $contract->getPeriod();
      $period_year = $period->getFromDate('Y');
      $current_date = ZendDate::toContract(date('Y-m-d'));
      $tutor = TutorPeer::retrieveByPK($tutor_id);
      $total_net = 0;
      $total_neto_literal = '';

      $string = self::ObtenerMensualidad($contract_id, $total_net);

      $decimales = explode('.', $total_net);

      if (!isset($decimales[1]) || $decimales[1] == 0)
      {
	      $decim = '00';
      } else {
	      $decim = $decimales[1];
      }

      // $monto_literal = $this->getLiteral().'  '.$decim.'/100 Bs';
      $total_neto_literal = self::getLiteral($total_net).'  '.$decim;

      return <<<xxx

      DOCUMENTO PRIVADO DE RECONOCIMIENTO DE DEUDA Y COMPROMISO DE PAGO

Contrato Nro: {$contract->getNro()}

Conste por el presente, un documento privado de reconocimiento de deuda y compromiso de pago, el mismo que, con firmas reconocidas y debidamente presentado por ante el competente, surtirá todos sus efectos legales; y que estará sujeto al tenor de las siguientes cláusulas:

PRIMERA: DE LAS PARTES: Son partes intervinientes en la celebración del presente documento: LA UNIDAD EDUCATIVA GABRIEL RENE  MORENO, Representada legalmente por el señor EDUARDO BALCÁZAR TASCA, portador de la Cédula de Identidad Nº 3893572 S.C.; y El señor (a) {$tutor->getFullName()}. portador de cédula de identidad Nº {$tutor->getCi()}.; todos mayores de edad y Hábiles por ley, domiciliados en esta ciudad; quienes para efectos del presente documento se denominarán: EL ACREEDOR y EL DEUDOR .

SEGUNDA: DE LA NATURALEZA JURÍDICA DEL CONTRATO: La naturaleza jurídica del presente contrato descansa en la norma prevista por el Art. 519 del Código Civil, constituyendo ley entre las partes contratantes a partir del momento de su suscripción, y tendrá la eficacia jurídica que le reconoce el Art. 1297 del mismo Código.
El contrato es otorgado y realizado en formulario impreso.

TERCERA.- DEL RECONOCIMIENTO DE DEUDA Y COMPROMISO DE PAGO: El (La) DEUDOR (a) declara que, en su condición de padres, (Tutores) del alumno (a), {$student->getFullName()}.; contratan los servicios educativos que ofrece EL ACREEDOR, para el nivel {$contract->getCursoNivelTurno()}.; que comprende la gestión escolar {$period_year}., por el precio de {$total_neto_literal} 00/100, Bolivianos, (Bs. {$total_net}.); monto de dinero que reconoce adeudar en favor del ACREEDOR, y que se compromete pagar de acuerdo al cronograma de cuotas que se detallarán en la siguiente cláusula.

CUARTA: DEL PLAN DE PAGOS: a objeto del cumplimiento de la obligación que se indica, se establece el siguiente plan de pagos:

{$string}

TOTAL COLEGIATURA ANUAL la suma de (Bs. {$total_net})
SON:({$total_neto_literal}/100 BOLIVIANOS)

QUINTA: (DE LA MORA Y DE LA FUERZA EJECUTIVA).-  En caso de que EL (La)  DEUDOR (a) incumpla en el pago de una sola cuota de las establecidas en el plan de pago en la fecha que le corresponda, constituirá en mora el total de la obligación sin necesidad de aviso judicial o de cualquier otra forma de interpelación, adquiriendo el presente documento calidad de título ejecutivo, conforme lo prevén los Arts. 486 y 487 del Código de Procedimiento Civil; facultando al ACREEDOR a iniciar la acción legal que corresponda, con cargo de intereses, costos procesales y honorarios profesionales.

SEXTA: (DE LA GARANTIA).- El (La) DEUDOR (a)  garantiza el cumplimiento de la presente obligación con la generalidad de sus bienes habidos y por haber, presentes y futuros, sin exclusión de ninguna naturaleza.

SÉPTIMA: PAGOS ANTICIPADOS Y/O PREPAGO.- Se establece que EL DEUDOR podrá en cualquier momento, proceder de manera anticipada a la cancelación parcial o total del servicio educativo adeudado por la gestión.

OCTAVA: FINALIZACION DEL CONTRATO Y DE LA DEVOLUCIÓN DE LAS CUOTAS: solo en caso de enfermedad que constituya impedimento definitivo para que el alumno cumpla con el programa de estudio de su nivel, EL ACREEDOR previa evaluación de cada caso en concreto dará por concluida la obligación contraída, y a la devolución del monto de las cuotas que hubiesen sido pagadas por adelantado hasta ese momento con el descuento por los conceptos que correspondan.

NOVENA.- (DE LA AUTORIZACION.- El (La) DEUDOR (a) autorizan a el ACREEDOR para obtener información respecto de sus obligaciones o antecedentes financieros, tributarios, comerciales, laborales o cualquier otra información vinculada, a través del acceso a servicios del Buró de Información Crediticia, a objeto de conocer la situación que presenta respecto a sus obligaciones o antecedentes financieros, tributarios, comerciales, laborales o cualquier otra información vinculada. Asimismo se autoriza expresamente a EL ACREEDOR, para que pueda intercambiar o proporcionar datos e información, derivados del desarrollo de la relación con EL ACREEDOR, o cualquier otra información, a los burós de información, empresas de cobranzas u otras personas, con la finalidad de que se facilite información o productos que puedan ser de su interés.

DÉCIMA: DEL DOMICILIO.- Para efectos de la notificación y demás actuaciones EL  (La)  DEUDOR  (a) , señala como domicilio legal el ubicado ................................................................................................................ Teléf.:................................................
En caso de cambio de domicilio El (La) DEUDOR (a) deberá informar inmediatamente al ACREEDOR mediante escrito, de no hacerlo prevalecerá el domicilio señalado, no pudiendo alegarse la nulidad de citaciones y/o notificaciones, en su caso.

DECIMA PRIMERA: CESION DE LA ACREENCIA.- Las partes convienen en que EL ACREEDOR, en cualquier tiempo podrá ceder el saldo de su acreencia a terceras personas naturales y/o jurídicas a cualquier título, pudiendo subrogar, efectuar cesión de deuda, así como transferir la cartera de deuda y/o dar en garantía la acreencia en favor de terceras personas o instituciones.

DECIMA SEGUNDA: DE LOS GASTOS.- Se deja establecido que todos los gastos económicos que demanden la escrituración, gastos notariales, etc., del presente documento correrán a cargo del DEUDOR.

DECIMA TERCERA: DE LA CONFORMIDAD.- Ambas partes conforme con todo lo anteriormente estipulado y sin que medie error ni vicios del consentimiento, acusan plena conformidad con todos los términos y cláusulas descritas en el presente documento obligándose a su fiel cumplimiento.


Montero, $current_date.






                                                   
EL ACREEDOR                                                                                               EL (LA) DEUDOR (A)
xxx;
   }






   public static function ObtenerMensualidad($contract_id, &$total)
   {
      $item_for_sales = ContractPeer::getMensualidadContracto($contract_id);

      $string = '';

      $c = 0;

      foreach ($item_for_sales as $item_for_sale)
      {
	 $c++;

	 if($c == 1)
	 {
	    $current_date = ZendDate::toContract(date('Y-m-d'));

	    $string = "$c.- En fecha {$current_date} la suma de (Bs.-  {$item_for_sale->getPrice()}) \n";
	 } else {
	    $string .= "$c.- En fecha 10 {$item_for_sale->getSales()->getNameSalesAccount()} la suma de (Bs.- {$item_for_sale->getPrice()}) \n";
	 }

	 $total += $item_for_sale->getPrice();
      }

      return $string;
   }



  public static function getLiteral($total_net)
  {
    return self::num2letras($total_net);
  }

  // aca esta la funcion que convierte el numero a literal

  /*!
    @function num2letras ()
    @abstract Dado un numero lo devuelve escrito.
    @param $num number - Numero a convertir.
    @param $fem bool - Forma femenina (true) o no (false).
    @param $dec bool - Con decimales (true) o no (false).
    @result string - Devuelve el numero escrito en letra.

  */
  public static function num2letras($num, $fem = false, $dec = false) {
  //if (strlen($num) > 14) die("El n?mero introducido es demasiado grande");
     $matuni[2]  = "dos";
     $matuni[3]  = "tres";
     $matuni[4]  = "cuatro";
     $matuni[5]  = "cinco";
     $matuni[6]  = "seis";
     $matuni[7]  = "siete";
     $matuni[8]  = "ocho";
     $matuni[9]  = "nueve";
     $matuni[10] = "diez";
     $matuni[11] = "once";
     $matuni[12] = "doce";
     $matuni[13] = "trece";
     $matuni[14] = "catorce";
     $matuni[15] = "quince";
     $matuni[16] = "dieciseis";
     $matuni[17] = "diecisiete";
     $matuni[18] = "dieciocho";
     $matuni[19] = "diecinueve";
     $matuni[20] = "veinte";
     $matunisub[2] = "dos";
     $matunisub[3] = "tres";
     $matunisub[4] = "cuatro";
     $matunisub[5] = "quin";
     $matunisub[6] = "seis";
     $matunisub[7] = "sete";
     $matunisub[8] = "ocho";
     $matunisub[9] = "nove";

     $matdec[2] = "veint";
     $matdec[3] = "treinta";
     $matdec[4] = "cuarenta";
     $matdec[5] = "cincuenta";
     $matdec[6] = "sesenta";
     $matdec[7] = "setenta";
     $matdec[8] = "ochenta";
     $matdec[9] = "noventa";
     $matsub[3]  = 'mill';
     $matsub[5]  = 'bill';
     $matsub[7]  = 'mill';
     $matsub[9]  = 'trill';
     $matsub[11] = 'mill';
     $matsub[13] = 'bill';
     $matsub[15] = 'mill';
     $matmil[4]  = 'millones';
     $matmil[6]  = 'billones';
     $matmil[7]  = 'de billones';
     $matmil[8]  = 'millones de billones';
     $matmil[10] = 'trillones';
     $matmil[11] = 'de trillones';
     $matmil[12] = 'millones de trillones';
     $matmil[13] = 'de trillones';
     $matmil[14] = 'billones de trillones';
     $matmil[15] = 'de billones de trillones';
     $matmil[16] = 'millones de billones de trillones';

     $num = trim((string)@$num);
     if ($num[0] == '-') {
        $neg = 'menos ';
        $num = substr($num, 1);
     }else
        $neg = '';
     while ($num[0] == '0') $num = substr($num, 1);
     if ($num[0] < '1' or $num[0] > 9) $num = '0' . $num;
     $zeros = true;
     $punt = false;
     $ent = '';
     $fra = '';
     for ($c = 0; $c < strlen($num); $c++) {
        $n = $num[$c];
        if (! (strpos(".,'''", $n) === false)) {
           if ($punt) break;
           else{
              $punt = true;
              continue;
           }

        }elseif (! (strpos('0123456789', $n) === false)) {
           if ($punt) {
              if ($n != '0') $zeros = false;
              $fra .= $n;
           }else

              $ent .= $n;
        }else

           break;

     }
     $ent = '     ' . $ent;
     if ($dec and $fra and ! $zeros) {
        $fin = ' coma';
        for ($n = 0; $n < strlen($fra); $n++) {
           if (($s = $fra[$n]) == '0')
              $fin .= ' cero';
           elseif ($s == '1')
              $fin .= $fem ? ' una' : ' un';
           else
              $fin .= ' ' . $matuni[$s];
        }
     }else
        $fin = '';
     if ((int)$ent === 0) return 'Cero ' . $fin;
     $tex = '';
     $sub = 0;
     $mils = 0;
     $neutro = false;
     while ( ($num = substr($ent, -3)) != '   ') {
        $ent = substr($ent, 0, -3);
        if (++$sub < 3 and $fem) {
           $matuni[1] = 'una';
           $subcent = 'as';
        }else{
           $matuni[1] = $neutro ? 'un' : 'uno';
           $subcent = 'os';
        }
        $t = '';
        $n2 = substr($num, 1);
        if ($n2 == '00') {
        }elseif ($n2 < 21)
           $t = ' ' . $matuni[(int)$n2];
        elseif ($n2 < 30) {
           $n3 = $num[2];
           if ($n3 != 0) $t = 'i' . $matuni[$n3];
           $n2 = $num[1];
           $t = ' ' . $matdec[$n2] . $t;
        }else{
           $n3 = $num[2];
           if ($n3 != 0) $t = ' y ' . $matuni[$n3];
           $n2 = $num[1];
           $t = ' ' . $matdec[$n2] . $t;
        }
        $n = $num[0];
        if ($n == 1) {
           $t = ' ciento' . $t;
        }elseif ($n == 5){
           $t = ' ' . $matunisub[$n] . 'ient' . $subcent . $t;
        }elseif ($n != 0){
           $t = ' ' . $matunisub[$n] . 'cient' . $subcent . $t;
        }
        if ($sub == 1) {
        }elseif (! isset($matsub[$sub])) {
           if ($num == 1) {
              $t = ' mil';
           }elseif ($num > 1){
              $t .= ' mil';
           }
        }elseif ($num == 1) {
           $t .= ' ' . $matsub[$sub] . '?n';
        }elseif ($num > 1){
           $t .= ' ' . $matsub[$sub] . 'ones';
        }
        if ($num == '000') $mils ++;
        elseif ($mils != 0) {
           if (isset($matmil[$sub])) $t .= ' ' . $matmil[$sub];
           $mils = 0;
        }
        $neutro = true;
        $tex = $t . $tex;
     }
     $tex = $neg . substr($tex, 1) . $fin;
     return ucfirst($tex);
  }


}
