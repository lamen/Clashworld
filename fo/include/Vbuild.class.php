<?php

/**
*	@desc View build
*	@author romain dumont
*/

	class Vbuild{

		private $_oLoad;
		private $_oSmarty;
		private $_oSession;
		private $_oLanguage;
		private $_oDbuild;

		function __construct(){
		  $this->_oLoad = new Loader();
		  //session
		  $this->_oSession = $this->_oLoad->load('Session');
		  //language
		  $this->_oLanguage = $this->_oLoad->load('Language',array('sPageName'=>'build'));
		  //smarty
		  $this->_oSmarty = $this->_oLoad->load('Smartyext');
		  //Data build
		  $this->_oDbuild = $this->_oLoad->load('Dbuild');
		  $this->_oDbuild->updateFinishedStatus($this->_oSession->getFromSession('userid'),0);
		  //Data city
		  $this->_oDcity = $this->_oLoad->load('Dcity');
		  //load the view
		  $this->_loadView();
		}

		private function _loadView(){
		
			$slang = $this->_oSession->getFromSession('lang');

			//build stats
			$this->_oSmarty->assign('aBuildStats',$this->_oDbuild->getBuildStats(false,false));
			$this->_oSmarty->assign('libellecity',$this->_oLanguage->libellecity->$slang);
			$this->_oSmarty->assign('libellebuild',$this->_oLanguage->libellebuild->$slang);
			$this->_oSmarty->assign('number',$this->_oLanguage->number->$slang);
			$this->_oSmarty->assign('buildlevel',$this->_oLanguage->level->$slang);
			$this->_oSmarty->assign('foodproduct',$this->_oLanguage->food->$slang);
			$this->_oSmarty->assign('woodproduct',$this->_oLanguage->wood->$slang);
			$this->_oSmarty->assign('ironproduct',$this->_oLanguage->iron->$slang);
			$this->_oSmarty->assign('stoneproduct',$this->_oLanguage->stone->$slang);
			$this->_oSmarty->assign('goldproduct',$this->_oLanguage->gold->$slang);
			$this->_oSmarty->assign('libelleresearch',$this->_oLanguage->libelleresearch->$slang);
			$this->_oSmarty->assign('food',$this->_oLanguage->food->$slang);
			$this->_oSmarty->assign('wood',$this->_oLanguage->wood->$slang);
			$this->_oSmarty->assign('iron',$this->_oLanguage->iron->$slang);
			$this->_oSmarty->assign('stone',$this->_oLanguage->stone->$slang);
			$this->_oSmarty->assign('gold',$this->_oLanguage->gold->$slang);
			//--

			//build select
			$this->_oSmarty->assign('select',$this->_oLanguage->select->$slang);
			$this->_oSmarty->assign('aSelectBuildLibelle',$this->_oDbuild->getSelectBuildLibelle(true,true));
			//--

			//city select
			$this->_oSmarty->assign('aSelectCityLibelle',$this->_oDcity->getSelectCityLibelle(true,true));

			//timeline
			$aUnitTimeline=$this->_oDbuild->getUnitTimeline(true,true);
			$aTimeLine=array();
			for($iI=0;$iI<count($aUnitTimeline);$iI++){

				array_push($aTimeLine,array(	'dlibellecity' => $aUnitTimeline[$iI]['libellecity'],
								'dlibellebuild' => $aUnitTimeline[$iI]['libellebuild'],
								'denddatetot' => $aUnitTimeline[$iI]['end_date_tot'],
								'denddatenext' => $aUnitTimeline[$iI]['end_date_next'],
								'dremainingsecondetot' => $this->_oDbuild->getConvertedSecond($aUnitTimeline[$iI]['seconde_rem_next'],$this->_oLanguage->finish->$slang),
								'dremainingsecondenext' => $this->_oDbuild->getConvertedSecond($aUnitTimeline[$iI]['seconde_rem_tot'],$this->_oLanguage->finish->$slang),
								'dnumber' => $aUnitTimeline[$iI]['number']
				));

			}
			$this->_oSmarty->assign('atimeline',$aTimeLine);
			$this->_oSmarty->assign('timeline',$this->_oLanguage->timeline->$slang);
			$this->_oSmarty->assign('libellecity',$this->_oLanguage->libellecity->$slang);
			$this->_oSmarty->assign('inprogress',$this->_oLanguage->inprogress->$slang);
			$this->_oSmarty->assign('cancel',$this->_oLanguage->cancel->$slang);
			$this->_oSmarty->assign('remainingtimetot',$this->_oLanguage->remainingtimetot->$slang);
			$this->_oSmarty->assign('remainingtimenext',$this->_oLanguage->remainingtimenext->$slang);
			$this->_oSmarty->assign('enddatetot',$this->_oLanguage->enddatetot->$slang);
			$this->_oSmarty->assign('enddatenext',$this->_oLanguage->enddatenext->$slang);

		}


		public function displayView(){
		  $this->_oSmarty->display('build.tpl');
		}

	}


?>
