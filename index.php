<?php
    include "common.php";
    include "set.php";
    include "ifc.php";
    include "ifccanv_.php";
?>
<!doctype html>
<html style='font-size:16px;' lang="uk-UA">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="ajax.js" type="text/javascript"></script>
	<link rel="stylesheet" href="ifctree.css">
	<script type="text/javascript">
        window.cnvst = [];
		/**/
        function canvBtnClick(xBtn) {
            let xCnv = xBtn.closest('.canvas');
            let idcanv = xCnv.getAttribute('idcanv');
            let idcurs = xCnv.querySelector('.canvas_item[selected=true]').getAttribute('idcurs');
            let pkeys = xCnv.querySelector('.canvas_item[selected=true] .pkwarp').getAttribute('pkeys');
            let pkval = xCnv.querySelector('.canvas_item[selected=true] .pkwarp .cursRow[selected=true]').getAttribute('pkval');
            let mode = xBtn.getAttribute('btn');
            //alert(xBtn.getAttribute('btn') + `; idcanv=${idcanv}; idcurs=${idcurs}; keys=${pkeys}; val=${pkval}`);
            /**/
            let nForm = document.createElement('div');
            nForm.className = 'form_wall';

            let myGet;
            myGet = `ifcform.php?mode=${mode}&idcanv=${idcanv}&idcurs=${idcurs}&keys=${pkeys}&pkval=${pkval}`;

            document.body.append(nForm);
            ajaxGet2(nForm, myGet);

		}
		/**/
		function nextCanv(nCnv, from) {
            from.closest('.canvas').style.display = 'none';
			let nCanv = document.createElement('div');
			nCanv.className = 'canvas';
			nCanv.setAttribute('idcanv', nCnv);
			//
            ajaxGet2(nCanv,`ifccanv.php?idcanv=${nCnv}`);

            window.cnvst.push(from.closest('.canvas'));
			document.body.append(nCanv);
		}
		/**/
		function quitCanv(from) {
		    from.closest('.canvas').remove();
		    window.cnvst.pop().style.display = 'flex';
		}
		/**/
        function quitForm(from) {
            from.closest('.form_wall').remove();
            //window.cnvst.pop().style.display = 'flex';
        }
		/**/
		function setCurRow(xRow) {
			let xRows = xRow.closest('.pkwarp').querySelectorAll('.cursRow');
			for(let p of xRows) {
				p.setAttribute('selected', 'false');
			}
			xRow.setAttribute('selected', true);

			let xCanvItms = xRow.closest('.canvas').querySelectorAll('.canvas_item');
            let xCanvID = xRow.closest('.canvas').getAttribute('idcanv');
            for(let p of xCanvItms) {
				p.setAttribute('selected', 'false');
			}
			xRow.closest('.canvas_item').setAttribute('selected', 'true');
////////////////////////////////////////////////////////////////////////
			let pKeys = xRow.closest('.pkwarp').getAttribute('pkeys');
			let pkVal = xRow.getAttribute('pkval');
			let thisIs = xRow.closest('.canvas_item').getAttribute('idcurs');
//childs = '';
			for(let xcItm of xCanvItms){
				if(xcItm.getAttribute('parent') === thisIs) {
				    let curs = xcItm.getAttribute('idcurs'); //Target //Что перерисовать...
				    let ctype= 'ifc' + xcItm.getAttribute('ctype'); //&ctype=${ctype}
				    ajaxGet2(xcItm.querySelector('.pkwarp'), 
					 `${ctype}.php?pkeys=${pKeys}&pkval=${pkVal}&curs=${curs}&idcanv=${xCanvID}`);
			    }
			}
            event.stopPropagation();
			/**/
		}
	</script>
    <link rel="stylesheet" href="reset.css">
	<style>
        html, body, .canvas {
             height:100%;
             font-style: normal 12px "Segoe UI", Arial, Sans-serif;
        }
        html, body, .canvas, .canvas_row {
             margin:0px; padding:0px;
        }
        .canvas, .canvas_rows {
            display: flex;
            flex-direction: column;
        }
        .canvas_cols {
            display: flex;
            flex-direction: row;
        }
        .canv_btn   {
            display: flex;
            margin:0; 
            padding:0; 
            width: 60px;
            height: 60px;
            /* onClick: */
        }
        .canv_btn img {
            display: block;
            margin: auto;
        }
        .canv_btn figcaption {text-align: center; /* подпись по центру*/}
        .canv_btn .btn-wrapper {
            display: flex;
            justify-content: 
        }
        .canvas_item		{ border:2px solid green; overflow:auto; }
        .canvas_item[selected=true] { border:2px solid red; }

        .table { display:table; white-space:nowrap; }
	.icons { display:flex; justify-content: space-around; flex-wrap: wrap;}
	.icon { max-height:100px; width: 100px; overflow: hidden; border: dotted 1px green; }	/*old*/

	.row {display:table-row; }/*old*/
	.canvas_item[ctype='grid'] .cursRow {display:table-row; }
	.canvas_item/*[ctype='grid']*/ .cursRow[selected=true] { background: lightblue;}
	.canvas_item[ctype='icons'] .cursRow { width: 100px; overflow: hidden; border: dotted 1px green; }

	
        /*.cell                    { display:table-cell; border:1px solid black; padding: 0 2px;}*/
	div.table div.cursRow span { display:table-cell; border:1px solid black; padding: 0 2px; }
    .form_wall{
        background: rgba(200, 200, 200, 0.9);
        border: 3px solid yellow;
        left: 1em; top: 1em; right: 1em; bottom: 1em;
    }
    .form{
        margin:auto;
        border:3px solid green;
        opacity:1.0;
        background:yellow;
        width: 20em;
        top: 1em; left: 0; right: 0;
    }
	</style>
    <title>#!/bin/ls</title>
</head>
<body>
  <!--p>
    <label>
      <input list="cursor" name="tsttxt" id="tsttxt"
             oninput="ajaxGet('cursor', 'keyval.php');">
    </label>
    <datalist id="cursor"></datalist>
  </p>
<hr-->

<?php
	if (!$ACC->isLog()) {
        //echo  "(-)SID = $ACC->sesId; UID = $ACC->userId;";
		runForm('flogin');
	} else {
        //echo  "(+)SID = $ACC->sesId; UID = $ACC->userId;";
		echoCanv('main');
		//runCanv('main');
		//runCanv('interf');
		//echoCanv2('dmzx');
	}
?>
</body>
</html>